<li class="nav-item">
    <a href="{{ url('operator') }}"
        class="nav-link rounded-0 {{ request()->is('operator') ? 'active' : 'bg-secondary' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-header">Menu</li>
<li class="nav-item">
    <a href="{{ url('operator/proposal-penelitian') }}"
        class="nav-link rounded-0 {{ request()->is('operator/proposal-penelitian*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Proposal Penelitian
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('operator/proposal-pengabdian') }}"
        class="nav-link rounded-0 {{ request()->is('operator/proposal-pengabdian*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Proposal Pengabdian
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('operator/proposal-laporan') }}"
        class="nav-link rounded-0 {{ request()->is('operator/proposal-laporan*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Laporan Proposal
        </p>
    </a>
</li>
<li class="nav-header">
    <hr class="m-0 bg-light">
</li>
<li class="nav-item">
    <a href="{{ url('operator/penelitian') }}"
        class="nav-link rounded-0 {{ request()->is('operator/penelitian*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Data Penelitian
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('operator/pengabdian') }}"
        class="nav-link rounded-0 {{ request()->is('operator/pengabdian*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Data Pengabdian
        </p>
    </a>
</li>
<li class="nav-header">Lainnya</li>
<li class="nav-item">
    <a href="{{ url('operator/dosen') }}"
        class="nav-link rounded-0 {{ request()->is('operator/dosen*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data Dosen</p>
    </a>
</li>
