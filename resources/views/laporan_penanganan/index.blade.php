@extends('layouts.main')
@section('apotekku')
    <?php $session_menu = explode(',', Auth::user()->akses_submenu); ?>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                                <li class="breadcrumb-item">{{ ucwords($submenu) }}</li>
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
                                        <button class="accordion-button fw-medium <?php if (isset($_GET['kode'])) {
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
                                    if (empty($_GET['like']) and (isset($_GET['kode']) or isset($_GET['customer']) or isset($_GET['aplikasi']) or isset($_GET['status2']) or isset($_GET['tgl_start']) or isset($_GET['tgl_end']))) {
                                        if ($_GET['kode'] != null or $_GET['customer'] != null or $_GET['aplikasi'] != null or $_GET['status2'] != null or $_GET['tgl_start'] != null or $_GET['tgl_end'] != null) {
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
                                                                    <input type="text" name="kode" id="kode"
                                                                        value="{{ isset($_GET['kode']) ? $_GET['kode'] : null }}"
                                                                        class="form-control" placeholder="Kode"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="customer" id="customer"
                                                                        value="{{ isset($_GET['customer']) ? $_GET['customer'] : null }}"
                                                                        class="form-control" placeholder="Customer"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="aplikasi" id="aplikasi"
                                                                        value="{{ isset($_GET['aplikasi']) ? $_GET['aplikasi'] : null }}"
                                                                        class="form-control" placeholder="Aplikasi"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4 mb-2">
                                                                    <div class="input-daterange input-group"
                                                                        id="datepicker6" data-date-format="yyyy-mm-dd"
                                                                        data-date-autoclose="true" data-provide="datepicker"
                                                                        data-date-container='#datepicker6'>
                                                                        <input type="text" class="form-control"
                                                                            name="tgl_start" id="tgl_start"
                                                                            value="{{ isset($_GET['tgl_start']) ? $_GET['tgl_start'] : null }}"
                                                                            placeholder="Tanggal " autocomplete="off" />
                                                                        <input type="text" class="form-control"
                                                                            name="tgl_end" id="tgl_end"
                                                                            value="{{ isset($_GET['tgl_end']) ? $_GET['tgl_end'] : null }}"
                                                                            placeholder="Tanggal" autocomplete="off" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <select class="form-control select select2 status2"
                                                                        name="status2" id="status2" style="width: 100%;">
                                                                        <option value=""> -- Status --</option>
                                                                        <option value="Belum Ditangani" <?php echo isset($_GET['status2']) && $_GET['status2'] == 'Belum Ditangani' ? 'selected' : ''; ?>>
                                                                            Belum Ditangani
                                                                        </option>
                                                                        <option value="On Hold" <?php echo isset($_GET['status2']) && $_GET['status2'] == 'On Hold' ? 'selected' : ''; ?>>
                                                                            On Hold
                                                                        </option>
                                                                        <option value="In Progress" <?php echo isset($_GET['status2']) && $_GET['status2'] == 'In Progress' ? 'selected' : ''; ?>>
                                                                            In Progress
                                                                        </option>
                                                                    </select>
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
                                                    <div class="row mt">
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
                                                            <a href="{{ route('hasil.index') }}"
                                                                class="btn btn-secondary w-md">Batal</a>
                                                            @if (isset($_GET['kode']) or isset($_GET['like']))
                                                                <?php
                                                                $kode = $_GET['kode'];
                                                                $customer = $_GET['customer'];
                                                                $aplikasi = $_GET['aplikasi'];
                                                                $status2 = $_GET['status2'];
                                                                $tgl_start = $_GET['tgl_start'];
                                                                $tgl_end = $_GET['tgl_end'];
                                                                $search_manual = $_GET['search_manual'];
                                                                if (isset($_GET['like'])) {
                                                                    $like = $_GET['like'];
                                                                } else {
                                                                    $like = null;
                                                                }
                                                                ?>
                                                                <a href="{{ route(
                                                                    'hasil.export_laporan',
                                                                    'kode=' .
                                                                        $kode .
                                                                        '&customer=' .
                                                                        $customer .
                                                                        '&aplikasi=' .
                                                                        $aplikasi .
                                                                        '&status2=' .
                                                                        $status2 .
                                                                        '&tgl_start=' .
                                                                        $tgl_start .
                                                                        '&tgl_end=' .
                                                                        $tgl_end .
                                                                        '&search_manual=' .
                                                                        $search_manual .
                                                                        '&like=' .
                                                                        $like .
                                                                        '',
                                                                ) }}"
                                                                    class="btn btn-success btn-rounded waves-effect waves-light w-md"><i
                                                                        class="bx bx-cloud-download me-1"></i>Unduh</a>
                                                            @else
                                                                <a href="{{ route('hasil.export_laporan') }}"
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

                            <table id="dataLaporan" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Customer</th>
                                        <th>Aplikasi</th>
                                        <th>Tgl Laporan</th>
                                        <th>Tgl Penanganan</th>
                                        <th>Status</th>
                                        {{-- <th>Aksi</th> --}}
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
    <script type="text/javascript">
        function toggleCheckbox() {
            like = document.getElementById("like").checked;
            if (like == true) {
                document.getElementById("kode").value = null;
                document.getElementById("customer").value = null;
                document.getElementById("aplikasi").value = null;
                document.getElementById("status2").value = null;
                document.getElementById("tgl_start").value = null;
                document.getElementById("tgl_end").value = null;
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
                document.getElementById("kode").value = null;
                document.getElementById("customer").value = null;
                document.getElementById("aplikasi").value = null;
                document.getElementById("status2").value = null;
                document.getElementById("tgl_start").value = null;
                document.getElementById("tgl_end").value = null;
                document.getElementById("id_where").style.display = 'none';
                document.getElementById("id_like").style.display = 'block';
            } else {
                document.getElementById("search_manual").value = null;
                document.getElementById("like").checked = false;
                document.getElementById("id_like").style.display = 'none';
                document.getElementById("id_where").style.display = 'block';
            }

            $('#dataLaporan').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                searching: false,
                ajax: {
                    url: "{{ route('cari_data_penanganan') }}",
                    data: function(d) {
                        d.kode = (document.getElementById("kode").value.length !=
                                0) ?
                            document
                            .getElementById(
                                "kode").value : null;
                        d.customer = (document.getElementById("customer").value.length != 0) ?
                            document
                            .getElementById(
                                "customer").value : null;
                        d.aplikasi = (document.getElementById("aplikasi").value.length != 0) ?
                            document
                            .getElementById(
                                "aplikasi").value : null;
                        d.status2 = (document.getElementById("status2").value.length != 0) ?
                            document
                            .getElementById(
                                "status2").value : null;
                        d.tgl_start = (document.getElementById("tgl_start").value.length != 0) ?
                            document
                            .getElementById(
                                "tgl_start").value : null;
                        d.tgl_end = (document.getElementById("tgl_end").value.length != 0) ? document
                            .getElementById(
                                "tgl_end").value : null;
                        d.like = (document.getElementById("like").value.length != 0) ? document
                            .getElementById(
                                "like").value : null;
                        d.search_manual = (document.getElementById("search_manual").value.length != 0) ?
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
                        data: 'kode',
                        name: 'kode'
                    },
                    {
                        data: 'customer',
                        name: 'customer'
                    },
                    {
                        data: 'aplikasi',
                        name: 'aplikasi'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'hasil_progres',
                        name: 'hasil_progres'
                    },
                ]
            });
        });
    </script>
@endsection
