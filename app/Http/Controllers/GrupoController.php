<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\GrupoEjercicio;
use App\Models\User;
use App\Models\Aprendiz;
use App\Models\Avance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::user()->rol == "Instructor")
        {
            $grupos = Grupo::orderBy('nombre', 'asc')
                            ->where('id', '>', 1)
                            ->where('user_id', Auth::user()->id)
                            ->get();
            return view('grupos.index', compact('grupos'));
        } else {
            return view('welcome');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grupos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grupo = Grupo::create($request->all());
        if ($grupo) {
            Alert::success('Éxito', "¡Se ha creado el nuevo grupo!");
        }
        else {
            Alert::error('Error', '¡Ha ocurrido un error!');
        }
        
        return redirect()->route('grupos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupo = Grupo::find($id);
        $usuarios = User::where('rol', 'Aprendiz')
                            ->orderBy('name', 'asc')
                            ->get();
        $aprendices = Aprendiz::where('grupo_id', $id)
                            ->get();
        $ejerciciosGrupo = GrupoEjercicio::where('grupo_id', $id)->get();

        $avances = Avance::all();
        return view('grupos.show', compact('grupo', 'usuarios', 'aprendices', 'ejerciciosGrupo', 'avances'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupo = Grupo::find($id);
        $usuarios = User::where('rol', 'Aprendiz')
                            ->orderBy('name', 'asc')
                            ->get();
        $aprendices = Aprendiz::where('grupo_id', $id)
                            ->select('email')
                            ->get();
        return view('grupos.edit', compact('grupo', 'usuarios', 'aprendices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aprendicesAgregar = [];
        $aprendicesSeleccionados = $request->aprendices;
        $aprendicesActuales = Aprendiz::where('grupo_id', $id)->select('id')->get()->toArray();
        $grupo = Grupo::find($id)->update($request->except(['aprendices']));

        $aprendicesActuales = Aprendiz::where('grupo_id', $id)->get();

        $yaAsignados = [];
        foreach($aprendicesActuales as $aa)
        {
            $yaAsignados[] = $aa;
        }

        // Desaignar a todos los que están asignado
        foreach($yaAsignados as $asignado)
        {
            $asignado->grupo_id = 1;
            $asignado->save();
        }
        
        // Obtener los id de los aprendices por el email
        $aAsignar = [];
        foreach ($request->aprendices as $item) {
            $user = User::find($item);
            $aAsignar[] = Aprendiz::where('email', $user->email)->first();
        }

        // Asignar a los aprendices seleccionados   
        foreach($aAsignar as $asignar)
        {
            // Asignar al grupo
            $asignar->grupo_id = $id;
            $asignar->save();
        }
        
        if($grupo)
        {
            Alert::success('Éxito', '¡Se ha modificado el grupo!');
        } else {
            Alert::error('Error', '¡Ha ocurrido un error!');
        }
        return redirect()->route('grupos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Grupo::find($id)->delete();
        return back();
    }
}
