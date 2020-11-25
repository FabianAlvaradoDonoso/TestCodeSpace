@extends('layout.inventario')
@section('content')
    <section class="content-header">
        <h1>
            Bodegas
            <small>Listado</small>
            <a href="{{route('warehouse.create')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Bodegas</li>
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
                <h3 class="box-title">Listado</h3>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="">Nombre</th>
                                <th style="">Descripción</th>
                                <th style="">Teléfono</th>
                                <th style="">Dirección</th>
                                <th style="">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warehouses as $warehouse)
                                <tr>
                                    <td>{{$warehouse->name}}</td>
                                    <td>{{$warehouse->description}}</td>
                                    <td>{{$warehouse->phone}}</td>
                                    <td>{{$warehouse->address}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{route('warehouse.edit', $warehouse->id)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar_warehouse-{{$warehouse->id}}"><i class="fa fa-trash"></i>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal modal-danger fade" id="eliminar_warehouse-{{$warehouse->id}}" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Eliminar</h4>
                                            </div>
                                            <div class="modal-body">
                                                    <strong> Si presiona continuar los datos no podrán ser recuperados.</strong><br> ¿Esta seguro que desea eliminar {{($warehouse->name)}}?
                                            </div>
                                            <div class="modal-footer">
                                                <form class="" action="{{route('warehouse.destroy', $warehouse->id)}}" method="post">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <button type="submit" class="btn btn-danger">Continuar</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                            @endforeach
                        </tbody>
                    </table>
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
    <script>
        $(function () {
            $('#example1').DataTable({
            "language": {
                        "emptyTable":			"No hay datos disponibles en la tabla.",
                        "info":		   			"Del _START_ al _END_ de _TOTAL_ ",
                        "infoEmpty":			"Mostrando 0 registros de un total de 0.",
                        "infoFiltered":			"(filtrados de un total de _MAX_ registros)",
                        "infoPostFix":			"(actualizados)",
                        "lengthMenu":			"Mostrar _MENU_ registros",
                        "loadingRecords":		"Cargando...",
                        "processing":			"Procesando...",
                        "search":				"",
                        "searchPlaceholder":	"Buscar",
                        "zeroRecords":			"No se han encontrado coincidencias.",
                        "paginate": {
                            "first":			"Primera",
                            "last":				"Última",
                            "next":				"Siguiente",
                            "previous":			"Anterior"
                        },
                        "aria": {
                            "sortAscending":	"Ordenación ascendente",
                            "sortDescending":	"Ordenación descendente"
                        }
                    },
                    "lengthMenu":				[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
                    "iDisplayLength":			10,
                    "columns" : [
                        {"data": 0},
                        {"data": 1},
                        {"data": 2},
                        {"data": 3},
                        {"data": 4},
                    ],
                pageLength: 10,

            });
        })
    </script>
@endsection
