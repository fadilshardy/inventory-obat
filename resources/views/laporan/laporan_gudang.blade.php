@extends('adminlte::page')

@section('title', 'Laporan stok obat gudang')

@section('content_header')
<h1>Laporan gudang obat</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Laporan stok gudang obat</h3>
            </div>
            <div class="box-body">
                <form id="form-work" class="form-horizontal" role="form" autocomplete="off" method="GET">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-9 col-md-offset-3">
                            <div class="col-xs-12 col-sm-3 date">
                                <div class='input-group date' id='myDatepicker'>
                                    <input type='text' class="form-control" name="startDate" value=<?= $startDate; ?> />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 date">
                                <div class='input-group date' id='myDatepicker2'>
                                    <input type='text' class="form-control" name="endDate" value=<?= $endDate; ?> />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <button type="submit" class="btn bg-purple btn-block">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>

                <br />
                <table class="table table-bordered " id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama obat</th>
                            <th>No batch</th>
                            <th>Harga satuan</th>
                            <th>Stok awal</th>
                            <th>Nilai awal</th>
                            <th>Stok keluar gudang</th>
                            <th>Nilai keluar</th>
                            <th>Stok akhir</th>
                            <th>Nilai akhir</th>

                        </tr>
                    </thead>
                    <tbody>

                        @php $total = 0; $harga_awal_raw = 0; $i = 0; @endphp
                        @foreach ($data as $data)
                        @php
                        $i++;
                        $total = $data->stokgudang + $data->stokapotek;
                        $harga_awal = $data->harga_satuan * $data->stok_awal;
                        $harga_keluar = $data->harga_satuan * $data->keluargudang;
                        $harga_akhir = $data->harga_satuan * $data->jumlah;


                        $harga_awal_rupiah = number_format($harga_awal,0,',',',');
                        $harga_keluar_rupiah = number_format($harga_keluar,0,',',',');
                        $harga_akhir_rupiah = number_format($harga_akhir,0,',',',');

                        @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td><a href="/gudangobat/{{$data->id}}">{{$data->nama_obat}}</a> ({{$data->dosis}})</td>
                            <td>{{$data->no_batch}}</td>
                            <td>{{$data->harga_satuan}}</td>
                            <td>{{$data->stok_awal}}</td>
                            <td>Rp. {{$harga_awal_rupiah}}</td>
                            <td>{{$data->keluargudang}}</td>
                            <td>Rp. {{$harga_keluar_rupiah}}</td>
                            <td>{{$data->jumlah}}</td>
                            <td>Rp. {{$harga_akhir_rupiah}}</td>


                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="{{asset('js/render_datatables.js')}}" charset="utf-8"></script>

<script>
    $('#myDatepicker').datetimepicker({
        format: 'DD-MM-YYYY'
    });

    $('#myDatepicker2').datetimepicker({
        format: 'DD-MM-YYYY'
    });
</script>
@endsection