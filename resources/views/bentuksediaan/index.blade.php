@extends('adminlte::page')

@section('title', 'Bentuk sediaant')

@section('content_header')
<h1>Bentuk sediaan</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Bentuk sediaan</h3>
			</div>
			<div class="box-body">
				<table class="table" id="datatable">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama nentuk sediaan</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						@foreach ($bentuksediaan as $bentuk_sediaan)
						<tr>
							<td>{{$bentuk_sediaan->id}}</td>
							<td><a href="/bentuksediaan/{{$bentuk_sediaan->id}}">{{$bentuk_sediaan->bentuk_sediaan}}</a></td>
							<td><a href="/bentuksediaan/{{$bentuk_sediaan->id}}/edit" class="btn btn-default">Edit</a></td>
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