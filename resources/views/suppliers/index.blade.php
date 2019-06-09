@extends('adminlte::page')

@section('title', 'Supplier')

@section('content_header')
    <h1>Supplier</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Supplier</h3>
					</div>
					<div class="box-body">
						<table class="table" id="datatable">
							<thead>
								<tr>
									<th>#</th>
									<th>nama supplier</th>
									<th>nomor telepon</th>
									<th></th>
								</tr>
							</thead>
							<tbody>

								@foreach ($suppliers as $supplier)
									<tr>
										<td>{{$supplier->id}}</td>
										<td><a href="/suppliers/{{$supplier->id}}">{{$supplier->nama_supplier}}</a></td>
										<td>{{$supplier->nomor_telepon}}</td>
										<td><a href="/suppliers/{{$supplier->id}}/edit" class="btn btn-default">Edit</a></td>
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
