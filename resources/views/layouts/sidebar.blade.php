<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end">Apotek
                            01</span>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <li class="menu-title" key="t-apps">Apps</li>
                <li>
                    <a href="{{ route('pengguna.profil') }}" class="waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-calendar">Profil User</span>
                    </a>
                </li>
                @if (Auth::user()->roles == 'Administrator')
                    <li>
                        <a href="" class="waves-effect">
                            <i class="bx bx-list-ul"></i>
                            <span key="bx bx-list-ul">List User</span>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-ecommerce">Master Data</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if (Auth::user()->roles == 'Administrator')
                            <li><a href="{{ route('supplier.index') }}" key="t-products">Supplier</a></li>
                            <li><a href="{{ route('jenis.index') }}" key="t-product-detail">Jenis</a></li>
                            <li><a href="{{ route('obat.index') }}" key="t-product-detail">Obat</a></li>
                            <li><a href="{{ route('pelanggan.index') }}" key="t-product-detail">Pelanggan</a></li>
                        @endif
                        {{-- <li><a href="#" key="t-orders">Voting</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-log-in-circle"></i>
                        <span key="t-file-manager">Pembelian</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('pembelian.index') }}" key="t-product-detail">Pembelian</a>
                        </li>
                        {{-- <li><a href="" key="t-products">Retur Pembelian</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-dollar"></i>
                        <span key="t-ecommerce">Penjualan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="" key="t-products">Kegiatan</a></li>
                        <li><a href="" key="t-products">Pembina</a></li>
                        <li><a href="" key="t-product-detail">Jadwal</a></li>
                        <li><a href="" key="t-orders">Ikuti</a></li>
                        <li><a href="" key="t-orders">Daftar Kegiatan</a>
                        </li>
                        <li><a href="" key="t-orders">Absensi</a></li>
                        <li><a href="" key="t-orders">Absen Mandiri</a></li>
                        <li><a href="" key="t-orders">Data Absensi</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-receipt"></i>
                        <span key="t-ecommerce">Laporan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="" key="t-products">Laporan Pembelian</a></li>
                        <li><a href="" key="t-products">Laporan Penjualan</a></li>
                        <li><a href="" key="t-product-detail">Jadwal</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
