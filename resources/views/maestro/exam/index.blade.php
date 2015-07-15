@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ trans("admin/materia.materia") }}} @parent @stop

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
           Examenes
            <div class="pull-right">
                <a href="{{{ URL::to('maestro/exam/create') }}}"
                   class="btn btn-sm  btn-primary iframe"><span
                            class="glyphicon glyphicon-plus-sign"></span> {{
				trans("admin/modal.new") }}</a>
            </div>
        </h3>
    </div>

    <table id="table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID de la Clase</th>
           
            <th>Nombre del examen</th>

            <th>Mes</th>
            <th>Bimestre</th>

       
            <th>{{{ trans("admin/admin.action") }}}</th>
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
                "sAjaxSource": "{{ URL::to('maestro/exam/data/')}}",
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
                    $.getJSON("{{ URL::to('admin/materia/reorder') }}", {
                        list: navigationList
                    }, function (data) {
                    });
                }
            });
        });
    </script>
@stop
