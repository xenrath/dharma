<li class="nav-item">
    <a href="{{ url('dev') }}" class="nav-link rounded-0 {{ request()->is('dev') ? 'active' : 'bg-secondary' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-header">Menu</li>
<li class="nav-item">
    <a href="{{ url('dev/proposal') }}" class="nav-link rounded-0 {{ request()->is('dev/proposal*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Data Proposal
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dev/penelitian') }}"
        class="nav-link rounded-0 {{ request()->is('dev/penelitian*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Data Penelitian
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dev/pengabdian') }}"
        class="nav-link rounded-0 {{ request()->is('dev/pengabdian*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Data Pengabdian
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dev/jurnal') }}" class="nav-link rounded-0 {{ request()->is('dev/jurnal*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Publikasi Jurnal
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dev/buku') }}" class="nav-link rounded-0 {{ request()->is('dev/buku*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Buku Ajar / Teks
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dev/makalah') }}" class="nav-link rounded-0 {{ request()->is('dev/makalah*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Makalah Ilmiah
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dev/hki') }}" class="nav-link rounded-0 {{ request()->is('dev/hki*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            HKI
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dev/luaran') }}" class="nav-link rounded-0 {{ request()->is('dev/luaran*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Luaran Lain
        </p>
    </a>
</li>
<li class="nav-header">Lainnya</li>
<li class="nav-item">
    <a href="{{ url('dev/user') }}" class="nav-link rounded-0 {{ request()->is('dev/user*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data User</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dev/fakultas') }}"
        class="nav-link rounded-0 {{ request()->is('dev/fakultas*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data Fakultas</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dev/prodi') }}" class="nav-link rounded-0 {{ request()->is('dev/prodi*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data Prodi</p>
    </a>
</li>
<li
    class="nav-item {{ request()->is('dev/jenis-penelitian*') || request()->is('dev/jenis-pengabdian*') || request()->is('dev/jenis-pendanaan*') || request()->is('dev/jenis-jurnal*') || request()->is('dev/jenis-hki*') || request()->is('dev/jenis-luaran*') ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ request()->is('dev/jenis-penelitian*') || request()->is('dev/jenis-pengabdian*') || request()->is('dev/jenis-pendanaan*') || request()->is('dev/jenis-jurnal*') || request()->is('dev/jenis-hki*') || request()->is('dev/jenis-luaran*') ? 'active' : '' }} rounded-0">
        <i class="nav-icon fas fa-list"></i>
        <p>
            Data Jenis
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('dev/jenis-penelitian') }}"
                class="nav-link rounded-0 {{ request()->is('dev/jenis-penelitian*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Jenis Penelitian</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('dev/jenis-pengabdian') }}"
                class="nav-link rounded-0 {{ request()->is('dev/jenis-pengabdian*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Jenis Pengabdian</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('dev/jenis-pendanaan') }}"
                class="nav-link rounded-0 {{ request()->is('dev/jenis-pendanaan*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Jenis Pendanaan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('dev/jenis-jurnal') }}"
                class="nav-link rounded-0 {{ request()->is('dev/jenis-jurnal*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Jenis Jurnal</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('dev/jenis-hki') }}"
                class="nav-link rounded-0 {{ request()->is('dev/jenis-hki*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Jenis HKI</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('dev/jenis-luaran') }}"
                class="nav-link rounded-0 {{ request()->is('dev/jenis-luaran*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Jenis Luaran</p>
            </a>
        </li>
    </ul>
</li>
