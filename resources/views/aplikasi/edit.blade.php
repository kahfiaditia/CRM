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
            <form class="needs-validation" action="{{ route('aplikasi.update', $editaplikasi->id) }}" method="POST"
                novalidate>
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <label for="nama" class="form-label">Nama <code>*</code></label>
                                                <input type="text" class="form-control" name="nama" id="nama"
                                                    oninput="this.value = this.value.toUpperCase()"
                                                    value="{{ old('nama', $editaplikasi->nama) }}" autocomplete="off">
                                            </div>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('nama', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <input type="text" class="form-control" name="deskripsi" id="deskripsi"
                                                    oninput="this.value = this.value.toUpperCase()"
                                                    value="{{ old('deskripsi', $editaplikasi->deskripsi) }}"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <label for="deskripsi" class="form-label">Status</label>
                                                <select class="form-control select select2 status1" name="status1"
                                                    id="status1">
                                                    <option value="1"
                                                        @if ($editaplikasi->status == 1) selected @endif> Aktive</option>
                                                    <option value="2"
                                                        @if ($editaplikasi->status == 2) selected @endif> Non Aktive
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <a href="{{ route('aplikasi.index') }}"
                                            class="btn btn-secondary waves-effect">Batal</a>
                                        <button class="btn btn-primary" type="submit" style="float: right">Simpan</button>
                                    </div>
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
