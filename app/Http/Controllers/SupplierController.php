<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('system.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('system.supplier.create');
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

        $supplier = new Supplier;
        $supplier->name = $request->nombre;
        $supplier->description = $request->descripcion;
        $supplier->phone = $request->telefono;
        $supplier->address = $request->direccion;
        $supplier->save();

        return redirect()->route('supplier.index')->with('success','Proveedor creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('system.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
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

        $supplier = Supplier::find($id);
        $supplier->name = $request->nombre;
        $supplier->description = $request->descripcion;
        $supplier->phone = $request->telefono;
        $supplier->address = $request->direccion;
        $supplier->save();

        return redirect()->route('supplier.index')->with('success','Actualización exitosa.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id)->delete();
        return back()->with('success', 'Proveedor eliminado con éxito');
    }
}
