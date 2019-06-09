@extends('adminlte::page')

@section('title', 'Laporan stok obat')

@section('content_header')
<h1>Laporan obat</h1>
@stop

@section('content')
@include('includes.messages')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Laporan stok obat</h3>
            </div>
            <div class="box-body">
                <a class="btn btn-warning" href="/laporan/stokobat/export">Export User Data</a>

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
                            <th>Stock gudang</th>
                            <th>Stock apotek</th>
                            <th>Stock In gudang</th>
                            <th>Stock In Apotek</th>
                            <th>Stock out gudang</th>
                            <th>Stock out Apotek</th>
                            <th>Safety stock</th>
                            <th>Reorder Point</th>
                            <th>Total stock</th>



                        </tr>
                    </thead>
                    <tbody>

                        @php $total = 0; $hargatotal = 0; $i = 0; @endphp
                        @foreach ($data as $data)
                        @php
                        $i++;
                        $total = $data->stokgudang + $data->stokapotek;
                        @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td><a href="/gudangobat/{{$data->id}}">{{$data->nama_obat}}</a> ({{$data->dosis}})</td>
                            <td>{{$data->stokgudang}}</td>
                            <td>{{$data->stokapotek}}</td>
                            <td>{{$data->stokawalgudang}}</td>
                            <td>{{$data->stokawalapotek}}</td>
                            <td>{{$data->keluargudang}}</td>
                            <td>{{$data->keluarapotek}}</td>
                            <td>{{$data->safetystock}}</td>
                            <td>{{$data->reorderpoint}}</td>

                            <td>{{$total}}</td>
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