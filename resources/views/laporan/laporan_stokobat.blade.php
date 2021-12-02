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
                <a class="btn btn-default" href="/laporan/stokobat/export">Export Data</a>

         </div>
            <div class="box-body">
        

                <table class="table table-bordered table-compact" id="datatable">
                    <thead>
                        <tr>
                            <th class="text-center" rowspan="2" colspan="1">
                                No
                            </th>
                            <th class="text-center" rowspan="2" colspan="1">
                                Nama obat
                            </th>
                            <th class="text-center" rowspan="2" colspan="1">
                                Harga satuan
                            </th>
                            <th class="text-center" rowspan="1" colspan="2">
                                Stok akhir
                            </th>
                            <th class="text-center" rowspan="2" colspan="1">
                                Jumlah
                            </th>
                            <th class="text-center" rowspan="2" colspan="1">
                                Harga
                            </th>
                            <th class="text-center" rowspan="2" colspan="1">
                                Safety stock
                            </th>
                            <th class="text-center" rowspan="2" colspan="1">
                                Reorder point
                            </th>
                            <th class="text-center" rowspan="2" colspan="1">
                                Rata-rata pemakaian (hari)
                            </th>
                            <th class="text-center" rowspan="2" colspan="1">
                                Status
                            </th>
                          
                        </tr>
                        <tr>
                            <th scope='col' class="text-center">gudang</th>

                            <th scope='col' class="text-center">loker</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php $i = 0; @endphp
                        @foreach ($data as $data)
                        @php
                        $i++;

                        $harga_total = number_format($data->harga_total, 0, ',', ',');
                        $safety_stock = number_format($data->safety_stock, 0, '.', '');
                        $reorder_point = number_format($data->reorder_point, 0, '.', '');
                        $daily_usage = number_format($data->daily_usage, 0, '.', '');

                        @endphp
    
                        @if ($data->stok_total != 0)
                        <tr>
                            <td>{{$i}}</td>
                            <td><a href="/masterobat/{{$data->id}}">{{$data->nama_obat}}</a> ({{$data->dosis}})</td>
                            <td>Rp.{{$data->harga_satuan}}</td>
                            <td>{{$data->stok_gudang}}</td>
                            <td>{{$data->stok_apotek}}</td>
                            <td>{{$data->stok_total}}</td>
                            <td>Rp.{{$harga_total}}</td>
                            <td>{{$safety_stock}}</td>
                            <td>{{$reorder_point}}</td>
                            <td>{{$daily_usage }}</td>

	<td class="text-center">
								@if ($data->stok_total <= $data->reorder_point && $data->stok_total <= $data->safety_stock)
								<span class="label label-danger">Tidak aman</span>
								@elseif($data->stok_total <= $data->reorder_point && $data->stok_total >= $data->safety_stock)
                                <span class="label label-warning">Segera restock</span>
                                @else
                                <span class="label label-success">Aman</span>
								@endif
							</td>
                            
                        </tr>
                        @else
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
</script>
@endsection