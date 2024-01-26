@extends('layouts.main')
@section('apotekku')
    <?php $session_menu = explode(',', Auth::user()->akses_submenu); ?>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                                <li class="breadcrumb-item">{{ ucwords($submenu) }}</li>
                            </ol>
                        </div>
                        {{-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                               
                                    <a href="{{ route('bursa_kategori.create') }}" type="button"
                                        class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i> Tambah Kategori
                                    </a>
                               
                            </ol>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            </div>
                            <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Penjualan</th>
                                        <th>Total Pembelian</th>
                                        <th>Total Produk</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode_penjualan }}</td>
                                            <td>Rp {{ number_format($item->nilai_pembelian, 0, ',', '.') }}</td>
                                            <td>{{ $item->total_produk }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <form class="delete-form"
                                                    action="{{ route('laporan_penjualan.destroy', Crypt::encryptString($item->id)) }}"
                                                    method="POST">
                                                    <div class="d-flex gap-3">

                                                        <a href="{{ route('laporan_penjualan.show', Crypt::encryptString($item->id)) }}"
                                                            class="text-info" title="Detil">
                                                            <i class="mdi mdi-eye font-size-18"></i></a>

                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
