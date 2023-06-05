@extends('transaksi.master')
@section('stylesheet1')
    <link rel="stylesheet" href="{{asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('/plugins/jquery-ui/jquery-ui.css') }}"> --}}
    <link rel="stylesheet" href="{{asset('/plugins/daterangepicker/daterangepicker.css') }}">
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
    <input type="hidden" id="tokennya" name="tokennya" value="{{ csrf_token() }}">
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">List Event</h3>
                        <div class="card-tools">
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" data-offset="-62">
                                  <i class="fas fa-bars"></i>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                  <a href="#" data-toggle="modal" data-target="#modal-addevent" class="dropdown-item" style="color:black">Add Event</a>
                                  <a href="#" data-toggle="modal" data-target="#modal-regevent" class="dropdown-item" style="color:black">Register Event</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="tabel_reg" class="table table-bordered table-hover" style="width:100%" dataLoad="{{route('trans-vdataevent')}}" dataDel="{{route('trans-veventpesertadel')}}">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Berakhir</th>
                                <th>Koordinator</th>
                                <th>Keterangan</th>
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

    <div class="modal fade" id="modal-addevent">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Event</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form class="form-horizontal" id="form-input" action="{{route('trans-veventsave')}}" method="POST">
            @csrf
            <div class="modal-body">
                <x-inputhcomp type="hidden" label="event_id" name="event_id" ></x-inputcomp>
                <x-inputhcomp type="text" label="Tanggal" name="tgldaftar" class="timestamp" readonly></x-inputcomp>
                <x-inputhcomp type="text" label="Nama" name="nama" ></x-inputcomp>
                <x-inputhcomp type="datesaja" label="Tgl Mulai" name="tglawal" ></x-inputcomp>
                <x-inputhcomp type="datesaja" label="Tgl Selesai" name="tglakhir" ></x-inputcomp>
                <x-inputhcomp type="text" label="Koordinator" name="eventby" ></x-inputcomp>
            </div>
            
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="btnsubmit" class="btn btn-info float-right">Save</button>
            </div>
            </form>

          </div>
        </div>
    </div>

    <div class="modal fade" id="modal-regevent">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Event</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form class="form-horizontal" id="form-input" action="{{route('trans-veventsavereg')}}" method="POST">                
            @csrf
            <div class="modal-body">

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Event</label>
                    <div class="col-sm-9">
                        <select class="custom-select form-control-border border-width-2" id="nm_event" name="nm_event">
                            <option value="" value2=""></option>
                            @foreach ($vevent as $i)
                                <option value="{{$i->event_id}}" value2="{{$i->event_by}}" >{{$i->event_nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <x-inputhcomp type="text" label="Koordinator" name="event_by" readonly ></x-inputcomp>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Peserta</label>
                    <div class="col-sm-9">
                        <select class="custom-select form-control-border border-width-2" id="nm_member" name="nm_member">
                            <option value=""></option>
                            @foreach ($vmember as $i)
                                <option value="{{$i->user_id}}" >{{$i->user_nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="btnsubmitreg" class="btn btn-info float-right">Save</button>
            </div>
            </form>

          </div>
        </div>
    </div>

    <div class="modal fade" id="modal-event">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detail Peserta</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="modal_eventid" id="modal_eventid" value="0">

                <table id="tabel_event" class="table table-bordered table-hover" style="width:100%" dataLoad="{{route('trans-veventpeserta')}}">
                    <thead>
                        <tr>
                            <th>Tgl Daftar</th>
                            <th>Nama Peserta</th>
                            <th>Handphone</th>
                            <th>Alamat</th>
                            <th>Member sejak</th>                            
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default ml-auto" data-dismiss="modal">Close</button>
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
    {{-- <script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script> --}}
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.19/dataRender/datetime.js"></script>
@endsection

@section('script2')
    <script src="{{asset('dist/js/trans_event.js')}}"></script>
@endsection
