@extends('transaksi.master')
{{-- @extends('laporan.master') --}}

@section('title', 'LAPORAN EVENT')
@section('nav-title', 'LAPORAN EVENT')

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
                    class="btn btn-md btn-secondary btn-block font-weight-bold">FASILITAS</button></a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('laporan-event') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-danger btn-block font-weight-bold">EVENT</button></a>
        </div>
    </div>

    <table id="tabel-laporan-event" class="table table-bordered table-hover table-sm text-center">
        <thead>
            <tr>
                <th style="width: 25%">ID EVENT</th>
                <th style="width: 25%">NAMA</th>
                <th style="width: 25%">MULAI</th>
                <th style="width: 25%">BERAKHIR</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#tabel-laporan-event').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('data-event') }}',
                columns: [{
                        data: 'event_id',
                        name: 'event_id'
                    },
                    {
                        data: 'event_nama',
                        name: 'event_nama'
                    },
                    {
                        data: 'event_start',
                        name: 'event_start'
                    },
                    {
                        data: 'event_end',
                        name: 'event_end'
                    },
                ],
                "info": false,
                dom: 'Bfrtip',
                buttons: ["csv", "excel", "pdf", "print"],
            });
        });
    </script>
@endsection
