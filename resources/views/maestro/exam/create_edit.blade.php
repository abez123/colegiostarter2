@extends('admin.layouts.modal') @section('content')
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab"> {{
			trans("admin/modal.general") }}</a></li>
</ul>
<form class="form-horizontal" method="post"
	action="@if(isset($exam)){{ URL::to('maestro/exam/'.$exam->id.'/edit') }}
	        @else {{ URL::to('maestro/exam/create') }}
	        @endif"
	autocomplete="off">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	
	<div class="tab-content">
		<div class="tab-pane active" id="tab-general">
			<div class="tab-pane active" id="tab-general">
				<div  class="form-group {{{ $errors->has('clase_id') ? 'error' : '' }}}">
					<div class="col-md-12">
						<label class="control-label" for="clase_id">Clase</label> <select
							style="width: 100%" name="clase_id" id="clase_id"
							class="form-control"> @foreach($clases as $item)
							<option value="{{$item->id}}"
								@if(!empty($clases))
                                        @if($item->id==$clase)
								            selected="selected"
								        @endif
								@endif >{{$item->name}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
					<div class="col-md-12">
						<label class="control-label" for="name">Nombre de Examen</label> <input
							class="form-control" type="text" name="name" id="name"
							value="{{{ Input::old('exam', isset($exam) ? $exam->name : null) }}}" />
						
					</div>
				</div>
                <div class="form-group {{{ $errors->has('mes') ? 'has-error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="mes"> Mes</label> <select
                                class="form-control" type="text" name="mes" id="mes">
                            <option value="Septiembre">Septiembre</option>
                            <option value="Octubre">Octubre</option>
                            <option value="Noviembre">Noviembre</option>
                            <option value="Diciembre">Diciembre</option>
                            <option value="Enero">Enero</option>
                            <option value="Febrero">Febrero</option>
                            <option value="Marzo">Marzo</option>
                            <option value="Abril">Abril</option>
                            <option value="ayo">Mayo</option>
                            <option value="Junio">Junio</option>
                        </select>


                    </div>
                </div>
<div class="form-group {{{ $errors->has('bimestre') ? 'has-error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="bimestre"> Bimestre</label> <select
                                class="form-control" type="text" name="bimestre" id="bimestre">
                            <option value="Primer Bimestre">Primer Bimestre</option>
                            <option value="Segundo Bimestre">Segundo Bimestre</option>
                            <option value="Tercer Bimestre">Tercer Bimestre</option>
                            <option value="Cuarto Bimestre">Cuarto Bimestre</option>
                            <option value="Quinto Bimestre">Quinto Bimestre</option>
                            <option value="Sexto Bimestre">Sexto Bimestre</option>
                            
                        </select>


                                               
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
					@if (isset($exam))
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
