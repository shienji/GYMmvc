@extends('laporan.master')

@section('konten')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>User</h3>
                            <p>...</p>
                        </div>
                        <a href="{{ route('laporan-user') }}" class="small-box-footer">Cek</a>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Transaksi</h3>
                            <p>...</p>
                        </div>
                        <a href="" class="small-box-footer">Cek</a>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>Fasilitas</h3>
                            <p>...</p>
                        </div>
                        <a href="" class="small-box-footer">Cek</a>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>Acara</h3>
                            <p>...</p>
                        </div>
                        <a href="" class="small-box-footer">Cek</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
