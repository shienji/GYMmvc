@extends('layout.User_AdminMaster')

@section('stylesheet1')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
@endsection

@section('konten')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                @foreach ($admin as $c)
                                    <h3 class="profile-username text-center">{{ $c->user_nama }}</h3>
                                    <p class="text-muted text-center">{{ $c->user_role }}</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Member Since</b> <a class="float-right">{{ $c->created_at }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Status</b> <a class="float-right">{{ $c->user_status }}</a>
                                        </li>
                                    </ul>
                                @endforeach
                                {{-- <h3 class="profile-username text-center">{{ Auth::user()->user_nama }}</h3>
                                    <p class="text-muted text-center">{{ Auth::user()->user_role }}</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Member Since</b> <a class="float-right">{{ Auth::user()->created_at }}</a>
                                        </li>
                                    </ul> --}}
                                <a href="{{ Route('actionlogout') }}" class="btn btn-danger btn-block"><b>Logout</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        {{-- <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>

                            <p class="text-muted">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">Malibu, California</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                            <p class="text-muted">
                                <span class="tag tag-danger">UI Design</span>
                                <span class="tag tag-success">Coding</span>
                                <span class="tag tag-info">Javascript</span>
                                <span class="tag tag-warning">PHP</span>
                                <span class="tag tag-primary">Node.js</span>
                            </p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                                fermentum enim neque.</p>
                        </div>
                        <!-- /.card-body -->
                    </div> --}}
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#profile"
                                            data-toggle="tab">Profile</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="profile">

                                        <div class="card-body">
                                            @foreach ($admin as $d)
                                                <strong>Email</strong>

                                                <p class="text-muted">{{ $d->user_email }}</p>

                                                <hr>

                                                <strong>Nama</strong>

                                                <p class="text-muted">{{ $d->user_nama }}</p>

                                                <hr>

                                                <strong>NIK</strong>

                                                <p class="text-muted">{{ $d->user_nik }}</p>

                                                <hr>

                                                <strong>Tanggal Lahir</strong>

                                                <p class="text-muted">{{ $d->user_tgllahir }}</p>

                                                <hr>

                                                <strong>No. HP</strong>

                                                <p class="text-muted">{{ $d->user_nohp }}</p>

                                                <hr>

                                                <strong>Alamat</strong>

                                                <p class="text-muted">{{ $d->user_alamat }}</p>

                                                <hr>

                                                <strong>Role</strong>

                                                <p class="text-muted">{{ $d->user_role }}</p>
                                            @endforeach
                                        </div>
                                        <!-- /.card-body -->

                                    </div>
                                    <div class="tab-pane" id="settings">
                                        <form class="form-horizontal">
                                            @foreach ($admin as $e)
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="inputEmail"
                                                            value="{{ $e->user_email }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputNama"
                                                            value="{{ $e->user_nama }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputNIK" class="col-sm-2 col-form-label">NIK</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" id="inputNIK"
                                                            value="{{ $e->user_nik }}"
                                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                            type="number" maxlength="19" min="0">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputTgllahir" class="col-sm-2 col-form-label">Tanggal
                                                        Lahir</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="inputTgllahir"
                                                            value="{{ $e->user_tgllahir }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputNohp" class="col-sm-2 col-form-label">No. HP</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" id="inputNohp"
                                                            value="{{ $e->user_nohp }}"
                                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                            type="number" maxlength="16" min="0">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputAlamat"
                                                        class="col-sm-2 col-form-label">Alamat</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputAlamat"
                                                            value="{{ $e->user_alamat }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <a href="#"><button type="submit"
                                                                class="btn btn-danger">Update</button></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script1')
    <script>
        var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            alert(msg);
        }
    </script>
@endsection
