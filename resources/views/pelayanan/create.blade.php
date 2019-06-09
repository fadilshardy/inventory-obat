@extends('adminlte::page')

@section('title', 'Obat baru')

@section('content_header')
<h1>Obat baru</h1>
@stop

@section('content')

<?php

$nama_pasien = old('nama_pasien');
$tanggal = date('d-m-Y');
$keterangan = old('keterangan');
$active = 1;
$method = "POST";
$mode = "Create";
$url = "pelayanan/";
$yes = 0;
$detail_count = 0;
if (isset($data)) {
  $detail_count = count($detail);
  $nama_pasien = $data[0]->nama_pasien;
  $tanggal = date('d-m-Y', strtotime($data[0]->tanggal));
  $keterangan = $data[0]->keterangan;
  $active = $data[0]->active;
  $method = "PUT";
  $mode = "Edit";
  $url = "pelayanan/" . $data[0]->id;
}
?>

@include('includes.messages')
<div class="row">
  <div class="col-sm-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Pelayanan pasien</h3>
      </div>
      <div class="box-body">
        {!! Form::open(['action' => 'PelayananController@store', 'method' => 'post']) !!}

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">

              {{Form::label('nama_pasien', 'Cari pasien')}}
              <select id="search_pasien" style="width: 100%" placeholder="cari obat..">
              </select>
              <!-- FORM PASIEN -->
              {{ Form::hidden('id_pasien', '', ['class' => 'form-control', 'id' => 'id_pasien' , 'readonly' => 'true']) }}
              {{ Form::hidden('nama_pasien', '', ['class' => 'form-control', 'id' => 'nama_pasien' ,  'readonly' => 'true']) }}
              <!-- END FORM PASIEN -->

            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('tanggal', 'Tanggal')}}
              <div class="input-group date" id="myDatepicker">
                <input type='text' class="form-control" / name="tanggal">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              {{Form::label('keterangan', 'keterangan')}}
              {{ Form::textarea('keterangan', '', ['class' => 'form-control', 'placeholder' => 'keterangan']) }}
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-9 pull-right">
            <div class="field_wrapper">
              <?php
              if (isset($data)) {
                $i = 1;
                foreach ($detail as $key => $value) :
                  ?>
                  <div class="row" style="margin-bottom:10px;">
                    <div class="col-sm-3">
                      <input type="hidden" name="id_obat[]" id="id_obat_<?= $i; ?>" value="<?= $value['id_obat']; ?>">
                      <input type="hidden" name="id_apotek_obat[]" id="id_apotek_obat_<?= $i; ?>" value="<?= $value['id_apotek']; ?>">
                      <input readonly type="text" name="nama_apotek_obat[]" id="nama_apotek_obat_<?= $i; ?>" class="form-control" placeholder="Nama Obat" required value="<?= $value['obat']->nama_obat; ?>">
                    </div>
                    <select id="search_obat_<?= $i; ?>" style="width: 100%" placeholder="cari obat..">
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <input type="text" name="harga[]" id="harga_<?= $i; ?>" class="form-control" placeholder="Harga" required value="<?= $value['harga']; ?>">
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="input-group">
                      <input type="text" name="qty[]" id="qty_<?= $i; ?>" class="form-control" placeholder="qty" required value="<?= $value['qty']; ?>">
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <?php
                    if ($i == 1) {
                      ?>
                      <a href="javascript:void(0);" class="add_button btn btn-primary" title="Tambah Baris"><i class="fa fa-plus-square" aria-hidden="true"></i>
                      </a>
                    <?php
                  } else {
                    ?>
                      <a href="javascript:void(0);" class="remove_button btn btn-danger" title="Hapus Baris"><i class="fa fa-trash" aria-hidden="true"></i>
                      </a>
                    <?php
                  }
                  ?>
                  </div>
                </div>
                <?php
                $i++;
              endforeach;
            } else {
              ?>
              <div class="row">
                <div class="col-sm-4" style="margin-bottom:30px;">
                  <input type="hidden" name="id_apotek_obat[]" id="id_apotek_1">
                  <input type="hidden" name="id_obat[]" id="id_obat_1">
                  <select id="search_obat" class="search_obat_1" style="width: 100%" placeholder="cari obat..">
                  </select>
                  <input readonly type="hidden" name="nama_obat[]" id="nama_obat_1" class="form-control" placeholder="Nama Obat" required>
                </div>

                <div class="col-sm-3">
                  <input type="text" name="harga[]" id="harga_1" class="form-control" placeholder="Harga" required>
                </div>
                <div class="col-sm-2">
                  <div class="input-group">

                    <span class="badge badge-light" id="jumlah_1"></span>
                    </button>
                    <input type="text" name="qty[]" id="qty_1" class="form-control" placeholder="qty" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <a href="javascript:void(0);" class="add_button btn btn-info btn-flat" title="Tambah Baris"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
              </div>
            <?php
          }
          ?>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">

          {{ Form::submit('Submit', ['class' => 'btn pull-right  btn-block bg-purple']) }}

          {!! Form::close() !!}
        </div>
      </div>
      @stop

      @section('css')
      <link rel="stylesheet" href="/css/colorbox.css">
      <link rel="stylesheet" href="/js/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css">

      @stop

      @section('js')

      <!-- colorbox -->
      <script src="{{asset('js/colorbox/jquery.colorbox.js')}}" charset="utf-8"></script>
      <script src="{{asset('js/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}" charset="utf-8"></script>

      <script type="text/javascript">
        $(document).ready(function() {
          var addButton = $('.add_button');
          var wrapper = $('.field_wrapper');
          var x = <?= $detail_count + 1; ?>;
          $(".search_obat_" + x).select2({
            multiple: true,
            placeholder: "Cari obat..",
            minimumInputLength: 1,
            language: {
              inputTooShort: function() {
                return 'Ketik nama obat';
              },
              "noResults": function() {
                return "Obat tidak ditemukan, <a href='/apotek/create'> Tambah data obat</a>";
              }
            },
            ajax: {
              url: "/pelayanan/cari/obat",
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
              '<div>' + obat.nama_obat + ' (' + obat.dosis + ')' + '</div>' +
              '<div class="col-sm-4">' + 'stock: ' + obat.jumlah + '</div > ' +
              '<div class="col-sm-4">' + obat.bentuk_sediaan + ' </div>' +
              '<div class="col-sm-4">' + obat.expiry_date;

            markup += '</div></div>';
            return markup;
          }

          function formatRepoSelection(obat) {
            let results = $(
              '<span>' + obat.nama_obat + '</span>' + ' ' + '<span>' + obat.dosis + ' ' + obat.bentuk_sediaan + '</span>'
            );
            return results;
          };

          $('.search_obat_1').on("select2:select", function(e) {
            $("#id_apotek_1").val(e.params.data.id)
            $("#id_obat_1").val(e.params.data.id_obat)
            $("#nama_obat_1").val(e.params.data.nama_obat)
            $("#harga_1").val(e.params.data.harga_satuan)
            $('.search_obat_1').val('1');
          });
          $(addButton).click(function() { //Once add button is clicked
            x++;
            var url = "<?= url('/') ?>";
            url = url + '/pelayanan/obat/popup-media/' + x;
            $(wrapper).append(
              '<div class="row" style="margin-bottom:10px;"><div class="col-sm-4"><input type="hidden" name="id_apotek_obat[]" id="id_apotek_' +
              x +
              '"> <input type="hidden" name="id_obat[]" id="id_obat_' +
              x +
              '">        <select id="search_obat" class="search_obat_' +
              x +
              '" style="width: 100%" placeholder="cari obat.."></select></div><div class="col-sm-3"><input type="text" name="harga[]" id="harga_' +
              x +
              '" class="form-control" placeholder="' +
              x +
              '" required></div><div class="col-sm-2"><div class="input-group"><input type="text" name="qty[]" id="qty_' +
              x +
              '" class="form-control" placeholder="Qty" required></div></div><div class="col-sm-2"><a href="javascript:void(0);" class="remove_button btn bg-red btn-flat" title="Hapus Baris"><i class="fa fa-trash" aria-hidden="true"></i> </a></div><br/></div>'
            );
            $(".search_obat_" + x).select2({
              multiple: true,
              placeholder: "Cari obat..",
              minimumInputLength: 1,
              language: {
                inputTooShort: function() {
                  return 'Ketik nama obat';
                },
                "noResults": function() {
                  return "Obat tidak ditemukan, <a href='/apotek/create'> Tambah data obat</a>";
                }
              },
              ajax: {
                url: "/pelayanan/cari/obat",
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
              let results = $(
                '<span>' + obat.nama_obat + '</span>' + ' ' + '<span>' + obat.dosis + ' ' + obat.bentuk_sediaan + '</span>'
              );
              return results;
            };

            $('.search_obat_' + x).on("select2:select", function(e) {
              $("#id_apotek_" + x).val(e.params.data.id)
              $("#id_obat_" + x).val(e.params.data.id_obat)
              $("#nama_obat_" + x).val(e.params.data.nama_obat)
              $("#harga_" + x).val(e.params.data.harga_satuan)
              $(".search_obat_" + x).val('1');
            });
          });
          $(wrapper).on('click', '.remove_button', function(e) {
            if (confirm("Apakah anda yakin mau menghapus baris ini?")) {
              e.preventDefault();
              $(this).parent().parent().remove();
            }
          });

        });
      </script>

      <script>

      </script>
      <script>
        $('#myDatepicker').datetimepicker({
          format: 'DD-MM-YYYY'
        });
      </script>


      <script>
        $("#search_pasien").select2({
          multiple: true,
          placeholder: "Cari pasien..",
          minimumInputLength: 1,
          language: {
            inputTooShort: function() {
              return 'Ketik nama pasien';
            }
          },
          ajax: {
            url: "/pelayanan/cari/pasien",
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
            allowClear: true
          },
          escapeMarkup: function(markup) {
            return markup;
          },
          minimumInputLength: 1,
          templateResult: formatObat,
          templateSelection: formatRepoSelection

        });

        function formatObat(pasien) {
          if (pasien.loading) return pasien.text;
          var markup =
            '<div class="clearfix">' +
            '<div class = "col-sm-12">' + pasien.nama_pasien + '</div>' +
            '<div class="col-sm-4">' + pasien.tanggal_lahir + '</div > ' +
            '<div class="col-sm-12">' + pasien.alamat + ' </div>';

          markup += '</div></div>';
          return markup;
        }

        function formatRepoSelection(pasien) {
          let results = $(
            '<span>' + pasien.nama_pasien + '</span>'
          );
          return results;
        };
        $("#search_pasien").on("select2:select", function(e) {
          $("#id_pasien").val(e.params.data.id)
          $("#nama_pasien").val(e.params.data.nama_pasien)
          $('#search_pasien').val('1');
        });
      </script>
      @endsection