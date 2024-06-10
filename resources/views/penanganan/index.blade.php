@extends('layouts.main')
@section('apotekku')
    <?php $session_menu = explode(',', Auth::user()->submenu); ?>
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
                                @if (in_array('18', $session_menu))
                                    <a href="{{ route('pelaporan.create') }}" type="button"
                                        class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-plus me-1"></i> Tambah
                                    </a>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Lapor</th>
                                        <th>ID RTL</th>
                                        <th>Kode Lapor</th>
                                        <th>Kode RTL</th>
                                        <th>Customer</th>
                                        <th>Aplikasi</th>
                                        <th>Status Progres</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tangani as $lapor)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $lapor->lapor_id }}</td>
                                            <td>{{ $lapor->tangani_id }}</td>
                                            <td>{{ $lapor->kode }}</td>
                                            <td>{{ $lapor->kode_penanganan }}</td>
                                            <td>{{ $lapor->customer }}</td>
                                            <td>{{ $lapor->aplikasi }}</td>
                                            <td>{{ $lapor->progres }}</td>
                                            {{-- <td>{{ $lapor->customer->nama }}</td>
                                            <td>{{ $lapor->aplikasi->nama }}</td>
                                            <td>{{ $lapor->progres }}</td> --}}
                                            <td>
                                                <form class="delete-form"
                                                    action="{{ route('penanganan.destroy', Crypt::encryptString($lapor->tangani_id)) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="d-flex gap-3">
                                                        @if (in_array('23', $session_menu))
                                                            <a href="{{ route('penanganan.edit', Crypt::encryptString($lapor->tangani_id)) }}"
                                                                class="text-success"><i
                                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                                        @endif
                                                        @if (in_array('21', $session_menu))
                                                            <a href="{{ route('pelaporan.show', Crypt::encryptString($lapor->lapor_id)) }}"
                                                                class="text-primary"><i
                                                                    class="mdi mdi-eye font-size-18"></i></a>
                                                        @endif
                                                        @if (in_array('24', $session_menu))
                                                            <a href class="text-danger delete_confirm"><i
                                                                    class="mdi mdi-delete font-size-18"></i></a>
                                                        @endif
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
