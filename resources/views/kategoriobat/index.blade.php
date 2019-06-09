@extends('adminlte::page')

@section('title', 'Kategori obat')

@section('content_header')
<h1>Kategori obat</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Kategori obat</h3>
			</div>
			<div class="box-body">
				<table class="table" id="datatable">
					<thead>
						<tr>
							<th>#</th>
							<th>nama Kategori</th>
							<th>Action</th>

						</tr>
					</thead>
					<tbody>

						@foreach ($kategoriobat as $kategori_obat)
						<tr>
							<td>{{$kategori_obat->id}}</td>
							<td><a href="/kategoriobat/{{$kategori_obat->id}}">{{$kategori_obat->nama_kategori}}</a></td>
							<td>
								<div class="btn-toolbar" role="toolbar">
									<div class="btn-group mr-2" role="group">

										<a href="/kategoriobat/{{$kategori_obat->id}}/edit" class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
										</a>
									</div>
									<div class="btn-group mr-2" role="group">

										<form action="{{ route('kategoriobat.destroy', $kategori_obat->id) }}" class="delete" method="POST">
											@method('DELETE')
											@csrf
											<button class="btn btn-danger delete"><i class="fa fa-trash-o" aria-hidden="true"></i>
											</button>
										</form>
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