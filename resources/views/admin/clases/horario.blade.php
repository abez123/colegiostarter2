@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')Horario @parent @stop

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
           Horario
            <div class="pull-right">
                <a href="{{{ URL::to('admin/clases') }}}"
                   class="btn btn-sm  btn-primary iframe"><span
                            class="glyphicon glyphicon-plus-sign"></span> Regresar</a>
            </div>
        </h3>
    </div>

    <table id="table" class="table table-striped table-hover">
        <thead>
        <tr>
       
            <th>Nombre de Clase</th>
            <th>Lunes Inicio</th>
            <th>Lunes Final</th>
            <th>Martes Inicio</th>
            <th>Martes Final</th>
            <th>Miercoles Inicio</th>
            <th>Miercoles Final</th>
            <th>Jueves Inicial</th>
            <th>Jueves Final</th>
            <th>Viernes Inicial</th>
            <th>Viernes Final</th>
            <th>Sabado Inicial</th>
            <th>Sabado Final</th>
            <th>Sabado Final</th>
            <th>Sabado Final</th>
             

           




        </tr>
        </thead>
        <tbody></tbody>
    </table>
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
    <script type="text/javascript">
        var oTable;
        $(document).ready(function () {
            oTable = $('#table').dataTable({
                "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                "sPaginationType": "bootstrap",

                "bProcessing": true,
                "bServerSide": true,
               "sAjaxSource": "{{ URL::to('admin/clases/data2/'.((isset($clase))?$clase->id:0)) }}"
                "fnDrawCallback": function (oSettings) {
                    $(".iframe").colorbox({
                        iframe: true,
                        width: "80%",
                        height: "80%",
                        onClosed: function () {
                            window.location.reload();
                        }
                    });
                }
            });
            var startPosition;
            var endPosition;
            $("#table tbody").sortable({
                cursor: "move",
                start: function (event, ui) {
                    startPosition = ui.item.prevAll().length + 1;
                },
                update: function (event, ui) {
                    endPosition = ui.item.prevAll().length + 1;
                    var navigationList = "";
                    $('#table #row').each(function (i) {
                        navigationList = navigationList + ',' + $(this).val();
                    });
                    $.getJSON("{{ URL::to('admin/clases/reorder') }}", {
                        list: navigationList
                    }, function (data) {
                    });
                }
            });
        });
    </script>

@stop
