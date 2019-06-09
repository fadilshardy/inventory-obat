@extends('adminlte::page')

@section('title', 'Tambah bentuk sediaan')

@section('content_header')
<h1>Tambah bentuk sediaan</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">bentuk sediaan baru</h3>
			</div>
			<div class="box-body">
				{!! Form::open(['action' => 'BentukSediaanController@store', 'method' => 'post']) !!}

				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							{{ Form::label('bentuk_sediaan', ' Nama bentuk sediaan') }}
							{{ Form::text('bentuk_sediaan', '', ['class' => 'form-control', 'placeholder' => 'Nama bentuk sediaan']) }}
						</div>
					</div>
				</div>

				
				{{ Form::submit('submit', ['class' => 'pull-right btn btn-default']) }}

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop