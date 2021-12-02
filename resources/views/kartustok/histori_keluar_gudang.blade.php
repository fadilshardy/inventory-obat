<div class="row">
    <div class="col-sm-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Kartu stok keluar {{$dataobat->nama_obat}} {{$dataobat->dosis}}</h3>
            </div>


            <div class="box-body">
                <div class="table-responsive-sm">
                    <table class="table  table-bordered table-responsive" id="datatable">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>jumlah</th>
                                <th>Keluar</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $data)
                            <tr>
                                <td>{{date('d M Y', strtotime($data->created_at))}}</td>
                                <td>{{$data->GudangObat->no_batch}} </td>
                                <td>{{$data->stok_awal}}</td>
                                <td>{{$data->GudangObat->keterangan}} </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>