@extends('adminlte::page')

@section('title', 'Data pasien')

@section('content_header')
<h1>Data pasien</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<a href="/datapasien/create">
					<div class="btn bg-purple">Tambah data</div>
				</a> </div>
			<div class="box-body">
				<table class="table" id="datatable">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Jenis kelamin</th>
							<th>Tanggal lahir</th>
							<th>Alamat</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						@foreach ($data as $data)
						@php
						$formattedexpiry_date = date("d-m-Y", strtotime($data->expiry_date));
						@endphp
						<tr>
							<td>{{$data->id}}</td>
							<td>{{$data->nama_pasien}}</td>
							<td>{{$data->gender}}</td>
							<td>{{$data->tanggal_lahir}}</td>
							<td>{{$data->alamat}}</td>
							<td>

								<a href="/datapasien/{{$data->id}}/edit" class="btn btn-default btn-xs btn-block"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									Edit
								</a>

								<form action="{{ route('datapasien.destroy', $data->id) }}" class="delete" method="POST">
									@method('DELETE')
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
<script src="{{asset('js/render_datatables.js')}}" charset="utf-8"></script>
@endsection