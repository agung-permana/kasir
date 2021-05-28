<li class="nav-item {{ Request::is('home') ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>
@if (Auth::user()->hasRole('owner'))
    <li class="nav-item {{ Request::is('kategori') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('kategori') }}">
        <i class="fas fa-fw fa-th"></i>
        <span>Kategori</span></a>
    </li>

    <li class="nav-item {{ Request::is('produk') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('produk') }}">
        <i class="fas fa-fw fa-utensils"></i>
        <span>Produk</span></a>
    </li>

    <li class="nav-item {{ Request::is('penjualan') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('penjualan') }}">
        <i class="fas fa-fw fa-money-bill"></i>
        <span>Penjualan</span></a>
    </li>

    <li class="nav-item {{ Request::is('laporan') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('laporan') }}">
        <i class="fas fa-fw fa-file-alt"></i>
        <span>Laporan</span></a>
    </li>

    <li class="nav-item {{ Request::is('profile') ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('profile') }}">
        <i class="fas fa-fw fa-user-cog"></i>
        <span>Pengaturan</span></a>
    </li>
@endif
