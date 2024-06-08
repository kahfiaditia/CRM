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
                                                <label>Nama Aplikasi <code>*</code></label>
                                                <input type="text" class="form-control"
                                                    oninput="this.value = this.value.toUpperCase()" id="produk"
                                                    name="produk" placeholder="Nama" autocomplete="off" maxlength="30">
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('produk', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label>Deskripsi <code></code></label>
                                                <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                                    oninput="this.value = this.value.toUpperCase()" placeholder="Deskripsi"
                                                    autocomplete="off" maxlength="30" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a class="btn btn-success" type="submit" style="float: left"
                                                id="tambahData">Tambah Aplikasi</a>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-responsive table-bordered table-striped"
                                                id="tableAplikasi">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 10%">Nama Aplikasi</th>
                                                        <th class="text-center" style="width: 10%">Deskripsi</th>
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
                                            <a href="{{ route('aplikasi.index') }}"
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

            function tambahDataTabel() {
                // Ambil nilai dari input form
                let produk = $("#produk").val();
                let deskripsi = $("#deskripsi").val();

                // Validasi apakah form telah diisi
                if (produk === "" || deskripsi === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menambah',
                        text: 'Form Aplikasi dan Minimal harus diisi.',
                    });
                    return;
                }

                // Buat baris HTML baru untuk ditambahkan ke dalam tabel
                let newRow = `
                <tr>
                    <td class="text-center">${produk}</td>
                    <td class="text-center">${deskripsi}</td>
                    <td class="text-center">
                        <a href="#" class="text-danger delete-record">
                            <i class="mdi mdi-delete font-size-18"></i>
                        </a>
                    </td>
                </tr>`;

                // Tambahkan baris ke dalam tabel
                $("#tableAplikasi tbody").append(newRow);

                // Reset nilai input form
                $("#produk").val("");
                $("#deskripsi").val("");
            }

            // Fungsi untuk menyimpan data ke controller
            function simpanData() {
                let dataTabel = [];

                // Ambil data dari setiap baris di dalam tabel
                $("#tableAplikasi tbody tr").each(function() {
                    let rowData = {
                        produk: $(this).find("td:eq(0)").text(),
                        deskripsi: $(this).find("td:eq(1)").text(),
                    };
                    dataTabel.push(rowData);
                });

                // Kirim data ke controller (contoh menggunakan AJAX)
                if (dataTabel.length > 0) {
                    $.ajax({
                        url: "{{ route('aplikasi.store') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            dataTabel: dataTabel
                        },
                        success: function(response) {
                            if (response.code === 200) {
                                Swal.fire(
                                    'Success',
                                    'Data Aplikasi Berhasil dimasukkan',
                                    'success'
                                ).then(() => {
                                    var APP_URL = {!! json_encode(url('/')) !!}
                                    window.location = APP_URL + '/aplikasi'
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
                        title: 'Tidak ada Aplikasi',
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
            $("#tableAplikasi").on("click", ".delete-record", function() {
                $(this).closest("tr").remove();
            });

            // Tangani peristiwa klik pada tombol "Simpan"
            $("#save").on("click", function() {
                simpanData();
            });
        });
    </script>
@endsection
