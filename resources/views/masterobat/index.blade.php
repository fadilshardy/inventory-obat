@extends('adminlte::page')

@section('title', 'Master data obat')

@section('content_header')
<h1>Master data obat</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<a href="/masterobat/create">
					<div class="btn bg-purple">Tambah</div>
				</a> </div>
			<div class="box-body">
				<table class="table" id="datatable">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama obat</th>
							<th>dosis</th>
							<th>Bentuk sediaan</th>
							<th>Harga satuan</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						@foreach ($masterobat as $data)
						<tr>
							<td>{{$data->id}}</td>
							<td><a href="/masterobat/{{$data->id}}">{{$data->nama_obat}}</a></td>
							<td>{{$data->dosis}}</td>
							<td>{{$data->bentuk_sediaan}}</td>
							<td>{{$data->harga_satuan}}</td>

							<td>
								<div class="col-sm-12">
									<div class="btn-group" role="group" aria-label="Basic example">

										<a href="/masterobat/{{$data->id}}/edit" class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											Edit
										</a>
									</div>
								</div>

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