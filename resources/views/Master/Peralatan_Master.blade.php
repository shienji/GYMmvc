{{-- @extends('Master.Home_Master') --}}
@extends('transaksi.master')

@section("title", "Peralatan Master")
@section('stylesheet1')
    <link rel="stylesheet" href="{{asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@if(Session::has('success'))
    <input type="hidden" id="flashpesan" icon="success" value="{{ Session::get('success') }}">
@endif
@section('konten')
<h1 style="text-align: center">Master Peralatan</h1>
<a href="{{ route("peralatan_master_list") }}" class="btn btn-success float-right">List</a> <br>
<br>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Insert New Peralatan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal"  action="{{ route("peralatan_masterpost") }}" method="POST">
                    @csrf
                <div class="card-body">
                    <x-inputhcomp type="text" label="id" name="peralatan_id" readonly></x-inputcomp>
                    <x-inputhcomp type="hidden" label="Tanggal" name="tgldaftar" class="timestamp" readonly></x-inputcomp>
                    <x-inputhcomp type="text" label="Nama" name="nama" ></x-inputcomp>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Fasilitas</label>
                        <div class="col-sm-9">
                            <select class="custom-select form-control-border border-width-2" id="fasilitas_nama" name="fasilitas_nama">
                                <option value=""></option>
                                @foreach ($vjenis as $i)
                                    <option value="{{$i->fasilitas_nama}}">{{$i->fasilitas_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                </div>

                <div class="card-footer">
                    <button type="reset" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-info float-right">Submit</button>
                </div>
                {{-- </form><form action="{{ route("peralatan_masterdel") }}" method="POST">
                    @csrf
                    <x-inputhcomp type="hidden" label="peralatan_id2" name="peralatan_id2" readonly></x-inputcomp>
                    <button type="submit" class="btn btn-danger">Remove/Restore</button>
                </form> --}}
            </div>
        </div>

        {{-- <div class="col-lg-7 col-md-12">
            <div class="card card-success">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">List Peralatan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="master_peralatan" class="table table-bordered table-hover" style="width:100%" dataLoad="{{route('getDataPeralatan')}}">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fasilitas</th>
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
@endsection

@section('script2')
    <script src="{{asset('dist/js/master_peralatan.js')}}"></script>
@endsection
