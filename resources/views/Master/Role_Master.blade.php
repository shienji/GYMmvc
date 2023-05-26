{{-- @extends('Master.Home_Master') --}}
@extends('transaksi.master')

@section("title", "Role Master")
@section('stylesheet1')
    <link rel="stylesheet" href="{{asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('konten')
    <div class="row">
        <div class="col-lg-5 col-md-12">
            <div class="card card-primary">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Insert New Role</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal"  action="{{route('role_masterpost')}}" method="POST">
                <div class="card-body">
                    <x-inputhcomp type="text" label="role_id" name="role_id" readonly></x-inputcomp>
                        <x-inputhcomp type="hidden" label="Tanggal" name="tgldaftar" class="timestamp" readonly></x-inputcomp>
                        <x-inputhcomp type="text" label="Nama" name="nama" ></x-inputcomp>
                        <x-inputhcomp type="number" label="Harga" name="Harga" ></x-inputcomp>


                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-default">Remove/Restore</button>
                    <button type="submit" class="btn btn-info float-right">Submit</button>
                </div>
                </form>
            </div>
        </div>

        <div class="col-lg-7 col-md-12">
            <div class="card card-success">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">List Role</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="master_role" class="table table-bordered table-hover" style="width:100%" dataLoad="{{route('getDataRole')}}">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Harga</th>
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
    <script src="{{asset('dist/js/master_role.js')}}"></script>
@endsection
