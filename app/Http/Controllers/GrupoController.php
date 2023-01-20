<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\User;
use App\Models\Aprendiz;
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
            $grupos = Grupo::orderBy('nombre', 'asc')->get();
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
    public function show(Grupo $grupo)
    {
        //
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

        foreach ($aprendicesSeleccionados as $id => $seleccionado) {
            // dd($aprendicesActuales);
            if (in_array($seleccionado, $aprendicesActuales))
                $aprendicesAgregar[] = $seleccionado;
        }
        dd($aprendicesAgregar);
        foreach($aprendicesAgregar as $item)
        {
            $user = User::find($item);
            $aprendiz = new Aprendiz();
            $aprendiz->nombre = $user->name;
            $aprendiz->email = $user->email;
            $aprendiz->grupo_id = $id;
            $aprendiz->save();
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
