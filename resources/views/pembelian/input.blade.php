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
                <form class="needs-validation">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label>Kedatangan <code>*</code></label>
                                                <div class="input-group" id="datepicker2">
                                                    <input type="text" class="form-control tgl_permintaan"
                                                        placeholder="Tgl" name="tgl_kedatangan" id="tgl_kedatangan"
                                                        value="" max="{{ date('Y-m-d') }}"
                                                        data-date-format="yyyy-mm-dd" data-date-container='#datepicker2'
                                                        data-provide="datepicker" required data-date-autoclose="true"
                                                        autocomplete="off">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                    <div class="invalid-feedback">
                                                        Data wajib diisi.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="total_kuantiti">Nomor DO/SJ <code>*</code></label>
                                                <input type="text" class="form-control"
                                                    oninput="this.value = this.value.toUpperCase()" id="nomor_do"
                                                    name="nomor_do" placeholder="Nomor" autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('nomor_do', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Supplier <code>*</code></label>
                                                <select class="form-control select select2 supplier" name="supplier"
                                                    id="supplier" required>
                                                    <option value="">-- PILIH --</option>
                                                    {{-- {{ dd($supplierdata) }}; --}}
                                                    @foreach ($supplierdata as $supplier)
                                                        <option value="{{ $supplier->id }}"
                                                            data-id="{{ $supplier->supplier }}">
                                                            {{ $supplier->supplier }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('supplier', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="mb-2">
                                                <label class="form-label">Produk <code>*</code></label>
                                                <select class="form-control select select2 obat" name="obat"
                                                    id="obat" required>
                                                    <option value="">-- PILIH --</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('obat', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-2">
                                                <label for="tgl_kadaluarsa">Kadaluarsa <code>*</code></label>
                                                <div class="input-group" id="datepicker2">
                                                    <input type="text" class="form-control tgl_kadaluarsa"
                                                        placeholder="Tgl" name="tgl_kadaluarsa" id="tgl_kadaluarsa"
                                                        value="" data-date-format="yyyy-mm-dd"
                                                        data-date-container='#datepicker2' data-provide="datepicker"
                                                        required data-date-autoclose="true">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                    <div class="invalid-feedback">
                                                        Data wajib diisi.
                                                    </div>
                                                </div>
                                                <div class="invalid-validasi"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-2">
                                                <label for="harga_total_produk">Harga <code>*</code></label>
                                                <input type="text" class="form-control" onkeyup="hitungHargaPerUnit()"
                                                    id="harga_total_produk" name="harga_total_produk" placeholder="Rp"
                                                    autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('harga_total_produk', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-2">
                                                <label for="total_kuantiti">Kuantiti <code>*</code></label>
                                                <input type="number" class="form-control" onkeyup="hitungHargaPerUnit()"
                                                    id="total_kuantiti" name="total_kuantiti" placeholder="Jumlah"
                                                    autocomplete="off" required />
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('total_kuantiti', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-2">
                                                <label for="harga_per_pcs">Harga Satuan</label>
                                                <input type="text" class="form-control" id="harga_per_pcs"
                                                    name="harga_per_pcs" placeholder="Rp"
                                                    onkeyup="formatRupiah('harga_per_pcs')" required disabled>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('harga_per_pcs', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-2">
                                                <label>Harga Jual <code>*</code></label>
                                                <input type="text" class="form-control" min="0" step="1000"
                                                    id="nilai_jual" name="nilai_jual" placeholder="Rp"
                                                    autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('nilai_jual', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-mb-2">
                                            <a type="submit" id="button" class="btn btn-info w-md"
                                                onclick="btnTambahProduk()">Tambah
                                                Produk</a>
                                        </div>
                                    </div>
                                    <input type="hidden" id="inputArray">
                                    <input type="hidden" id="inputArrayNoID">
                                    <input type="hidden" id="inputArrayNo">
                                    <input type="hidden" id="inputArrayID">
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-responsive table-bordered table-striped"
                                                id="tableBarang">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 20%">Obat</th>
                                                        <th class="text-center" style="width: 10%">Kadaluarsa</th>
                                                        <th class="text-center" style="width: 10%">Harga</th>
                                                        <th class="text-center" style="width: 10%">Kuantiti</th>
                                                        <th class="text-center" style="width: 10%">Harga Satuan</th>
                                                        <th class="text-center" style="width: 10%">Harga Jual</th>
                                                        <th class="text-center" style="width: 5%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-9 offset-md-7 wajib">
                                            <div class="row mb-2">
                                                <label class="col-md-3 text-right">Ongkir</label>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control" id="ongkir"
                                                        name="ongkir" placeholder="Rp" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-md-3">Potongan</label>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control" id="potongan"
                                                        name="potongan" placeholder="Rp" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label class="col-md-3 form-label">Pembayaran</label>
                                                <div class="col-md-3">
                                                    <select class="form-control select select2 pembayaran"
                                                        name="status_pembayaran" id="status_pembayaran">
                                                        <option value="">-- PILIH --</option>
                                                        <option value="1"> LUNAS </option>
                                                        <option value="2"> BELUM LUNAS </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-sm-12">
                                            <a class="btn btn-secondary" type="submit" id="batal">Batal</a>
                                            <a class="btn btn-primary" type="submit" style="float: right"
                                                id="save">Simpan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('pembelian.mengambil_data_obat') }}',
                type: 'GET',
                success: function(data) {
                    // Populate the dropdown with data
                    var obatDropdown = $('#obat');
                    obatDropdown.empty();
                    obatDropdown.append('<option value="">-- PILIH --</option>');

                    $.each(data, function(index, obat) {
                        obatDropdown.append('<option value="' + obat.id + '">' + obat
                            .obat + '</option>');
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        function formatRupiah(angka) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah + (split[1] !== undefined ? ',' + split[1] : '');
        }

        //ketik harga total langsung format rupiah
        document.addEventListener('DOMContentLoaded', function() {
            var harga_total_produk_input = document.getElementById('harga_total_produk');

            harga_total_produk_input.addEventListener('input', function(e) {
                var harga_total_produk_value = this.value; // Retrieve the value
                var formattedRupiah = formatRupiah(harga_total_produk_value); // Format the value
                this.value = formattedRupiah; // Update the input value to show the formatted rupiah value
            });
        });

        //ketik harga nilai_jual langsung format rupiah
        document.addEventListener('DOMContentLoaded', function() {
            var nilai_jual_input = document.getElementById('nilai_jual');

            nilai_jual_input.addEventListener('input', function(e) {
                var nilai_jual_value = this.value; // Retrieve the value
                var formattedRupiah = formatRupiah(nilai_jual_value); // Format the value
                this.value = formattedRupiah; // Update the input value to show the formatted rupiah value
            });
        });

        function hitungHargaPerUnit() {
            const totalHarga = parseFloat(document.getElementById('harga_total_produk').value.replace(/[^\d]/g, ''));
            const total_kuantiti = document.getElementById('total_kuantiti').value;
            const hargaPerUnitInput = document.getElementById('harga_per_pcs');

            if (totalHarga && total_kuantiti) {
                const hargaPerUnit = totalHarga / total_kuantiti;
                hargaPerUnitInput.value = hargaPerUnit.toLocaleString();
            }
        }

        function btnTambahProduk() {
            var tgl_kedatangan = document.getElementById('tgl_kedatangan').value;
            var nomor_do = document.getElementById('nomor_do').value;
            var supplier = document.getElementById('supplier').value;

            var obat = document.getElementById('obat').value;
            var tgl_kadaluarsa = document.getElementById('tgl_kadaluarsa').value;

            //manupulasi harga_total_produk
            var harga_total_produk = document.getElementById('harga_total_produk').value;
            var rupiah_harga_total_produk = formatRupiah(harga_total_produk);

            var total_kuantiti = document.getElementById('total_kuantiti').value;

            //manupulasi harga_per_pcs
            var harga_per_pcs = document.getElementById('harga_per_pcs').value;
            var rupiah_harga_per_pcs = formatRupiah(harga_per_pcs);

            //manupulasi nilai_jual
            var nilai_jual = document.getElementById('nilai_jual').value;
            var rupiah_nilai_jual = formatRupiah(nilai_jual);

            tgl_kedatangan_value = $('#tgl_kedatangan option:selected').data('id');
            supplier_value = $('#supplier option:selected').data('id');
            status_pembayaran_value = $('#status_pembayaran option:selected').data('id');
            tgl_kadaluarsa_value = $('#tgl_kedatangan option:selected').data('id');
            // obat_nama = $('#produk option:selected').data('id');
            var selectedOptionnama = $('#obat option:selected');
            var obat_nama = selectedOptionnama.text();
            // console.log(obat_nama);

            var selectedPembelian = $('#untuk option:selected');
            var status_pembelian = selectedPembelian.val();
            var status_pembelian_name = selectedPembelian.text();

            document.getElementById('tgl_kadaluarsa').value = '';
            document.getElementById('harga_total_produk').value = '';
            document.getElementById('total_kuantiti').value = '';
            document.getElementById('harga_per_pcs').value = '';
            document.getElementById('nilai_jual').value = '';
            $('#obat').val("").trigger('change')

            if (obat == '' || tgl_kadaluarsa == '' || harga_total_produk == '' || total_kuantiti == '' || harga_per_pcs ==
                '' ||
                nilai_jual == '' || tgl_kedatangan == '' || supplier == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Tanda * (bintang) wajib Diisi',
                    showConfirmButton: false,
                    timer: 1500,
                })
            } else {
                // set array awal
                // Nama Barang + NO + ID
                var inputArray = document.getElementById('inputArray').value;
                if (inputArray == '') {
                    var cekArr = [];
                } else {
                    var cekArr = [];
                    strArray = inputArray.split(",");
                    for (var i = 0; i < strArray.length; i++) {
                        cekArr.push(strArray[i]);
                    }
                    var cekArr = cekArr;
                }

                // NO + ID
                var inputArrayNoID = document.getElementById('inputArrayNoID').value;
                if (inputArrayNoID == '') {
                    var cekArrNoID = [];
                } else {
                    var cekArrNoID = [];
                    strArray = inputArrayNoID.split(",");
                    for (var i = 0; i < strArray.length; i++) {
                        cekArrNoID.push(strArray[i]);
                    }
                    var cekArrNoID = cekArrNoID;
                }

                // NO 
                var inputArrayNo = document.getElementById('inputArrayNo').value;
                if (inputArrayNo == '') {
                    var cekArrNo = [];
                } else {
                    var cekArrNo = [];
                    strArray = inputArrayNo.split(",");
                    for (var i = 0; i < strArray.length; i++) {
                        cekArrNo.push(strArray[i]);
                    }
                    var cekArrNo = cekArrNo;
                }

                // ID
                var inputArrayID = document.getElementById('inputArrayID').value;
                if (inputArrayID == '') {
                    var cekArrID = [];
                } else {
                    var cekArrID = [];
                    strArray = inputArrayID.split(",");
                    for (var i = 0; i < strArray.length; i++) {
                        cekArrID.push(strArray[i]);
                    }
                    var cekArrID = cekArrID;
                }

                // cek inputan
                // Nama Barang + NO + ID
                var cekGabungan = String(obat);
                isVal = cekArr.includes(cekGabungan)

                // NO
                var cekGabunganNo = String(obat);
                isValNo = cekArrNo.includes(cekGabunganNo)


                // cek salah satu validasi
                if (isVal == true || isValNo == true) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Obat Sudah ada',
                        showConfirmButton: false,
                        timer: 1500,
                    })
                } else {
                    // push ke array
                    cekArr.push(cekGabungan);
                    cekArrNoID.push(cekGabunganNo);

                    // set inputan ke form
                    document.getElementById('inputArray').value = cekArr;
                    document.getElementById('inputArrayNo').value = cekArrNo;

                    $("#tableBarang tr:last").after(`
                    <tr>
                        <td hidden>${tgl_kedatangan}</td>
                        <td hidden>${nomor_do}</td>
                        <td hidden>${supplier}</td>
                        <td hidden>${obat}</td>
                        <td hidden>${harga_total_produk}</td>
                        <td hidden>${nilai_jual}</td>
                        <td hidden>${harga_per_pcs}</td>
                        <td class="text-center">${obat_nama}</td>
                        <td class="text-center">${tgl_kadaluarsa}</td>
                        <td class="text-center">${rupiah_harga_total_produk}</td>
                        <td class="text-center">${total_kuantiti}</td>
                        <td class="text-center">${rupiah_harga_per_pcs}</td>
                        <td class="text-center">${rupiah_nilai_jual}</td>   
                        <td class="text-center">
                            <a href="#" class="text-danger delete-record">
                                <i class="mdi mdi-delete font-size-18"></i>
                            </a>
                        </td>
                    </tr>
                `)
                }
            }
        }

        $(document).ready(function() {
            //fungsi hapus
            $("#tableBarang").on('click', '.delete-record', function() {
                $(this).parent().parent().remove()
            })

            $("#save").on('click', function() {
                let datapembelian = []
                let tambahandata = []

                var ongkir = document.getElementById('ongkir').value;
                var potongan = document.getElementById('potongan').value;
                var status_pembayaran = document.getElementById('status_pembayaran').value;

                tambahandata.push({
                    ongkir,
                    potongan,
                    status_pembayaran
                });

                $("#tableBarang").find("tr").each(function(index, element) {
                    let tableData = $(this).find('td'),
                        tgl_kedatangan = tableData.eq(0).text(),
                        nomor_do = tableData.eq(1).text(),
                        supplier = tableData.eq(2).text(),
                        obat = tableData.eq(3).text(),
                        harga_total_produk = tableData.eq(4).text(),
                        nilai_jual = tableData.eq(5).text(),
                        harga_per_pcs = tableData.eq(6).text(),
                        obat_nama = tableData.eq(7).text(),
                        tgl_kadaluarsa = tableData.eq(8).text(),
                        rupiah_harga_total_produk = tableData.eq(9).text(),
                        total_kuantiti = tableData.eq(10).text(),
                        rupiah_harga_per_pcs = tableData.eq(11).text(),
                        rupiah_nilai_jual = tableData.eq(12).text()

                    if (obat != '') {
                        datapembelian.push({
                            tgl_kedatangan,
                            nomor_do,
                            supplier,
                            obat,
                            harga_total_produk,
                            nilai_jual,
                            harga_per_pcs,
                            obat_nama,
                            tgl_kadaluarsa,
                            rupiah_harga_total_produk,
                            total_kuantiti,
                            rupiah_harga_per_pcs,
                            rupiah_nilai_jual
                        });
                    }
                });

                if (datapembelian.length > 0) {
                    jQuery.ajax({
                        type: "POST",
                        url: '{{ route('pembelian.store') }}',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            datapembelian,
                            tambahandata
                        },
                        success: (response) => {
                            if (response.code === 200) {
                                Swal.fire(
                                    'Success',
                                    'Data Pembelian Berhasil di masukan',
                                    'success'
                                ).then(() => {
                                    var APP_URL = {!! json_encode(url('/')) !!}
                                    window.location = APP_URL +
                                        '/pembelian'
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
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak ada Produk',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            });

            $("#batal").on('click', function() {
                var APP_URL = {!! json_encode(url('/')) !!}
                window.location = APP_URL + '/pembelian'
            })
        })
    </script>
@endsection
