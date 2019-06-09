<div class="row">
    <div class="col-sm-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Gudang obat</h3>
            </div>
            <div class="box-body">
                <table class="table  dataTable-gudang-obat table-media" id="datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama obat</th>
                            <th>dosis</th>
                            <th>Bentuk sediaan</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($masterobat as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->nama_obat}}</td>
                            <td>{{$data->dosis}}</td>
                            <td>{{$data->bentuk_sediaan}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $('.table-media').on('click', 'tbody tr', function(e) {
        e.preventDefault();
        $('#id_obat').val($(this).find('td').html());
        $('#nama_obat').val($(this).find('td').next().html());
        $('#dosis').val($(this).find('td').next().next().html());
        $('#bentuk_sediaan').val($(this).find('td').next().next().next().html());
        $.colorbox.close();
    });
</script>

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css">
@stop

@section('js')
<script src="{{asset('js/render_datatables.js')}}" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

@endsection