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
                                <li class="breadcrumb-item">{{ ucwords($submenu) }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form class="needs-validation" action="{{ route('pelaporan.store') }}" method="POST" novalidate>
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="mb-6">
                                            <label>Account Representative <code>*</code></label>
                                            <input type="text" class="form-control" id="ar" name="ar"
                                                oninput="this.value = this.value.toUpperCase()" autocomplete="off"
                                                maxlength="25" readonly>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('ar', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="mb-6">
                                            <label>Aplikasi <code>*</code></label>
                                            <select class="form-control seelect select2 aplikasi" name="aplikasi"
                                                id="aplikasi">
                                                <option value=""> -- Pilih --</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('nama', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label>Link</label>
                                            <input type="text" class="form-control" id="link" name="link"
                                                placeholder="link" oninput="this.value = this.value.toUpperCase()"
                                                autocomplete="off" maxlength="25" required>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('link', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <label>Deskripsi <code>*</code></label>
                                            <textarea class="form-control" maxlength="128" oninput="this.value = this.value.toUpperCase()" id="deskripsi"
                                                rows="3" placeholder="Deskripsi" name="deskripsi" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-sm-12">
                                            <a href="{{ route('pelanggan.index') }}"
                                                class="btn btn-secondary waves-effect">Batal</a>
                                            <button class="btn btn-primary" type="submit"
                                                style="float: right">Simpan</button>
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
