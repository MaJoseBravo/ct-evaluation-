<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Address;
use App\Models\Identification;
use App\Models\Invoice;

class Generic extends Controller
{
    public function index()
    {
        return 'now dev do your thing';
    }

    public function q1()
    {
        $randArr = [];

        for($i = 0; $i < 100; ++$i){
            array_push(
                $randArr,
                rand(0, 1) ? 
                    rand() : 
                    substr(md5(rand()), 0, 5)
            );
        }

        return $randArr;
    }

    public function q2()
    {
        $randArr = $this->q1();
        $numbers = array_values(array_filter($randArr, 'is_integer')); 
        $strings = array_values(array_filter($randArr, 'is_string'));

        return compact('randArr','numbers', 'strings');
    }

    public function q3()
    {
        $ansQ2 = $this->q2();
        $numbers = $ansQ2['numbers'];
        $sum = array_sum($numbers);

        return compact('numbers', 'sum');
    }

    public function q4()
    {
        $ansQ2 = $this->q2();
        $strings = $ansQ2['strings'];
        $sorted_strings = array_values($strings);
        sort($sorted_strings, SORT_STRING);

        return compact('strings', 'sorted_strings');
    }

    public function q5()
    {
        $url = 'http://developers.ctdesarrollo.org/triofrio/json-dbs/persons.json';
        $json = file_get_contents($url);
        $persons = json_decode($json, true);

        return $persons;
    }

    public function q6()
    {
        $persons = $this->q5();
        $numberWomen = count(array_filter($persons, function($p) {
            return $p['gender'] === 'f';
        }));

        return $numberWomen;
    }

    public function q7()
    {
        $persons = $this->q5();
        $countByCountries = [];
        foreach($persons as $p){
            $country = $p['country'];
            if(!array_key_exists($country, $countByCountries))
                $countByCountries[$country] = 0;
            $countByCountries[$country]++;
        }

        return $countByCountries;
    }

    public function q8()
    {
        $url = 'http://developers.ctdesarrollo.org/triofrio/json-dbs/addresses.json';
        $json = file_get_contents($url);
        $addresses = json_decode($json, true);

        return $addresses;
    }

    public function q9()
    {
        $persons = $this->q5();
        // $countriesByPerson = [];

        // foreach($persons as $p)
        //     $countriesByPerson[$p['id']] = $p['country'];

        $addresses = $this->q8();
        $ans = [];
        foreach($addresses as $addr){
            //if($addr['country'] !== $countriesByPerson[$addr['person_id']])
            if($addr['country'] !== $persons[$addr['person_id'] - 1]['country'])
                array_push($ans, $addr);
        }
        return $ans;
    }

    public function q10()
    {
        $urlDocs = "http://developers.ctdesarrollo.org/triofrio/json-dbs/identifications.json";
        $urlInv = "http://developers.ctdesarrollo.org/triofrio/json-dbs/invoices.json";

        $docs = json_decode(file_get_contents($urlDocs), true);
        $invs = json_decode(file_get_contents($urlInv), true);
        $addrs = $this->q8();
        $persons = $this->q5();
        $ans = [];

        $docsxPerson = [];
        foreach($docs as $doc){
            if(!array_key_exists($doc['person_id'], $docsxPerson))
                $docsxPerson[$doc['person_id']] = [];
            array_push($docsxPerson[$doc['person_id']], $doc);     
        }

        $invsxDoc = [];
        foreach($invs as $inv){
            if(!array_key_exists($inv['identification_id'], $invsxDoc))
                $invsxDoc[$inv['identification_id']] = [];
            array_push($invsxDoc[$inv['identification_id']], $inv);     
        }

        $addrsxPerson = [];
        foreach($addrs as $addr){
            if(!array_key_exists($addr['person_id'], $addrsxPerson))
                $addrsxPerson[$addr['person_id']] = [];
            array_push($addrsxPerson[$addr['person_id']], $addr);     
        }

        foreach($persons as $p){
            $data = [
                'person' => $p, 
                'addresses' => array_key_exists($p['id'], $addrsxPerson) ? $addrsxPerson[$p['id']] : [],
                'identifications' => array_key_exists($p['id'], $docsxPerson) ? $docsxPerson[$p['id']] : [],
                'invoices' => []
            ];

            foreach($data['identifications'] as $doc){
                if(array_key_exists($doc['id'], $invsxDoc))
                    $data['invoices'] = array_merge($data['invoices'], $invsxDoc[$doc['id']]);
            }

            array_push($ans, $data);
        }

        return $ans;
    }

    public function q11()
    {
        return 'Check migrations and models files';
    }

    public function q12()
   {
        $persons = $this->q5();
        $addresses = $this->q8();

        $urlDocs = "http://developers.ctdesarrollo.org/triofrio/json-dbs/identifications.json";
        $urlInv = "http://developers.ctdesarrollo.org/triofrio/json-dbs/invoices.json";

        $identifications = json_decode(file_get_contents($urlDocs), true);
        $invoices = json_decode(file_get_contents($urlInv), true);

        // array_walk($persons, function($person){
        //     Person::create($person);
        // });

        // array_walk($addresses, function($address){
        //     Address::create($address);
        // });

        // array_walk($identifications, function($identification){
        //     Identification::create($identification);
        // });

        array_walk($invoices, function($invoice){
            Invoice::create($invoice);
        });

        return 'DB synced successfully!';

    } 

    public function q13()
    {
        $rows = DB::select("SELECT * FROM (
                                SELECT per.id, per.name, per.last_name, country, sum(inv.total) as total FROM ct_evaluation.invoice inv
                                    inner join ct_evaluation.identification ide on inv.identification_id = ide.id
                                    inner join ct_evaluation.person per on ide.person_id = per.id
                                    group by per.id) sq
                                group by sq.country
                                order by sq.total desc;");
        return $rows;
    }

    public function q14()
    {
        $rows = DB::select("SELECT per.country pais, sum(inv.total) total_ventas_junio FROM ct_evaluation.invoice inv
                                inner join ct_evaluation.identification ide on inv.identification_id = ide.id
                                inner join ct_evaluation.person per on ide.person_id = person.id
                                where MONTH(inv.date) = 6 
                                group by per.country;");
        return $rows;
    }

    public function q15()
    {
        return 'No hay datos sobre productos.';
    }

    public function phase3($vector)
    {
        $lastIdx = count($vector) - 1;
        if($vector[0] === 0 || $vector[$lastIdx] === 0)
            return false;
        
        if($vector[0] >= ($lastIdx))
            return true;

        $aux = array_fill(0, $lastIdx, false);

        for($i = $lastIdx - 1; $i >= 0; $i--){
            if($vector[$i] >= $lastIdx - $i){
                $aux[$i] = true;
            }else if($vector[$i] !== 0){
                $h = $vector[$i];
                while($h > 0){
                    if($aux[$i + $h]){
                        $aux[$i] = true;
                        break;
                    }
                    $h--;
                }
            }
        }

        return $vector[0];
    }
}