@extends('layouts.main')
@section('apotekku')

    <body class="InvBarang">
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
                <form id="form" class="needs-validation">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="invoice-title">
                                        <h4 class="float-end font-size-16">Order # {{ $penjualan->kode_penjualan }}<br></h4>
                                        <div class="mb-4">
                                            <img src="{{ URL::asset('assets/images/logo/dataicon.jpg') }}" alt="logo"
                                                height="20" />
                                        </div>
                                    </div>
                                    {{-- {{ dd($penjualan) }}; --}}
                                    <div class="row">
                                        {{-- <?php $tanggal = date('d-m-Y', strtotime($penjualan->kode_penjualan)); ?> --}}
                                        <div class="col-sm-12 text-sm-center">
                                            <address class="mt-2 mt-sm-0">
                                                <strong>Detil Penjualan</strong><br>
                                                <form>
                                                    <table class="col-sm-12 text-sm-end">
                                                        <tr class="text-sm-end">
                                                            <td>Pelanggan</td>
                                                            <td>:</td>
                                                            <td> {{ $penjualan->pelanggan->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal Transaksi</td>
                                                            <td>:</td>
                                                            <td> {{ $penjualan->created_at }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jumlah Produk</td>
                                                            <td>:</td>
                                                            <td> {{ $count }}</td>
                                                        </tr>

                                                    </table>
                                                </form>
                                            </address>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 table-responsive">
                                                    <table class="table table-responsive table-bordered table-striped"
                                                        id="tablePinjam">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" style="width: 5%">No</th>
                                                                <th class="text-center" style="width: 25%">Nama Produk
                                                                </th>
                                                                <th class="text-center" style="width: 10%">Harga Jual</th>
                                                                <th class="text-center" style="width: 10%">Kauntiti</th>
                                                                </th>
                                                                <th class="text-center" style="width: 10%">Jumlah</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($detil_penjualan as $detil)
                                                                <tr>
                                                                    <td class="text-center" style="width: 5%">
                                                                        {{ $loop->iteration }}</td>
                                                                    <td class="text-left" style="width: 25%">

                                                                        {{ $detil->nama->obat }}

                                                                    </td>
                                                                    <td class="text-center" style="width: 10%">
                                                                        Rp
                                                                        {{ number_format($detil->harga_jual, 0, ',', '.') }}
                                                                    </td>
                                                                    <td class="text-center" style="width: 10%">
                                                                        {{ $detil->qty }}
                                                                    </td>
                                                                    <td class="text-center" style="width: 10%">
                                                                        Rp
                                                                        {{ number_format($detil->total, 0, ',', '.') }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td class="text-center" style="width: 5%" colspan="4">
                                                                    Total</td>
                                                                <td class="text-center" style="width: 5%">
                                                                    Rp
                                                                    {{ number_format($total, 0, ',', '.') }}</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6 wajib">
                                                <div class="mb-6">
                                                    <label>Keterangan :</label>
                                                    {{-- <p>{{ $pembelian->keterangan }}</p> --}}
                                                </div>
                                            </div>
                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <a href="javascript:window.print()"
                                                        class="btn btn-success waves-effect waves-light me-1"><i
                                                            class="fa fa-print"></i></a>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-sm-12">
                                                    <a href="{{ route('laporan_penjualan.index') }}"
                                                        class="btn btn-secondary waves-effect">Kembali</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </body>
@endsection
