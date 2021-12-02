@extends('adminlte::page')

@section('title', 'Gudang obat')

@section('content_header')
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">
					<a href="/gudangobat/create">
						<div class="btn bg-purple">Tambah</div>
					</a>
				</h3>
			</div>
			<div class="box-body">
				<table class="table" id="datatable">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama pasien</th>
							<th>tanggal</th>
							<th>keterangan</th>
							<th>Action</th>

						</tr>
					</thead>
					<tbody>

						@foreach ($pelayanan as $pelayanan)
						@php
						$formattedexpiry_date = date("d-m-Y", strtotime($pelayanan->tanggal));
						@endphp
						<tr>
							<td>{{$pelayanan->id}}</td>
							<td><a href="/pelayanan/{{$pelayanan->id}}">{{$pelayanan->DataPasien->nama_pasien}}</a></td>
							<td>{{$formattedexpiry_date}}</td>
							<td>{{$pelayanan->keterangan}}</td>

							<td>
								<form action="{{ route('pelayanan.destroy', $pelayanan->id) }}" class="delete" method="POST">
									@method('DELETE')
									@csrf
									<button class="btn btn-default btn-sm btn-block "><i class="fa fa-trash-o" aria-hidden="true"></i>
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