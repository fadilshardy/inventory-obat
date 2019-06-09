@extends('adminlte::page')

@section('title', 'Inventory puskesmas')

@section('content_header')
<h1>Dashboard</h1>
@stop
<?php
$detail_count = 0;
if (isset($data)) {
    $detail_count = count($detail);
}
?>

@section('content')
<div class="row">
    <div class="col-sm-6">
        <select id="search_gudangobat_1" style="width: 100%" placeholder="cari obat..">
        </select>
    </div>
    <div class="col-sm-6">
        <div class="field_wrapper">

            <?php
            if (isset($data)) {
                $i = 1;
                foreach ($detail as $key => $value) :
                    ?>
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="id_obat[]" id="id_obat_<?= $i; ?>" value="<?= $value['id_obat']; ?>">
                            <input readonly type="text" name="nama_apotek_obat[]" id="nama_apotek_obat_<?= $i; ?>" class="form-control" placeholder="Nama Obat" required value="<?= $value['obat']->nama_obat; ?>">
                        </div>
                        <div class="col-sm-2">
                            <a href="<?= url('pelayanan/obat/popup-media/' . $i); ?>" class="btn btn-success browse-data-obat" title="Browse"><i class="fa fa-search-plus" aria-hidden="true"></i>
                            </a>
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
                <div class="row" style="margin-bottom:10px;">
                    <div class="col-sm-3">
                        <input type="text" name="id_obat[]" id="id_obat_1">
                        <input readonly type="text" name="nama_obat[]" id="nama_obat_1" class="form-control" placeholder="Nama Obat" required>
                    </div>
                    <div class="col-sm-2">
                        <a href="<?= url('pelayanan/obat/popup-media/1'); ?>" class="btn bg-orange browse-data-obat" title="Browse"><i class="fa fa-search" aria-hidden="true"></i>
                        </a>
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
        <button class="btn bg-purple tambah">Tambah</button>
    </div>
</div>
@stop


@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');
        var x = <?= $detail_count + 1; ?>;
        $(addButton).click(function() { //Once add button is clicked
            x++;
            var url = "<?= url('/') ?>";
            url = url + '/pelayanan/obat/popup-media/' + x;
            $(wrapper).append(
                '<div class="row" style="margin-bottom:10px;"><div class="col-sm-3"><input type="hidden" name="id_apotek_obat[]" id="id_apotek_obat_' +
                x +
                '"> <input type="hidden" name="id_obat[]" id="id_obat_' +
                x +
                '"> <input readonly type="text" name="nama_apotek_obat[]" id="nama_apotek_obat_' +
                x +
                '" class="form-control" placeholder="Nama obat" required></div><div class="col-sm-2"><a href="' +
                url +
                '" class="btn bg-orange btn-flat browse-data-obat" title="Browse"><i class="fa fa-search" aria-hidden="true"></i></a></div><div class="col-sm-3"><input type="text" name="harga[]" id="harga_' +
                x +
                '" class="form-control" placeholder="Harga" required></div><div class="col-sm-2"><div class="input-group"><input type="text" name="qty[]" id="qty_' +
                x +
                '" class="form-control" placeholder="Qty" required></div></div><div class="col-sm-2"><a href="javascript:void(0);" class="remove_button btn bg-red btn-flat" title="Hapus Baris"><i class="fa fa-trash" aria-hidden="true"></i> </a></div><br/></div>'
            );
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
    $("#search_gudangobat_1").select2({
        multiple: true,
        placeholder: "Cari obat..",
        minimumInputLength: 1,
        language: {
            inputTooShort: function() {
                return 'Ketik nama obat';
            }
        },
        ajax: {
            url: "apotek/cari/gudangobat",
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
                console.log(results);

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

    function formatObat(obat) {
        if (obat.loading) return obat.text;
        var markup =
            '<div class="clearfix">' +
            '<div class = "">' + obat.nama_obat + ' (' + obat.dosis + ')' + '</div>' +
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
    var x = <?= $detail_count + 1; ?>;

    $("#search_gudangobat_" + x).on("select2:select", function(e) {
        $("#id_gudang").val(e.params.data.id)
        $("#id_obat").val(e.params.data.id_obat)
        $("#nama_obat_" + x).val(e.params.data.nama_obat)
        $("#dosis").val(e.params.data.dosis)
        $("#no_batch").val(e.params.data.no_batch)
        $("#expiry_date").val(e.params.data.expiry_date)
        $("#bentuk_sediaan").val(e.params.data.bentuk_sediaan)
        $("#supplier").val(e.params.data.supplier)
        $("#harga_satuan").val(e.params.data.harga_satuan)
        $("#stokobat").val(e.params.data.jumlah)
        $('#search_gudangobat').val('2');
    });
</script>
@endsection