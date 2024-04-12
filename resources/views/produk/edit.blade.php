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
            <form class="needs-validation" action="{{ route('produk.update', $editobat->id) }}" method="POST" novalidate>
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
                                                <label for="produk" class="form-label">Obat <code>*</code></label>
                                                <input type="text" class="form-control" name="produk" id="produk"
                                                    value="{{ old('nama', $editobat->nama) }}" maxlength="30"
                                                    oninput="this.value = this.value.toUpperCase()" autocomplete="off"
                                                    required>
                                            </div>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('produk', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="descr" class="form-label">Deskripsi</label>
                                                <input type="text" class="form-control" name="descr" id="descr"
                                                    value="{{ old('descr', $editobat->deskripsi) }}" maxlength="30"
                                                    oninput="this.value = this.value.toUpperCase()" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="satuan" class="form-label">Jenis <code>*</code></label>
                                                <select class="form-control select select2 satuan" name="satuan"
                                                    id="satuan">
                                                    <option value=""> -- Pilih --</option>
                                                    @foreach ($jenis as $datajenis)
                                                        <option value="{{ $datajenis->id }}"
                                                            {{ $datajenis->id == $editobat->satuan_id ? 'selected' : '' }}>
                                                            {{ $datajenis->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('satuan', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="status1" class="form-label">Status <code>*</code></label>
                                                <select class="form-control select select2 status1" name="status1"
                                                    id="status1">
                                                    <option value=""> -- Pilih --</option>
                                                    <option value="1"
                                                        @if ($editobat->status == 1) selected @endif> Aktif</option>
                                                    <option value="2"
                                                        @if ($editobat->status == 2) selected @endif> Non Aktif
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('status1', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <a href="{{ route('produk.index') }}"
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
