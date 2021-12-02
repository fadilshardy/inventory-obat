@extends('adminlte::page')

@section('title', 'Inventory puskesmas')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$jumlah['jumlah_gudang']}}</h3>

                <p>Gudang puskesmas</p>
            </div>
            <div class="icon">
                <i class="ion ion-medkit"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{$jumlah['jumlah_apotek']}}</h3>

                <p>Apotek</p>
            </div>
            <div class="icon">
                <i class="fa fa-stethoscope" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{$jumlah['jumlah_pasien']}}</h3>

                <p>Data pasien</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{$jumlah['jumlah_pelayanan']}}</h3>

                <p>Pelayanan</p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>


<!-- /.row -->
<div class="box">
    <div class="box box-default">
        <div class="box-header with-border">
            <i class="fa fa-info"></i>
            <h3 class="box-title">Laporan hari ini</h3>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                    <span class="description-percentage"><i class="fa fa-caret-down"></i></span>
                    <h5 class="description-header">{{$laporanharian['jumlah_transaksi']}}</h5>
                    <span class="description-text"> total Transaksi hari ini</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                    <span class="description-percentage"><i class="fa fa-caret-down"></i></span>
                    <h5 class="description-header">{{$laporanharian['jumlah_obat_keluar']}}</h5>
                    <span class="description-text">Total obat yang keluar</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                    <span class="description-percentage"><i class="fa fa-caret-down"></i> </span>
                    <h5 class="description-header">{{$laporanharian['jumlah_obat_masuk']}}</h5>
                    <span class="description-text">Total obat yang masuk</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->

        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12" id="peringatan">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i>Awas!</h4>
{{$notification['safety_stock']}} obat dibawah stok pengaman (safety stock), <a href="/gudangobat">klik disini</a> untuk informasi lebih lanjut.
        </div>
    </div>
    <div class="col-sm-12" id="pemberitahuan">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Pemberitahuan</h4>
            {{$notification['reorder_point']}} obat harus segera di pesan kembali, <a href="/laporan/stokobat">klik disini</a> untuk informasi lebih lanjut.
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Transaksi paling baru</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama pasien</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @foreach ($pelayanan as $pelayanan)
                            @php $i++;
                            $formatted_tanggal = date("d-m-Y", strtotime($pelayanan->tanggal));

                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td><a href="/pelayanan/{{$pelayanan->id}}">{{$pelayanan->DataPasien->nama_pasien}}</a></td>
                                <td>{{ $formatted_tanggal}}</td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="box-footer clearfix">
                <a href="/pelayanan/create" class="btn btn-sm bg-purple pull-left">Transaksi baru</a>
                <a href="/pelayanan" class="btn btn-sm btn-info pull-right">Semua transaksi</a>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Data obat yang masuk</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama obat</th>
                                <th>jumlah</th>
                                <th>tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @foreach ($gudangobat as $gudangobat)
                            @php $i++;
                            $formatted_tanggal = date("d-m-Y", strtotime($gudangobat->created_at));
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td><a href="/gudangobat/{{$gudangobat->id}}/">{{$gudangobat->MasterObat->nama_obat}} </a> {{$gudangobat->MasterObat->dosis}}</td>
                                <td>{{$gudangobat->stok_awal}}</td>
                                <td>{{ $formatted_tanggal }}</td>

                                <td>
                                    <a href="/pelayanan/{{$gudangobat->id}}/" class="btn btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="box-footer clearfix">
                <a href="/pelayanan/create" class="btn btn-sm bg-purple pull-left">Tambah obat</a>
                <a href="/pelayanan" class="btn btn-sm btn-default pull-right">Lihat semua</a>
            </div>
        </div>
    </div>
</div>

<script>
        var SafetyStock = <?php echo $notification['safety_stock'] ?>;

    var reorderPoint = <?php echo $notification['reorder_point'] ?>;

    function ShowROP(reorderPoint) {
  if (reorderPoint > 0) {
    document.getElementById("pemberitahuan").style.display = "block";
  } else {
    document.getElementById("pemberitahuan").style.display = "none";
  }
};

function ShowSS(SafetyStock) {
  if (SafetyStock > 0) {
    document.getElementById("peringatan").style.display = "block";
  } else {
    document.getElementById("peringatan").style.display = "none";
  }
};

ShowROP(reorderPoint);
ShowSS(SafetyStock);
console.log(SafetyStock);

  </script>
@stop