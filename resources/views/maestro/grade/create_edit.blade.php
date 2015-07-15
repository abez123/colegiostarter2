@extends('admin.layouts.modal') @section('content')
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab"> {{
			trans("admin/modal.general") }}</a></li>
</ul>
<form class="form-horizontal" method="post"
	action="@if(isset($grade)){{ URL::to('maestro/grade/'.$grade->id.'/edit') }}
	        @else {{ URL::to('maestro/grade/create') }}
	        @endif"
	autocomplete="off">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	
	<div class="tab-content">
		<div class="tab-pane active" id="tab-general">
			<div class="tab-pane active" id="tab-general">
				<div  class="form-group {{{ $errors->has('exam_id') ? 'error' : '' }}}">
					<div class="col-md-12">
						<label class="control-label" for="exam_id">Examen</label> <select
							style="width: 100%" name="exam_id" id="exam_id"
							class="form-control"> @foreach($exams as $item)
							<option value="{{$item->id}}"
								@if(!empty($exams))
                                        @if($item->id==$exam)
								            selected="selected"
								        @endif
								@endif >{{$item->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
					<div  class="form-group {{{ $errors->has('alumno_id') ? 'error' : '' }}}">
					<div class="col-md-12">
						<label class="control-label" for="alumno_id">Alumno(a)</label> <select
							style="width: 100%" name="alumno_id" id="alumno_id"
							class="form-control"> @foreach($alumnos as $item)
							<option value="{{$item->id}}"
								@if(!empty($alumnos))
                                        @if($item->id==$alumno)
								            selected="selected"
								        @endif
								@endif >{{$item->name}} {{$item->apellidop}} {{$item->apellidom}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group {{{ $errors->has('score') ? 'has-error' : '' }}}">
					<div class="col-md-12">
						<label class="control-label" for="score">Calificación</label> <input
							class="form-control" type="text" name="score" id="score"
							value="{{{ Input::old('score', isset($grade) ? $grade->score : null) }}}" />
						
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
					@if (isset($grade))
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
