@extends('adminlte::page')

@section('title', 'Obat baru apotek')

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


        {!! Form::open(['action' => 'ApotekController@store', 'method' => 'post']) !!}
        <?php
        $i = 1;
        ?>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('nama_obat', 'Cari obat')}}
              <select id="search_gudangobat" style="width: 100%" placeholder="cari obat..">
              </select> {{ Form::hidden('id_gudang', '', ['class' => 'form-control', 'id' => 'id_gudang' , 'placeholder' => 'id_gudang', 'readonly' => 'true']) }}
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

              {{Form::label('expiry_date', 'Expiry date')}}
              <div class="input-group date" id="myDatepicker">
                <input type='text' id="expiry_date" class="form-control" / name="expiry_date" readonly>
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
              {{ Form::text('no_batch', '', ['class' => 'form-control', 'placeholder' => 'no batch obat', 'readonly' => 'true']) }}
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
              {{Form::label('supplier', 'supplier')}}
              {{ Form::text('supplier', '', ['class' => 'form-control', 'placeholder' => 'Nama supplier', 'readonly' => 'true']) }}
            </div>
          </div>

          <div class="col-sm-3">
            {{Form::label('harga_satuan', 'Harga satuan obat')}}
            {{Form::number('harga_satuan', '', [ 'class' => 'form-control', 'placeholder' => 'Harga satuan'])}}

          </div>
          <div class="col-sm-3">

            <div class="form-group">

              {{Form::label('jumlah', 'Jumlah')}} <button type="button" class="btn btn-primary btn-xs pull-right">
                Stok gudang: <span class="badge badge-light" id="stokobat"></span>
              </button>
              {{Form::number('jumlah', '', [ 'class' => 'form-control', 'placeholder' => 'jumlah'])}}
            </div>

          </div>

        </div>
        <hr />
        <div class="row">

        </div>

        {{Form::textarea('keterangan', '', ['class' => 'form-control', 'placeholder' => 'Keterangan obat'])}}



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
  <script>
    $("#search_gudangobat").select2({
      multiple: false,
      placeholder: "Cari obat..",
      minimumInputLength: 1,
      language: {
        inputTooShort: function() {
          return 'Ketik nama obat';
        },
        "noResults": function() {
          return "Obat tidak ditemukan, <a href='/gudangobat/create'> Tambah data obat</a>";
        }
      },
      ajax: {
        url: "/apotek/cari/gudangobat",
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
        '<div class="col-sm-4">' + 'stock: ' + obat.jumlah + '</div > ' +
        '<div class="col-sm-4">' + obat.bentuk_sediaan + ' </div>' +
        '<div class="col-sm-4">' + obat.expiry_date;

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
    $('#search_gudangobat').on("select2:select", function(e) {
      $("#id_gudang").val(e.params.data.id_gudang)
      $("#id_obat").val(e.params.data.id_obat)
      $("#nama_obat").val(e.params.data.nama_obat)
      $("#dosis").val(e.params.data.dosis)
      $("#no_batch").val(e.params.data.no_batch)
      $("#expiry_date").val(e.params.data.expiry_date)
      $("#bentuk_sediaan").val(e.params.data.bentuk_sediaan)
      $("#supplier").val(e.params.data.supplier)
      $("#harga_satuan").val(e.params.data.harga_satuan)
      $("#stokobat").text(e.params.data.jumlah)
    });
  </script>
  @endsection