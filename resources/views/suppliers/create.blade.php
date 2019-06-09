@extends('adminlte::page')

@section('title', 'Supplier baru')

@section('content_header')
    <h1>Supplier baru</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Supplier baru</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['action' => 'SupplierController@store', 'method' => 'post']) !!}

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									{{ Form::label('nama_supplier', 'Nama supplier') }}
									{{ Form::text('nama_supplier', '', ['class' => 'form-control', 'placeholder' => ' nama supplier']) }}
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									{{ Form::label('nomor_telepon', 'nomor telepon') }}
									{{ Form::text('nomor_telepon', '', ['class' => 'form-control', 'placeholder' => 'Nomor telepon']) }}
								</div>
							</div>
						</div>

						{{ Form::submit('Create supplier', ['class' => 'pull-right btn btn-default']) }}

						{!! Form::close() !!}
					</div>
				</div>
			</div>
    </div>
@stop
