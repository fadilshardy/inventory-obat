@extends('adminlte::page')

@section('title', 'Laporan stok obat apotek')

@section('content_header')
@stop

@section('content')
@include('includes.messages')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Laporan stok apotek</h3>
            </div>
            <div class="box-body">
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
                            <th>Stok keluar Apotek</th>
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
                        $harga_awal = $data->MasterObat->harga_satuan * $data->stok_awal;
                        $harga_keluar = $data->MasterObat->harga_satuan * $data->keluarapotek;
                        $harga_akhir = $data->MasterObat->harga_satuan * $data->jumlah_apotek;


                        $harga_awal_rupiah = number_format($harga_awal,0,',',',');
                        $harga_keluar_rupiah = number_format($harga_keluar,0,',',',');
                        $harga_akhir_rupiah = number_format($harga_akhir,0,',',',');

                        @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td><a href="/apotek/{{$data->id}}">{{$data->MasterObat->nama_obat}}</a> ({{$data->MasterObat->dosis}})</td>
                            <td>{{$data->GudangObat->no_batch}}</td>
                            <td>{{$data->MasterObat->harga_satuan}}</td>
                            <td>{{$data->stok_awal}}</td>
                            <td>Rp. {{$harga_awal_rupiah}}</td>
                            <td>{{$data->keluarapotek}}</td>
                            <td>Rp. {{$harga_keluar_rupiah}}</td>
                            <td>{{$data->jumlah_apotek}}</td>
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