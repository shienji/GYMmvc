@extends('transaksi.master')

@section('konten')
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Registration New Member</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form class="form-horizontal">
                        <div class="card-body">
                            @php
                                $mjenis = [
                                    'kode'  => 'kode1',
                                    'nama' => 'Nama1'
                                ];
                            @endphp
                            <x-inputcomp type="text" label="Tanggal" name="tgldaftar"></x-inputcomp>
                            @foreach ($mjenis as $i)
                                    <pre>{{ $i[0] }}</pre>
                                @endforeach
                            <select name="jenis" id="jenis">
                                
                            </select>
                        </div>
                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <div class="card-footer">

                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">

        </div>
    </div>
@endsection