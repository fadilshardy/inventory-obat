@extends('adminlte::page')

@section('title', 'Edit data gudang obat')

@section('content_header')
<h1>Edit product {{$gudangobat->nama_obat}}</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
  <div class="col-sm-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Obat {{$gudangobat->nama_obat}}</h3>
      </div>
      <div class="box-body">
        {!! Form::open(['action' => ['GudangObatController@update', $gudangobat->id], 'method' => 'post']) !!}

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              {{ Form::label('nama_obat', 'Nama obat') }}
              {{ Form::text('nama_obat', $gudangobat->nama_obat, ['class' => 'form-control', 'placeholder' => 'Nama obat']) }}
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              {{Form::label('keterangan', 'keterangan')}}
              {{Form::text('keterangan', $gudangobat->keterangan, ['class' => 'form-control', 'placeholder' => 'Keterangan obat'])}}
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('dosis', 'dosis')}}
              {{ Form::text('dosis', $gudangobat->dosis, ['class' => 'form-control', 'placeholder' => 'dosis']) }}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('expire_date', 'Expire date')}}
              {{ Form::text('expire_date', $gudangobat->expire_date, ['class' => 'form-control', 'placeholder' => 'Expire date']) }}
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('kategori_obat', 'Kategori obat')}}
              {{Form::select('kategori_obat', $kategoriobat->pluck('nama_kategori', 'nama_kategori'), null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Pilih Kategori obat'])}}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('bentuk_sediaan', 'bentuk sediaan')}}
              {{Form::select('bentuk_sediaan', $bentuksediaan->pluck('bentuk_sediaan', 'bentuk_sediaan'), null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Pilih Bentuk sediaan'])}}
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('supplier', 'supplier')}}
              {{Form::select('supplier', $supplier->pluck('nama_supplier', 'nama_supplier'), null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Pilih nama supplier'])}}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('instock', 'Ada stok')}}
              {{Form::select('instock', [0 => 'No', 1 => 'Yes'], null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Pilih'])}}
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('jumlah', 'Jumlah')}}
              {{Form::number('jumlah', $gudangobat->jumlah, ['step' => '0.01', 'class' => 'form-control', 'placeholder' => 'jumlah'])}}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('harga_satuan', 'Harga satuan')}}
              {{Form::number('harga_satuan', $gudangobat->harga_satuan, ['step' => '0.01', 'class' => 'form-control', 'placeholder' => 'Harga satuan'])}}
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            {{ Form::hidden('_method', 'PUT') }}
            {{ Form::submit('Submit', ['class' => 'btn btn-default btn-lg btn-block']) }}

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    @stop

    @section('js')
    <script src="{{asset('js/render_select2.js')}}" charset="utf-8"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="{{asset('js/render_ckeditor.js')}}" charset="utf-8"></script>
    @endsection