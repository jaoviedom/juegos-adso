<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\Grupo;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\GrupoEjercicio;
use App\Models\Aprendiz;
use App\Models\Avance;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\VarDumper\VarDumper;
use Illuminate\Support\Facades\Auth;
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

    public function for()
    {
        $categoria = "Ciclo for";
        $aprendiz = Aprendiz::where('email', Auth::user()->email)->first();
        $ejerciciosGrupo = GrupoEjercicio::where('grupo_id', $aprendiz->grupo_id)->get();
        $ejercicios = [];
        $strEjercicios = [];
        foreach ($ejerciciosGrupo as $item) {
            $ejercicio = Ejercicio::find($item->ejercicio_id);
            if($ejercicio->categoria == $categoria)
            {
                $ejercicio = Ejercicio::find($item->ejercicio_id);
                $ejercicios[] = $ejercicio;
                $strEjercicios[] = preg_replace('/\[.*?\]/', '(__)', $ejercicio->enunciado);
            }
        }
        return view('aprendiz.ejercicios.index', compact('ejercicios', 'categoria', 'strEjercicios'));
    }

    public function while()
    {
        $categoria = "Ciclo while";
        $aprendiz = Aprendiz::where('email', Auth::user()->email)->first();
        $ejerciciosGrupo = GrupoEjercicio::where('grupo_id', $aprendiz->grupo_id)->get();
        $ejercicios = [];
        $strEjercicios = [];
        foreach ($ejerciciosGrupo as $item) {
            $ejercicio = Ejercicio::find($item->ejercicio_id);
            if($ejercicio->categoria == $categoria)
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
        $aprendiz = Aprendiz::where('email', Auth::user()->email)->first();
        $avance = Avance::where('aprendiz_id', $aprendiz->id)
                        ->where('ejercicio_id', $ejercicio->id)
                        ->first();

        return view('aprendiz.ejercicios.responder', compact('ejercicio', 'strEjercicio', 'preguntas', 'respuestas', 'avance'));
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

    public function editarRespuestas(Request $request)
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

        $avance = Avance::where('aprendiz_id', $aprendiz->id)
                        ->where('ejercicio_id', $request->ejercicio_id)
                        ->first();

        $avance->porcentaje = $puntaje;
        $avance->save();

        return redirect()->route('miavance');
    }

    public function miavance()
    {
        $aprendiz = Aprendiz::where('email', Auth::user()->email)->first();
        // $ejerciciosGrupo = GrupoEjercicio::where('grupo_id', $aprendiz->grupo_id)->get();
        $ejerciciosGrupo = DB::table('grupo_ejercicios')
        ->join('ejercicios', 'ejercicios.id', '=', 'grupo_ejercicios.ejercicio_id')
        ->leftJoin('avances', 'avances.ejercicio_id', '=', 'ejercicios.id')
        ->select('ejercicios.*','avances.porcentaje')
        ->where('grupo_ejercicios.grupo_id',$aprendiz->grupo_id)
        ->get();
        // dd($ejerciciosGrupo);
        $avances = Avance::where('aprendiz_id', $aprendiz->id)->get();
        $avanceGlobal = 0;
        foreach ($avances as $avance) {
            $avanceGlobal += $avance->porcentaje;
        }
        $avanceGlobal /= count($ejerciciosGrupo);
        $avanceGlobal = round($avanceGlobal);

        return view('aprendiz.miavance', compact('aprendiz', 'avances', 'avanceGlobal', 'ejerciciosGrupo'));
    }
}
