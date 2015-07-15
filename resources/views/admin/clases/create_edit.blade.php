@extends('admin.layouts.modal') @section('content')
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab"> {{
			trans("admin/modal.general") }}</a></li>
</ul>
<form class="form-horizontal" method="post"
      action="@if(isset($clase)){{ URL::to('admin/clases/'.$clase->id.'/edit') }}
	        @else {{ URL::to('admin/clases/create') }}
	        @endif"
      autocomplete="off">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<div class="tab-content">
		<div class="tab-pane active" id="tab-general">
			<div class="tab-pane active" id="tab-general">
				<div  class="form-group {{{ $errors->has('grupo_id') ? 'error' : '' }}}">
					<div class="col-md-12">
						<label class="control-label" for="grupo_id">Asignar Grupo</label> <select
							style="width: 100%" class="js-example-basic-single" name="grupo_id" id="grupo_id"
							class="form-control"> @foreach($grupos as $item)
							<option value="{{$item->id}}"
								@if(!empty($grupo))
                                        @if($item->id==$grupo)
								            selected="selected"
								        @endif
								@endif >{{$item->name}}</option>
							@endforeach
						</select>
					</div>
				</div>


                <div  class="form-group {{{ $errors->has('maestro_id') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="maestro_id">Asignar Maestro(a)</label> <select
                                style="width: 100%" class="js-example-basic-single" name="maestro_id" id="maestro_id"
                                class="form-control"> @foreach($maestros as $item)
                                <option value="{{$item->id}}"
                                @if(!empty($maestro))
                                    @if($item->id==$maestro)
                                        selected="selected"
                                            @endif
                                        @endif >{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div  class="form-group {{{ $errors->has('materia_id') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="materia_id">Asignar Materia</label> <select
                                style="width: 100%" class="js-example-basic-single" name="materia_id" id="materia_id"
                                class="form-control"> @foreach($materias as $item)
                                <option value="{{$item->id}}"
                                @if(!empty($materia))
                                    @if($item->id==$materia)
                                        selected="selected"
                                            @endif
                                        @endif >{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="clase">Nombre de la Clase</label> <input
                                class="form-control" type="text" name="name" id="name"
                                value="{{{ Input::old('name', isset($clase) ? $clase->name : null) }}}" />
                       
                    </div>
                </div>



                <div class="row">

                    <div class="col-md-2">

                        <label class="control-label" for="lunesi">Lunes Inicio</label> <input
                                class="form-control" type="time" name="lunesi" id="lunesi"
                                value="{{{ Input::old('lunesi', isset($clase) ? $clase->lunesi : null) }}}" />
                       
                    </div>

                    <div class="col-md-2">

                        <label class="control-label" for="lunesf">Lunes Final</label> <input
                                class="form-control" type="time" name="lunesf" id="lunesf"
                                value="{{{ Input::old('lunesf', isset($clase) ? $clase->lunesf : null) }}}" />
                       
                    </div>


                    <div class="col-md-2">

                        <label class="control-label" for="martesi">Martes Inicio</label> <input
                                class="form-control" type="time" name="martesi" id="martesi"
                                value="{{{ Input::old('martesi', isset($clase) ? $clase->martesi : null) }}}" />
                        
                    </div>

                    <div class="col-md-2">

                    <label class="control-label" for="martesf">Martes Final</label> <input
                            class="form-control" type="time" name="martesf" id="martesf"
                            value="{{{ Input::old('martesf', isset($clase) ? $clase->martesf : null) }}}" />
                    
                </div>

                <div class="col-md-2">

                    <label class="control-label" for="miercolesi">Miercoles Inicio</label> <input
                            class="form-control" type="time" name="miercolesi" id="miercolesi"
                            value="{{{ Input::old('miercolesi', isset($clase) ? $clase->miercolesi : null) }}}" />
                  
                </div>
                    <div class="col-md-2">

                        <label class="control-label" for="miercolesf">Miercoles Final</label> <input
                                class="form-control" type="time" name="miercolesf" id="miercolesf"
                                value="{{{ Input::old('miercolesf', isset($clase) ? $clase->miercolesf : null) }}}" />
                       
                    </div>
            </div>

                <div class="row">
                    <div class="col-md-2">

                        <label class="control-label" for="juevesi">Jueves Inicio</label> <input
                                class="form-control" type="time" name="juevesi" id="juevesi"
                                value="{{{ Input::old('juevesi', isset($clase) ? $clase->juevesi : null) }}}" />
                      
                    </div>

                    <div class="col-md-2">
                        <label class="control-label" for="juevesf">Jueves Final</label> <input
                                class="form-control" type="time" name="juevesf" id="juevesf"
                                value="{{{ Input::old('juevesf', isset($clase) ? $clase->juevesf : null) }}}" />
                       
                    </div>

                    <div class="col-md-2">

                        <label class="control-label" for="viernesi">Viernes Inicio</label> <input
                                class="form-control" type="time" name="viernesi" id="viernesi"
                                value="{{{ Input::old('viernesi', isset($clase) ? $clase->viernesi : null) }}}" />
                       
                    </div>

                    <div class="col-md-2">
                        <label class="control-label" for="viernesf">Viernes Final</label> <input
                                class="form-control" type="time" name="viernesf" id="viernesf"
                                value="{{{ Input::old('viernesf', isset($clase) ? $clase->viernesf : null) }}}" />
                        
                    </div>

                    <div class="col-md-2">

                        <label class="control-label" for="sabadoi">Sabado Inicio</label> <input
                                class="form-control" type="time" name="sabadoi" id="sabadoi"
                                value="{{{ Input::old('sabadoi', isset($clase) ? $clase->sabadoi : null) }}}" />
                       
                    </div>
                    <div class="col-md-2">
                        <label class="control-label" for="sabadof">Sabado Final</label> <input
                                class="form-control" type="time" name="sabadof" id="sabadof"
                                value="{{{ Input::old('sabadof', isset($clase) ? $clase->sabadof : null) }}}" />
                       
                    </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="confirm">Activar Clase</label>
                            <div class="col-md-6">
                                <select class="form-control" name="confirmed" id="confirmed">
                                    <option value="1" {{{ ((isset($clase) && $clase->confirmed == 1)? '
								selected="selected"' : '') }}}>Si</option>
                                    <option value="0" {{{ ((isset($clase) && $clase->confirmed == 0) ?
								' selected="selected"' : '') }}}>No</option>
                                </select>

                        </div>
                    </div>
                </div>


         </div>

     </div>
   </div>

		<div class="form-group">
			<div class="col-md-12">
				<button type="reset" class="btn btn-sm btn-warning close_popup">
					<span class="glyphicon glyphicon-ban-circle"></span> {{
					trans("admin/modal.cancel") }}
				</button>
				<button type="reset" class="btn btn-sm btn-default">
					<span class="glyphicon glyphicon-remove-circle"></span> {{
					trans("admin/modal.reset") }}
				</button>
				<button type="submit" class="btn btn-sm btn-success">
					<span class="glyphicon glyphicon-ok-circle"></span> 
					@if (isset($clase))
					   {{ trans("admin/modal.edit") }}
				    @else 
				        {{trans("admin/modal.create") }}
				    @endif
				</button>
			</div>
		</div>

</form>
@stop @section('scripts')
    <script type="text/javascript">
        $(function() {
            $("#roles").select2();
            $(".js-example-basic-single").select2();
        });




    </script>
@stop

