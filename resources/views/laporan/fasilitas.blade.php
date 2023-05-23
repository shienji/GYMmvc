@extends('transaksi.master')
{{-- @extends('laporan.master') --}}

{{-- @section('title', 'LAPORAN FASILITAS')
@section('nav-title', 'LAPORAN FASILITAS') --}}

@section('konten')
    <div class="row mb-3">
        <div class="col-lg-3">
            <a href="{{ route('laporan-user') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-secondary btn-block font-weight-bold">USER</button></a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('laporan-transaksi') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-secondary btn-block font-weight-bold">TRANSAKSI</button></a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('laporan-fasilitas') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-warning btn-block font-weight-bold">FASILITAS</button></a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('laporan-event') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-secondary btn-block font-weight-bold">EVENT</button></a>
        </div>
    </div>

    <table id="tabel-laporan-fasilitas" class="table table-bordered table-hover table-sm text-center">
        <thead>
            <tr>
                <th style="width: 50%">ID FASILITAS</th>
                <th style="width: 50%">ID NAMA</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#tabel-laporan-fasilitas').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('data-fasilitas') }}',
                columns: [{
                        data: 'fasilitas_id',
                        name: 'fasilitas_id'
                    },
                    {
                        data: 'fasilitas_nama',
                        name: 'fasilitas_nama'
                    },
                ],
                "info": false,
                dom: 'Bfrtip',
                buttons: ["csv", "excel", "pdf", "print"],
            });
        });
    </script>
@endsection
