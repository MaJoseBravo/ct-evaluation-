<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimeraFaseController extends Controller
{
    public function BloqueUno()
    {

        $arrayElementosRandom = array();
        $arrayElementosNumericos = array();
        $arrayElementosString = array();
        $arrayStringOrden = array();

        for ($i=0; $i < 100; $i++)
        {
            $boolTipoElemento = boolval(mt_rand(0,1));

            if($boolTipoElemento)
            {
                $arrayElementosRandom["random"][$i] = mt_rand(0, 100);
            }else{
                $arrayElementosRandom["random"][$i] = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"),0,8);
            }
        }

        $i=0;
        foreach ($arrayElementosRandom["random"] as $key => $value) {
            if(is_numeric($value))
            {
                $arrayElementosRandom["numerico"][$i] = $value;
            }else if(is_string($value)){
                $arrayElementosRandom["string"][$i] = $value;
                array_push($arrayStringOrden,$value);
            }
            $i++;

        };

        $sumaNumericos = array_sum($arrayElementosRandom["numerico"]);
        $arrayElementosRandom["suma"] = $sumaNumericos;
        $arrayElementosRandom["ordenString"] = call_user_func(function(array $array){asort($array);return $array;}, $arrayStringOrden);

        return $arrayElementosRandom;
    }

    public function BloqueDos()
    {
        $arrayFemenino = array();
        $arrayPaises = array();
        $arrayPaisesPersona = array();
        $arrayDireccionesDifiere = array();
        $arrayPersonas = array();
        $arrayFacturas = array();

        $jsonPersonas = $this->generarJsonUrl("http://developers.ctdesarrollo.org/triofrio/json-dbs/persons.json");//json_decode($responsePersonas, true);

        foreach ($jsonPersonas as $key => $value)
        {
            if($value["gender"] == 'f')
            {
                array_push($arrayFemenino,$value["name"]);
            }
            array_push($arrayPaises,$value["country"]);
            $arrayPaisesPersona[$value["id"]] = $value["country"];
            $arrayPersonas[$value["id"]]["person"] = $value["name"];
        }

        $jsonDirecciones = $this->generarJsonUrl("http://developers.ctdesarrollo.org/triofrio/json-dbs/addresses.json");//json_decode($responseDirecciones, true);

        foreach ($jsonDirecciones as $key => $value) {
            foreach ($arrayPaisesPersona as $keyPP => $valuePP) {
                if($keyPP[$value["person_id"]] !==  $value["country"])
                {
                    $arrayDireccionesDifiere[$value["person_id"]] = "Dirección país: ".$value["country"];
                }
            }
            $arrayPersonas[$value["person_id"]]["addresses"] = $value["detail"];
        }

        $jsonIdentificaciones = $this->generarJsonUrl("http://developers.ctdesarrollo.org/triofrio/json-dbs/identifications.json");
        
            foreach ($jsonIdentificaciones as $key => $value) {
                $arrayPersonas[$value["person_id"]]["identifications"] = $value["value"];
                $arrayPersonas[$value["person_id"]]["identifications_id"] = $value["id"];
            }



        $jsonFacturas = $this->generarJsonUrl("http://developers.ctdesarrollo.org/triofrio/json-dbs/invoices.json");
        foreach ($jsonFacturas as $key => $value)
        {
            $arrayFacturas[$value["identification_id"]] =  $value["id"];
        }

        foreach ($arrayPersonas as $key => $value)
        {
            if(array_key_exists("identifications_id",$arrayPersonas))
            {
                if(array_key_exists($arrayPersonas[$key]["identifications_id"],$arrayFacturas))
                {
                    $arrayPersonas[$key]["invoices"] =  $arrayFacturas[$arrayPersonas[$key]["identifications_id"]];
                }else{
                    $arrayPersonas[$key]["invoices"] = "N/A";
                }
            }
        }

        return $arrayPersonas;
    }

    public function generarJsonUrl($url)
    {
        $response = file_get_contents($url);
        $jsonResponse = json_decode($response, true);
        return $jsonResponse;

    }
}
