<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Category;
use App\Supplier;
use App\Warehouse;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('supplier', 'category', 'warehouse')->get();
        return view('system.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $warehouses = Warehouse::all();
        return view('system.product.create', compact('categories', 'suppliers', 'warehouses'));
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
            'codigo'        =>'required',
            'nombre'        =>'required',
            'categoria'     =>'required',
            'proveedor'     =>'required',
            'precioVenta'   =>'required',
            'precioNeto'    =>'required',
            'fechaVenc'     =>'required_if: expirate, on',
            'fechaAdq'      =>'required',
            'stockAct'      =>'required',
            'stockMin'      =>'required',
            'bodega'        =>'required',
        ]);

        $search = Product::where('code', '=', $request->codigo)->get();
        if(!$search->isEmpty()){
            return redirect()->route('product.create')->with('error','Ya existe un producto asociado a ese código. Intente otro.');
        }else{
            $product = new Product;
            $product->code = $request->codigo;
            $product->name = $request->nombre;
            $product->category_id = $request->categoria;
            $product->supplier_id = $request->proveedor;
            $product->priceSale = $request->precioVenta;
            $product->pricePurchase = $request->precioNeto;

            if($request->expirate == 'on'){
                $product->dateExpiration = null;
                $product->expirate = 0;
            }else{
                $product->dateExpiration = date('Y-m-d', strtotime($request->fechaVenc));
                $product->expirate = 1;
            }

            $product->dateAcquisition = date('Y-m-d', strtotime($request->fechaAdq));
            $product->stockCurrent = $request->stockAct;
            $product->stockMinimum = $request->stockMin;
            $product->warehouse_id = $request->bodega;

            $product->save();

            return redirect()->route('product.index')->with('success','Producto creado con éxito.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $warehouses = Warehouse::all();
        return view('system.product.edit', compact('product', 'categories', 'suppliers', 'warehouses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'codigo'        =>'required',
            'nombre'        =>'required',
            'categoria'     =>'required',
            'proveedor'     =>'required',
            'precioVenta'   =>'required',
            'precioNeto'    =>'required',
            'fechaVenc'     =>'required_if: expirate, on',
            'fechaAdq'      =>'required',
            'stockAct'      =>'required',
            'stockMin'      =>'required',
            'bodega'        =>'required',
        ]);

        $product = Product::find($id);
        $product->code = $request->codigo;
        $product->name = $request->nombre;
        $product->category_id = $request->categoria;
        $product->supplier_id = $request->proveedor;
        $product->priceSale = $request->precioVenta;
        $product->pricePurchase = $request->precioNeto;
        if($request->expirate == 'on'){
            $product->dateExpiration = null;
            $product->expirate = 0;
        }else{
            $product->dateExpiration = date('Y-m-d', strtotime($request->fechaVenc));
            $product->expirate = 1;
        }
        $product->dateAcquisition = date('Y-m-d', strtotime($request->fechaAdq));
        $product->stockCurrent = $request->stockAct;
        $product->stockMinimum = $request->stockMin;
        $product->warehouse_id = $request->bodega;
        $product->save();

        return redirect()->route('product.index')->with('success','Actualización exitosa.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id)->delete();
        return back()->with('success', 'Producto eliminado con éxito');
    }

    public function sale(){
        $products = Product::with('supplier', 'category', 'warehouse')->get();
        return view('system.product.sale', compact('products'));
    }

    public function getInfoProduct($product){
        return Product::with('supplier', 'category', 'warehouse')->where('id', '=', $product)->first();
    }

    public function discountProduct($product, $cantidad){
        $descontar = Product::find($product);
        $descontar->stockCurrent -= $cantidad;
        $descontar->save();
        return Product::find($product);
    }

}
