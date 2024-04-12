@extends('layouts.main')
@section('apotekku')
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-left">
                <h4 class="mb-sm-0 font-size-18">{{ $menu }}</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">{{ ucwords($submenu) }}</li>
                    @if ($submenu)
                        <li class="breadcrumb-item">{{ ucwords($label) }}</li>
                    @endif
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{ $viewobat->obat }}</h4>
                            <form>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="input-date1">Deskripsi</label>
                                            <input type="text" class="form-control" value="{{ $viewobat->deskripsi }}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="input-datetime">Stok</label>
                                            <input type="text" class="form-control" value="{{ $viewobat->stok }}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="input-datetime">Jenis</label>
                                            <input type="text" class="form-control" value="{{ $viewobat->jenis->jenis }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="input-date1">Harga Jual</label>
                                            <input type="text" class="form-control" value="{{ $viewobat->harga_jual }}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="input-datetime">Harga Beli</label>
                                            <input type="text" class="form-control" value="{{ $viewobat->harga_beli }}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="input-datetime">Status</label>
                                            <input type="text" class="form-control"
                                                value="{{ $viewobat->status == 1 ? 'Aktive' : 'Non Aktive' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
