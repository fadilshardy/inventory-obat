@extends('adminlte::page')

@section('title', 'Master data obat baru')

@section('content_header')
<h1>Data obat baru</h1>
@stop

@section('content')
@include('includes.messages')

<div class="row">
  <div class="col-sm-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Master data obat baru</h3>
      </div>
      <div class="box-body">
        {!! Form::open(['action' => 'MasterObatController@store', 'method' => 'post']) !!}

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('nama_obat', 'Nama obat')}}
              {{ Form::text('nama_obat', '', ['class' => 'form-control', 'placeholder' => 'Nama obat']) }}

            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('bentuk_sediaan', 'bentuk sediaan')}}
              {{ Form::text('bentuk_sediaan', '', ['class' => 'form-control', 'placeholder' => 'Bentuk sediaan obat']) }}

            </div>
          </div>
        </div>

      

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('harga_satuan', 'Harga')}}
              {{ Form::text('harga_satuan', '', ['class' => 'form-control', 'placeholder' => 'Harga satuan obat']) }}

            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('dosis', 'dosis')}}
              {{ Form::text('dosis', '', ['class' => 'form-control', 'placeholder' => 'dosis']) }}
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-1 pull-right">

            {{ Form::submit('Submit', ['class' => 'btn bg-purple']) }}

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  @stop

  @section('js')
  <script src="{{asset('js/render_select2.js')}}" charset="utf-8"></script>
  @endsection