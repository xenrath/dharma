<li class="nav-item">
    <a href="{{ url('dosen') }}" class="nav-link rounded-0 {{ request()->is('dosen') ? 'active' : 'bg-secondary' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-header">Menu</li>
<li class="nav-item">
    <a href="{{ url('dosen/proposal-penelitian') }}"
        class="nav-link rounded-0 {{ request()->is('dosen/proposal-penelitian*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Proposal Penelitian
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dosen/proposal-pengabdian') }}"
        class="nav-link rounded-0 {{ request()->is('dosen/proposal-pengabdian*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Proposal Pengabdian
        </p>
    </a>
</li>
<li class="nav-header">
    <hr class="m-0 bg-light">
</li>
<li class="nav-item">
    <a href="{{ url('dosen/penelitian') }}"
        class="nav-link rounded-0 {{ request()->is('dosen/penelitian*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Data Penelitian
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dosen/pengabdian') }}"
        class="nav-link rounded-0 {{ request()->is('dosen/pengabdian*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Data Pengabdian
        </p>
    </a>
</li>
