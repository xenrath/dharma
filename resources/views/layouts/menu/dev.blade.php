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
<li class="nav-header">Lainnya</li>
<li class="nav-item">
    <a href="{{ url('dev/user') }}" class="nav-link rounded-0 {{ request()->is('dev/user*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data User</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dev/fakultas') }}" class="nav-link rounded-0 {{ request()->is('dev/fakultas*') ? 'active' : '' }}">
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
