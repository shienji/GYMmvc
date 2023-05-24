@extends('transaksi.master')
{{-- @extends('laporan.master') --}}

{{-- @section('title', 'LAPORAN USER')
@section('nav-title', 'LAPORAN USER') --}}
@section('stylesheet1')    
    <link rel="stylesheet" href="{{asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('konten')
    <div class="row mb-3">
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
    </div>

    <table id="tabel-laporan-user" class="table table-bordered table-hover table-sm text-center">
        <thead>
            <tr>
                <th style="width: 25%">ID USER</th>
                <th style="width: 25%">NAMA</th>
                <th style="width: 25%">ROLE</th>
                <th style="width: 25%">STATUS</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    
@endsection

@section('script1')
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
@endsection

@section('script2')
<script>
    $(document).ready(function() {
        $('#tabel-laporan-user').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('data-user') }}',
            columns: [{
                    data: 'user_id',
                    name: 'user_id'
                },
                {
                    data: 'user_nama',
                    name: 'user_nama'
                },
                {
                    data: 'role_nama',
                    name: 'role_nama'
                },
                {
                    data: 'user_status',
                    name: 'user_status'
                },
            ],
            "info": false,
            dom: 'Bfrtip',
            buttons: ["csv", "excel", "pdf", "print"],
        });
    });
</script>
@endsection