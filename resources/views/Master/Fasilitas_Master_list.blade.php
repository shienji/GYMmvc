{{-- @extends('Master.Home_Master') --}}
@extends('transaksi.master')

@section('title', 'Fasilitas Master')
@section('stylesheet1')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@if (Session::has('success'))
    <input type="hidden" id="flashpesan" icon="success" value="{{ Session::get('success') }}">
@endif
@section('konten')
    <h1 style="text-align: center">Master Fasilitas</h1>
    <a href="{{ route('fasilitas_master') }}" class="btn btn-success float-right">Insert</a>
    <br>
    <br>
    <div class="row">
        {{-- <div class="col-lg-5 col-md-12">
            <div class="card card-primary">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Insert New Fasilitas</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal"  action="{{ route("fasilitas_masterpost") }}" method="POST">
                    @csrf
                <div class="card-body">
                    <x-inputhcomp type="text" label="id" name="fasilitas_id" readonly></x-inputcomp>
                        <x-inputhcomp type="hidden" label="Tanggal" name="tgldaftar" class="timestamp" readonly></x-inputcomp>
                        <x-inputhcomp type="text" label="Nama" name="nama" ></x-inputcomp>



                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Submit</button>
                </div>
                </form><form action="{{ route("fasilitas_masterdel") }}" method="POST">
                    @csrf
                    <x-inputhcomp type="hidden" label="fasilitas_id2" name="fasilitas_id2" readonly></x-inputcomp>
                    <button type="submit" class="btn btn-danger">Remove/Restore</button>
                </form>
            </div>
        </div> --}}

        <div class=" col-md-12">
            <div class="card card-success">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">List Fasilitas</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="master_fasilitaas" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vjenis as $d)
                                <tr>
                                    <td>{{ $d->fasilitas_id }}</td>
                                    <td>{{ $d->fasilitas_nama }}</td>
                                    <td>{{ $d->fasilitas_status }}</td>
                                    <td>
                                        <a href="{{ route('getDataFasilitas', ['id' => $d->fasilitas_id]) }}"
                                            class="btn btn-primary">
                                            Edit
                                        </a>
                                        @if ($d->fasilitas_status == 'aktif')
                                            <a href="{{ route('fasilitas_masterdel', ['id' => $d->fasilitas_id]) }}"
                                                class="btn btn-danger">
                                                Hapus
                                            </a>
                                        @else
                                            <a href="{{ route('fasilitas_masterdel', ['id' => $d->fasilitas_id]) }}"
                                                class="btn btn-danger">
                                                Restore
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

                <div class="card-footer">

                </div>
            </div>
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
@endsection

@section('script2')
    <script src="{{ asset('dist/js/master_fasilitas.js') }}"></script>
@endsection
