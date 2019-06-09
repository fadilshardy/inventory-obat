<div class="row">
    <div class="col-sm-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Stok apotek</h3>
            </div>
            <div class="box-body">
                <table class="table  dataTable-gudang-obat table-media_<?= $id_count; ?>" id="datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID obat</th>
                            <th>Nama obat</th>
                            <th>Harga satuan</th>
                            <th>No batch</th>
                            <th>dosis</th>
                            <th>Expiry date</th>
                            <th>Bentuk sediaan</th>
                            <th>Supplier</th>
                            <th>Jumlah</th>
                            <th>Instock</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($apotek as $apotek)
                        @php
                        $formattedexpiry_date = date("d-m-Y", strtotime($apotek->expiry_date));
                        @endphp
                        <tr>
                            <td>{{$apotek->id}}</td>
                            <td>{{$apotek->id_obat}}</td>
                            <td>{{$apotek->nama_obat}}</td>
                            <td>{{$apotek->harga_satuan}}</td>
                            <td>{{$apotek->no_batch}}</td>
                            <td>{{$apotek->dosis}}</td>
                            <td>{{$formattedexpiry_date}}</td>
                            <td>{{$apotek->bentuk_sediaan}}</td>
                            <td>{{$apotek->supplier}}</td>

                            <td style="text-align: center;"><span class="badge badge-secondary">
                                    {{$apotek->jumlah}}</span> </td>
                            <td>
                                @if ($apotek->instock == 1)
                                <span class="label label-success">Yes</span>
                                @else
                                <span class="label label-danger">No</span>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $('.table-media_<?php echo $id_count; ?>').on('click', 'tbody tr', function(e) {
        e.preventDefault();
        $('#id_apotek_obat_<?= $id_count; ?>').val($(this).find('td').html());
        $('#id_obat_<?= $id_count; ?>').val($(this).find('td').next().html());
        $('#nama_apotek_obat_<?= $id_count; ?>').val($(this).find('td').next().next().html());
        $('#harga_<?= $id_count; ?>').val($(this).find('td').next().next().next().html());
        $('#jumlah_1').text($(this).find('td').next().next().next().html());

        $.colorbox.close();
    });
</script>

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css">

@stop

@section('js')
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>
<script src="{{asset('js/render_datatables.js')}}" charset="utf-8"></script>

@endsection