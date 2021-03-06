@extends('layout.inventario')
@section('content')
<section class="content-header">
        <h1>
            Bodega
            <small>Nueva</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{route('warehouse.index')}}">Bodega</a></li>
            <li class="active">Nueva</li>
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


        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Creación de una nueva bodega</h3>
            </div>

            <div class="box-body">
                <div class="form">
                    <form class="form-validate form-horizontal " role="form" method="POST" action="{{route('warehouse.store')}}" novalidate="novalidate">
                        @csrf
                        <div class="form-group {{ ($errors->first('nombre')) ? 'has-error'  :''}}">
                            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{Request::old('nombre')}}">
                            </div>
                        </div>
                        <div class="form-group {{ ($errors->first('descripcion')) ? 'has-error'  :''}}">
                            <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Maximo 50 caracteres" value="{{Request::old('descripcion')}}">
                            </div>
                        </div>
                        <div class="form-group {{ ($errors->first('telefono')) ? 'has-error'  :''}}">
                            <label for="telefono" class="col-sm-2 control-label">Teléfono</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="telefono" name="telefono" value="{{Request::old('telefono')}}">
                            </div>
                        </div>
                        <div class="form-group {{ ($errors->first('direccion')) ? 'has-error'  :''}}">
                            <label for="direccion" class="col-sm-2 control-label">Dirección</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="direccion" name="direccion" value="{{Request::old('direccion')}}">
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="pull-right">
                                <a href="{{ route('warehouse.index') }}"class="btn btn-danger">Cancelar</a>
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
    </script>
@endsection
