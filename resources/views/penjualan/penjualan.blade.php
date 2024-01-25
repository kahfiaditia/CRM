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
            <form class="needs-validation">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mt-6">
                                    <div class="col-lg-12">
                                        <div class="mb-12">
                                            <label class="form-label">
                                                Pelanggan</label>
                                            <select class="form-control select select2 pembeli" name="pembeli"
                                                id="pembeli" required>
                                                <option value="" required>-- Pilih --</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Data wajib diisi.
                                            </div>
                                            {!! $errors->first('pembeli', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                </div>

                                <form>
                                    <div class="row mt-5">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Obat<code>
                                                        *</code></label>
                                                <select class="form-control select select2 produk" name="produk"
                                                    id="produk" required>
                                                    <option value="" selected>-- Pilih --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-6">
                                                    <label for="formrow-firstname-input" class="form-label">Stok</label>
                                                    <input type="text" class="form-control" id="stok" name="stok"
                                                        placeholder="Stok" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-6">
                                                    <label for="formrow-inputState" class="form-label">Harga Jual<code>
                                                            *</code></label>
                                                    <input type="text" class="form-control" id="harga_jual"
                                                        name="harga_jual" placeholder="harga jual" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <div class="mb-6">
                                                    <label for="formrow-inputState" class="form-label">Qty<code>
                                                            *</code></label>
                                                    <input type="number" min="1" class="form-control"
                                                        onkeyup="hitungTotalHargaProduk()" id="qty" name="qty">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-6">

                                                    {{-- harga_jual --}}
                                                    <input type="text" class="form-control" id="total_harga_jual"
                                                        name="total_harga_jual" placeholder="Total harga jual" readonly>

                                                    {{-- harga_beli --}}
                                                    <input type="text" class="form-control" id="harga_beli"
                                                        name="harga_beli" placeholder="harga beli" readonly>
                                                    <input type="text" class="form-control" id="total_harga_beli"
                                                        name="total_harga_beli" placeholder="Total harga beli" readonly>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mt-4">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <a type="submit" id="button" class="btn btn-info w-md"
                                                    onclick="tambahBarang()">Tambah
                                                    Produk</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-1">Transaksi</h4>
                                <form>
                                    <div class="row">
                                        <hr>
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-responsive table-bordered table-striped"
                                                id="grandTotal">
                                                <tbody>
                                                    <tr>
                                                        <th class="text-right" style="float: right">
                                                            <span id="jumlah_belanja">
                                                                Sub Total
                                                            </span>
                                                        </th>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-responsive table-bordered table-striped"
                                                id="tambahBarang">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 10%">id</th>
                                                        <th class="text-center" style="width: 10%">Obat</th>
                                                        <th class="text-center" style="width: 10%">Stok</th>
                                                        <th class="text-center" style="width: 10%">Qty</th>
                                                        <th class="text-center" style="width: 10%">Harga</th>
                                                        <th class="text-center" style="width: 10%">Total</th>
                                                        <th class="text-center" style="width: 10%">Modal</th>
                                                        <th class="text-center" style="width: 5%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">
                                                    Jenis Pembayaran</label>
                                                <select id="jenis_pembayaran" name="jenis_pembayaran"
                                                    class="form-control select select2 jenis_pembayaran" required>
                                                    <option value="1" selected> Cash / Tunai</option>
                                                    <option value="2"> Transfer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">
                                                    Catatan</label>
                                                <textarea type="text" class="form-control" name="keterangan1" id="keterangan1" placeholder="Keterangan"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-12">
                                            <div>
                                                <a class="btn btn-danger" type="submit" id="batal"
                                                    style="float: left">Reset</a>
                                                <a class="btn btn-primary" type="submit" style="float: right"
                                                    id="save">Checkout</a>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="row mt-3">
                                            <div class="col-sm-12">
                                                <div>
                                                    <button type="button" onclick="printReceipt({{ $detil_struk->id }})"
                                                        class="btn btn-dark waves-effect btn-label waves-light">
                                                        <i class="bx bx-printer label-icon"></i> Print Struk Transaksi
                                                        Terakhir
                                                    </button>
                                                </div>
                                            </div>
                                        </div> --}}
                                </form>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>


    <script>
        $(document).ready(function() {
            // Fetch customers using AJAX when the page loads
            $.ajax({
                url: '{{ route('penjualan.data_pelanggan') }}',
                type: 'GET',
                success: function(data) {
                    // Populate the dropdown with customer data
                    $.each(data, function(index, customer) {
                        $('#pembeli').append('<option value="' + customer.id + '">' + customer
                            .nama + ' - ' + customer.telp + '</option>');
                    });
                },
                error: function() {
                    console.log('Error fetching customers');
                }
            });

            // Fetch obat data using AJAX when the page loads
            $.ajax({
                url: '{{ route('penjualan.obat_list') }}', // Change to your actual route
                type: 'GET',
                success: function(data) {
                    // Populate the "produk" dropdown with obat data
                    $.each(data, function(index, obat) {
                        $('#produk').append('<option value="' + obat.id + '">' + obat.obat +
                            '</option>');
                    });
                },
                error: function() {
                    console.log('Error fetching obat data');
                }
            });

            // Handle the change event of the "produk" dropdown
            $('#produk').on('change', function() {
                var selectedObatId = $(this).val();

                // Fetch obat data based on the selected option
                $.ajax({
                    url: '/get-obat/' +
                        selectedObatId, // Change to your actual route for getting obat details
                    type: 'GET',
                    success: function(obat) {
                        // Update the relevant fields in the form with obat data
                        $('#stok').val(obat.stok);
                        $('#harga_jual').val(obat.harga_jual);
                        $('#harga_beli').val(obat.harga_beli);
                    },
                    error: function() {
                        console.log('Error fetching obat details');
                    }
                });
            });
        });

        // hitung-total harga jual dan beli
        function hitungTotalHargaProduk() {
            var qty = parseInt($('#qty').val()) || 0;
            var stok = parseInt($('#stok').val()) || 0;
            var hargaJual = parseFloat($('#harga_jual').val().replace(',', '')) || 0;
            var hargaBeli = parseFloat($('#harga_beli').val().replace(',', '')) || 0;

            if (qty > stok) {
                // Show sweet alert if qty exceeds stok
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Qty tidak boleh melebihi stok!',
                });

                // Reset the qty input
                $('#qty').val(1);
            } else {
                // Calculate total harga jual and update the field
                var totalHargaJual = qty * hargaJual;
                $('#total_harga_jual').val(totalHargaJual.toLocaleString());

                // Calculate total harga beli and update the field
                var totalHargaBeli = qty * hargaBeli;
                $('#total_harga_beli').val(totalHargaBeli.toLocaleString());
            }
        }
    </script>
@endsection
