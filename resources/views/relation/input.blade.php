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
                                                <label for="total_kuantiti">Customer <code>*</code></label>
                                                <select class="form-control select select2 customer" name="customer"
                                                    id="customer">
                                                    <option value=""> -- Pilih --</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('customer', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Applikasi <code>*</code></label>
                                                <select class="form-control select select2 aplikasi" name="aplikasi"
                                                    id="aplikasi" required>
                                                    <option value="">-- PILIH --</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Data wajib diisi.
                                                </div>
                                                {!! $errors->first('aplikasi', '<div class="invalid-validasi">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-mb-2">
                                            <a type="submit" id="button" class="btn btn-info w-md"
                                                onclick="btnTambahAplikasi()">Tambah
                                                Aplikasi</a>
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-responsive table-bordered table-striped"
                                                id="tableRelation">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 20%">id Customer</th>
                                                        <th class="text-center" style="width: 10%">Customer</th>
                                                        <th class="text-center" style="width: 10%">id Aplikasi</th>
                                                        <th class="text-center" style="width: 10%">Nama</th>
                                                        <th class="text-center" style="width: 5%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
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
                url: '{{ route('relation.mengambil_data_customer') }}',
                type: 'GET',
                success: function(data) {
                    var customerDropdown = $('#customer');
                    customerDropdown.empty();
                    customerDropdown.append('<option value="">-- PILIH --</option>');

                    $.each(data, function(index, customer) {
                        customerDropdown.append('<option value="' + customer.id + '">' +
                            customer.nama + '</option>');
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });

            $.ajax({
                url: '{{ route('relation.mengambil_data_aplikasi') }}',
                type: 'GET',
                success: function(data) {
                    var aplikasiDropdown = $('#aplikasi');
                    aplikasiDropdown.empty();
                    aplikasiDropdown.append('<option value="">-- PILIH --</option>');

                    $.each(data, function(index, aplikasi) {
                        aplikasiDropdown.append('<option value="' + aplikasi.id + '">' +
                            aplikasi.nama + '</option>');
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });

            $("#tableRelation").on('click', '.delete-record', function() {
                $(this).parent().parent().remove()
            })
        });

        function btnTambahAplikasi() {
            var selectedOptioncustomer = $('#customer option:selected');
            var customer_id = selectedOptioncustomer.val();
            var customer_nama = selectedOptioncustomer.text();

            var selectedOptionaplikasi = $('#aplikasi option:selected');
            var aplikasi_id = selectedOptionaplikasi.val();
            var aplikasi_nama = selectedOptionaplikasi.text();

            if (customer_id === "" || aplikasi_id === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Tanda * (bintang) wajib Diisi',
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                // $('#customer').val("").trigger('change');
                $('#aplikasi').val("").trigger('change');

                $("#tableRelation tbody").append(`
                <tr>
                    <td class="text-center">${customer_id}</td>
                    <td class="text-center">${customer_nama}</td>
                    <td class="text-center">${aplikasi_id}</td>
                    <td class="text-center">${aplikasi_nama}</td>   
                    <td class="text-center">
                        <a href="#" class="text-danger delete-record">
                            <i class="mdi mdi-delete font-size-18"></i>
                        </a>
                    </td>
                </tr>
            `);
            }
        }

        $(document).ready(function() {
            //fungsi hapus


            $('#save').on('click', function() {
                var tableData = [];
                $('#tableRelation tbody tr').each(function() {
                    var row = $(this);
                    var customer_id = row.find('td:eq(0)').text();
                    var customer_nama = row.find('td:eq(1)').text();
                    var aplikasi_id = row.find('td:eq(2)').text();
                    var aplikasi_nama = row.find('td:eq(3)').text();

                    tableData.push({
                        customer_id: customer_id,
                        customer_nama: customer_nama,
                        aplikasi_id: aplikasi_id,
                        aplikasi_nama: aplikasi_nama
                    });
                });

                $.ajax({
                    url: '{{ route('relation.store') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        tableData: tableData
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
                                    '/relation'
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
            });

        })
    </script>
@endsection
