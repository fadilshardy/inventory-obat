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
				<h3 class="box-title">Gudang obat</h3>
			</div>
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
							<th>Keterangan</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						@foreach ($gudangobat as $gudangobat)
						@php
						$formattedexpiry_date = date("d-m-Y", strtotime($gudangobat->expiry_date));
						@endphp
						<tr>
							<td>{{$gudangobat->id}}</td>
							<td><a href="/gudangobat/{{$gudangobat->id}}">{{$gudangobat->nama_obat}}</a></td>
							<td>{{$gudangobat->no_batch}}</td>
							<td>{{$gudangobat->dosis}}</td>
							<td>{{$formattedexpiry_date}}</td>
							<td>{{$gudangobat->bentuk_sediaan}}</td>
							<td>{{$gudangobat->supplier}}</td>
							<td>{{$gudangobat->harga_satuan}}</td>
							<td>{{$gudangobat->jumlah}}</td>
							<td>
								@if ($gudangobat->instock == 1)
								<span class="label label-success">Yes</span>
								@else
								<span class="label label-danger">No</span>
								@endif
							</td>
							<td>{{$gudangobat->keterangan}}</td>

							<td>

								<a href="/gudangobat/{{$gudangobat->id}}/edit" class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									Edit
								</a>

								<form action="{{ route('gudangobat.destroy', $gudangobat->id) }}" class="delete" method="POST">
									@method('DELETE')
									@csrf
									<button class="btn btn-default btn-xs "><i class="fa fa-trash-o" aria-hidden="true"></i>
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
<script src="{{asset('js/render_datatables.js')}}" charset="utf-8"></script>
@endsection