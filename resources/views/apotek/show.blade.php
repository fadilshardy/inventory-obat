@extends('adminlte::page')

@section('title', 'Data obat ')

@section('content_header')
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-6">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Detail obat</h3>
			</div>
			<div class="box-body">
				<dl class="dl-horizontal">
					<dt>Nama obat:</dt>
					<dd>{{$data->MasterObat->nama_obat}}</dd>
					<dt>No batch:</dt>
					<dd>{{$data->GudangObat->no_batch}}</dd>
					<dt>Dosis:</dt>
					<dd>{{$data->MasterObat->dosis}}</dd>
					<dt>Expiry date:</dt>
					<dd>{{$data->GudangObat->expiry_date}}</dd>
					<dt>Bentuk sediaan:</dt>
					<dd>{{$data->MasterObat->bentuk_sediaan}}</dd>
					<dt>Suppliers:</dt>
					<dd>{{$data->GudangObat->supplier}}</dd>
					<dt>Harga satuan:</dt>
					<dd>{{$data->GudangObat->harga_satuan}}</dd>
					<dt>Jumlah stok:</dt>
					<dd>{{$data->jumlah}}</dd>

					<dt>Di input pada:</dt>
					<dd>{{$data->created_at}}</dd>
				</dl>
			</div>
		</div>
	</div>


</div>
@stop

@section('js')
<script src="{{asset('js/render_datatables.js')}}" charset="utf-8"></script>
@endsection