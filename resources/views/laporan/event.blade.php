@extends('transaksi.master')

@section('stylesheet1')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('konten')
    <div class="card bg-gradient-info">
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
                <div class="col-2 pt-1">
                    <label>TANGGAL MULAI</label>
                    <span class="float-right">:</span>
                </div>
                <div class="col-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control filter-tanggal" id="filter-tanggal-event-mulai">
                        <input type="hidden" class="form-control" id="startDate-mulai" value="-">
                        <input type="hidden" class="form-control" id="endDate-mulai" value="-">
                    </div>
                </div>
                <div class="col-2"></div>
                <div class="col-2 pt-1">
                    <label>TANGGAL BERAKHIR</label>
                    <span class="float-right">:</span>
                </div>
                <div class="col-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control filter-tanggal" id="filter-tanggal-event-berakhir">
                        <input type="hidden" class="form-control" id="startDate-berakhir" value="-">
                        <input type="hidden" class="form-control" id="endDate-berakhir" value="-">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table id="tabel-laporan-event" class="table table-bordered table-hover table-sm text-center">
        <thead>
            <tr>
                <th></th>
                <th>NAMA</th>
                <th>MULAI</th>
                <th>BERAKHIR</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
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
        function panggil_tabel_event(x, y, z, a) {
            var t = $('#tabel-laporan-event').DataTable({
                async: false,
                bDestroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'get',
                    'url': '{{ route('data-event-filter') }}',
                    'data': {
                        x,
                        y,
                        z,
                        a
                    },
                },
                columns: [{
                        width: '5%',
                        data: 'event_id',
                        name: 'event_id'
                    },
                    {
                        width: '30%',
                        data: 'event_nama',
                        name: 'event_nama'
                    },
                    {
                        width: '30%',
                        data: 'event_start',
                        name: 'event_start'
                    },
                    {
                        width: '30%',
                        data: 'event_end',
                        name: 'event_end'
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
        };

        $(document).ready(function() {
            $('.card:first').find('[data-card-widget="collapse"]').click();

            panggil_tabel_event('-', '-', '-', '-');

            $('.filter-tanggal').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY',
                }
            }).val("-");

            $('#filter-tanggal-event-mulai').on('apply.daterangepicker', function(ev, picker) {
                var x = picker.startDate.format('YYYY-MM-DD') + ' 00:00:00';
                var y = picker.endDate.format('YYYY-MM-DD') + ' 23:59:59';

                $('#startDate-mulai').val(x);
                $('#endDate-mulai').val(y);

                var z = $('#startDate-berakhir').val();
                var a = $('#endDate-berakhir').val();

                panggil_tabel_event(x, y, z, a);
            });

            $('#filter-tanggal-event-berakhir').on('apply.daterangepicker', function(ev, picker) {
                var z = picker.startDate.format('YYYY-MM-DD') + ' 00:00:00';
                var a = picker.endDate.format('YYYY-MM-DD') + ' 23:59:59';

                $('#startDate-berakhir').val(z);
                $('#endDate-berakhir').val(a);

                var x = $('#startDate-mulai').val();
                var y = $('#endDate-mulai').val();

                panggil_tabel_event(x, y, z, a);
            });
        });
    </script>
@endsection
