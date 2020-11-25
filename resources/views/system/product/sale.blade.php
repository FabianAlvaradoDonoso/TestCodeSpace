@extends('layout.inventario')
@section('content')
    <section class="content-header">
        <h1>
            Productos
            <small>Venta</small>
            {{-- <a href="{{route('product.create')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Venta</li>
        </ol>
    </section>




    <section class="content">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible" id="success-alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p><i class="icon fa fa-check"></i>
                    {{ $message }}
                </p>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Buscar</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                        <th>Precio</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{$product->code}}</td>
                                            <td>{{$product->name}}</td>
                                            <td class="text-center">{{$product->stockCurrent}}</td>
                                            <td class="text-right">$ {{number_format($product->priceSale, 0, ',', '.')}}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a class="btn btn-sm btn-warning" id="buscarInfo" name="buscarInfo" onclick="buscarInfo({{$product->id}})"><i class="fa fa-eye"></i></a>
                                                    <a class="btn btn-success btn-sm" id="enviarInfo" name="enviarInfo" onclick="enviarInfo({{$product->id}})"><i class="fa fa-plus"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Carro Compra</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer text-center">
                        <div class="pull-left">
                            <a class="btn btn-danger" name="btnBorrarTodo" id="btnBorrarTodo">Borrar Todo</a>
                            <a class="btn btn-danger" name="prueba" id="prueba">Modal</a>
                        </div>
                        <strong style="" class="text-center">Total: <label id="precioFinal">$ 0</label></strong>
                        <div class="pull-right">
                            <button class="btn btn-primary" type="submit" id="btnDescontar">Descontar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Modals --}}
        <div class="modal fade" id="show_product" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title"><strong>Información del Producto</strong></h4>
                    </div>
                    <div class="modal-body">
                            Código: <strong><label id="codigoLabel"></label></strong><br>
                            Nombre: <strong><label id="nombreLabel"></strong><br>
                            Categoria: <strong><label id="categoriaLabel"></strong><br>
                            Stock Actual: <strong><label id="stockLabel"></strong><br>
                            Precio: <strong>$ <label id="precioLabel"></strong><br>
                            Bodega: <strong><label id="bodegaLabel"></strong><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="show_sale" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title"><strong>Información del Producto</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example3" class="table table-bordered table-striped hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>a</td>
                                            <td>a</td>
                                            <td>a</td>
                                            <td>a</td>
                                            <td>a</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </section>
@endsection
@section('scripts')
    <script src="{{asset('js/ventas.js')}}"></script>
@endsection
