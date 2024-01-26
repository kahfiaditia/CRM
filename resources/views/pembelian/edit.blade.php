@extends('layouts.main')
@section('apotekku')

    <body class="InvPinjam()">
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
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="invoice-title">
                                        <h4 class="float-end font-size-16">{{ $editpembelian->kode_pembelian }}</h4>
                                        <div class="mb-4">
                                            {{-- <img src="/assets/images/logo/sid.png" alt="logo" height="20" /> --}}
                                        </div>
                                    </div>
                                    {{-- nesting --}}
                                    <div class="container text-left">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <address>
                                                    <strong>Detil Pembelian:</strong><br>
                                                    Tanggal:
                                                    {{ date('Y-m-d', strtotime($editpembelian->tgl_kedatangan)) }}<br>
                                                    No SJ: {{ $editpembelian->nomor_do }}<br>
                                                </address>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-8 col-sm-9" style="text-align: right;">
                                                        Supplier
                                                    </div>
                                                    <div class="col-4 col-sm-3">
                                                        <select class="form-control select select2 supplier" name="supplier"
                                                            id="supplier" required>
                                                            @foreach ($supplier as $supplier)
                                                                <option value="{{ $supplier->id }}"
                                                                    data-id="{{ $supplier->supplier_id }}"
                                                                    {{ $supplier->id == $editpembelian->supplier_id ? 'selected' : '' }}>
                                                                    {{ $supplier->supplier }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Data wajib diisi.
                                                        </div>
                                                        {!! $errors->first('supplier', '<div class="invalid-validasi">:message</div>') !!}
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-8 col-sm-9" style="text-align: right;">
                                                        Status Pembayaran
                                                    </div>
                                                    <div class="col-4 col-sm-3">
                                                        <select class="form-control select select2 pembayaran"
                                                            name="pembayaran" id="pembayaran">
                                                            <option value="">-- Pilih Status --</option>
                                                            <option value="1"
                                                                {{ $editpembelian->status_pembayaran == 1 ? 'selected' : '' }}>
                                                                Lunas</option>
                                                            <option value="2"
                                                                {{ $editpembelian->status_pembayaran == 2 ? 'selected' : '' }}>
                                                                Belum Lunas</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-4">
                                                        <input type="text" class="form-control" id="kode_transaksi"
                                                            name="kode_transaksi"
                                                            value="{{ $editpembelian->kode_pembelian }}" hidden>
                                                        <input type="text" name="purchase_id" id="purchase_id"
                                                            value="{{ $editpembelian->id }}" hidden>
                                                        <input type="text" name="url" id="url"
                                                            value="{{ Crypt::encryptString($editpembelian->id) }}" hidden>
                                                        <input type="text" class="form-control" name="suratjalan"
                                                            id="suratjalan" value="{{ $editpembelian->nomor_do }}" hidden>
                                                        <input type="text" class="form-control" name="tgl_kedatangan"
                                                            id="tgl_kedatangan"
                                                            value="{{ $editpembelian->tgl_kedatangan }}" hidden>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- akhir nesting --}}
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-responsive table-bordered table-striped" id="tableList">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Produk </th>
                                                    <th class="text-center">Kadaluarsa</th>
                                                    <th class="text-center">Harga</th>
                                                    <th class="text-center">Kuantiti</th>
                                                    <th class="text-center">Harga Satuan</th>
                                                    <th class="text-center">Harga Jual</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            @php
                                                $index = 1;
                                            @endphp
                                            @foreach ($detilpembelian as $data)
                                                <tr>
                                                    <td>
                                                        {{ $index++ }}
                                                    </td>
                                                    <td>
                                                        <select class="form-control select select2 produk"
                                                            style="width:200px" name="produk[]"
                                                            id="produk{{ $loop->index }}" required>
                                                            <option value=""> -- Pilih --</option>
                                                            @foreach ($barang as $ini)
                                                                <option value="{{ $ini->id }}"
                                                                    {{ $ini->id == $data->produk_id ? 'selected' : '' }}>
                                                                    {{ $ini->obat }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="text" class="form-control" name="kode[]"
                                                            id="kode" value="<?= $editpembelian->id ?>" hidden>
                                                        <input type="text" class="form-control" name="detil[]"
                                                            id="detil{{ $loop->index }}" value="<?= $data->id ?>" hidden>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd"
                                                            name="kadaluarsa[]" id="kadaluarsa{{ $loop->index }}"
                                                            value="{{ $data->kadaluarsa }}" data-date-format="yyyy-mm-dd"
                                                            data-date-container="#datepicker2" data-provide="datepicker"
                                                            required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="harga[]"
                                                            id="harga{{ $loop->index }}"
                                                            value="{{ $data->harga_total_produk }}" hidden>

                                                        <input type="text" class="form-control" name="harga2[]"
                                                            id="harga2{{ $loop->index }}"
                                                            value="{{ number_format($data->harga_total_produk, 0, ',', '.') }}"
                                                            oninput="updateHarga2({{ $loop->index }})" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" min="1"
                                                            name="kuantitas[]" id="kuantitas{{ $loop->index }}"
                                                            style="width:80px" oninput="updateHargaSatuanEdit(this)"
                                                            value="{{ $data->total_kuantiti }}" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="harsat[]"
                                                            id="harsat{{ $loop->index }}"
                                                            value="{{ $data->nilai_per_pcs }}" hidden>

                                                        <input type="text" class="form-control" name="harsat1[]"
                                                            id="harsat1[]"
                                                            value="{{ number_format($data->nilai_per_pcs, 0, ',', '.') }}"
                                                            readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="harjual[]"
                                                            id="harjual{{ $loop->index }}"
                                                            value="{{ $data->nilai_jual }}" hidden>

                                                        <input type="text" class="form-control" name="harjual3[]"
                                                            id="harjual3{{ $loop->index }}"
                                                            value="{{ number_format($data->nilai_jual, 0, ',', '.') }}"
                                                            oninput="hargajualfungsi({{ $loop->index }})" required>
                                                    </td>
                                                    <td class="text-center">
                                                        <form class="delete-form"
                                                            action="{{ route('pembelian.destroy', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="d-flex gap-3">
                                                                <a href class="text-danger delete_confirm"><i
                                                                        class="mdi mdi-delete font-size-18"></i></a>
                                                            </div>

                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-sm-12">
                                            <button class="btn btn-primary" type="button" id="tambahBaris">Tambah
                                                Baris</button>
                                        </div>
                                    </div>
                                    <div class="container mt-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group d-flex align-items-center">
                                                    <label for="keterangan" class="mr-2">Keterangan</label>
                                                </div>
                                                <div>
                                                    <textarea id="keterangan" name="keterangan" id="keterangan" class="form-control">{{ isset($editpembelian->keterangan) ? $pembelian->keterangan : '' }}</textarea>
                                                </div>
                                            </div>
                                            <?php
                                            $c = $editpembelian->total_nilai;
                                            $d = number_format($c, 0, ',', '.');
                                            ?>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <div class="p-3" style="text-align: right;">Total</div>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control"
                                                            style="text-align: right;" name="totala" id="totala"
                                                            value="{{ $d }}" readonly>
                                                    </div>
                                                </div>
                                                <?php
                                                $l = $editpembelian->ongkir;
                                                $dcongkir = number_format($l, 0, ',', '.');
                                                ?>
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <div class="p-3" style="text-align: right;">Ongkir</div>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control"
                                                            style="text-align: right;" name="ongkir" id="ongkir"
                                                            value="{{ number_format($editpembelian->ongkir, 0, ',', '.') }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <div class="p-3" style="text-align: right;">Potongan</div>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control"
                                                            style="text-align: right;" name="potongan" id="potongan"
                                                            value="{{ number_format($editpembelian->potongan, 0, ',', '.') }}">
                                                    </div>
                                                </div>
                                                <?php
                                                $grandb = $editpembelian->total_nilai + $editpembelian->ongkir - $editpembelian->potongan;
                                                $grandc = number_format($grandb, 0, ',', '.');
                                                ?>
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <div class="p-3" style="text-align: right;"><strong>Grand
                                                                Total</strong></div>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control"
                                                            style="text-align: right;" name="grand_total"
                                                            id="grand_total" value="{{ $grandc }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-sm-12">
                                            <a href="{{ route('pembelian.index') }}"
                                                class="btn btn-secondary waves-effect">Kembali</a>
                                            <button class="btn btn-success" type="button" style="float: right"
                                                id="simpanDataBtn">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    <script>
        var rowCount = {{ count($detilpembelian) }};

        //form tambah baris
        document.getElementById("tambahBaris").addEventListener("click", function() {
            var table = document.getElementById("tableList");
            var row = table.insertRow();
            rowCount++;

            var cell1 = row.insertCell(0);
            cell1.innerHTML = rowCount;

            var cell2 = row.insertCell(1);
            var pilihlahproduk = document.createElement("select");
            pilihlahproduk.className = "form-control select select2 produk" + rowCount;
            pilihlahproduk.name = "produk[]";
            pilihlahproduk.id = "produk" + rowCount;
            pilihlahproduk.required = true;

            var defaultOption = document.createElement("option");
            defaultOption.value = "";
            defaultOption.text = "-- Pilih --";
            pilihlahproduk.appendChild(defaultOption);

            cell2.appendChild(pilihlahproduk);


            pilihlahproduk.addEventListener("change", function() {
                var selectedProductId = this.value;
                console.log("Selected Product ID:", selectedProductId);
            });

            var selectedProductIds = [];
            var selectElements = document.querySelectorAll("select[name='produk[]']");
            for (var i = 0; i < selectElements.length; i++) {
                var selectElement = selectElements[i];
                var selectedProductId = selectElement.value;
                if (selectedProductId !== "") {
                    selectedProductIds.push(selectedProductId);
                }
            }

            $.ajax({
                type: "POST",
                url: "{{ route('pembelian.ambil_dataproduk') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    selectedProductIds: selectedProductIds
                },
                success: function(response) {
                    console.log(response);
                    if (response.code === 200) {
                        var produkList = response.data;
                        var pilihlahproduk = $("#produk" + rowCount);

                        pilihlahproduk.empty();

                        var defaultOption = $("<option></option>")
                            .val("")
                            .text("-- Pilih --");
                        pilihlahproduk.append(defaultOption);

                        $.each(produkList, function(index, item) {
                            var option = $("<option></option>")
                                .val(item.id)
                                .text(item.obat);

                            pilihlahproduk.append(option);
                        });

                        pilihlahproduk.select2();
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });

            var selectElements = document.getElementsByClassName("select2");
            for (var i = 0; i < selectElements.length; i++) {
                var selectElement = selectElements[i];
                var selectedProductId = selectElement.value;
                if (selectedProductId !== "") {
                    $("#produk" + rowCount + " option[value='" + selectedProductId + "']").prop("disabled", true);
                }
            }

            //tanggal kadaluarsa
            var cell3 = row.insertCell(2);
            var kadaluarsa = document.createElement("input");
            kadaluarsa.type = "datetime";
            kadaluarsa.className = "form-control";
            kadaluarsa.name = "kadaluarsa[]";
            kadaluarsa.id = "kadaluarsa" + rowCount;
            kadaluarsa.placeholder = "Kadaluarsa";
            kadaluarsa.required = true;

            cell3.appendChild(kadaluarsa);

            // Inisialisasi Datepicker
            $(kadaluarsa).datepicker({
                dateFormat: 'dd-mm-yy HH:mm:ss',
            });

            // Harga
            var cell4 = row.insertCell(3);
            cell4.innerHTML =
                '<input type="number" class="form-control" name="harga[]" id="harga' + rowCount +
                '" placeholder="Harga" required>' +
                '<input type="number" class="form-control" name="kode[]" id="kode' + rowCount +
                '" value="<?= $editpembelian->id ?>" hidden>' +
                '<input type="number" class="form-control" name="detil[]" id="detil' + rowCount +
                '" value="0" hidden>' +
                '<input type="number" class="form-control" name="produk' + rowCount + '" id="produk' +
                rowCount +
                '" value="0" hidden>';

            // Kuantitas
            var cell5 = row.insertCell(4);
            cell5.innerHTML =
                '<input type="number" style="width:80px" class="form-control" min="1" name="kuantitas[]" placeholder="Qty" oninput="updateHargaSatuan(this)" required>';

            // Harga satuan
            var cell6 = row.insertCell(5);
            cell6.innerHTML =
                '<input type="number" class="form-control" name="harsat[]" id="harsat' +
                rowCount +
                '" placeholder="Modal" hidden>' +
                '<input type="number" class="form-control" name="harsat1[]" id="harsat1' +
                rowCount +
                '" placeholder="Modal" readonly>';

            // Harga jual
            var cell7 = row.insertCell(6);
            cell7.innerHTML =
                '<input type="number" class="form-control" name="harjual[]" id="harjual' +
                rowCount +
                '" placeholder="Jual" required>';

            var cell8 = row.insertCell(7);
            cell8.innerHTML =
                '<a href = "#" class ="text-danger delete_confirm" onclick ="hapusBaris(this)" >' +
                '<i class = "mdi mdi-delete font-size-18"></i>' +
                '</a>';

        });

        function hapusBaris(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        // Fungsi untuk mengisi harga satuan
        function updateHargaSatuan(input) {
            var row = input.parentNode.parentNode;
            var hargaInput = row.querySelector('[name="harga[]"]');
            var hargaSatuanInput = row.querySelector('[name="harsat[]"]');
            var hargaSatuanInput1 = row.querySelector('[name="harsat1[]"]');

            var harga = parseFloat(hargaInput.value);
            var harga1 = parseFloat(hargaInput.value);
            var kuantitas = parseFloat(input.value);

            if (!isNaN(harga) && !isNaN(kuantitas) && kuantitas !== 0) {
                var hargaSatuan = harga / kuantitas;
                hargaSatuanInput.value = hargaSatuan;
                hargaSatuanInput1.value = hargaSatuan.toLocaleString('id-ID');
            }
        }


        function updateHargaSatuanEdit(input) {
            var row = input.parentNode.parentNode;
            var hargaInput = row.querySelector('[name="harga[]"]');
            var hargaSatuanInput = row.querySelector('[name="harsat[]"]');
            var hargaSatuanInput1 = row.querySelector('[name="harsat1[]"]');

            var harga1 = parseFloat(hargaSatuanInput1.value);
            var harga = parseFloat(hargaInput.value);
            var kuantitas = parseFloat(input.value);

            if (!isNaN(harga) && !isNaN(kuantitas) && kuantitas !== 0) {
                var hargaSatuan = harga / kuantitas;
                hargaSatuanInput.value = hargaSatuan;
                hargaSatuanInput1.value = hargaSatuan.toLocaleString('id-ID');
            }
        }


        $('#simpanDataBtn').click(function() {
            var dataheader = [];
            var purchase_id = document.getElementById('purchase_id').value;
            var kode_transaksi = document.getElementById('kode_transaksi').value;
            var tgl_kedatangan = document.getElementById('tgl_kedatangan').value;
            var supplier = document.getElementById('supplier').value;
            var suratjalan = document.getElementById('suratjalan').value;
            var pembayaran = document.getElementById('pembayaran').value;
            var potongan = document.getElementById('potongan').value;
            var keterangan = document.getElementById('keterangan').value;
            var ongkir = document.getElementById('ongkir').value;

            var dataMaster = {
                purchase_id: purchase_id,
                kode_transaksi: kode_transaksi,
                tgl_kedatangan: tgl_kedatangan,
                supplier: supplier,
                suratjalan: suratjalan,
                pembayaran: pembayaran,
                potongan: potongan,
                keterangan: keterangan,
                ongkir: ongkir
            };
            dataheader.push(dataMaster);

            var dataSemua = [];
            $('tbody tr').each(function() {
                var dataatas = [];

                var produk = $(this).find('select[name="produk[]"]').val();
                var kode = $(this).find('input[name="kode[]"]').val();
                var kuantiti = $(this).find('input[name="kuantitas[]"]').val();
                var kadaluarsa = $(this).find('input[name="kadaluarsa[]"]').val();
                var harga = $(this).find('input[name="harga[]"]').val();
                var harsat = $(this).find('input[name="harsat[]"]').val();
                var harjual = $(this).find('input[name="harjual[]"]').val();
                var detil = $(this).find('input[name="detil[]"]').val();

                dataatas.push({
                    produk: produk,
                    kode: kode,
                    kuantiti: kuantiti,
                    kadaluarsa: kadaluarsa,
                    harga: harga,
                    harsat: harsat,
                    harjual: harjual,
                    detil: detil
                });
                dataSemua.push(dataatas);
            });

            $(document).ready(function() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('pembelian.edit_jumlah_pembelian') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        dataheader: dataheader,
                        dataSemua: dataSemua
                    },
                    success: response => {
                        if (response.code == 200) {
                            Swal.fire({
                                title: 'Edit Data',
                                text: `${response.message}`,
                                icon: 'success',
                                timer: 1000,
                                willClose: () => {
                                    location.reload();
                                }
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: `${response.message}`,
                                showConfirmButton: false,
                                timer: 1500,
                                willClose: () => {
                                    location.reload();
                                }
                            })
                        }
                    },
                    error: (err) => {
                        console.log(err);
                    },
                });
            });
        });

        // Fungsi untuk menangani perubahan nilai pada input harga[]
        function updateHarga2(index) {
            var harga2Input = document.getElementById('harga2' + index);
            var hargaInput = document.getElementById('harga' + index);

            // Ambil nilai dari input dengan name "harga2[]"
            var harga2Value = parseFloat(harga2Input.value);

            // Perbarui nilai pada input dengan name "harga[]"
            hargaInput.value = isNaN(harga2Value) ? '' : harga2Value;
        }

        // Fungsi untuk memanggil fungsi updateHarga() saat nilai pada input dengan name "harga2[]" berubah
        function onHarga2Change(index) {
            updateHarga(index);
        }

        function removeFormatAngka(angka) {
            return angka.replace(/\./g, '').replace(/,/g, '');
        }

        // Fungsi untuk memperbarui nilai pada input dengan name "harjual[]"
        function updateHargajual(index) {
            var harjual3Input = document.getElementById('harjual3' + index);
            var harjualInput = document.getElementById('harjual' + index);

            // Ambil nilai dari input dengan name "harjual3[]"
            var harjual3Value = removeFormatAngka(harjual3Input.value);

            // Perbarui nilai pada input dengan name "harjual[]"
            harjualInput.value = harjual3Value;
        }

        // Fungsi untuk memanggil fungsi updateHargajual() saat nilai pada input dengan name "harjual3[]" berubah
        function hargajualfungsi(index) {
            updateHargajual(index);
        }

        //Mendapatkan input harga
        var inputHarga = document.getElementById('grand_total');
        // var harsat1 = document.getElementById('harsat1[]');


        // Menghapus karakter non-numerik dan mengonversi nilai menjadi angka
        var angka = inputHarga.value.replace(/[^0-9,-]+/g, "");
        // var angka = harsat1.value.replace(/[^0-9,-]+/g, "");
        var angkaParsed = parseFloat(angka.replace(',', '.'));

        // Fungsi untuk mengubah format angka menjadi format rupiah
        function formatRupiah(angka) {
            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
            return formatter.format(angka);
        }
    </script>
@endsection
