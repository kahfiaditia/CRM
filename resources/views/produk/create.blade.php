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
                                                <label>Produk <code>*</code></label>
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
                                                <label>Satuan <code>*</code></label>
                                                <select class="form-control select select2 jenis" name="satuan"
                                                    id="satuan">
                                                    <option value=""> -- Pilih --</option>
                                                    @foreach ($satuan as $ini)
                                                        <option value="{{ $ini->id }}"> {{ $ini->nama }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label>Stok Minimal <code>*</code></label>
                                                <input type="number" class="form-control" id="minimal" name="minimal"
                                                    placeholder="Stok Minimal" autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('minimal', '<div class="invalid-validasi">:message</div>') !!}
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
                                                id="tambahData">Tambah Produk</a>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-responsive table-bordered table-striped"
                                                id="tableObat">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 10%">Produk</th>
                                                        <th hidden>id_satuan</th>
                                                        <th class="text-center" style="width: 10%">Satuan</th>
                                                        <th class="text-center" style="width: 10%">Minimal Stok</th>
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
                                            <a href="{{ route('produk.index') }}"
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
                let selectedJenisText = $("#satuan option:selected").text();
                let produk = $("#produk").val();
                let satuan = $("#satuan").val();
                let minimal = $("#minimal").val();
                let deskripsi = $("#deskripsi").val();

                // Validasi apakah form telah diisi
                if (produk === "" || satuan === "" || minimal === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menambah',
                        text: 'Form Produk, Produk dan Minimal harus diisi.',
                    });
                    return;
                }

                // Buat baris HTML baru untuk ditambahkan ke dalam tabel
                let newRow = `
                <tr>
                    <td class="text-center">${produk}</td>
                    <td class="text-center" hidden>${satuan}</td>
                    <td class="text-center">${selectedJenisText}</td>
                    <td class="text-center">${minimal}</td>
                    <td class="text-center">${deskripsi}</td>
                    <td class="text-center">
                        <a href="#" class="text-danger delete-record">
                            <i class="mdi mdi-delete font-size-18"></i>
                        </a>
                    </td>
                </tr>`;

                // Tambahkan baris ke dalam tabel
                $("#tableObat tbody").append(newRow);

                // Reset nilai input form
                $("#produk").val("");
                $("#minimal").val("");
                $("#kontak").val("");
                $("#deskripsi").val("");
            }

            // Fungsi untuk menyimpan data ke controller
            function simpanData() {
                let dataTabel = [];

                // Ambil data dari setiap baris di dalam tabel
                $("#tableObat tbody tr").each(function() {
                    let rowData = {
                        produk: $(this).find("td:eq(0)").text(),
                        satuan: $(this).find("td:eq(1)").text(),
                        selectedJenisText: $(this).find("td:eq(2)").text(),
                        minimal: $(this).find("td:eq(3)").text(),
                        deskripsi: $(this).find("td:eq(4)").text(),
                    };
                    dataTabel.push(rowData);
                });

                // Kirim data ke controller (contoh menggunakan AJAX)
                if (dataTabel.length > 0) {
                    $.ajax({
                        url: "{{ route('produk.store') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            dataTabel: dataTabel
                        },
                        success: function(response) {
                            if (response.code === 200) {
                                Swal.fire(
                                    'Success',
                                    'Data Produk Berhasil dimasukkan',
                                    'success'
                                ).then(() => {
                                    var APP_URL = {!! json_encode(url('/')) !!}
                                    window.location = APP_URL + '/produk'
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
                        title: 'Tidak ada Obat',
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
            $("#tableObat").on("click", ".delete-record", function() {
                $(this).closest("tr").remove();
            });

            // Tangani peristiwa klik pada tombol "Simpan"
            $("#save").on("click", function() {
                simpanData();
            });
        });
    </script>
@endsection
