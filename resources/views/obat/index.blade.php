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
                                <a href="{{ route('obat.create') }}" type="button"
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

                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button fw-medium <?php if (isset($_GET['obat'])) {
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
                                    if (isset($_GET['obat']) or isset($_GET['jenis']) or isset($_GET['harga_jual']) or isset($_GET['harga_beli']) or isset($_GET['stok'])) {
                                        if ($_GET['obat'] != null or $_GET['jenis'] != null or $_GET['harga_jual'] != null or $_GET['harga_beli'] != null or $_GET['stok'] != null) {
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
                                                                    <input type="text" name="obat" id="obat"
                                                                        value="{{ isset($_GET['obat']) ? $_GET['obat'] : null }}"
                                                                        class="form-control" placeholder="Obat"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="jenis" id="jenis"
                                                                        value="{{ isset($_GET['jenis']) ? $_GET['jenis'] : null }}"
                                                                        class="form-control" placeholder="Jenis"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="harga_jual" id="harga_jual"
                                                                        value="{{ isset($_GET['harga_jual']) ? $_GET['harga_jual'] : null }}"
                                                                        class="form-control" placeholder="Harga Jual"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="harga_beli" id="harga_beli"
                                                                        value="{{ isset($_GET['harga_beli']) ? $_GET['harga_beli'] : null }}"
                                                                        class="form-control" placeholder="Harga Beli"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="stok" id="stok"
                                                                        value="{{ isset($_GET['stok']) ? $_GET['stok'] : null }}"
                                                                        class="form-control" placeholder="Stok"
                                                                        autocomplete="off">
                                                                </div>
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
                                                            <a href="{{ route('supplier.index') }}"
                                                                class="btn btn-secondary w-md">Batal</a>
                                                            @if (isset($_GET['id_ketua']) or isset($_GET['id_ketua']))
                                                                <?php
                                                                $obat = $_GET['obat'];
                                                                $jenis = $_GET['jenis'];
                                                                $harga_jual = $_GET['harga_jual'];
                                                                $harga_beli = $_GET['harga_beli'];
                                                                $stok = $_GET['stok'];
                                                                $search_manual = $_GET['search_manual'];
                                                                if (isset($_GET['like'])) {
                                                                    $like = $_GET['like'];
                                                                } else {
                                                                    $like = null;
                                                                }
                                                                ?>
                                                                <a href="{{ route(
                                                                    'obat.index',
                                                                    'obat=' .
                                                                        $obat .
                                                                        '&jenis=' .
                                                                        $jenis .
                                                                        '&harga_jual=' .
                                                                        $harga_jual .
                                                                        '&harga_beli=' .
                                                                        $harga_beli .
                                                                        '&stok=' .
                                                                        $stok .
                                                                        '&search_manual=' .
                                                                        $search_manual .
                                                                        '&like=' .
                                                                        $like .
                                                                        '',
                                                                ) }}"
                                                                    class="btn btn-success btn-rounded waves-effect waves-light w-md"><i
                                                                        class="bx bx-cloud-download me-1"></i>Unduh</a>
                                                            @else
                                                                <a href="{{ route('obat.index') }}"
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

                            <table id="datatable" class="table table-striped dt-responsive nowrap w-100 mt-3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Obat</th>
                                        <th>Jenis</th>
                                        <th>Stok</th>
                                        <th>Harga Jual</th>
                                        <th>Harga Jual</th>
                                        <th>Status</th>
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
                document.getElementById("obat").value = null;
                document.getElementById("jenis").value = null;
                document.getElementById("harga_jual").value = null;
                document.getElementById("harga_beli").value = null;
                document.getElementById("stok").value = null;
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
                document.getElementById("obat").value = null;
                document.getElementById("jenis").value = null;
                document.getElementById("harga_jual").value = null;
                document.getElementById("harga_beli").value = null;
                document.getElementById("stok").value = null;
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
                ajax: {
                    url: "{{ route('obat.data_list') }}",
                    data: function(d) {
                        d.obat = (document.getElementById("obat").value
                                .length != 0) ?
                            document
                            .getElementById(
                                "obat").value : null;
                        d.jenis = (document.getElementById("jenis").value.length != 0) ?
                            document
                            .getElementById(
                                "jenis").value : null;
                        d.harga_jual = (document.getElementById("harga_jual").value.length != 0) ?
                            document
                            .getElementById(
                                "harga_jual").value : null;
                        d.harga_beli = (document.getElementById("harga_beli").value.length != 0) ?
                            document
                            .getElementById(
                                "harga_beli").value : null;
                        d.stok = (document.getElementById("stok").value.length != 0) ?
                            document
                            .getElementById(
                                "stok").value : null;
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
                        data: 'obat',
                        name: 'obat'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'harga_jual',
                        name: 'harga_jual'
                    },
                    {
                        data: 'harga_beli',
                        name: 'harga_beli'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, full, meta) {
                            return data == 1 ? 'Aktif' : 'Non Aktif';
                        }
                    },

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
