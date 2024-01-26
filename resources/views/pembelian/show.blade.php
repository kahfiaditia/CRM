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
                                        <h4 class="float-end font-size-16">Order # {{ $pembelian->kode_pembelian }}<br></h4>
                                        <div class="mb-4">
                                            <img src="{{ URL::asset('assets/images/logo/dataicon.jpg') }}" alt="logo"
                                                height="20" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php $tanggal = date('d-m-Y', strtotime($pembelian->tgl_kedatangan)); ?>
                                        <div class="col-sm-12 text-sm-center">
                                            <address class="mt-2 mt-sm-0">
                                                <strong>Detil Pembelian</strong><br>
                                                <form>
                                                    <table class="col-sm-12 text-sm-end">
                                                        <tr class="text-sm-end">
                                                            <td>Supplier</td>
                                                            <td>:</td>
                                                            <td> {{ $pembelian->supplier->supplier }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal Pembelian</td>
                                                            <td>:</td>
                                                            <td> {{ $tanggal }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Surat Jalan No</td>
                                                            <td>:</td>
                                                            <td> {{ $pembelian->nomor_do }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status</td>
                                                            <td>:</td>
                                                            <td> {{ $pembelian->status_pembayaran == 1 ? 'Lunas' : 'Belum Lunas' }}
                                                            </td>
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
                                                                <th class="text-center" style="width: 10%">Kadaluarsa</th>

                                                                <th class="text-center" style="width: 10%">Harga Per PCS
                                                                </th>
                                                                <th class="text-center" style="width: 10%">Harga Jual</th>
                                                                <th class="text-center" hidden>{{ Auth::user()->id }}</th>
                                                                <th class="text-center" style="width: 10%">Jumlah PCS</th>
                                                                <th class="text-center" style="width: 15%">Nilai Pembelian
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($detilpembelian as $detil)
                                                                <tr>
                                                                    <td class="text-center" style="width: 5%">
                                                                        {{ $loop->iteration }}</td>
                                                                    <td class="text-left" style="width: 25%">
                                                                        @if ($detil->produk)
                                                                            {{ $detil->produk->nama }}
                                                                        @else
                                                                            Product not found
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center" style="width: 10%">
                                                                        {{ $detil->kadaluarsa }}
                                                                    </td>
                                                                    <td class="text-center" style="width: 10%">
                                                                        Rp
                                                                        {{ number_format($detil->nilai_per_pcs, 0, ',', '.') }}
                                                                    </td>
                                                                    <td class="text-center" style="width: 10%">
                                                                        Rp
                                                                        {{ number_format($detil->nilai_jual, 0, ',', '.') }}
                                                                    </td>
                                                                    <td class="text-center" style="width: 10%">
                                                                        {{ $detil->total_kuantiti }}
                                                                    </td>
                                                                    <td class="text-left" style="width: 15%">
                                                                        Rp
                                                                        {{ number_format($detil->harga_total_produk, 0, ',', '.') }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="5" class="text-end">Sub Total</td>
                                                                <td class="text-center">PCS</td>
                                                                {{-- @foreach ($jumlah as $item)
                                                                    <td class="text-left">Rp.
                                                                        {{ number_format($item->nilai_pembelian, 0, ',', '.') }}
                                                                    </td>
                                                                @endforeach --}}
                                                            </tr>
                                                            <tr>
                                                                <td colspan="7" class="text-end"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6" class="text-end">Nilai Pembelian</td>
                                                                <td class="text-center">Rp.
                                                                    {{-- {{ number_format($item->nilai_pembelian, 0, ',', '.') }} --}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6" class="text-end">Ongkir</td>
                                                                <td class="text-center">Rp.
                                                                    {{-- {{ number_format($pembelian->ongkir, 0, ',', '.') }} --}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6" class="text-end">Discount/Potongan</td>
                                                                <td class="text-center">Rp.
                                                                    {{-- {{ number_format($pembelian->potongan, 0, ',', '.') }} --}}
                                                                </td>
                                                            </tr>
                                                            {{-- <?php
                                                            $totalq = $item->nilai_pembelian - $pembelian->potongan + $pembelian->ongkir;
                                                            ?> --}}
                                                            <tr>
                                                                <td colspan="6" class="border-0 text-end">
                                                                    <strong>Total</strong>
                                                                </td>
                                                                <td class="border-0 text-center">
                                                                    <h5 class="m-0">Rp.
                                                                        {{-- {{ number_format($totalq, 0, ',', '.') }} --}}
                                                                    </h5>
                                                                </td>
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
                                                    <a href="{{ route('pembelian.index') }}"
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
