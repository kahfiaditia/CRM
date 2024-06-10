@extends('layouts.main')
@section('apotekku')
    <?php $session_menu = explode(',', Auth::user()->submenu); ?>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $submenu }}</a></li>
                                <li class="breadcrumb-item active">{{ $label }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="product-detai-imgs">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-3 col-4">
                                                {{-- <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist"
                                                    aria-orientation="vertical">
                                                    <a class="nav-link active" id="product-1-tab" data-bs-toggle="pill"
                                                        href="#product-1" role="tab" aria-controls="product-1"
                                                        aria-selected="true">
                                                        <img src="assets/images/product/img-7.png" alt=""
                                                            class="img-fluid mx-auto d-block rounded">
                                                    </a>
                                                    <a class="nav-link" id="product-2-tab" data-bs-toggle="pill"
                                                        href="#product-2" role="tab" aria-controls="product-2"
                                                        aria-selected="false">
                                                        <img src="assets/images/product/img-8.png" alt=""
                                                            class="img-fluid mx-auto d-block rounded">
                                                    </a>
                                                    <a class="nav-link" id="product-3-tab" data-bs-toggle="pill"
                                                        href="#product-3" role="tab" aria-controls="product-3"
                                                        aria-selected="false">
                                                        <img src="assets/images/product/img-7.png" alt=""
                                                            class="img-fluid mx-auto d-block rounded">
                                                    </a>
                                                    <a class="nav-link" id="product-4-tab" data-bs-toggle="pill"
                                                        href="#product-4" role="tab" aria-controls="product-4"
                                                        aria-selected="false">
                                                        <img src="assets/images/product/img-8.png" alt=""
                                                            class="img-fluid mx-auto d-block rounded">
                                                    </a>
                                                </div> --}}
                                            </div>
                                            <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                                <div class="tab-content" id="v-pills-tabContent">
                                                    <div class="tab-pane fade show active" id="product-1" role="tabpanel"
                                                        aria-labelledby="product-1-tab">
                                                        <div>
                                                            <img src="{{ asset('assets/pelaporan/' . $pelaporandata->screenshoot) }}"
                                                                alt="" class="img-fluid mx-auto d-block">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mt-4 mt-xl-3">
                                        <a href="javascript: void(0);"
                                            class="text-primary">{{ $pelaporandata->customer->nama }}</a>
                                        <h4 class="mt-1 mb-3">{{ $pelaporandata->aplikasi->nama }}</h4>
                                        <p class="text-muted mb-4">{{ $pelaporandata->deskripsi }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="mt-5">
                                <h5 class="mb-3">Specifications :</h5>

                                <div class="table-responsive">
                                    <table class="table mb-0 table-bordered">
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width: 400px;">Customer</th>
                                                <td>{{ $pelaporandata->customer->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Aplikasi</th>
                                                <td>{{ $pelaporandata->aplikasi->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Deskripsi</th>
                                                <td>{{ $pelaporandata->deskripsi }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tanggal Lapor</th>
                                                <td>{{ $pelaporandata->created_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row mt-4">
                                        <div class="col-sm-12">
                                            <a href="{{ route('pelaporan.index') }}"
                                                class="btn btn-secondary waves-effect">Batal</a>
                                            {{-- <button class="btn btn-primary" type="submit"
                                                style="float: right">Simpan</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
