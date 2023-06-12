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
            <div class="card bg-gradient-success">
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
                            <label>TANGGAL MULAI</label>
                            <span class="float-right">:</span>
                        </div>
                        <div class="col-8">
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
                    </div>
                    <div class="form-group row">
                        <div class="col-4 pt-1">
                            <label>TANGGAL BERAKHIR</label>
                            <span class="float-right">:</span>
                        </div>
                        <div class="col-8">
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
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header border-0 bg-gradient-info">
                    <h3 class="card-title pt-1">
                        <i class="fas fa-chart-line mr-1"></i>
                        Chart
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-default btn-sm" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chartEvent" style="min-height: 240px; height: 240px; max-height: 240px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="tabel-laporan-event" class="table table-bordered table-hover table-sm text-center">
                <thead>
                    <tr>
                        <th></th>
                        <th>NAMA</th>
                        <th>MULAI</th>
                        <th>BERAKHIR</th>
                        <th>FASILITAS TERPAKAI</th>
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
        function panggil_tabel_event(x, y, z, a) {
            var t = $('#tabel-laporan-event').DataTable({
                async: false,
                bDestroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'get',
                    'url': '{{ route('data-event') }}',
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
                        width: '25%',
                        data: 'event_nama',
                        name: 'event_nama'
                    },
                    {
                        width: '25%',
                        data: 'event_start',
                        name: 'event_start'
                    },
                    {
                        width: '25%',
                        data: 'event_end',
                        name: 'event_end'
                    },
                    {
                        width: '25%',
                        data: 'fasilitas_nama',
                        name: 'fasilitas_nama'
                    }
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
            $('.card').find('[data-card-widget="collapse"]').click();

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

            
            var areaChartData = {
                labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [
                    {
                    label               : 'EVENT DIADAKAN',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : {!! json_encode($arrayStart) !!}
                    }
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

            var barChartCanvas = $('#chartEvent').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false
            }

            new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
            })
        });
    </script>
@endsection
