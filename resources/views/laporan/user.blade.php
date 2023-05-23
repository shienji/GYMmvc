@extends('transaksi.master')
{{-- @extends('laporan.master') --}}

@section('title', 'LAPORAN USER')
@section('nav-title', 'LAPORAN USER')

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
