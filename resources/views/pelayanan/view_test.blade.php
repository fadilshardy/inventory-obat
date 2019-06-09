<head>

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="/css/colorbox.css">
    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('vendor/adminlte/vendor/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{asset('js/colorbox/jquery.colorbox.js')}}" charset="utf-8"></script>
    <script src="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>

</head>

<body>
    <H1>reeeeeeeeeeeeeeeeeeeeee</h1>
    <div class="container">
        <table class="table  dataTable-gudang-obat table-media data-table" id="datatable">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Obat</th>
                    <th>Dosis</th>
                    <th>No batch</th>
                    <th>Expiry date</th>
                    <th>Bentuk sediaan</th>
                    <th>supplier</th>
                    <th>Harga satuan</th>
                    <th>Stok</th>
                    <th>Instock</th>
                    <th>keterangan</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</body>

<script type="text/javascript">
    $(function() {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'nama_obat',
                    name: 'nama_obat'
                },
                {
                    data: 'dosis',
                    name: 'dosis'
                },
                {
                    data: 'no_batch',
                    name: 'no_batch'
                },
                {
                    data: 'expiry_date',
                    name: 'expiry_date'
                },
                {
                    data: 'bentuk_sediaan',
                    name: 'bentuk_sediaan'
                },
                {
                    data: 'supplier',
                    name: 'supplier'
                },
                {
                    data: 'harga_satuan',
                    name: 'harga_satuan'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'instock',
                    name: 'instock'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },

            ]
        });

    });
</script>
<script>
    $('.table-media').on('click', 'tbody tr', function(e) {
        e.preventDefault();
        $('#id_gudang').val($(this).find('td').html());
        $('#id_obat').val($(this).find('td').next().html());
        $('#nama_obat').val($(this).find('td').next().next().html());
        $('#dosis').val($(this).find('td').next().next().next().html());
        $('#no_batch').val($(this).find('td').next().next().next().next().html());
        $('#expiry_date').val($(this).find('td').next().next().next().next().next().html());
        $('#bentuk_sediaan').val($(this).find('td').next().next().next().next().next().next().html());
        $('#supplier').val($(this).find('td').next().next().next().next().next().next().next().html());
        $('#harga_satuan').val($(this).find('td').next().next().next().next().next().next().next().next().html());
        $('#stokobat').text($(this).find('td').next().next().next().next().next().next().next().next().next().html());
        $.colorbox.close();
    });
</script>