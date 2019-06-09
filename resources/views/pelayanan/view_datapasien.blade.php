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
                            <th>Nama pasien</th>
                            <th>NIK</th>
                            <th>Jenis kelamin</th>
                            <th>Tanggal lahir</th>
                            <th>Alamat </th>
                            <th>No telepon</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($datapasien as $data)
                        @php
                        $tanggal_lahir = date("d-m-Y", strtotime($data->tanggal_lahir));
                        @endphp
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->nama_pasien}}</td>
                            <td>{{$data->NIK}}</td>
                            <td>{{$data->gender}}</td>
                            <td>{{$tanggal_lahir}}</td>
                            <td>{{$data->alamat}}</td>
                            <td>{{$data->no_telp}}</td>
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
        $('#id_pasien').val($(this).find('td').html());
        $('#nik').val($(this).find('td').next().next().html());
        $('#nama_pasien').val($(this).find('td').next().html());
        $('#gender').val($(this).find('td').next().next().next().html());
        $('#tanggal_lahir').val($(this).find('td').next().next().next().next().html());
        $('#alamat').val($(this).find('td').next().next().next().next().next().html());
        $('#no_telp').val($(this).find('td').next().next().next().next().next().next().html());

        $('#nama').text($(this).find('td').next().html());
        $('#nik_pasien').text($(this).find('td').next().next().html());
        $('#alamat_pasien').text($(this).find('td').next().next().next().next().next().html());

        $.colorbox.close();

        $("#test").show("slow");
    });
</script>