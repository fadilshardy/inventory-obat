@extends('adminlte::page')

@section('title', 'Apotek')

@section('content_header')
<h1>Apotek</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<a href="/apotek/create">
					<div class="btn bg-purple">Tambah obat</div>
				</a> </div>
			<div class="box-body">
				<table class="table" id="datatable">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama obat</th>
							<th>No batch</th>
							<th>dosis</th>
							<th>Expiry date</th>
							<th>Bentuk sediaan</th>
							<th>Supplier</th>
							<th>Harga satuan</th>
							<th>Jumlah</th>
							<th>Instock</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($apotek as $apotek)
						@php
						$formattedexpiry_date = date("d-m-Y", strtotime($apotek->GudangObat->expiry_date));
						$date = Carbon\Carbon::parse($apotek->GudangObat->expiry_date);
						$kurang = Carbon\Carbon::parse($apotek->GudangObat->expiry_date)->subYear();
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
							<td>{{$apotek->id}}</td>
							<td><a href="/apotek/{{$apotek->id}}">{{$apotek->MasterObat->nama_obat}}</a></td>
							<td>{{$apotek->GudangObat->no_batch}}</td>
							<td>{{$apotek->MasterObat->dosis}}</td>
							<td><span class="label label-{{$label}}">{{$formattedexpiry_date}}</span></td>
							<td>{{$apotek->MasterObat->bentuk_sediaan}}</td>
							<td>{{$apotek->GudangObat->supplier}}</td>
							<td style="text-align: center;">
								<span class="label bg-teal">Rp. {{$apotek->GudangObat->harga_satuan}}</span></h3>
							</td>
							<td style="text-align: center;"><span class="badge badge-secondary">
									{{$apotek->jumlah_apotek}}</span> </td>
							<td>
								@if ($apotek->active == 1)
								<span class="label label-success">Yes</span>
								@else
								<span class="label label-danger">No</span>
								@endif
							</td>
							<td>


								<form action="{{ route('apotek.destroy', $apotek->id) }}" class="delete" method="POST">
									@method('delete')
									@csrf
									<button class="btn btn-default btn-xs btn-block "><i class="fa fa-trash-o" aria-hidden="true"></i>
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