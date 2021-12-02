@extends('adminlte::page')

@section('title', 'Pelayanan')

@section('content_header')
<h1>Pelayanan #{{$pelayanan->id}}</h1>
@stop

@section('content')
@include('includes.messages')
<?php
$tanggal_input = date("d-m-Y", strtotime($pelayanan->created_at));
?>
<div class="row">
	<div class="col-sm-3">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Detail</h3>
			</div>
			<div class="box-body">
				<dl class="dl-vertical">
					<dt>Nama pasien:</dt>
					<dd>{{$pelayanan->DataPasien->nama_pasien}}</dd>
					<dt>Keterangan:</dt>
					<dd>{{$pelayanan->keterangan}}</dd>
					<dt>Di input pada:</dt>
					<dd>{{$tanggal_input}}</dd>
				</dl>
			</div>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Obat</h3>
			</div>
			<div class="box-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama obat</th>
							<th>harga</th>
							<th>Jumlah</th>
							<th class="text-right">Total</th>
						</tr>
					</thead>
					<tbody>

						@php $i = 0; $total_unformatted = 0; @endphp
						@foreach ($pelayanan_detail as $pelayanan_detail)
						@php
						$i++;
						$harga_total_perobat = $pelayanan_detail->harga_jual * $pelayanan_detail->qty;
						$harga_total_rupiah = number_format($harga_total_perobat,0,',',',');
						$total_unformatted = $total_unformatted + $harga_total_perobat;
						$total_akhir = number_format($total_unformatted,0,',','.');
						@endphp
						<tr>
							<td>{{$i}}</td>
							<td>{{$pelayanan_detail->nama_obat}}</td>

							<td>{{$pelayanan_detail->harga_jual}}</td>
							<td>{{$pelayanan_detail->qty}}</td>
							<td class="text-right">Rp. {{$harga_total_rupiah}}</td>


						</tr>
						@endforeach
						<tr class="im-total-border">

							<td colspan="5" class="text-right text-bold">Harga total: Rp. {{$total_akhir}}</td>

						</tr>
						<tr class="im-total-border">

							<td colspan="5" class="text-right text-bold">total obat: {{$total}}</td>

						</tr>


					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop

@section('js')
<script src="{{asset('js/render_datatables.js')}}" charset="utf-8"></script>
@endsection