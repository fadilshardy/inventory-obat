@extends('adminlte::page')

@section('title', 'Edit kategori obat {{$kategori_obat->nama_kategori}}')

@section('content_header')
<h1>Edit kategori obat {{$kategoriobat->nama_kategori}}</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Edit kategori obat {{$kategoriobat->nama_kategori}}</h3>
			</div>
			<div class="box-body">
				{!! Form::open(['action' => ['KategoriObatController@update', $kategoriobat->id], 'method' => 'post']) !!}

				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							{{ Form::label('nama_kategori', 'Nama kategori') }}
							{{ Form::text('nama_kategori', $kategoriobat->nama_kategori, ['class' => 'form-control', 'placeholder' => 'Nama kategori']) }}
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