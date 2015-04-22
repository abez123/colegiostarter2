@extends('admin.layouts.modal') @section('content')
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab"> {{
			trans("admin/modal.general") }}</a></li>
</ul>
<form class="form-horizontal" method="post"
	action="@if(isset($grupo)){{ URL::to('admin/grupo/'.$grupo->id.'/edit') }}
	        @else {{ URL::to('admin/grupo/create') }}
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
						<label class="control-label" for="grupo">Nombre de Grupo</label> <input
							class="form-control" type="text" name="name" id="name"
							value="{{{ Input::old('grupo', isset($grupo) ? $grupo->name : null) }}}" />
						{!!$errors->first('name', '<span class="help-block">:message </span>')!!}
					</div>
				</div>
                <div
                        class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="grupo"> Año Escolar</label> <select
                                class="form-control" type="text" name="schoolyear" id="schoolyear">
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                        </select>


                                                      {!!$errors->first('schoolyear', '<span class="help-block">:message </span>')!!}
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
					@if (isset($grupo))
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
