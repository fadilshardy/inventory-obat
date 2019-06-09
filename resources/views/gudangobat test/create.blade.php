@extends('adminlte::page')

@section('title', 'Obat baru')

@section('content_header')
<h1>Obat baru</h1>
@stop

@section('content')
@include('includes.messages')

<div class="row">
  <div class="col-sm-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Obat baru</h3>
      </div>
      <div class="box-body">
        {!! Form::open(['action' => 'GudangObatController@store', 'method' => 'post']) !!}

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
              {{Form::label('dosis', 'dosis')}}
              {{ Form::text('dosis', '', ['class' => 'form-control', 'placeholder' => 'dosis']) }}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">

              {{Form::label('expiry_date', 'Expiry date')}}
              <div class="input-group date" id="myDatepicker">
                <input type='text' class="form-control" / name="expiry_date">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('no_batch', 'No.batch')}}
              {{ Form::text('no_batch', '', ['class' => 'form-control', 'placeholder' => 'Isi no batch obat']) }}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('bentuk_sediaan', 'bentuk sediaan')}}
              {{Form::select('bentuk_sediaan', $bentuksediaan->pluck('bentuk_sediaan', 'bentuk_sediaan'), null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => '-- Pilih Bentuk sediaan --'])}}
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('supplier', 'supplier')}}
              {{Form::select('supplier', $supplier->pluck('nama_supplier', 'nama_supplier'), null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => '-- Pilih nama supplier --'])}}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('instock', 'Active')}}
              {{Form::select('instock', [0 => 'No', 1 => 'Yes'], null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => '-- Pilih --'])}}
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('jumlah', 'Jumlah')}}
              {{Form::number('jumlah', '', ['step' => '0.01', 'class' => 'form-control', 'placeholder' => 'jumlah'])}}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('harga_satuan', 'Harga satuan obat')}}
              {{Form::number('harga_satuan', '', ['step' => '0.01', 'class' => 'form-control', 'placeholder' => 'Harga satuan'])}}
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              {{Form::label('keterangan', 'keterangan')}}
              {{Form::textarea('keterangan', '', ['class' => 'form-control', 'placeholder' => 'Keterangan obat'])}}
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-12">

            {{ Form::submit('Submit', ['class' => 'btn btn-default btn-lg btn-block']) }}

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  @stop

  @section('js')
  <script src="{{asset('js/render_select2.js')}}" charset="utf-8"></script>
  <script>
    $('#myDatepicker').datetimepicker({
      format: 'DD-MM-YYYY'
    });
  </script>
  @endsection