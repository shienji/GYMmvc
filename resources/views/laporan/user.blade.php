@extends('transaksi.master')

@section('stylesheet1')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('konten')
    {{-- <div class="row mb-3">
        <div class="col-lg-3">
            <a href="{{ route('laporan-user') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-info btn-block font-weight-bold">USER</button></a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('laporan-transaksi') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-secondary btn-block font-weight-bold">TRANSAKSI</button></a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('laporan-fasilitas') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-secondary btn-block font-weight-bold">FASILITAS</button></a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('laporan-event') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-secondary btn-block font-weight-bold">EVENT</button></a>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-1 pt-1">
                    <label>ROLE :</label>
                </div>
                <div class="col-2">
                    <select class="form-control" id="filter-role">
                        <option value="-">Semua</option>
                        <option value="Gold">Gold</option>
                        <option value="Silver">Silver</option>
                        <option value="Bronze">Bronze</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <table id="tabel-laporan-user" class="table table-bordered table-hover table-sm text-center">
        <thead>
            <tr>
                <th>ID USER</th>
                <th>NAMA</th>
                <th>ROLE</th>
                <th>STATUS</th>
                <th>CREATED_AT</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('script1')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
@endsection

@section('script2')
    <script>
        function panggil_tabel_user(x) {
            $('#tabel-laporan-user').DataTable({
                bDestroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'get',
                    'url': '{{ route('data-user-filter') }}',
                    'data': {
                        x
                    },
                },
                columns: [{
                        width: '20%',
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        width: '20%',
                        data: 'user_nama',
                        name: 'user_nama'
                    },
                    {
                        width: '20%',
                        data: 'role_nama',
                        name: 'role_nama'
                    },
                    {
                        width: '20%',
                        data: 'user_status',
                        name: 'user_status'
                    },
                    {
                        width: '20%',
                        data: 'created_at',
                        name: 'created_at'
                    },
                ],
                "info": false,
                dom: 'Bfrtip',
                buttons: ["csv", "excel", "pdf", "print"],
            });
        }

        $(document).ready(function() {
            var x = $('#filter-role').val();
            panggil_tabel_user(x);

            $('#filter-role').on('change', function() {
                var x = $(this).val();
                panggil_tabel_user(x);
            });
        });
    </script>
@endsection
