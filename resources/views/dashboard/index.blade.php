@extends('layouts.main')
@section('apotekku')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $title }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                                <li class="breadcrumb-item active">File Manager</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="d-xl-flex">
                <div class="w-100">
                    <div class="d-md-flex">
                        <div class="card filemanager-sidebar me-md-2">
                            <div class="card-body">

                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4">

                                        <ul class="list-unstyled categories-list">
                                            <li>
                                                <div class="custom-accordion">
                                                    <a class="text-body fw-medium py-1 d-flex align-items-center"
                                                        data-bs-toggle="collapse" href="#categories-collapse" role="button"
                                                        aria-expanded="false" aria-controls="categories-collapse">
                                                        <i class="mdi mdi-folder font-size-16 text-warning me-2"></i> Files
                                                        <i class="mdi mdi-chevron-up accor-down-icon ms-auto"></i>
                                                    </a>
                                                    <div class="collapse show" id="categories-collapse">
                                                        <div class="card border-0 shadow-none ps-2 mb-0">
                                                            <ul class="list-unstyled mb-0">
                                                                <li><a href="javascript: void(0);"
                                                                        class="d-flex align-items-center"><span
                                                                            class="me-auto">Design</span></a></li>
                                                                <li><a href="javascript: void(0);"
                                                                        class="d-flex align-items-center"><span
                                                                            class="me-auto">Development</span> <i
                                                                            class="mdi mdi-pin ms-auto"></i></a></li>
                                                                <li><a href="javascript: void(0);"
                                                                        class="d-flex align-items-center"><span
                                                                            class="me-auto">Project A</span></a></li>
                                                                <li><a href="javascript: void(0);"
                                                                        class="d-flex align-items-center"><span
                                                                            class="me-auto">Admin</span> <i
                                                                            class="mdi mdi-pin ms-auto"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript: void(0);" class="text-body d-flex align-items-center">
                                                    <i class="mdi mdi-google-drive font-size-16 text-muted me-2"></i> <span
                                                        class="me-auto">Google Drive</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript: void(0);" class="text-body d-flex align-items-center">
                                                    <i class="mdi mdi-dropbox font-size-16 me-2 text-primary"></i> <span
                                                        class="me-auto">Dropbox</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript: void(0);" class="text-body d-flex align-items-center">
                                                    <i class="mdi mdi-share-variant font-size-16 me-2"></i> <span
                                                        class="me-auto">Shared</span> <i
                                                        class="mdi mdi-circle-medium text-danger ms-2"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript: void(0);" class="text-body d-flex align-items-center">
                                                    <i class="mdi mdi-star-outline text-muted font-size-16 me-2"></i> <span
                                                        class="me-auto">Starred</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript: void(0);" class="text-body d-flex align-items-center">
                                                    <i class="mdi mdi-trash-can text-danger font-size-16 me-2"></i> <span
                                                        class="me-auto">Trash</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript: void(0);" class="text-body d-flex align-items-center">
                                                    <i class="mdi mdi-cog text-muted font-size-16 me-2"></i> <span
                                                        class="me-auto">Setting</span><span
                                                        class="badge bg-success rounded-pill ms-2">01</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- filemanager-leftsidebar -->

                        <div class="w-100">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <div class="row mb-3">
                                            <div class="col-xl-3 col-sm-6">
                                                <div class="mt-2">
                                                    <h5>My Files</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl-9 col-sm-6">
                                                <form class="mt-4 mt-sm-0 float-sm-end d-flex align-items-center">
                                                    <div class="search-box mb-2 me-2">
                                                        <div class="position-relative">
                                                            <input type="text"
                                                                class="form-control bg-light border-light rounded"
                                                                placeholder="Search...">
                                                            <i class="bx bx-search-alt search-icon"></i>
                                                        </div>
                                                    </div>

                                                    <div class="dropdown mb-0">
                                                        <a class="btn btn-link text-muted mt-n2" role="button"
                                                            data-bs-toggle="dropdown" aria-haspopup="true">
                                                            <i class="mdi mdi-dots-vertical font-size-20"></i>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Share Files</a>
                                                            <a class="dropdown-item" href="#">Share with me</a>
                                                            <a class="dropdown-item" href="#">Other Actions</a>
                                                        </div>
                                                    </div>


                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="row">
                                            <div class="col-xl-4 col-sm-6">
                                                <div class="card shadow-none border">
                                                    <div class="card-body p-3">
                                                        <div class="">
                                                            <div class="float-end ms-2">
                                                                <div class="dropdown mb-2">
                                                                    <a class="font-size-16 text-muted" role="button"
                                                                        data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="avatar-xs me-3 mb-3">
                                                                <div class="avatar-title bg-transparent rounded">
                                                                    <i class="bx bxs-folder font-size-24 text-warning"></i>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="overflow-hidden me-auto">
                                                                    <h5 class="font-size-14 text-truncate mb-1"><a
                                                                            href="javascript: void(0);"
                                                                            class="text-body">Users</a></h5>
                                                                    <p class="text-muted text-truncate mb-0">12 Files</p>
                                                                </div>
                                                                <div class="align-self-end ms-2">
                                                                    <p class="text-muted mb-0">6GB</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- end col -->

                                            <div class="col-xl-4 col-sm-6">
                                                <div class="card shadow-none border">
                                                    <div class="card-body p-3">
                                                        <div class="">
                                                            <div class="float-end ms-2">
                                                                <div class="dropdown mb-2">
                                                                    <a class="font-size-16 text-muted" role="button"
                                                                        data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="avatar-xs me-3 mb-3">
                                                                <div class="avatar-title bg-transparent rounded">
                                                                    <i class="bx bxs-folder font-size-24 text-warning"></i>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="overflow-hidden me-auto">
                                                                    <h5 class="font-size-14 text-truncate mb-1"><a
                                                                            href="javascript: void(0);"
                                                                            class="text-body">Pembelian</a></h5>
                                                                    <p class="text-muted text-truncate mb-0">20 Files</p>
                                                                </div>
                                                                <div class="align-self-end ms-2">
                                                                    <p class="text-muted mb-0">8GB</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- end col -->

                                            <div class="col-xl-4 col-sm-6">
                                                <div class="card shadow-none border">
                                                    <div class="card-body p-3">
                                                        <div class="">
                                                            <div class="float-end ms-2">
                                                                <div class="dropdown mb-2">
                                                                    <a class="font-size-16 text-muted" role="button"
                                                                        data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="avatar-xs me-3 mb-3">
                                                                <div class="avatar-title bg-transparent rounded">
                                                                    <i class="bx bxs-folder font-size-24 text-warning"></i>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="overflow-hidden me-auto">
                                                                    <h5 class="font-size-14 text-truncate mb-1"><a
                                                                            href="javascript: void(0);"
                                                                            class="text-body">Penjualan
                                                                        </a></h5>
                                                                    <p class="text-muted text-truncate mb-0">06 Files</p>
                                                                </div>
                                                                <div class="align-self-end ms-2">
                                                                    <p class="text-muted mb-0">2GB</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- end col -->

                                            <div class="col-xl-4 col-sm-6">
                                                <div class="card shadow-none border">
                                                    <div class="card-body p-3">
                                                        <div class="">
                                                            <div class="float-end ms-2">
                                                                <div class="dropdown mb-2">
                                                                    <a class="font-size-16 text-muted" role="button"
                                                                        data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="avatar-xs me-3 mb-3">
                                                                <div class="avatar-title bg-transparent rounded">
                                                                    <i class="bx bxs-folder font-size-24 text-warning"></i>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="overflow-hidden me-auto">
                                                                    <h5 class="font-size-14 text-truncate mb-1"><a
                                                                            href="javascript: void(0);"
                                                                            class="text-body">Admin</a></h5>
                                                                    <p class="text-muted text-truncate mb-0">08 Files</p>
                                                                </div>
                                                                <div class="align-self-end ms-2">
                                                                    <p class="text-muted mb-0">4GB</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- end col -->

                                            <div class="col-xl-4 col-sm-6">
                                                <div class="card shadow-none border">
                                                    <div class="card-body p-3">
                                                        <div class="">
                                                            <div class="float-end ms-2">
                                                                <div class="dropdown mb-2">
                                                                    <a class="font-size-16 text-muted" role="button"
                                                                        data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="avatar-xs me-3 mb-3">
                                                                <div class="avatar-title bg-transparent rounded">
                                                                    <i class="bx bxs-folder font-size-24 text-warning"></i>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="overflow-hidden me-auto">
                                                                    <h5 class="font-size-14 text-truncate mb-1"><a
                                                                            href="javascript: void(0);"
                                                                            class="text-body">Sketch
                                                                            Design</a></h5>
                                                                    <p class="text-muted text-truncate mb-0">12 Files</p>
                                                                </div>
                                                                <div class="align-self-end ms-2">
                                                                    <p class="text-muted mb-0">6GB</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- end col -->

                                            <div class="col-xl-4 col-sm-6">
                                                <div class="card shadow-none border">
                                                    <div class="card-body p-3">
                                                        <div class="">
                                                            <div class="float-end ms-2">
                                                                <div class="dropdown mb-2">
                                                                    <a class="font-size-16 text-muted" role="button"
                                                                        data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="avatar-xs me-3 mb-3">
                                                                <div class="avatar-title bg-transparent rounded">
                                                                    <i class="bx bxs-folder font-size-24 text-warning"></i>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="overflow-hidden me-auto">
                                                                    <h5 class="font-size-14 text-truncate mb-1"><a
                                                                            href="javascript: void(0);"
                                                                            class="text-body">Applications</a></h5>
                                                                    <p class="text-muted text-truncate mb-0">20 Files</p>
                                                                </div>
                                                                <div class="align-self-end ms-2">
                                                                    <p class="text-muted mb-0">8GB</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- end col -->

                                        </div>
                                        <!-- end row -->
                                    </div>


                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end w-100 -->
                    </div>
                </div>

                <div class="card filemanager-sidebar ms-lg-2">
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="font-size-15 mb-4">Data Menu</h5>
                            <div class="apex-charts" id="radial-chart"></div>

                            <p class="text-muted mt-4">48.02 GB (76%) of 64 GB used</p>
                        </div>

                        <div class="mt-4">
                            <div class="card border shadow-none mb-2">
                                <a href="javascript: void(0);" class="text-body">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-success font-size-20">
                                                    <i class="mdi mdi-account-key"></i>
                                                </div>
                                            </div>

                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-size-13 text-truncate mb-1">Users</h5>
                                                <p class="text-muted text-truncate mb-0">{{ $user_jumlah }} Data</p>
                                            </div>

                                            <div class="ms-2">
                                                <p class="text-muted">{{ $total_roles->total_roles }} Roles</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="card border shadow-none mb-2">
                                <a href="javascript: void(0);" class="text-body">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-danger font-size-20">
                                                    <i class="mdi mdi-application-import"></i>
                                                </div>
                                            </div>

                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-size-13 text-truncate mb-1">Supplier</h5>
                                                <p class="text-muted text-truncate mb-0">{{ $supplier_jumlah }} Data</p>
                                            </div>

                                            <div class="ms-2">
                                                <p class="text-muted">4.1 GB</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="card border shadow-none mb-2">
                                <a href="javascript: void(0);" class="text-body">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-info font-size-20">
                                                    <i class="mdi mdi-animation"></i>
                                                </div>
                                            </div>

                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-size-13 text-truncate mb-1">Satuan</h5>
                                                <p class="text-muted text-truncate mb-0">{{ $satuan_jumlah }} Data</p>
                                            </div>

                                            <div class="ms-2">
                                                <p class="text-muted">3.2 GB</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="card border shadow-none mb-2">
                                <a href="javascript: void(0);" class="text-body">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-primary font-size-20">
                                                    <i class="mdi mdi-file-document"></i>
                                                </div>
                                            </div>

                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-size-13 text-truncate mb-1">Produk</h5>
                                                <p class="text-muted text-truncate mb-0">{{ $produk_jumlah }} Data</p>
                                            </div>

                                            <div class="ms-2">
                                                <p class="text-muted">2 GB</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="card border shadow-none">
                                <a href="javascript: void(0);" class="text-body">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-warning font-size-20">
                                                    <i class="mdi mdi-account-reactivate"></i>
                                                </div>
                                            </div>

                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-size-13 text-truncate mb-1">Customer</h5>
                                                <p class="text-muted text-truncate mb-0">{{ $pelanggan_jumlah }} Data</p>
                                            </div>

                                            <div class="ms-2">
                                                <p class="text-muted">1.4 GB</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
