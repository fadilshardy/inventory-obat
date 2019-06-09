@extends('adminlte::page')

@section('title', 'Tambah kategori obat')

@section('content_header')
<h1>Tambah kategori obat</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Kategori obat baru</h3>
			</div>
			<div class="box-body">
				{!! Form::open(['action' => 'KategoriObatController@store', 'method' => 'post']) !!}

				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							{{ Form::label('nama_kategori', 'Nama kategori') }}
							{{ Form::text('nama_kategori', '', ['class' => 'form-control', 'placeholder' => 'Nama kategori']) }}
						</div>
					</div>
				</div>

				
				{{ Form::submit('Buat kategori obat', ['class' => 'pull-right btn btn-default']) }}

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop