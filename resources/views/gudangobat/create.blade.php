@extends('adminlte::page')

@section('title', 'Obat baru gudang obat')

@section('content_header')
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
        <?php
        $i = 1;
        ?>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('nama_obat', 'Cari obat')}}
              <select id="search_masterobat" style="width: 100%" placeholder="cari obat.."></select>
              {{ Form::hidden('id_obat', '', ['class' => 'form-control', 'id' => 'id_obat' , 'placeholder' => 'id_obat', 'readonly' => 'true']) }}
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('nama_obat', 'Nama obat')}}
              {{ Form::text('nama_obat', '', ['class' => 'form-control', 'placeholder' => 'Nama Obat' , 'readonly' => 'true']) }}
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('dosis', 'dosis')}}
              {{ Form::text('dosis', '', ['class' => 'form-control', 'placeholder' => 'dosis' , 'readonly' => 'true']) }}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('bentuk_sediaan', 'bentuk sediaan')}}
              {{ Form::text('bentuk_sediaan', '', ['class' => 'form-control', 'placeholder' => 'Bentuk sediaan obat', 'readonly' => 'true']) }}
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('expiry_date', 'Expiry date')}}
              <div class="input-group date" id="myDatepicker">
                <input type='text' id="expiry_date" class="form-control" / name="expiry_date">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('no_batch', 'No.batch')}}
              {{ Form::text('no_batch', '', ['class' => 'form-control', 'placeholder' => 'no batch obat']) }}
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('supplier', 'supplier')}}
              {{ Form::text('supplier', '', ['class' => 'form-control', 'placeholder' => 'Supplier']) }}
            </div>
          </div>


          <div class="col-sm-3">
            {{Form::label('harga_satuan', 'Harga satuan obat')}}
            {{Form::number('harga_satuan', '', [ 'class' => 'form-control', 'placeholder' => 'Harga satuan', 'readonly' => 'true'])}}

          </div>
          <div class="col-sm-3">

            <div class="form-group">

              {{Form::label('jumlah', 'Jumlah')}}
              </button>
              {{Form::number('jumlah', '', [ 'class' => 'form-control', 'placeholder' => 'jumlah'])}}
            </div>

          </div>

        </div>
        <div class="row">

        </div>
        {{Form::label('keterangan', 'Keterangan')}}

        {{Form::textarea('keterangan', '', ['class' => 'form-control', 'placeholder' => 'Keterangan obat'])}}

        <div class="row">
          <div class="col-sm-12">

            {{ Form::submit('Submit', ['class' => 'btn bg-purple btn-lg btn-block']) }}

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  @stop

  @section('js')


  <script>
    $(document).ready(function() {
      $('.select2s').select2();
    });

    $("#search_masterobat").select2({
      multiple: false,
      placeholder: "Cari data..",
      minimumInputLength: 1,
      language: {
        inputTooShort: function() {
          return 'Ketik nama obat';
        },
        "noResults": function() {
          return "data tidak ditemukan, <a href='/masterobat/create'> Tambah data obat</a>";
        }
      },
      ajax: {
        url: "/gudangobat/cari/masterobat",
        dataType: 'json',
        delay: 5,
        data: function(params) {
          return {
            q: params.term,
            page: params.page
          };
        },
        processResults: function(data, page) {

          return {
            results: data
          };

        },
        allowClear: false
      },
      escapeMarkup: function(markup) {
        return markup;
      },
      minimumInputLength: 1,
      templateResult: formatObat,
      templateSelection: formatRepoSelection

    });

    function formatObat(obat) {
      if (obat.loading) return obat.text;
      var markup =
        '<div class="clearfix">' +
        '<h4 class = "">' + obat.nama_obat + ' (' + obat.dosis + ')' + '</h4>' +
        '<div class="col-sm-4">' + obat.bentuk_sediaan + ' </div>';
      markup += '</div></div>';
      return markup;
    }

    function formatRepoSelection(obat) {
      if (!obat.id) {
        return obat.text;
      }
      let results = $(
        '<span>' + obat.nama_obat + '</span>' + ' ' + '<span>' + obat.dosis + ' ' + obat.bentuk_sediaan + '</span>'
      );
      return results;
    };
    $('#search_masterobat').on("select2:select", function(e) {
      $("#id_obat").val(e.params.data.id)
      $("#nama_obat").val(e.params.data.nama_obat)
      $("#dosis").val(e.params.data.dosis)
      $("#bentuk_sediaan").val(e.params.data.bentuk_sediaan)
      $("#harga_satuan").val(e.params.data.harga_satuan)
      $('#search_masterobat').val('2');
    });
  </script>
  <script>
    $('#myDatepicker').datetimepicker({
      format: 'DD-MM-YYYY'
    });
  </script>
  @endsection