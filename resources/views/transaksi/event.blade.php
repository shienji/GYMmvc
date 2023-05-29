@extends('transaksi.master')
@section('stylesheet1')    
    <link rel="stylesheet" href="{{asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@if(Session::has('success'))
    <input type="hidden" id="flashpesan" icon="success" value="{{ Session::get('success') }}">
@endif

@section('konten')
    <div class="row">
        <div class="col-lg-5 col-md-12">
            <form class="form-horizontal" id="form-input" action="{{route('trans-vrensave')}}" method="POST">
            @csrf
            <div class="card card-secondary">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Registrasi Event</h3>
                        <div class="card-tools">
                            <div class="btn-group" style="display: none;">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" data-offset="-62">
                                  <i class="fas fa-bars"></i>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                  <a href="#" data-toggle="modal" data-target="#modal-transaksi" class="dropdown-item" style="color:black">History Transaksi</a>
                                  {{-- <a href="#" data-toggle="modal" data-target="#modal-event" class="dropdown-item" style="color:black">History Event</a> --}}
                                </div>
                            </div>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <x-inputhcomp type="text" label="Tanggal" name="tgldaftar" class="timestamp" readonly></x-inputcomp>                                        
                    <x-inputhcomp type="text" label="Nama" name="nama" ></x-inputcomp>
                    <x-inputhcomp type="text" label="Tgl Mulai" name="tglawal" ></x-inputcomp>
                    <x-inputhcomp type="text" label="Tgl Selesai" name="tglakhir" ></x-inputcomp>
                </div>

                <div class="card-footer">
                    <button type="reset" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-info float-right">Submit</button>
                </div>
            </div>
            </form>    
        </div>

        <div class="col-lg-7 col-md-12">
            <div class="card card-secondary">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">List Event</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="tabel_reg" class="table table-bordered table-hover" style="width:100%" dataLoad="{{route('trans-vdatarenewal')}}">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Berakhir</th>
                                <th>Peserta</th>
                            </tr>
                        </thead>
                        <tbody>
                            
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
    <script src="{{asset('dist/js/trans_event.js')}}"></script>
@endsection