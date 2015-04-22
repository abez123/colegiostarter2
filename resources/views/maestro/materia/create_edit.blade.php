@extends('admin.layouts.modal') @section('content')
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab"> {{
			trans("admin/modal.general") }}</a></li>
</ul>
<form class="form-horizontal" method="post"
	action="@if(isset($materia)){{ URL::to('admin/materia/'.$materia->id.'/edit') }}
	        @else {{ URL::to('admin/materia/create') }}
	        @endif"
	autocomplete="off">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<div class="tab-content">
		<div class="tab-pane active" id="tab-general">
			<div class="tab-pane active" id="tab-general">
				<div
					class="form-group {{{ $errors->has('departamento_id') ? 'error' : '' }}}">
					<div class="col-md-12">
						<label class="control-label" for="departamento_id">Etapa Escolar</label> <select
							style="width: 100%" name="departamento_id" id="departamento_id"
							class="form-control"> @foreach($departamentos as $item)
							<option value="{{$item->id}}"
								@if(!empty($departmentos))
                                        @if($item->id==$departamentos)
								            selected="selected"
								        @endif
								@endif >{{$item->nombre}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div
					class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
					<div class="col-md-12">
						<label class="control-label" for="materia">Nombre</label> <input
							class="form-control" type="text" name="name" id="name"
							value="{{{ Input::old('materia', isset($materia) ? $materia->name : null) }}}" />
						{!!$errors->first('name', '<span class="help-block">:message </span>')!!}
					</div>
				</div>

                <div
                        class="form-group {{{ $errors->has('clave') ? 'has-error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="materia">Clave</label> <input
                                class="form-control" type="text" name="clave" id="clave"
                                value="{{{ Input::old('materia', isset($materia) ? $materia->clave : null) }}}" />
                        {!!$errors->first('clave', '<span class="help-block">:message </span>')!!}
                    </div>
                </div>

                <div
                        class="form-group {{{ $errors->has('plan') ? 'has-error' : '' }}}">
                    <div class="col-md-12">Plan</label> <input
                                class="form-control" type="text" name="plan" id="plan"
                                value="{{{ Input::old('materia', isset($materia) ? $materia->plan : null) }}}" />
                        {!!$errors->first('plan', '<span class="help-block">:message </span>')!!}
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
					@if (isset($materia))
					   {{ trans("admin/modal.edit") }}
				    @else 
				        {{trans("admin/modal.create") }}
				    @endif
				</button>
			</div>
		</div>
	</div>
</form>
@stop
