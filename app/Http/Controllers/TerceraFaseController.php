<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TerceraFaseController extends Controller
{
    public function ProblemaRana()
    {
        $jumps = [2,2,1,0,5,2,2,5,1,5,4,0,5,5,1,4,5,5,2,2,3,0,3,0,1,3,3,1,0,3,2,2,4,1,4,4,2,2,5,2,4,1,4,0,5,1,5,5,3,4,3,2,4,0,3,0,3,0,0,5,3,3,3,1,0,2,1,1,5,0,3,1,3,0,4,5,1,2,3,4,1,4,4,3,1,0,3,4,2,5,5,0,5,4,0,2,2,5,3,4];
        //$jumps = [1,0,1];
        $auxJumps = array();

        $boolPosible = true;
        $suma = array_sum($jumps);
        $cantidad = count($jumps);

        if($suma < $cantidad)
        {
            $boolPosible = false;
        }

        foreach ($jumps as $key => $value) {
            if($value !== 0)
            {
                array_push($auxJumps, $value);
            }else{
                $sumaEsp = array_sum($auxJumps);
                $cantidadEsp = count($auxJumps);

                if($sumaEsp < $cantidadEsp)
                {
                    $boolPosible = false;
                }
            }
        }

        if($boolPosible)
            return "TRUE";
        else
            return "FALSE";

    }
}
