@extends('adminlte::page')

@section('title', 'Gudang obat')

@section('content_header')
<h1>Gudang obat</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">
					<a href="/gudangobat/create">
						<div class="btn bg-purple">Tambah obat</div>
					</a>
				</h3>
			</div>
			<div class="box-body">
				<table class="table" id="datatable">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama obat</th>
							<th>No batch</th>
							<th>Expiry date</th>
							<th>Bentuk sediaan</th>
							<th>Supplier</th>
							<th>Harga satuan</th>
							<th>Jumlah</th>
							<th>Active</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						@foreach ($data as $data)
						@php
						$formattedexpiry_date = date("d-m-Y", strtotime($data->expiry_date));
						$date = Carbon\Carbon::parse($data->expiry_date);
						$kurang = Carbon\Carbon::parse($data->expiry_date)->subMonths(6);  
						$now = Carbon\Carbon::now();
						@endphp

						@php
						if($now->greaterThan($date)) {
						$label = 'danger';
						}
						elseif($now->lessThan($date) && $now->greaterThan($kurang) ) {
						$label = 'warning';
						}
						elseif($now->lessThan($date) && $now->lessThan($kurang)) {
						$label = 'success';
						}
						else{
						$label = 'success';
						}
						@endphp

						<tr>
							<td>{{$data->id}}</td>
							<td><a href="/gudangobat/{{$data->id}}">{{$data->MasterObat->nama_obat}} </a> {{$data->MasterObat->dosis}}</td>
							<td>{{$data->no_batch}}</td>
							<td><span class="label label-{{$label}}">{{$formattedexpiry_date}}</span></td>
							<td>{{$data->MasterObat->bentuk_sediaan}}</td>
							<td>{{$data->supplier}}</td>
							<td style="text-align: center;">
								<span class="label label-info">Rp. {{$data->MasterObat->harga_satuan}}</span></h3>
							</td>
							<td style="text-align: center;"><span class="badge badge-secondary">
									{{$data->jumlah}}</span> </td>
							<td>
								@if ($data->active == 1)
								<span class="label label-success">Yes</span>
								@else
								<span class="label label-danger">No</span>
								@endif
							</td>
							<td>


								<form action="{{ route('gudangobat.destroy', $data->id) }}" class="delete" method="POST">
									@method('DELETE')
									@csrf
									<button class="btn btn-default btn-xs  btn-block "><i class="fa fa-trash-o" aria-hidden="true"></i>
										Delete
									</button>
								</form>

							</td>
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop

@section('js')
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>
<script src="{{asset('js/render_datatables.js')}}" charset="utf-8"></script>
@endsection