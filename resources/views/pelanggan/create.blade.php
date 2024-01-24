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
                <form>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label>Supplier <code>*</code></label>
                                                <input type="text" class="form-control"
                                                    oninput="this.value = this.value.toUpperCase()" id="supplier"
                                                    name="supplier" placeholder="Supplier" autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('supplier', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label>Alamat</label>
                                                <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                                                    oninput="this.value = this.value.toUpperCase()" autocomplete="off" required></textarea>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('alamat', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label>Kontak <code></code></label>
                                                <input type="text" class="form-control" id="kontak" name="kontak"
                                                    placeholder="Kontak" oninput="this.value = this.value.toUpperCase()"
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label>Telp <code></code></label>
                                                <input type="number" class="form-control" id="telp" name="telp"
                                                    placeholder="No HP" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-sm-12">
                                            <a class="btn btn-primary" type="submit" style="float: left"
                                                id="tambahData">Tambah Supplier</a>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-responsive table-bordered table-striped"
                                                id="tableSupplier">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 10%">Nama</th>
                                                        <th class="text-center" style="width: 10%">Alamat</th>
                                                        <th class="text-center" style="width: 10%">Kontak</th>
                                                        <th class="text-center" style="width: 10%">Telp</th>
                                                        <th class="text-center" style="width: 10%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-sm-12">
                                            <a href="{{ route('supplier.index') }}"
                                                class="btn btn-secondary waves-effect">Batal</a>
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
            // Fungsi untuk menambahkan data ke dalam tabel
            function tambahDataTabel() {
                // Ambil nilai dari input form
                let supplier = $("#supplier").val();
                let alamat = $("#alamat").val();
                let kontak = $("#kontak").val();
                let telp = $("#telp").val();

                // Validasi apakah form telah diisi
                if (supplier === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menambah',
                        text: 'Form SUPPLIER harus diisi.',
                    });
                    return;
                }

                // Buat baris HTML baru untuk ditambahkan ke dalam tabel
                let newRow = `
                    <tr>
                        <td class="text-center">${supplier}</td>
                        <td class="text-center">${alamat}</td>
                        <td class="text-center">${kontak}</td>
                        <td class="text-center">${telp}</td>
                        <td class="text-center">
                            <a href="#" class="text-danger delete-record">
                                <i class="mdi mdi-delete font-size-18"></i>
                            </a>
                        </td>
                    </tr>`;

                // Tambahkan baris ke dalam tabel
                $("#tableSupplier tbody").append(newRow);

                // Reset nilai input form
                $("#supplier").val("");
                $("#alamat").val("");
                $("#kontak").val("");
                $("#telp").val("");
            }

            // Fungsi untuk menyimpan data ke controller
            function simpanData() {
                let dataTabel = [];

                // Ambil data dari setiap baris di dalam tabel
                $("#tableSupplier tbody tr").each(function() {
                    let rowData = {
                        nama: $(this).find("td:eq(0)").text(),
                        alamat: $(this).find("td:eq(1)").text(),
                        kontak: $(this).find("td:eq(2)").text(),
                        telp: $(this).find("td:eq(3)").text(),
                    };
                    dataTabel.push(rowData);
                });

                // Kirim data ke controller (contoh menggunakan AJAX)
                if (dataTabel.length > 0) {
                    $.ajax({
                        url: "{{ route('supplier.store') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            dataTabel: dataTabel
                        },
                        success: function(response) {
                            if (response.code === 200) {
                                Swal.fire(
                                    'Success',
                                    'Data Supplier Berhasil dimasukkan',
                                    'success'
                                ).then(() => {
                                    var APP_URL = {!! json_encode(url('/')) !!}
                                    window.location = APP_URL + '/supplier'
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
                        error: function(err) {
                            console.error(err);
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak ada Produk',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            }

            // Tangani peristiwa klik pada tombol "Tambah Supplier"
            $("#tambahData").on("click", function() {
                tambahDataTabel();
            });

            // Tangani peristiwa klik pada tombol delete
            $("#tableSupplier").on("click", ".delete-record", function() {
                $(this).closest("tr").remove();
            });

            // Tangani peristiwa klik pada tombol "Simpan"
            $("#save").on("click", function() {
                simpanData();
            });
        });
    </script>
@endsection
