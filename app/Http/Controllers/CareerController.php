<?php

namespace App\Http\Controllers;

use App\Career;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $careers = Career::withCount('courses')->get();
        return view('system.career.index', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('system.career.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre'    => 'required',
            'codigo'      => 'required|max:5',
        ]);

        $career = new Career;
        $career->name = $request->nombre;
        $career->code = $request->codigo;
        $career->save();

        return redirect()->route('career.index')->with('success', 'Carrera creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function show(Career $career)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
        return view('system.career.edit', compact('career'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre'    => 'required',
            'codigo'      => 'required|max:5',
        ]);

        $career = Career::find($id);
        $career->name = $request->nombre;
        $career->code = $request->codigo;
        $career->save();

        return redirect()->route('career.index')->with('success', 'Carrera actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Se busca la carrera a borrar por id, trayendo los datos de la tabla pivot
        $career = Career::with('courses')->find($id);

        // Borrar datos de tabla pivote antes del ramo en si, para no generar errores de FK
        foreach($career->courses as $course){ // Borrado
            DB::table('career_course')->where('id', '=', $course->pivot->id)->delete();
        }

        // Borrado los datos de la tabla pivot, se elimina el ramo
        $career->delete();

        return back()->with('success', 'Carrera eliminada con éxito');

    }
}
