<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EjercicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ejercicios = Ejercicio::orderBy('categoria', 'asc')->get();
        return view('ejercicios.index', compact('ejercicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ejercicios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ejercicio = Ejercicio::create($request->all());
        if ($ejercicio) {
            Alert::success('Éxito', '¡Se ha creado el nuevo ejercicio!');
        }
        else {
            Alert::error('Error', '¡Ha ocurrido un error!');
        }
        
        return redirect()->route('ejercicios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ejercicio  $ejercicio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ejercicio = Ejercicio::find($id);
        return view ('ejercicios.show', compact('ejercicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ejercicio  $ejercicio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ejercicio = Ejercicio::find($id);
        return view('ejercicios.edit', compact('ejercicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ejercicio  $ejercicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ejercicio = Ejercicio::find($id)->update($request->all());
        if($ejercicio)
        {
            Alert::success('Éxito', '¡Se ha modificado el ejercicio!');
        } else {
            Alert::error('Error', '¡Ha ocurrido un error!');
        }
        return redirect()->route('ejercicios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ejercicio  $ejercicio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ejercicio::find($id)->delete();
        return back();
    }
}
