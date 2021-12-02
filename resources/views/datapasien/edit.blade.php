@extends('adminlte::page')

@section('title', 'Edit pasien')

@section('content_header')
<h1>Edit pasien</h1>
@stop

@section('content')
@include('includes.messages')

<div class="row">
  <div class="col-sm-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Edit pasien</h3>
      </div>
      <div class="box-body">
        {!! Form::open(['action' => ['DataPasienController@update', $data->id], 'method' => 'post']) !!}

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              {{Form::label('nama_pasien', 'Nama pasien')}}
              {{ Form::text('nama_pasien', $data->nama_pasien, ['class' => 'form-control', 'placeholder' => 'Nama pasien']) }}
            </div>
          </div>
        </div>



        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('gender', 'Jenis kelamin')}}
              {{Form::select('gender', ['laki-laki' => 'Laki-Laki', 'perempuan' => 'Perempuan'], null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => '-- Pilih --'])}}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">

              {{Form::label('tanggal_lahir', 'Tanggal lahir')}}
              <div class="input-group date" id="myDatepicker">
                <input type='text' class="form-control" name="tanggal_lahir">
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
              {{Form::label('alamat', 'Alamat')}}
              {{ Form::text('alamat', $data->alamat, ['class' => 'form-control', 'placeholder' => 'Alamat pasien']) }}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('no_telp', 'Nomor telepon')}}
              {{Form::number('no_telp', $data->no_telp, ['step' => '1', 'class' => 'form-control', 'placeholder' => 'Nomor telepon pasien'])}}
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