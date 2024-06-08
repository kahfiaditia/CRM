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
                                <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form class="needs-validation" action="{{ route('data_user.store') }}" enctype="multipart/form-data"
                method="POST" novalidate>
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role <code>*</code></label>
                                            <select class="form-control select select2 role" name="roles" id="roles"
                                                required>
                                                <option value=""> --- Pilih --</option>
                                                <option value="Administrator"> Administrator</option>
                                                <option value="Leader"> Leader</option>
                                                <option value="Customer"> Customer</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama <code>*</code></label>
                                            <input type="text" class="form-control" name="nama" id="nama"
                                                autocomplete="off" oninput="this.value = this.value.toUpperCase()"
                                                placeholder="Nama" maxlength="30" required>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('nama', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username <code>*</code></label>
                                            <input type="text" class="form-control" name="username" id="username"
                                                autocomplete="off" oninput="this.value = this.value.toUpperCase()"
                                                placeholder="Username" maxlength="15" required>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('username', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password <code>*</code></label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                autocomplete="off" maxlength="15" placeholder="Password">
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('password', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="telepon" class="form-label">Phone</label>
                                            <input type="number" class="form-control" name="telepon" id="telepon"
                                                autocomplete="off" maxlength="20" placeholder="Telepone">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email </label>
                                            <input class="form-control" type="email" id="email" name="email"
                                                autocomplete="off" oninput="this.value = this.value.toUpperCase()"
                                                maxlength="50" placeholder="Email">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <a href="{{ route('data_user.index') }}"
                                            class="btn btn-secondary waves-effect">Batal</a>
                                        <button class="btn btn-primary" type="submit" style="float: right"
                                            id="submit">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
