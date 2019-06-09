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
                <table class="table compact" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama obat</th>
                            <th>Histori keluar</th>
                            <th>Histori Masuk</th>
                            <th>Total masuk</th>
                            <th>Total keluar</th>
                            <th>Stok akhir</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php $total = 0; $hargatotal = 0; $i = 0; @endphp
                        @foreach ($data as $data)
                        @php
                        $i++;
                        $total = $data->stokgudang + $data->stokapotek;
                        @endphp
                        @if($data->stok_masuk >= 0 && $data->stok_akhir >= 0)

                        <tr>
                            <td>{{$i}}</td>
                            <td><a href="/gudangobat/{{$data->id}}">{{$data->nama_obat}}</a> ({{$data->dosis}})</td>
                            <td><a class='btn-action btn bg-purple histori-gudang' href="/kartustok/gudang/histori/keluar/{{$data->id}}" title='Histori'>Histori keluar gudang</a></td>
                            <td><a class='btn-action btn bg-purple histori-gudang' href="/kartustok/gudang/histori/masuk/{{$data->id}}" title='Histori'>Histori masuk gudang</a></td>
                            <td>{{$data->stok_masuk}}</td>
                            <td>{{$data->stok_keluar}}</td>
                            <td>{{$data->stok_akhir}}</td>

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