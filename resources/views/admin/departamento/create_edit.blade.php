@extends('admin.layouts.modal') {{-- Content --}} @section('content')
<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab"> {{
			trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
<form class="form-horizontal" enctype="multipart/form-data"
	method="post"
	action="@if(isset($departamento)){{ URL::to('admin/departamento/'.$departamento->id.'/edit') }}
	        @else{{ URL::to('admin/departamento/create') }}@endif"
	autocomplete="off">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<div class="tab-content">
		<div class="tab-pane active" id="tab-general">
			<div
				class="form-group {{{ $errors->has('nombre') ? 'has-error' : '' }}}">
				<div class="col-md-12">
					<label class="control-label" for="name"> Nombre</label> <input
						class="form-control" type="text" name="nombre" id="nombre"
						value="{{{ Input::old('nombre', isset($departamento) ? $departamento->nombre : null) }}}" />
					{!!$errors->first('nombre', '<label class="control-label" for="nombre">:message</label>')!!}
				</div>
			</div>
			<div class="tab-content">
		<div class="tab-pane active" id="tab-general">
			
				<div
				class="form-group">
				<div class="col-md-12">
					<label class="control-label" for="descripcion"> Descripcion</label> <input
						class="form-control" type="text" name="descripcion" id="descripcion"
						value="{{{ Input::old('descripcion', isset($departamento) ? $departamento->descripcion : null) }}}" />
					
				</div>
			</div>
			<div
				class="form-group {{{ $errors->has('depa_code') ? 'has-error' : '' }}}">
				<div class="col-md-12">
					<label class="control-label" for="depa_code">Clave</label> <input
						class="form-control" type="text" name="depa_code" id="depa_code"
						value="{{{ Input::old('depa_code', isset($departamento) ? $departamento->depa_code : null) }}}" />
					{!!$errors->first('depa_code', '<label class="control-label"
						for="name">:message</label>')!!}
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
				@if (isset($departamento)) 
				    {{ trans("admin/modal.edit") }}
				@else 
				    {{trans("admin/modal.create") }}
			     @endif
			</button>
		</div>
	</div>
            </div>
    </div>
</form>
@stop
