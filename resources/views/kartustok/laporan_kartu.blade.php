@extends('adminlte::page')

@section('title', 'Laporan kartu stok')

@section('content_header')
<h1>Laporan obat</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Laporan kartu stok bulan ini</h3>
            </div>
            <div class="box-body">
             

                <br />
                <table class="table compact" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama obat</th>
                            <th>Histori keluar</th>
                            <th>Histori Masuk</th>

                        </tr>
                    </thead>
                    <tbody>

                        @php $total = 0; $hargatotal = 0; $i = 0; @endphp
                        @foreach ($data as $data)
                        @php
                        $i++;
                        @endphp
                        @if($data->stok_masuk >= 0 && $data->stok_akhir >= 0)

                        <tr>
                            <td>{{$i}}</td>
                            <td><a href="/gudangobat/{{$data->id}}">{{$data->nama_obat}}</a> ({{$data->dosis}})</td>
                            <td><a class='btn-action btn bg-purple histori-gudang' href="/kartustok/gudang/histori/keluar/{{$data->id}}" title='Histori'>Histori keluar gudang</a></td>
                            <td><a class='btn-action btn bg-purple histori-gudang' href="/kartustok/gudang/histori/masuk/{{$data->id}}" title='Histori'>Histori masuk gudang</a></td>


                        </tr>
                        @endif


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

    $('body').on('click', '.histori-gudang', function(e) {
        $.colorbox({

            'transition': 'elastic',
            'scrolling': true,

            'href': $(this).attr('href')
        });
        e.preventDefault();
    });
</script>


@endsection