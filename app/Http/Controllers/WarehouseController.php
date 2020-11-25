<?php

namespace App\Http\Controllers;

use App\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('system.warehouse.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('system.warehouse.create');
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
            'nombre'   =>'required',
            'descripcion'   =>'required|max:50',
            'telefono'   =>'required',
            'direccion'   =>'required',
        ]);

        $warehouse = new Warehouse;
        $warehouse->name = $request->nombre;
        $warehouse->description = $request->descripcion;
        $warehouse->phone = $request->telefono;
        $warehouse->address = $request->direccion;
        $warehouse->save();

        return redirect()->route('warehouse.index')->with('success','Bodega creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        return view('system.warehouse.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nombre'   =>'required',
            'descripcion'   =>'required|max:50',
            'telefono'   =>'required',
            'direccion'   =>'required',
        ]);

        $warehouse = Warehouse::find($id);
        $warehouse->name = $request->nombre;
        $warehouse->description = $request->descripcion;
        $warehouse->phone = $request->telefono;
        $warehouse->address = $request->direccion;
        $warehouse->save();

        return redirect()->route('warehouse.index')->with('success','Actualización exitosa.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $warehouse = Warehouse::find($id)->delete();
        return back()->with('success', 'Bodega eliminada con éxito');
    }
}
