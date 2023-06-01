{{-- @extends('Master.Home_Master') --}}
@extends('transaksi.master')

@section("title", "Fasilitas Master")
@section('stylesheet1')
    <link rel="stylesheet" href="{{asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('/plugins/jquery-ui/jquery-ui.css') }}"> --}}
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{asset('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" /> --}}
@endsection
@if(Session::has('success'))
    <input type="hidden" id="flashpesan" icon="success" value="{{ Session::get('success') }}">
@endif
@section('konten')
<h1 style="text-align: center">Master Fasilitas</h1>
<a href="{{ route("fasilitas_master_list") }}" class="btn btn-danger float-right">List</a> <br>
<br>
    <div class="row">
        <div class="col-md-12">
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
                    <x-inputhcomp type="text" label="id" name="fasilitas_id" value="{{$vjenisedit->fasilitas_id}}" readonly></x-inputcomp>
                        <x-inputhcomp type="hidden" label="Tanggal" name="tgldaftar" class="timestamp" readonly></x-inputcomp>
                        <x-inputhcomp type="text" label="Nama" name="nama" value="{{$vjenisedit->fasilitas_nama}}"  ></x-inputcomp>



                </div>

                <div class="card-footer">
                    <a href="{{ route("fasilitas_master") }}"class="btn btn-default"> Cancel</a>
                    <button type="submit" class="btn btn-info float-right">Submit</button>
                </div>
                {{-- </form><form action="{{ route("fasilitas_masterdel") }}" method="POST">
                    @csrf
                    <x-inputhcomp type="hidden" label="fasilitas_id2" name="fasilitas_id2" readonly></x-inputcomp>
                    <button type="submit" class="btn btn-danger">Remove/Restore</button>
                </form> --}}
            </div>
        </div>

        {{-- <div class="col-lg-7 col-md-12">
            <div class="card card-success">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">List Fasilitas</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="master_fasilitas" class="table table-bordered table-hover" style="width:100%" dataLoad="{{route('getDataFasilitas')}}">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        </table>

                </div>

                <div class="card-footer">

                </div>
            </div>
        </div> --}}
    </div>
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
    {{-- <script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script> --}}
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
@endsection

@section('script2')
    <script src="{{asset('dist/js/master_fasilitas.js')}}"></script>
@endsection
