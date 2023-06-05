@extends('transaksi.master')
@section('stylesheet2')
    <link rel="stylesheet" href="{{asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                        <h3 class="card-title">Registrasi Event</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>

                <form class="form-horizontal" id="form-input" action="{{route('trans-veventsavereg')}}" method="POST">                
                @csrf
                <div class="card-body">
                    {{-- <x-inputhcomp type="text" label="peserta" name="nm_member" value="{{islogin.user_id}}" readonly ></x-inputcomp> --}}

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Peserta</label>
                        <div class="col-sm-9">
                            <select class="custom-select form-control-border border-width-2" id="nm_member" name="nm_member">
                                @foreach ($vmember as $i)
                                    <option value="{{$i->user_id}}" >{{$i->user_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Event</label>
                        <div class="col-sm-9">
                            <select class="custom-select form-control-border border-width-2" id="nm_event" name="nm_event[]" multiple="multiple">
                                <option value="" value2=""></option>
                                @foreach ($vevent as $i)
                                    <option value="{{$i->event_id}}" value2="{{$i->event_by}}" >{{$i->event_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <x-inputhcomp type="text" label="Koordinator" name="event_by" readonly ></x-inputcomp>
                </div>

                <div class="card-footer">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" id="btnsubmitreg" class="btn btn-info float-right">Save</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="//cdn.datatables.net/plug-ins/1.10.19/dataRender/datetime.js"></script> --}}
@endsection

@section('script2')
    <script src="{{asset('dist/js/trans_eventuser.js')}}"></script>
@endsection