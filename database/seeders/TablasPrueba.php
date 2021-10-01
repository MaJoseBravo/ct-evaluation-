<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TablasPrueba extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $responsePersons = file_get_contents("http://developers.ctdesarrollo.org/triofrio/json-dbs/persons.json");
        $jsonPersons     = json_decode($responsePersons, true);
        foreach ($jsonPersons as $key => $value) {
            $dataPersons = array("name" => $value["name"], "last_name" => $value["last_name"], "birth_date" => $value["birth_date"],
                                 "gender" => $value["gender"], "country" => $value["country"]);
        }

        //\App\Models\Person::insert($dataPersons);
        DB::table('person')->insert($dataPersons);

        $responseAddress = file_get_contents("http://developers.ctdesarrollo.org/triofrio/json-dbs/addresses.json");
        $jsonAddress     = json_decode($responseAddress, true);
        foreach ($jsonAddress as $key => $value) {
            $dataAddress = array("person_id" => $value["person_id"], "country" => $value["country"], 
                                 "postal_code" => $value["postal_code"], "detail" => $value["detail"]);
        }

        \App\Models\Address::insert($dataAddress);

        $responseIdentification = file_get_contents("http://developers.ctdesarrollo.org/triofrio/json-dbs/identifications.json");
        $jsonIdentification     = json_decode($responseIdentification, true);
        foreach ($jsonIdentification as $key => $value) {
            $dataIdentification = array("person_id" => $value["person_id"], "type" => $value["type"], 
                                 "value" => $value["value"]);
        }

        \App\Models\Identificaction::insert($dataIdentification);

        $responseInvoice = file_get_contents("http://developers.ctdesarrollo.org/triofrio/json-dbs/invoices.json");
        $jsonInvoice     = json_decode($responseInvoice, true);
        foreach ($jsonInvoice as $key => $value) {
            $dataInvoice = array("identification_id" => $value["identification_id"], "date" => $value["date"], 
                                 "total" => $value["total"], "observation" => $value["observation"]);
        }

        \App\Models\Invoice::insert($dataInvoice);

    }
}
