@extends('layouts.main')
@section('apotekku')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $title }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">{{ $submenu }}</li>
                                <li class="breadcrumb-item">{{ $label }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form class="needs-validation" action="{{ route('jenis.store') }}" method="POST" novalidate>
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-6">
                                                <label for="jenis" class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="jenis" id="jenis"
                                                    oninput="this.value = this.value.toUpperCase()" autocomplete="off"
                                                    required>
                                            </div>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('supplier', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-6">
                                                <label for="descr" class="form-label">Deskripsi</label>
                                                <input type="text" class="form-control" name="descr" id="descr"
                                                    oninput="this.value = this.value.toUpperCase()" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <a href="{{ route('jenis.index') }}"
                                            class="btn btn-secondary waves-effect">Batal</a>
                                        <button class="btn btn-primary" type="submit" style="float: right">Simpan</button>
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
