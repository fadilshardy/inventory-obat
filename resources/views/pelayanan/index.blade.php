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
				<h3 class="box-title">Pelayanan</h3>
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
						$totals = DB::table('pelayanan_detail')
						->where('id_pelayanan', 49)
						->sum('qty');
						@endphp
						<tr>
							<td>{{$pelayanan->id}}</td>
							<td><a href="/pelayanan/{{$pelayanan->id}}">{{$pelayanan->nama_pasien}}</a></td>
							<td>{{$pelayanan->tanggal}}</td>
							<td>{{$pelayanan->keterangan}}</td>

							<td>

								<a href="/pelayanan/{{$pelayanan->id}}/edit" class="btn btn-default btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
								<a href="/pelayanan/{{$pelayanan->id}}/" class="btn btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<form action="{{ route('pelayanan.destroy', $pelayanan->id) }}" class="delete" method="POST">
									@method('DELETE')
									@csrf
									<button class="btn btn-default btn-sm "><i class="fa fa-trash-o" aria-hidden="true"></i>
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