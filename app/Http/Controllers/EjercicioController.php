<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\Grupo;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\GrupoEjercicio;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\VarDumper\VarDumper;
use Illuminate\Support\Facades\DB;

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
        
        $grupos = Grupo::where('user_id',auth()->user()->id)->get();
        return view('ejercicios.create', compact('grupos'));
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
        $grupo = new GrupoEjercicio();
        $grupo->grupo_id = $request->grupo_id;
        $grupo->ejercicio_id = $ejercicio->id;
        $grupo->save();
        $pattern = "/\[[^\]]*\]/";
        preg_match_all($pattern, $ejercicio->enunciado, $captura);
        for ($i=0; $i < count($captura[0]); $i++) {
            $textorespuesta = substr($captura[0][$i],1,-1);
            $pregunta = new Pregunta();
            $pregunta->numero = $i;
            $pregunta->ejercicio_id = $ejercicio->id;
            $pregunta->save();
            $respuesta = new Respuesta();
            $respuesta->texto = $textorespuesta;
            $respuesta->esCorrecta = 1;
            $respuesta->pregunta_id = $pregunta->id;
            $respuesta->save();
        }

        if ($ejercicio) {
            Alert::success('Éxito', '¡Se ha creado el nuevo ejercicio!');
        }
        else {
            Alert::error('Error', '¡Ha ocurrido un error!');
        }
        
        return redirect()->route('ejercicios.show',$ejercicio->id);
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
        // $pregejercicio = Pregunta::where('ejercicio_id',$id)->get();
        $pregejercicio = DB::table('preguntas')
        ->select(['preguntas.id as preguntas_id','preguntas.ejercicio_id','preguntas.numero','respuestas.id', 'respuestas.texto', 'respuestas.esCorrecta'])
        ->join('respuestas', 'preguntas.id', '=', 'respuestas.pregunta_id')
        ->where('ejercicio_id',$id)
        ->get();
        return view ('ejercicios.show', compact('ejercicio','pregejercicio'));
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
