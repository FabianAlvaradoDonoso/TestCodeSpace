@extends('layout.inventario')
@section('content')
    <section class="content-header">
        <h1>
            Productos
            <small>Nuevo</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{route('product.index')}}">Productos</a></li>
            <li class="active">Nuevo</li>
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
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible" id="success-alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p><i class="icon fa fa-close"></i>
                    {{ $message }}
                </p>
            </div>
        @endif


        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Creación de un nuevo producto</h3>
            </div>

            <div class="box-body">
                <div class="form">
                    <form class="form-validate form-horizontal " role="form" method="POST" action="{{route('product.store')}}" novalidate="novalidate">
                        @csrf
                        <div class="form-group {{ ($errors->first('codigo')) ? 'has-error'  :''}}">
                            <label for="codigo" class="col-sm-2 control-label">Código</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="codigo" name="codigo" value="{{Request::old('codigo')}}">
                            </div>
                        </div>
                        <div class="form-group {{ ($errors->first('nombre')) ? 'has-error'  :''}}">
                            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{Request::old('nombre')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="{{ ($errors->first('categoria')) ? 'has-error'  :''}}">
                                <label for="categoria" class="col-sm-2 control-label">Categoría</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="categoria" id="categoria">
                                        <option value="" selected disabled>Seleccione...</option>
                                        @foreach ($categories as $category)
                                            @if (Request::old('categoria') == $category->id)
                                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                            @else
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="{{ ($errors->first('proveedor')) ? 'has-error'  :''}}">
                                <label for="proveedor" class="col-sm-2 control-label">Proveedor</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="proveedor" id="proveedor">
                                        <option value="" selected disabled>Seleccione...</option>
                                        @foreach ($suppliers as $supplier)
                                            @if (Request::old('proveedor') == $supplier->id)
                                                <option value="{{$supplier->id}}" selected>{{$supplier->name}}</option>
                                            @else
                                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Precios --}}
                        <div class="form-group">
                            <div class="{{ ($errors->first('precioVenta')) ? 'has-error'  :''}}">
                                <label for="precioVenta" class="col-sm-2 control-label">Precio Venta</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                        <input type="number" min="1" class="form-control" name="precioVenta" id="precioVenta" value="{{Request::old('precioVenta')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="{{ ($errors->first('precioNeto')) ? 'has-error'  :''}}">
                                <label for="precioNeto" class="col-sm-2 control-label">Precio Neto</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                        <input type="number" min="1" class="form-control" name="precioNeto" id="precioNeto" value="{{Request::old('precioNeto')}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Fechas --}}
                        <div class="form-group">
                            <div class="{{ ($errors->first('fechaAdq')) ? 'has-error'  :''}}">
                                <label for="fechaAdq" class="col-sm-2 control-label">Fecha Adquisición</label>
                                <div class="col-sm-4">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="fechaAdq" name="fechaAdq" value="{{Request::old('fechaAdq')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="{{ ($errors->first('fechaVenc')) ? 'has-error'  :''}}">
                                <label for="fechaVenc" class="col-sm-2 control-label">Fecha Vencimiento</label>
                                <div class="col-sm-4">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="fechaVenc" name="fechaVenc" value="{{Request::old('fechaVenc')}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Stocks --}}
                        <div class="form-group">
                            <div class="{{ ($errors->first('stockAct')) ? 'has-error'  :''}}">
                                <label for="stockAct" class="col-sm-2 control-label">Stock Actual</label>
                                <div class="col-sm-4">
                                    <input type="number" min="0" class="form-control" name="stockAct" id="stockAct" value="{{Request::old('stockAct')}}">
                                </div>
                            </div>

                            <div class="{{ ($errors->first('stockMin')) ? 'has-error'  :''}}">
                                <label for="stockMin" class="col-sm-2 control-label">Stock Mínimo</label>
                                <div class="col-sm-4">
                                    <input type="number" min="1" class="form-control" name="stockMin" id="stockMin" value="{{Request::old('stockMin')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="{{ ($errors->first('bodega')) ? 'has-error'  :''}}">
                                <label for="bodega" class="col-sm-2 control-label">Bodega</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="bodega" id="bodega">
                                        <option value="" selected disabled>Seleccione...</option>
                                        @foreach ($warehouses as $warehouse)
                                            @if (Request::old('bodega') == $warehouse->id)
                                                <option value="{{$warehouse->id}}" selected>{{$warehouse->name}}</option>
                                            @else
                                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="col-sm-5">
                                    <label>
                                        <input type="checkbox" class="minimal form-control" name="expirate" id="expirate">
                                        Producto No Vence
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="pull-right">
                                <a href="{{ route('product.index') }}"class="btn btn-danger">Cancelar</a>
                                <button class="btn btn-primary ml-3" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });
        $('#fechaAdq').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            language: 'es-ES',
        })
        $('#fechaVenc').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            language: 'es-ES',
        })
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
        $('input[type="checkbox"].minimal').on('ifChanged',function(){
            if($("#fechaVenc").prop('disabled') == false){
                $('#fechaVenc').prop('disabled', true);
            } else {
                $('#fechaVenc').prop('disabled', false);
            }
        })
    </script>
@endsection
