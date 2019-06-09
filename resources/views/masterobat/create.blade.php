@extends('adminlte::page')

@section('title', 'Master data obat baru')

@section('content_header')
<h1>Obat baru</h1>
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
          <div class="col-sm-12">
            <div class="form-group">
              {{Form::label('nama_obat', 'Nama obat')}}
              {{Form::select('nama_obat', $kategoriobat->pluck('nama_kategori', 'nama_kategori'), null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => '-- Pilih nama obat --'])}}
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('bentuk_sediaan', 'bentuk sediaan')}}
              {{Form::select('bentuk_sediaan', $bentuksediaan->pluck('bentuk_sediaan', 'bentuk_sediaan'), null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => '-- Pilih Bentuk sediaan --'])}}
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