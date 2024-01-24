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
            <form class="needs-validation" action="{{ route('supplier.update', $editsuplier->id) }}" method="POST"
                novalidate>
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="supplier" class="form-label">Supplier</label>
                                                <input type="text" class="form-control" name="supplier" id="supplier"
                                                    value="{{ old('supplier', $editsuplier->supplier) }}"
                                                    autocomplete="off">
                                            </div>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('supplier', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input type="text" class="form-control" name="alamat" id="alamat"
                                                    value="{{ old('alamat', $editsuplier->alamat) }}" autocomplete="off">
                                            </div>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('alamat', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-2">
                                                <label for="alamat" class="form-label">Kontak</label>
                                                <input type="text" class="form-control" name="kontak" id="kontak"
                                                    oninput="this.value = this.value.toUpperCase()"
                                                    value="{{ old('kontak', $editsuplier->kontak) }}" autocomplete="off">
                                            </div>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('kontak', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-2">
                                                <label for="telp" class="form-label">Telp</label>
                                                <input type="text" class="form-control" name="telp" id="telp"
                                                    oninput="this.value = this.value.toUpperCase()"
                                                    value="{{ old('telp', $editsuplier->telp) }}" autocomplete="off">
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('telp', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-2">
                                                <label for="status1" class="form-label">Status</label>
                                                <select class="form-control select select2 status1" name="status1"
                                                    id="status1" required>
                                                    <option value=""> -- Pilih --</option>
                                                    <option value="1"
                                                        @if ($editsuplier->status == 1) selected @endif> Aktif </option>
                                                    <option value="2"
                                                        @if ($editsuplier->status == 2) selected @endif> Tidak Aktif
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('status1', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <a href="{{ route('supplier.index') }}"
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
