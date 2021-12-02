@extends('adminlte::page')

@section('title', 'Data obat')

@section('content_header')
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-6">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Nama obat {{$gudangobat->MasterObat->nama_obat}}</h3>
			</div>
			<div class="box-body">
				<dl class="dl-horizontal">
					<dt>Nama obat:</dt>
					<dd>{{$gudangobat->MasterObat->nama_obat}}</dd>
					<dt>No batch:</dt>
					<dd>{{$gudangobat->no_batch}}</dd>
					<dt>Dosis:</dt>
					<dd>{{$gudangobat->MasterObat->dosis}}</dd>
					<dt>Expiry date:</dt>
					<dd>{{$gudangobat->expiry_date}}</dd>
					<dt>Bentuk sediaan:</dt>
					<dd>{{$gudangobat->MasterObat->bentuk_sediaan}}</dd>
					<dt>Suppliers:</dt>
					<dd>{{$gudangobat->supplier}}</dd>
					<dt>Harga satuan:</dt>
					<dd>{{$gudangobat->MasterObat->harga_satuan}}</dd>
					<dt>Jumlah stok:</dt>
					<dd>{{$gudangobat->jumlah}}</dd>
					<dt>Di input pada:</dt>
					<dd>{{$gudangobat->created_at}}</dd>
					<dt>Keterangan:</dt>
					<dd>{{$gudangobat->keterangan}}</dd>
				</dl>
			</div>
		</div>
	</div>


</div>
@stop

@section('js')
<script src="{{asset('js/render_datatables.js')}}" charset="utf-8"></script>
@endsection