@extends('transaksi.master')

@section('stylesheet1')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/chart.js/Chart.min.css') }}">
@endsection

@section('konten')
    <div class="row">
        <div class="col-6">
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
                <div class="card-body" style="margin-bottom: -10px;">
                    <div class="form-group row">
                        <div class="col-4 pt-1">
                            <label>TANGGAL DAFTAR</label>
                            <span class="float-right">:</span>
                        </div>
                        <div class="col-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control filter-tanggal" id="filter-tanggal-transaksi-daftar">
                                <input type="hidden" class="form-control" id="startDate-daftar" value="-">
                                <input type="hidden" class="form-control" id="endDate-daftar" value="-">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4 pt-1">
                            <label>TANGGAL EXPIRED</label>
                            <span class="float-right">:</span>
                        </div>
                        <div class="col-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control filter-tanggal" id="filter-tanggal-transaksi-expired">
                                <input type="hidden" class="form-control" id="startDate-expired" value="-">
                                <input type="hidden" class="form-control" id="endDate-expired" value="-">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4 pt-1">
                            <label>ROLE</label>
                            <span class="float-right">:</span>
                        </div>
                        <div class="col-8">
                            <select class="form-control" id="filter-role-transaksi">
                                <option value="-">-</option>
                                <option value="1">Gold</option>
                                <option value="2">Silver</option>
                                <option value="3">Bronze</option>
                                <option value="4">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header border-0 bg-gradient-info">
                    <h3 class="card-title pt-1">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Chart
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-default btn-sm" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="lineChart" style="min-height: 340px; height: 340px; max-height: 340px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div> 

    <div class="card">
        <div class="card-body">
            <table id="tabel-laporan-transaksi" class="table table-bordered table-hover table-sm text-center">
                <thead>
                    <tr>
                        <th></th>
                        <th>NAMA</th>
                        <th>DAFTAR</th>
                        <th>EXPIRED</th>
                        <th>ROLE</th>
                        <th>HARGA</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

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
    <script src="{{ asset('plugins/chart.js/Chart.js') }}"></script>
@endsection

@section('script2')
    <script>
        function panggil_tabel_transaksi(x, y, z, a, b) {
            var t = $('#tabel-laporan-transaksi').DataTable({
                async: false,
                bDestroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'get',
                    'url': '{{ route('data-transaksi') }}',
                    'data': {
                        x,
                        y,
                        z,
                        a,
                        b
                    },
                },
                columns: [{
                        width: '5%',
                        data: 'transaksi_id',
                        name: 'transaksi_id'
                    },
                    {
                        width: '15%',
                        data: 'user_nama',
                        name: 'user_nama'
                    },
                    {
                        width: '15%',
                        data: 'transaksi_daftar',
                        name: 'transaksi_daftar'
                    },
                    {
                        width: '15%',
                        data: 'transaksi_expired',
                        name: 'transaksi_expired'
                    },
                    {
                        width: '15%',
                        data: 'role_nama',
                        name: 'role_nama'
                    },
                    {
                        width: '15%',
                        data: 'transaksi_harga',
                        name: 'transaksi_harga',
                        render: function ( data, type, row ) {
                            return 'Rp.' + data;
                        }
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
            // $('.card').find('[data-card-widget="collapse"]').click();

            panggil_tabel_transaksi('-', '-', '-', '-', '-');

            $('.filter-tanggal').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY',
                }
            }).val("-");

            $('#filter-tanggal-transaksi-daftar').on('apply.daterangepicker', function(ev, picker) {
                var x = picker.startDate.format('YYYY-MM-DD') + ' 00:00:00';
                var y = picker.endDate.format('YYYY-MM-DD') + ' 23:59:59';

                $('#startDate-daftar').val(x);
                $('#endDate-daftar').val(y);

                var z = $('#startDate-expired').val();
                var a = $('#endDate-expired').val();

                var b = $('#filter-role-transaksi').val();

                panggil_tabel_transaksi(x, y, z, a, b);
            });

            $('#filter-tanggal-transaksi-expired').on('apply.daterangepicker', function(ev, picker) {
                var z = picker.startDate.format('YYYY-MM-DD') + ' 00:00:00';
                var a = picker.endDate.format('YYYY-MM-DD') + ' 23:59:59';

                $('#startDate-expired').val(z);
                $('#endDate-expired').val(a);

                var x = $('#startDate-daftar').val();
                var y = $('#endDate-daftar').val();

                var b = $('#filter-role-transaksi').val();

                panggil_tabel_transaksi(x, y, z, a, b);
            });

            $('#filter-role-transaksi').on('change', function() {
                var x = $('#startDate-daftar').val();
                var y = $('#endDate-daftar').val();
                var z = $('#startDate-expired').val();
                var a = $('#endDate-expired').val();
                var b = $(this).val();

                panggil_tabel_transaksi(x, y, z, a, b);
            });

            var areaChartData = {
                labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [
                    {
                    label               : 'Daftar',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : {!! json_encode($dataDaftar) !!}
                    },
                    {
                    label               : 'Electronics',
                    backgroundColor     : 'rgba(210, 214, 222, 1)',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : {!! json_encode($dataExpired) !!}
                    },
                ]
            }

            var areaChartOptions = {
                maintainAspectRatio : false,
                responsive : true,
                legend: {
                    display: false
            },
            scales: {
                xAxes: [{
                gridLines : {
                    display : true,
                }
                }],
                yAxes: [{
                gridLines : {
                    display : true,
                }
                }]
            }
            }

            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = $.extend(true, {}, areaChartOptions)
            var lineChartData = $.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartData.datasets[1].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
            })

        });
    </script>
@endsection
