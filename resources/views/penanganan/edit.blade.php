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
            {{-- {{ dd($customer) }} --}}
            <form class="needs-validation" action="{{ route('penanganan.update', $edit[0]->tangani_id) }}" method="POST"
                enctype="multipart/form-data" novalidate>
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-4">
                                        <div class="mb-6">
                                            <label>Kode Pelaporan <code>*</code></label>
                                            <input type="text" class="form-control" id="kode_lapor" name="kode_lapor"
                                                autocomplete="off" value="{{ $edit[0]->kode }}" readonly>
                                            <input type="text" class="form-control" id="id_pelaporan" name="id_pelaporan"
                                                value="{{ $edit[0]->lapor_id }}" autocomplete="off" maxlength="25" hidden>
                                            <input type="text" class="form-control" id="id_penanganan"
                                                name="id_penanganan" value="{{ $edit[0]->tangani_id }}" autocomplete="off"
                                                maxlength="25" hidden>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('ar', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <div class="mb-6">
                                            <label>Aplikasi <code>*</code></label>
                                            <input type="text" class="form-control" id="arid" name="ar"
                                                autocomplete="off" maxlength="25" value="{{ $edit[0]->aplikasi }}" readonly>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('id_aplikasi', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-6">
                                            <label>Link</label>
                                            <input type="text" class="form-control" id="link" name="link"
                                                placeholder="link" value="{{ $edit[0]->link }}" autocomplete="off"
                                                maxlength="25" readonly>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('link', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-6">
                                            <label>Status Progress</label>
                                            <select class="form-control select select2 status2" name="status2"
                                                id="status2">
                                                <option value=""> -- Pilih --</option>
                                                <option value="In Progress"> In Progress </option>
                                                <option value="Selesai"> Selesai </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('link', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="mt-6">
                                        <label>Deskripsi <code>*</code></label>
                                        <textarea class="form-control" maxlength="128" oninput="this.value = this.value.toUpperCase()" id="deskripsi"
                                            rows="3" placeholder="Deskripsi" name="deskripsi" autocomplete="off" readonly>{{ $edit[0]->deskripsi }}</textarea>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <a href="{{ route('penanganan.index') }}"
                                            class="btn btn-secondary waves-effect">Batal</a>
                                        <button class="btn btn-primary" type="submit" style="float: right">Ubah</button>
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
