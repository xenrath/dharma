<li class="nav-item">
    <a href="{{ url('operator') }}"
        class="nav-link rounded-0 {{ request()->is('operator') ? 'active' : 'bg-secondary' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
@php
    $proposal_list = \App\Models\Proposal::where('status', 'menunggu')->count();
    $proposal_pendanaan = \App\Models\Proposal::where(function ($query) {
        $query->where('status', 'setuju1');
        $query->orWhere('status', 'revisi2');
    })->count();
    $proposal_mou = \App\Models\Proposal::where('status', 'mou')->count();
    $penelitian = \App\Models\Penelitian::where('status', 'menunggu')->orWhere('status', 'revisi')->count();
    $pengabdian = \App\Models\Pengabdian::where('status', 'menunggu')->orWhere('status', 'revisi')->count();
@endphp
<li class="nav-header">Menu</li>
<li
    class="nav-item 
    {{ request()->is('operator/proposal-list*') ||
    request()->is('operator/proposal-jadwal*') ||
    request()->is('operator/proposal-pendanaan*') ||
    request()->is('operator/proposal-mou*') ||
    request()->is('operator/proposal-riwayat*')
        ? 'menu-open'
        : '' }}">
    <a href="#"
        class="nav-link 
        {{ request()->is('operator/proposal-list*') ||
        request()->is('operator/proposal-jadwal*') ||
        request()->is('operator/proposal-pendanaan*') ||
        request()->is('operator/proposal-mou*') ||
        request()->is('operator/proposal-riwayat*')
            ? 'active'
            : '' }} rounded-0">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
            Menu Proposal
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('operator/proposal-list') }}"
                class="nav-link rounded-0 {{ request()->is('operator/proposal-list*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Data Proposal
                    @if ($proposal_list)
                        <span class="right badge badge-info rounded-0">{{ $proposal_list }}</span>
                    @endif
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('operator/proposal-jadwal') }}"
                class="nav-link rounded-0 {{ request()->is('operator/proposal-jadwal*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Jadwal Proposal
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('operator/proposal-pendanaan') }}"
                class="nav-link rounded-0 {{ request()->is('operator/proposal-pendanaan*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Pendanaan Proposal
                    @if ($proposal_pendanaan)
                        <span class="right badge badge-info rounded-0">{{ $proposal_pendanaan }}</span>
                    @endif
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('operator/proposal-mou') }}"
                class="nav-link rounded-0 {{ request()->is('operator/proposal-mou*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    MOU Proposal
                    @if ($proposal_mou)
                        <span class="right badge badge-info rounded-0">{{ $proposal_mou }}</span>
                    @endif
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('operator/proposal-riwayat') }}"
                class="nav-link rounded-0 {{ request()->is('operator/proposal-riwayat*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Riwayat Proposal
                </p>
            </a>
        </li>
    </ul>
</li>
<li
    class="nav-item {{ request()->is('operator/penelitian-list*') || request()->is('operator/penelitian-riwayat*') ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ request()->is('operator/penelitian-list*') || request()->is('operator/penelitian-riwayat*') ? 'active' : '' }} rounded-0">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
            Menu Penelitian
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('operator/penelitian-list') }}"
                class="nav-link rounded-0 {{ request()->is('operator/penelitian-list*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Data Penelitian
                    @if ($penelitian)
                        <span class="right badge badge-info rounded-0">{{ $penelitian }}</span>
                    @endif
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('operator/penelitian-riwayat') }}"
                class="nav-link rounded-0 {{ request()->is('operator/penelitian-riwayat*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Arsip Penelitian
                </p>
            </a>
        </li>
    </ul>
</li>
<li
    class="nav-item {{ request()->is('operator/pengabdian-list*') || request()->is('operator/pengabdian-riwayat*') ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ request()->is('operator/pengabdian-list*') || request()->is('operator/pengabdian-riwayat*') ? 'active' : '' }} rounded-0">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
            Menu Pengabdian
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('operator/pengabdian-list') }}"
                class="nav-link rounded-0 {{ request()->is('operator/pengabdian-list*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Data Pengabdian
                    @if ($pengabdian)
                        <span class="right badge badge-info rounded-0">{{ $pengabdian }}</span>
                    @endif
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('operator/pengabdian-riwayat') }}"
                class="nav-link rounded-0 {{ request()->is('operator/pengabdian-riwayat*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Arsip Pengabdian
                </p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-header">Lainnya</li>
<li class="nav-item">
    <a href="{{ url('operator/jurnal') }}"
        class="nav-link rounded-0 {{ request()->is('operator/jurnal*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Publikasi Jurnal</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('operator/buku') }}"
        class="nav-link rounded-0 {{ request()->is('operator/buku*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Buku Ajar</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('operator/makalah') }}"
        class="nav-link rounded-0 {{ request()->is('operator/makalah*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Pemakalah Forum Ilmiah
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('operator/hki') }}" class="nav-link rounded-0 {{ request()->is('operator/hki*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            HKI
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('operator/luaran') }}"
        class="nav-link rounded-0 {{ request()->is('operator/luaran*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Luaran Lain
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('operator/dosen') }}"
        class="nav-link rounded-0 {{ request()->is('operator/dosen*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>Data Dosen</p>
    </a>
</li>
