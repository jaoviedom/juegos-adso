<?php

namespace App\Http\Controllers;

use App\Models\Respuesta;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\VarDumper\VarDumper;
use Illuminate\Support\Facades\DB;

class RespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $c=0;
        for ($i=0; $i < count($request->idpregunta); $i++) {
           for ($f=0; $f < 3 ; $f++) {
                $respuesta = new Respuesta();
                $respuesta->texto = $request->respuesta[$c];
                $respuesta->esCorrecta = 0;
                $respuesta->pregunta_id = $request->idpregunta[$i];
                $respuesta->save();
                $c++;
           }
         }
         if ($respuesta) {
            Alert::success('Éxito', '¡Se ha registrado las Respuestas!');
        }
        else {
            Alert::error('Error', '¡Ha ocurrido un error!');
        }
        
        return redirect()->route('ejercicios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\Response
     */
    public function show(Respuesta $respuesta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\Response
     */
    public function edit(Respuesta $respuesta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Respuesta $respuesta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Respuesta  $respuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Respuesta $respuesta)
    {
        //
    }
}
