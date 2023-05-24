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
            @method('DELETE')
            <div class="card card-secondary">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Revewal</h3>
                        <div class="card-tools">
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" data-offset="-62">
                                  <i class="fas fa-bars"></i>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                  <a href="{{route('trans-vrendel')}}" class="dropdown-item" style="color:black">Hapus Renewal</a>
                                  <div class="dropdown-divider"></div>
                                  <a href="#" class="dropdown-item" style="color:black">History Transaksi</a>
                                  <a href="#" class="dropdown-item" style="color:black">History Event</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <x-inputhcomp type="text" label="Tanggal" name="tgldaftar" class="timestamp" readonly></x-inputcomp>
                    <x-inputhcomp type="hidden" label="transaksi_id" name="transaksi_id" readonly></x-inputcomp>
                    <x-inputhcomp type="hidden" label="user_id" name="user_id" readonly></x-inputcomp>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tipe</label>
                        <div class="col-sm-9">
                            <select class="custom-select form-control-border border-width-2" id="role" name="role">
                                <option value=""></option>
                                @foreach ($vjenis as $i)
                                    <option value="{{$i->role_nama}}">{{$i->role_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <x-inputhcomp type="text" label="NIK" name="nik" readonly></x-inputcomp>                        
                    <x-inputhcomp type="text" label="Nama" name="nama" readonly></x-inputcomp>
                    <x-inputhcomp type="text" label="Handphone" name="nohp" readonly></x-inputcomp>
                    <x-inputhcomp type="text" label="Email" name="email" readonly></x-inputcomp>
                    <x-inputhcomp type="text" label="Tgl Lahir" name="tgllahir" readonly ></x-inputcomp>
                    <x-textareahcomp label="Alamat" name="alamat" readonly></x-inputcomp>
                    <x-inputhcomp type="text" label="Tgl Expired" name="tglexpiredold" readonly></x-inputcomp>
                    <x-inputhcomp type="text" label="Berlaku sampai" name="tglexpired" readonly></x-inputcomp>
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
                        <h3 class="card-title">List Member</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="tabel_reg" class="table table-bordered table-hover" style="width:100%" dataLoad="{{route('trans-vdatarenewal')}}">
                        <thead>
                            <tr>
                                <th>Tgl Daftar</th>                                
                                <th>Nama</th>
                                <th>Handphone</th>
                                <th>Tipe</th>
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
    <script src="{{asset('dist/js/trans_ren.js')}}"></script>
@endsection