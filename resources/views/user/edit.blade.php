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
            <form class="needs-validation" action="{{ route('data_user.update', $dataku->id) }}"
                enctype="multipart/form-data" method="POST" novalidate>
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role <code>*</code></label>
                                            <select class="form-control select select2 role" name="roles" id="roles">
                                                <option value="Kasir" @if ($dataku->roles == 'Kasir') selected @endif>
                                                    Kasir
                                                </option>
                                                <option value="Admin" @if ($dataku->roles == 'Admin') selected @endif>
                                                    Admin
                                                </option>
                                                <option value="Administrator"
                                                    @if ($dataku->roles == 'Administrator') selected @endif> Administrator
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama <code>*</code></label>
                                            <input type="text" class="form-control" name="nama" id="nama"
                                                value="{{ $dataku->name }}" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <code>*</code></label>
                                            <input class="form-control" type="text" id="email" name="email"
                                                value="{{ $dataku->email }}" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="telepon" class="form-label">Phone </label>
                                            <input type="text" class="form-control" name="telepon" id="telepon"
                                                value="{{ $dataku->phone }}" autocomplete="off">
                                        </div>
                                    </div>


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
