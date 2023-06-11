@extends('transaksi.master')
@section('stylesheet2')
    <link rel="stylesheet" href="{{asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('/plugins/dropzone/min/dropzone.min.css')}}"> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@if(Session::has('success'))
    <input type="hidden" id="flashpesan" icon="success" value="{{ Session::get('success') }}">
@endif

@section('konten')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">List New Member</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="tabel_reg" class="table table-bordered table-hover" style="width:100%" dataLoad="{{route('trans-vdataregister')}}">
                        <thead>
                            <tr>
                                <th>Tgl Daftar</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Handphone</th>
                                <th>Alamat</th>
                                <th>Tipe</th>
                                <th>Action</th>
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

    <div class="modal fade" id="modal-register">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Approval Pembayaran Anggota</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form class="form-horizontal" id="form-input" action="{{route('trans-vregsave')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <x-inputhcomp type="hidden" label="user_id" name="user_id" readonly></x-inputcomp>                    
                        <x-inputhcomp type="text" label="NIK" name="nik" readonly></x-inputcomp>
                        <x-inputhcomp type="text" label="Nama" name="nama" readonly></x-inputcomp>
                        <x-inputhcomp type="text" label="Hp" name="nohp" readonly></x-inputcomp>
                        <x-inputhcomp type="text" label="Email" name="email" readonly></x-inputcomp>
                        <x-inputhcomp type="text" label="Tgl Lahir" name="tgllahir" readonly ></x-inputcomp>
                        <x-textareahcomp label="Alamat" name="alamat" readonly></x-inputcomp>
                        <hr>
                        <div class="form-group row">
                            <label for="role" class="col-sm-3 col-form-label">Tipe</label>
                            <div class="col-sm-5">
                                <select class="custom-select form-control-border border-width-2" id="role" name="role">
                                    <option value=""></option>
                                    @foreach ($vjenis as $i)
                                        <option value="{{$i->role_nama}}" value2="{{$i->role_harga}}">{{$i->role_nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" id="role_harga" name="role_harga" class="form-control" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Berlaku</label>
                            <div class="col-sm-4">
                                <select class="form-control select2" style="width: 100%;" id="jmlbulan" name=jmlbulan>
                                    <option value="1">1 Bulan</option>
                                    <option value="2">2 Bulan</option>
                                    <option value="3">3 Bulan</option>
                                    <option value="4">4 Bulan</option>
                                    <option value="5">5 Bulan</option>
                                    <option value="6">6 Bulan</option>
                                    <option value="7">7 Bulan</option>
                                    <option value="8">8 Bulan</option>
                                    <option value="9">9 Bulan</option>
                                    <option value="10">10 Bulan</option>
                                    <option value="11">11 Bulan</option>
                                    <option value="12">12 Bulan</option>
                                    <option value="24">2 Tahun</option>
                                    <option value="36">3 Tahun</option>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" name="tglexpired" id="tglexpired" class="form-control" value="" readonly >
                            </div>
                        </div>
                        <x-inputhcomp type="text" label="Total" name="totalbyr" readonly></x-inputcomp>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Bukti Bayar</label>
                            <div class="col-9">
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input id="buktiimg" name="buktiimg[]"  type="file" class="file" data-show-upload="false" data-max-file-count="3" data-theme="fa5" multiple>
                                    </div>
                                </div>
                                {{-- <input class="custom-file-input" id="buktiimg" name="buktiimg[]" data-show-upload="false" type="file" multiple> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-9">
                                
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>

            <div class="modal-footer justify-content-between">
              <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-info float-right">Save</button>
            </div>
            </form>
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
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/dataRender/datetime.js"></script>
    {{-- <script src="{{asset('plugins/dropzone/min/dropzone.min.js')}}"></script> --}}

    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/buffer.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/filetype.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/piexif.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/fileinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/locales/LANG.js"></script>
@endsection

@section('script2')
    <script src="{{asset('dist/js/trans_reg.js')}}"></script>
@endsection