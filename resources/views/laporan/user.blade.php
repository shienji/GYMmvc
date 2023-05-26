@extends('transaksi.master')

@section('stylesheet1')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('konten')
    <div class="card bg-gradient-danger">
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
                    <label>ROLE</label>
                    <span class="float-right">:</span>
                </div>
                <div class="col-2">
                    <select class="form-control" id="filter-role">
                        <option value="-">-</option>
                        <option value="Gold">Gold</option>
                        <option value="Silver">Silver</option>
                        <option value="Bronze">Bronze</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <div class="col-5"></div>
                <div class="col-1 pt-1">
                    <label>TANGGAL</label>
                    <span class="float-right">:</span>
                </div>
                <div class="col-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="filter-tanggal">
                        <input type="hidden" class="form-control" id="startDate" value="-">
                        <input type="hidden" class="form-control" id="endDate" value="-">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-1 pt-1">
                    <label>STATUS</label>
                    <span class="float-right">:</span>
                </div>
                <div class="col-2">
                    <select class="form-control" id="filter-status">
                        <option value="-">-</option>
                        <option value="Active">Active</option>
                        <option value="Process">Process</option>
                        {{-- <option value="NonActive">NonActive</option> --}}
                    </select>
                </div>
            </div>
        </div>
    </div>

    <table id="tabel-laporan-user" class="table table-bordered table-hover table-sm text-center">
        <thead>
            <tr>
                <th></th>
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
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
@endsection

@section('script2')
    <script>
        function panggil_tabel_user(x, y, z, a) {
            var t = $('#tabel-laporan-user').DataTable({
                async: false,
                bDestroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'get',
                    'url': '{{ route('data-user-filter') }}',
                    'data': {
                        x,
                        y,
                        z,
                        a
                    },
                },
                columns: [{
                        width: '5%',
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
            $('.card:first').find('[data-card-widget="collapse"]').click();

            panggil_tabel_user('-', '-', '-', '-');

            $('#filter-role').on('change', function() {
                var x = $(this).val();
                var y = $('#startDate').val();
                var z = $('#endDate').val();
                var a = $('#filter-status').val();
                panggil_tabel_user(x, y, z, a);
            });

            $('#filter-status').on('change', function() {
                var x = $('#filter-role').val();
                var y = $('#startDate').val();
                var z = $('#endDate').val();
                var a = $(this).val();
                panggil_tabel_user(x, y, z, a);
            });

            $('#filter-tanggal').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                }
            }).val("-");

            $('#filter-tanggal').on('apply.daterangepicker', function(ev, picker) {
                var y = picker.startDate.format('YYYY-MM-DD') + ' 00:00:00';
                var z = picker.endDate.format('YYYY-MM-DD') + ' 23:59:59';

                $('#startDate').val(y);
                $('#endDate').val(z);

                var x = $('#filter-role').val();
                var a = $('#filter-status').val();

                panggil_tabel_user(x, y, z, a);
            });
        });
    </script>
@endsection
