@extends('adminlte::page')

@section('title', 'Kategori Obat')

@section('content_header')
<h1>Kategori obat {{ $kategoriobat->nama_kategori}}</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-3">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Kategori obat {{$kategoriobat->nama_kategori}}</h3>
			</div>
			<div class="box-body">
				<dl class="dl-vertical">
					<dt>#id:</dt>
					<dd>{{$kategoriobat->id}}</dd>
					<dt>Nama kategori:</dt>
					<dd>{{$kategoriobat->nama_kategori}}</dd>
					<dt>Dibuat pada:</dt>
					<dd>{{$kategoriobat->created_at}}</dd>
				</dl>
			</div>
		</div>
	</div>


</div>
@stop

@section('js')
<script src="{{asset('js/render_datatables.js')}}" charset="utf-8"></script>
@endsection