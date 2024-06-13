@extends('layouts.main')
@section('apotekku')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $submenu }}</a></li>
                                <li class="breadcrumb-item active">{{ $master }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">{{ $label1 }}</h4>
                            <p class="card-title-desc">Data profil pengguna yang sedang login saat ini yaitu sebagai
                                berikut:

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Nama</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="{{ $akun->name }}"
                                        id="example-text-input">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="{{ $akun->email }}"
                                        id="example-text-input">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Roles</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="{{ $akun->roles }}"
                                        id="example-text-input" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Phone</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="{{ $akun->phone }}"
                                        id="example-text-input">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Menu</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="{{ $akun->menu }}"
                                        id="example-text-input">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Submenu</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="{{ $akun->submenu }}"
                                        id="example-text-input">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-password-input" class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="password" value="{{ $akun->password }}"
                                        placeholder="Enter Password" id="example-password-input">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
