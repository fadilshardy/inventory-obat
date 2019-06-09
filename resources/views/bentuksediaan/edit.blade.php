@extends('adminlte::page')

@section('title', 'Edit bentuk sediaan {{$bentuksediaan->bentuk_sediaan}}')

@section('content_header')
<h1>Edit bentuk sediaan {{$bentuksediaan->bentuk_sediaan}}</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Edit bentuk sediaan {{$bentuksediaan->bentuk_sediaan}}</h3>
			</div>
			<div class="box-body">
				{!! Form::open(['action' => ['BentukSediaanController@update', $bentuksediaan->id], 'method' => 'post']) !!}

				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							{{ Form::label('bentuk_sediaan', 'Bentuk sediaan') }}
							{{ Form::text('bentuk_sediaan', $bentuksediaan->bentuk_sediaan, ['class' => 'form-control', 'placeholder' => 'Nama bentuk sediaan']) }}
						</div>
					</div>
				</div>

				{{ Form::hidden('_method', 'PUT') }}
				{{ Form::submit('Save changes', ['class' => 'pull-right btn btn-default']) }}

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop