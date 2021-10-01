<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Person::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $person = new Person();
        $person->name =  $request->input('name');
        $person->last_name = $request->input('last_name');
        $person->birth_date = $request->input('birth_date');
        $person->gender = $request->input('gender');
        $person->country = $request->input('country');
        $respuesta = $person->save();

        if ($respuesta) {
            return response()->json(['message' => 'Persona creada exitosamente'], 201);
        }
        return response()->json(['message' => 'Error en la transacción'], 500);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        $person = Person::find($request->input('id'));

        if (!empty($request->input('name'))) {
            $person->name = $request->input('name');
        }

        if (!empty($request->input('last_name'))) {
            $person->last_name = $request->input('last_name');
        }

        if (!empty($request->input('gender'))) {
            $person->gender = $request->input('gender');
        }

        if (!empty($request->input('country'))) {
            $person->country = $request->input('country');
        }

        $update = $person->save();

        if ($update) {
            return response()->json(['message' => 'Persona actualizada exitosamente.']);
        }

        return response()->json(['message' => 'Error en la transacción'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Person $person)
    {
        $person = Person::find($request->input('id'));
        $delete = $person->delete();

        if ($delete) {
            return response()->json(['message' => 'Persona eliminada exitosamente']);
        }

        return response()->json(['message' => 'Error en la transacción'], 500);
    }
}
