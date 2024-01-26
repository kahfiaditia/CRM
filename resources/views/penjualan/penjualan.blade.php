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
                                                        name="total_harga_jual" placeholder="Total harga jual" hidden>

                                                    {{-- harga_beli --}}
                                                    <input type="text" class="form-control" id="harga_beli"
                                                        name="harga_beli" placeholder="harga beli" hidden>
                                                    <input type="text" class="form-control" id="total_harga_beli"
                                                        name="total_harga_beli" placeholder="Total harga beli" hidden>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mt-4">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <a type="submit" id="button" class="btn btn-info w-md"
                                                    onclick="tombolInput()">Tambah
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
                                                id="tablePenjualan">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" hidden>id</th>
                                                        <th class="text-center" style="width: 10%">Obat</th>
                                                        <th class="text-center" hidden>Stok</th>
                                                        <th class="text-center" style="width: 10%">Qty</th>
                                                        <th class="text-center" style="width: 10%">Harga</th>
                                                        <th class="text-center" style="width: 10%">Total</th>
                                                        <th class="text-center" hidden>Modal</th>
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
            // data pelanggan
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

            // data obat
            $.ajax({
                type: "POST",
                url: '{{ route('penjualan.obat_list') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: response => {
                    $.each(response.data, function(i, item) {
                        $('.produk').append(
                            `<option value="${item.id}"
                        data-id="${item.obat}"
                        data-value="${item.stok}"
                        data-value1="${item.harga_jual}"
                        data-value2="${item.harga_beli}">${item.obat}</option>`
                        );
                    });

                    $(".produk").change(function() {
                        var selectedOption = $('option:selected', this);

                        document.getElementById("stok").value = selectedOption.attr(
                            'data-value');
                        document.getElementById("harga_jual").value = selectedOption.attr(
                            'data-value1');
                        document.getElementById("harga_beli").value = selectedOption.attr(
                            'data-value2');
                    });
                },
                error: (err) => {
                    console.log(err);
                },
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

        function tombolInput() {
            // Get values from the form
            var id_pembeli = $("#pembeli").val();
            var id = $("#produk").val();
            var obat = $('#produk option:selected').text();
            var stok = $('#stok').val();
            var qty = parseInt($('#qty').val()) || 0; // Ensure qty is a number, default to 0
            var hargaJual = parseFloat($('#harga_jual').val().replace(',', '')) ||
                0; // Ensure hargaJual is a number, default to 0
            var totalHargaJual = parseFloat($('#total_harga_jual').val().replace(',', '')) ||
                0; // Ensure totalHargaJual is a number, default to 0
            var hargaBeli = parseFloat($('#harga_beli').val().replace(',', '')) ||
                0; // Ensure hargaBeli is a number, default to 0
            var totalHargaBeli = parseFloat($('#total_harga_beli').val().replace(',', '')) ||
                0; // Ensure totalHargaBeli is a number, default to 0

            // Flag to check if the product already exists in the table
            var productExists = false;

            // Iterate through existing rows
            $('#tablePenjualan tbody tr').each(function() {
                var existingId = $(this).find('td:first').text();

                // Check if the id already exists
                if (existingId == id) {
                    // Update quantity and total price
                    var existingQty = parseInt($(this).find('td:nth-child(4)').text()) || 0;
                    var existingTotalHargaJual = parseFloat($(this).find('td:nth-child(6)').text().replace(',',
                        '')) || 0;

                    $(this).find('td:nth-child(4)').text(existingQty + qty);
                    $(this).find('td:nth-child(6)').text((existingTotalHargaJual + totalHargaJual)
                        .toLocaleString());

                    productExists = true;
                    return false; // Break out of the loop
                }
            });

            // If the product does not exist, add a new row
            if (!productExists) {
                var newRow = '<tr>' +
                    '<td class="text-center" hidden>' + id + '</td>' +
                    '<td class="text-center">' + obat + '</td>' +
                    '<td class="text-center" hidden>' + stok + '</td>' +
                    '<td class="text-center">' + qty + '</td>' +
                    '<td class="text-center">' + hargaJual.toLocaleString() + '</td>' +
                    '<td class="text-center">' + totalHargaJual.toLocaleString() + '</td>' +
                    '<td class="text-center" hidden>' + hargaBeli.toLocaleString() + '</td>' +
                    '<td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">Hapus</button></td>' +
                    '</tr>';

                $('#tablePenjualan tbody').append(newRow);
            }

            // Clear form fields after adding a row
            $('#produk').val(null).trigger('change');
            // $('#produk').val('');
            $('#stok').val('');
            $('#qty').val('');
            $('#harga_jual').val('');
            $('#total_harga_jual').val('');
            $('#harga_beli').val('');
            $('#total_harga_beli').val('');

            updateGrandTotal();
        }

        //tombol hapus
        function hapusBaris(button) {
            // Remove the row when the "Hapus" button is clicked
            $(button).closest('tr').remove();
            updateGrandTotal();
        }

        function updateGrandTotal() {
            // Calculate the sum of totalHargaJual from all rows in the "tablePenjualan" table
            var grandTotal = 0;

            $('#tablePenjualan tbody tr').each(function() {
                var totalHargaJual = parseFloat($(this).find('td:nth-child(6)').text().replace(',', '')) || 0;
                grandTotal += totalHargaJual;
            });

            // Update the grand total in the "grandTotal" table
            $('#grandTotal #jumlah_belanja').text('Sub Total: ' + grandTotal.toLocaleString());
        }

        $('#save').on('click', function() {
            checkout();
        });

        function checkout() {
            // Get additional data from the form
            var additionalData = {
                id_pembeli: $("#pembeli").val(),
                jenis_pembayaran: $("#jenis_pembayaran").val(),
                keterangan1: $("#keterangan1").val(),
            };

            // Get data from the "tablePenjualan" table
            var tableData = [];

            $('#tablePenjualan tbody tr').each(function() {
                var rowData = {
                    id: $(this).find('td:nth-child(1)').text(),
                    obat: $(this).find('td:nth-child(2)').text(),
                    stok: $(this).find('td:nth-child(3)').text(),
                    qty: $(this).find('td:nth-child(4)').text(),
                    harga: $(this).find('td:nth-child(5)').text(),
                    total: $(this).find('td:nth-child(6)').text(),
                    modal: $(this).find('td:nth-child(7)').text()
                };

                tableData.push(rowData);
            });

            // Validate conditions before sending data
            if (tableData.length === 0) {
                // If no products are added, show SweetAlert
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Tambahkan produk terlebih dahulu!',
                });
            } else {
                var duplicateIds = checkDuplicateIds(tableData);

                if (duplicateIds.length > 0) {
                    // If there are duplicate product IDs, show SweetAlert
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Terdapat produk dengan ID yang sama lebih dari satu!',
                    });
                } else {
                    // Combine additional data and product data into a single object
                    var requestData = {
                        "_token": "{{ csrf_token() }}",
                        additionalData: additionalData,
                        tableData: tableData
                    };

                    // If everything is valid, send data using AJAX
                    $.ajax({
                        url: "{{ route('penjualan.store') }}",
                        method: 'POST',
                        data: requestData,
                        success: (response) => {
                            if (response.code === 200) {
                                Swal.fire(
                                    'Success',
                                    'Data Penjualan Berhasil di masukan',
                                    'success'
                                ).then(() => {
                                    var APP_URL = {!! json_encode(url('/')) !!}
                                    window.location = APP_URL +
                                        '/penjualan'
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Tanda * (bintang) wajib diisi',
                                    showConfirmButton: false,
                                    timer: 1500,
                                })
                            }
                        },
                        error: err => console.log(err)
                    });
                }
            }
        }

        function checkDuplicateIds(data) {
            var idCounts = {};
            var duplicateIds = [];

            // Count occurrences of each product ID
            for (var i = 0; i < data.length; i++) {
                var id = data[i].id;

                if (id in idCounts) {
                    idCounts[id]++;
                } else {
                    idCounts[id] = 1;
                }
            }

            // Check for duplicate product IDs
            for (var id in idCounts) {
                if (idCounts[id] > 1) {
                    duplicateIds.push(id);
                }
            }

            return duplicateIds;
        }
    </script>
@endsection
