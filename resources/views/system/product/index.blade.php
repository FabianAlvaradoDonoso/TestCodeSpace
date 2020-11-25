@extends('layout.inventario')
@section('content')
    <section class="content-header">
        <h1>
            Productos
            <small>Listado</small>
            <a href="{{route('product.create')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Productos</li>
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
                <div class="col-xs-12 col-xs-offset-1 col-md-offset-2 col-lg-offset-2">

                    <a class="btn btn-sm bg-navy toggle-vis" data-column="2">Categoria</a>
                    <a class="btn btn-sm btn-primary toggle-vis" data-column="3">Proveedor</a>
                    <a class="btn btn-sm btn-info toggle-vis" data-column="4">$ Venta</a>
                    <a class="btn btn-sm btn-success toggle-vis" data-column="5">$ Neto</a>
                    <a class="btn btn-sm btn-warning toggle-vis" data-column="6">Vencimiento</a>
                    <a class="btn btn-sm bg-orange toggle-vis" data-column="7">Adquisición</a>
                    <a class="btn btn-sm btn-danger toggle-vis" data-column="8">Stock Min</a>
                    <a class="btn btn-sm bg-purple toggle-vis" data-column="9">Stock Act</a>
                    <a class="btn btn-sm bg-gray toggle-vis" data-column="10">Bodega</a>
                </div>

                <div class="col-xs-12">
                    <div class="table-responsive" style="margin-top: 2%">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="">Codigo</th>
                                    <th style="">Nombre</th>
                                    <th style="">Categoria</th>
                                    <th style="">Proveedor</th>
                                    <th style="">$Venta</th>
                                    <th style="">$Neto</th>
                                    <th style="">Fecha Vencimiento</th>
                                    <th style="">Fecha Adquisición</th>
                                    <th style="">Stock Min</th>
                                    <th style="">Stock Act</th>
                                    <th style="">Bodega</th>
                                    <th style="">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    @if (($product->dateExpiration < Carbon\Carbon::now()) && $product->expirate)
                                        <tr style="color: rgba(255,0,0,1)">
                                    @else
                                        @if ((Carbon\Carbon::parse($product->dateExpiration)->diffInDays(Carbon\Carbon::now()) < 30) && $product->expirate)
                                            <tr style="color: rgba(255, 131, 0, 1)">
                                        @else
                                            <tr>
                                        @endif
                                    @endif
                                        <td>{{$product->code}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->supplier->name}}</td>
                                        <td>$ {{$product->priceSale}}</td>
                                        <td>$ {{$product->pricePurchase}}</td>
                                        @if ($product->expirate == 1)
                                            <td>{{date('d-m-Y', strtotime($product->dateExpiration))}}</td>
                                        @else
                                            <td>No Aplica</td>
                                        @endif
                                        <td>{{date('d-m-Y', strtotime($product->dateAcquisition))}}</td>
                                        <td>{{$product->stockMinimum}}</td>
                                        <td>{{$product->stockCurrent}}</td>
                                        <td>{{$product->warehouse->name}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{route('product.edit', $product->id)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar_product-{{$product->id}}"><i class="fa fa-trash"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal modal-danger fade" id="eliminar_product-{{$product->id}}" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">Eliminar</h4>
                                                </div>
                                                <div class="modal-body">
                                                        <strong> Si presiona continuar los datos no podrán ser recuperados.</strong><br> ¿Esta seguro que desea eliminar {{($product->name)}}?
                                                </div>
                                                <div class="modal-footer">
                                                    <form class="" action="{{route('product.destroy', $product->id)}}" method="post">
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
        $(document).ready(function() {
            var table = $('#example1').DataTable( {
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
                        {"data": 5},
                        {"data": 6},
                        {"data": 7},
                        {"data": 8},
                        {"data": 9},
                        {"data": 10},
                        {"data": 11},
                    ],
                pageLength: 10,
                "columnDefs": [
                    {
                        "targets": [ 5,7,8,10 ],
                        "visible": false
                    }
                ],
                // "initComplete": function () { //click para buscar especificamente ese algo
                //     var api = this.api();   //Cuidado con los botones
                //     api.$('td').click( function () {
                //         api.search( this.innerHTML ).draw();
                //     } );
                // },
                // "deferRender": true, //Mejora la velocidad de carga de DataTable

            } );

            $('a.toggle-vis').on( 'click', function (e) {
                e.preventDefault();

                // Get the column API object
                var column = table.column( $(this).attr('data-column') );

                // Toggle the visibility
                column.visible( ! column.visible() );
            } );
        } );

    </script>
@endsection
