@extends('transaksi.master')

@section('stylesheet1')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('konten')
    <div class="card bg-gradient-warning">
        <div class="card-header border-0">
            <h3 class="card-title pt-1">
                <i class="fas fa-filter mr-1"></i>
                Filter
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-default btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="margin-bottom: -20px;">
            <div class="form-group row">
                <div class="col-1 pt-1">
                    <label>STATUS</label>
                    <span class="float-right">:</span>
                </div>
                <div class="col-2">
                    <select class="form-control" id="filter-status">
                        <option value="-">-</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <table id="tabel-laporan-transaksi" class="table table-bordered table-hover table-sm text-center">
        <thead>
            <tr>
                <th style="width: 25%">ID TRANSAKSI</th>
                <th style="width: 25%">NAMA</th>
                <th style="width: 25%">DAFTAR</th>
                <th style="width: 25%">EXPIRED</th>
                {{-- <th style="width: 5%">AKSI</th> --}}
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
        function panggil_tabel_transaksi(x) {
            var t = $('#tabel-laporan-transaksi').DataTable({
                async: false,
                bDestroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'get',
                    'url': '{{ route('data-fasilitas-filter') }}',
                    'data': {
                        x
                    },
                },
                columns: [{
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'user_nama',
                        name: 'user_nama'
                    },
                    {
                        data: 'transaksi_daftar',
                        name: 'transaksi_daftar'
                    },
                    {
                        data: 'transaksi_expired',
                        name: 'transaksi_expired'
                    },
                ],
                "info": false,
                dom: 'Bfrtip',
                buttons: ["csv", "excel", "pdf", "print"],
            });

            t.on('order.dt search.dt', function() {
                let i = 1;

                t.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();
        }

        $(document).ready(function() {
            $('#tabel-laporan-transaksi').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('data-transaksi') }}',
                columns: [{
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'user_nama',
                        name: 'user_nama'
                    },
                    {
                        data: 'transaksi_daftar',
                        name: 'transaksi_daftar'
                    },
                    {
                        data: 'transaksi_expired',
                        name: 'transaksi_expired'
                    },
                ],
                "info": false,
                dom: 'Bfrtip',
                buttons: ["csv", "excel", "pdf", "print"],
            });
        });
    </script>
@endsection
