<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\GrupoEjercicio;
use App\Models\Aprendiz;
use App\Models\Avance;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\VarDumper\VarDumper;
use Illuminate\Support\Facades\Auth;

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

    public function condicionales()
    {
        $categoria = "Condicionales";
        $aprendiz = Aprendiz::where('email', Auth::user()->email)->first();
        $ejerciciosGrupo = GrupoEjercicio::where('grupo_id', $aprendiz->grupo_id)->get();
        $ejercicios = [];
        $strEjercicios = [];
        foreach ($ejerciciosGrupo as $item) {
            $ejercicio = Ejercicio::find($item->ejercicio_id);
            if($ejercicio->categoria == "Condicionales")
            {
                $ejercicio = Ejercicio::find($item->ejercicio_id);
                $ejercicios[] = $ejercicio;
                $strEjercicios[] = preg_replace('/\[.*?\]/', '(__)', $ejercicio->enunciado);
            }
        }
        return view('aprendiz.ejercicios.index', compact('ejercicios', 'categoria', 'strEjercicios'));
    }
    
    public function resolver($id)
    {
        $ejercicio = Ejercicio::find($id);
        $strEjercicio = preg_replace('/\[.*?\]/', '(__)', $ejercicio->enunciado);
        $preguntas = Pregunta::where('ejercicio_id', $id)->get();
        $respuestas = [];
        foreach($preguntas as $pregunta)
        {
            $respuestas[] = Respuesta::where('pregunta_id', $pregunta->id)->orderByRaw("RAND()")->get();
        }
        // dd($respuestas);
        return view('aprendiz.ejercicios.responder', compact('ejercicio', 'strEjercicio', 'preguntas', 'respuestas'));
    }

    public function guardarRespuestas(Request $request)
    {
        $puntaje = 0;
        $preguntas = [];
        foreach ($request->preguntas as $pregunta) {
            $preguntas[] = Pregunta::find($pregunta);
        }
        $puntosPregunta = 100 / count($preguntas);
        $respuestas = [];
        foreach ($request->respuestas as $respuesta) {
            $respuesta = Respuesta::find($respuesta);
            if($respuesta->esCorrecta)
                $puntaje += $puntosPregunta;
        }
        // var_dump($puntaje);
        $aprendiz = Aprendiz::where('email', Auth::user()->email)->first();

        $avance = new Avance();
        $avance->aprendiz_id = $aprendiz->id;
        $avance->ejercicio_id = $request->ejercicio_id;
        $avance->porcentaje = $puntaje;
        $avance->save();

        return redirect()->route('miavance');
    }

    public function miavance()
    {
        $aprendiz = Aprendiz::where('email', Auth::user()->email)->first();
        $ejerciciosGrupo = GrupoEjercicio::where('grupo_id', $aprendiz->grupo_id)->get();
        $avances = Avance::where('aprendiz_id', $aprendiz->id)->get();
        $avanceGlobal = 0;
        foreach ($avances as $avance) {
            $avanceGlobal += $avance->porcentaje;
        }
        $avanceGlobal /= count($ejerciciosGrupo);
        return view('aprendiz.miavance', compact('aprendiz', 'avances', 'avanceGlobal', 'ejerciciosGrupo'));
    }
}
