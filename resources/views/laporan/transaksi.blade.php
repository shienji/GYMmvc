@extends('laporan.master')

@section('konten')
    <div class="row mb-3">
        <div class="col-lg-3">
            <button class="btn btn-md btn-primary btn-block font-weight-bold">USER</button>
        </div>
        <div class="col-lg-3">
            <button class="btn btn-md btn-success btn-block font-weight-bold">TRANSAKSI</button>
        </div>
        <div class="col-lg-3">
            <button class="btn btn-md btn-warning btn-block font-weight-bold">FASILITAS</button>
        </div>
        <div class="col-lg-3">
            <button class="btn btn-md btn-danger btn-block font-weight-bold">ACARA</button>
        </div>
    </div>

    <table id="tabel-laporan-transaksi" class="table table-bordered table-hover table-sm text-center">
        <thead>
            <tr>
                <th style="width: 5%">ID</th>
                <th style="width: 45%">DAFTAR</th>
                <th style="width: 45%">EXPIRED</th>
                {{-- <th style="width: 5%">AKSI</th> --}}
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#tabel-laporan-transaksi').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('data_transaksi') }}',
                columns: [{
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'transaksi_daftar',
                        name: 'transaksi_daftar'
                    },
                    {
                        data: 'transaksi_expired',
                        name: 'transaksi_expired'
                    },
                ]
            });
        });
    </script>
@endsection
