@extends('layouts.main')
@section('apotekku')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4 class="mb-sm-0 font-size-18">{{ $menu }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">{{ ucwords($submenu) }}</li>
                                @if ($submenu)
                                    <li class="breadcrumb-item">{{ ucwords($label) }}</li>
                                @endif
                            </ol>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                {{-- @if (in_array('148', $session_menu)) --}}
                                <a href="{{ route('pembelian.create') }}" type="button"
                                    class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                    <i class="mdi mdi-plus me-1"></i> Tambah
                                </a>
                                {{-- @endif --}}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="accordion mb-4" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button fw-medium <?php if (isset($_GET['kode_pembelian'])) {
                                        } else {
                                            echo 'collapsed';
                                        } ?>" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="bx bx-search-alt font-size-18"></i>
                                            <b>Cari & Unduh Data</b>
                                        </button>
                                    </h2>

                                    <div id="collapseOne" class="accordion-collapse collapse <?php
                                    if (isset($_GET['kode_pembelian']) or isset($_GET['supplier']) or isset($_GET['total']) or isset($_GET['status'])) {
                                        if ($_GET['kode_pembelian'] != null or $_GET['supplier'] != null or $_GET['total'] != null or $_GET['status'] != null) {
                                            echo 'show';
                                        }
                                    }
                                    if (isset($_GET['like'])) {
                                        if ($_GET['like'] != null) {
                                            echo 'show';
                                        }
                                    } ?>"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="text-muted">
                                                <form>
                                                    <div class="row" id="id_where">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-2 mb-2">
                                                                    <input type="text" name="kode_pembelian"
                                                                        id="kode_pembelian"
                                                                        value="{{ isset($_GET['kode_pembelian']) ? $_GET['kode_pembelian'] : null }}"
                                                                        class="form-control" placeholder="Kode Pembelian"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="supplier" id="supplier"
                                                                        value="{{ isset($_GET['supplier']) ? $_GET['supplier'] : null }}"
                                                                        class="form-control" placeholder="Supplier"
                                                                        autocomplete="off">
                                                                </div>
                                                                {{-- <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="total" id="total"
                                                                        value="{{ isset($_GET['total']) ? $_GET['total'] : null }}"
                                                                        class="form-control" placeholder="Total"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="status" id="status"
                                                                        value="{{ isset($_GET['status']) ? $_GET['status'] : null }}"
                                                                        class="form-control" placeholder="Status"
                                                                        autocomplete="off">
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="id_like" style="display: none">
                                                        <div class="col-md-2 mb-2">
                                                            <input type="text" name="search_manual" id="search_manual"
                                                                value="{{ isset($_GET['search_manual']) ? $_GET['search_manual'] : null }}"
                                                                class="form-control" placeholder="Search">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-2 mb-2">
                                                            <div class="form-check form-check-right mb-3">
                                                                <input class="form-check-input" name="like"
                                                                    type="checkbox" id="like"
                                                                    value="{{ isset($_GET['like']) ? 'search' : 'default' }}"
                                                                    {{ isset($_GET['like']) ? 'checked' : null }}
                                                                    onclick="toggleCheckbox()">
                                                                <label class="form-check-label" for="like">
                                                                    Like semua data
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-10 mb-2">
                                                            <button type="submit"
                                                                class="btn btn-primary w-md">Cari</button>
                                                            <a href="{{ route('pembelian.index') }}"
                                                                class="btn btn-secondary w-md">Batal</a>
                                                            @if (isset($_GET['id_ketua']) or isset($_GET['id_ketua']))
                                                                <?php
                                                                $kode_pembelian = $_GET['kode_pembelian'];
                                                                $supplier = $_GET['supplier'];
                                                                $total = $_GET['total'];
                                                                $status = $_GET['status'];
                                                                $search_manual = $_GET['search_manual'];
                                                                if (isset($_GET['like'])) {
                                                                    $like = $_GET['like'];
                                                                } else {
                                                                    $like = null;
                                                                }
                                                                ?>
                                                                <a href="{{ route(
                                                                    'pembelian.index',
                                                                    'kode_pembelian=' .
                                                                        $kode_pembelian .
                                                                        '&supplier=' .
                                                                        $supplier .
                                                                        '&total=' .
                                                                        $total .
                                                                        '&status=' .
                                                                        $status .
                                                                        '&search_manual=' .
                                                                        $search_manual .
                                                                        '&like=' .
                                                                        $like .
                                                                        '',
                                                                ) }}"
                                                                    class="btn btn-success btn-rounded waves-effect waves-light w-md"><i
                                                                        class="bx bx-cloud-download me-1"></i>Unduh</a>
                                                            @else
                                                                <a href="{{ route('pembelian.index') }}"
                                                                    class="btn btn-success btn-rounded waves-effect waves-light w-md"><i
                                                                        class="bx bx-cloud-download me-1"></i>Unduh</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Pembelian</th>
                                        <th>Supplier</th>
                                        <th>Tanggal</th>
                                        {{-- <th>Total</th>
                                        <th>Status</th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    <script>
        function toggleCheckbox() {
            like = document.getElementById("like").checked;
            if (like == true) {
                document.getElementById("kode_pembelian").value = null;
                document.getElementById("supplier").value = null;
                // document.getElementById("kontak").value = null;
                // document.getElementById("telp").value = null;
                // document.getElementById("status").value = null;
                $('#type').val("").trigger('change')
                document.getElementById("id_where").style.display = 'none';
                document.getElementById("id_like").style.display = 'block';
            } else {
                document.getElementById("search_manual").value = null;
                document.getElementById("like").checked = false;
                document.getElementById("id_like").style.display = 'none';
                document.getElementById("id_where").style.display = 'block';
            }
        }

        $(document).ready(function() {
            like = document.getElementById("like").checked;
            if (like == true) {
                document.getElementById("kode_pembelian").value = null;
                document.getElementById("supplier").value = null;
                // document.getElementById("kontak").value = null;
                // document.getElementById("telp").value = null;
                // document.getElementById("status").value = null;
                $('#type').val("").trigger('change')
                document.getElementById("id_where").style.display = 'none';
                document.getElementById("id_like").style.display = 'block';
            } else {
                document.getElementById("search_manual").value = null;
                document.getElementById("like").checked = false;
                document.getElementById("id_like").style.display = 'none';
                document.getElementById("id_where").style.display = 'block';
            }


            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                searching: false,
                ajax: {
                    url: "{{ route('pembelian.data_list_pembelian') }}",
                    data: function(d) {
                        d.kode_pembelian = (document.getElementById("kode_pembelian").value
                                .length != 0) ?
                            document
                            .getElementById(
                                "kode_pembelian").value : null;
                        d.supplier = (document.getElementById("supplier").value.length != 0) ?
                            document
                            .getElementById(
                                "supplier").value : null;
                        // d.kontak = (document.getElementById("kontak").value.length != 0) ?
                        //     document
                        //     .getElementById(
                        //         "kontak").value : null;
                        // d.telp = (document.getElementById("telp").value.length != 0) ?
                        //     document
                        //     .getElementById(
                        //         "telp").value : null;
                        // d.status = (document.getElementById("status").value.length != 0) ?
                        //     document
                        //     .getElementById(
                        //         "status").value : null;
                        d.search_manual = (document.getElementById("search_manual").value
                                .length != 0) ?
                            document
                            .getElementById(
                                "search_manual").value : null;
                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: null,
                        sortable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }

                    },
                    {
                        data: 'kode_pembelian',
                        name: 'kode_pembelian'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    // {
                    //     data: 'telp',
                    //     name: 'telp'
                    // },
                    // {
                    //     data: 'status',
                    //     name: 'status',
                    //     render: function(data, type, full, meta) {
                    //         return data == 1 ? 'Aktif' : 'Non Aktif';
                    //     }
                    // },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@endsection
