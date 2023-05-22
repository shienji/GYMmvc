@extends('laporan.master')

@section('title', 'LAPORAN TRANSAKSI')
@section('nav-title', 'LAPORAN TRANSAKSI')

@section('konten')
    <div class="row mb-3">
        <div class="col-lg-3">
            <a href="{{ route('laporan-user') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-secondary btn-block font-weight-bold">USER</button></a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('laporan-transaksi') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-success btn-block font-weight-bold">TRANSAKSI</button></a>
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

    <script>
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
                buttons: ["excel", "pdf", "print"],
            });
        });
    </script>
@endsection
