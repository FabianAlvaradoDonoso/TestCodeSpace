<?php

namespace App\Http\Controllers;

use App\Career;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::withCount('careers')->get();
        return view('system.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $careers = Career::all();
        return view('system.course.create', compact('careers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' =>'required',
            'codigo' =>'required|max:8',
            'carreras' =>'required',
        ]);

        $course= Course::create([   
            'name' => $request->nombre,
            'code' => $request->codigo,
        ]);

        foreach($request->carreras as $carrera){
            $course->careers()->attach($carrera);
        }

        return redirect()->route('course.index')->with('success','Ramo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::with('careers')->find($id);
        $careers = Career::all();
        return view('system.course.edit', compact('course', 'careers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nombre' =>'required',
            'codigo' =>'required|max:8',
            'carreras' =>'required',
        ]);

        // Actualizar datos de las carreras
        $course = Course::with('careers')->find($id);
        $course->name = $request->nombre;
        $course->code = $request->codigo;
        $course->save();

        // Actualizar datos de la union carreras/ramos (Borrar y guardar de nuevo)
        foreach($course->careers as $career){ // Borrado
            DB::table('career_course')->where('id', '=', $career->pivot->id)->delete();
        }
        foreach($request->carreras as $carrera){ // Guardado
            $course->careers()->attach($carrera);
        }

        return redirect()->route('course.index')->with('success','Ramo modificado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Se busca el ramo a borrar por id, trayendo los datos de la tabla pivot
        $course = Course::with('careers')->find($id);

        // Borrar datos de tabla pivote antes del ramo en si, para no generar errores de FK
        foreach($course->careers as $career){ // Borrado
            DB::table('career_course')->where('id', '=', $career->pivot->id)->delete();
        }

        // Borrado los datos de la tabla pivot, se elimina el ramo
        $course->delete();

        return back()->with('success', 'Ramo eliminado con éxito');
    }
}
