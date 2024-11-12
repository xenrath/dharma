<li class="nav-item">
    <a href="{{ url('dosen') }}" class="nav-link rounded-0 {{ request()->is('dosen') ? 'active' : 'bg-secondary' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-header">
    Menu
    @if (auth()->user()->isKetua() || auth()->user()->isPeninjau())
        Dosen
    @endif
</li>
<li
    class="nav-item {{ request()->is('dosen/proposal-list*') || request()->is('dosen/proposal-riwayat*') ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ request()->is('dosen/proposal-list*') || request()->is('dosen/proposal-riwayat*') ? 'active' : '' }} rounded-0">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
            Menu Proposal
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('dosen/proposal-list') }}"
                class="nav-link rounded-0 {{ request()->is('dosen/proposal-list*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Data Proposal
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('dosen/proposal-riwayat') }}"
                class="nav-link rounded-0 {{ request()->is('dosen/proposal-riwayat*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Riwayat Proposal
                </p>
            </a>
        </li>
    </ul>
</li>
<li
    class="nav-item {{ request()->is('dosen/penelitian-list*') || request()->is('dosen/penelitian-riwayat*') ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ request()->is('dosen/penelitian-list*') || request()->is('dosen/penelitian-riwayat*') ? 'active' : '' }} rounded-0">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
            Menu Penelitian
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('dosen/penelitian-list') }}"
                class="nav-link rounded-0 {{ request()->is('dosen/penelitian-list*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Data Penelitian
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('dosen/penelitian-riwayat') }}"
                class="nav-link rounded-0 {{ request()->is('dosen/penelitian-riwayat*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Riwayat Penelitian
                </p>
            </a>
        </li>
    </ul>
</li>
<li
    class="nav-item {{ request()->is('dosen/pengabdian-list*') || request()->is('dosen/pengabdian-riwayat*') ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ request()->is('dosen/pengabdian-list*') || request()->is('dosen/pengabdian-riwayat*') ? 'active' : '' }} rounded-0">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
            Menu Pengabdian
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ url('dosen/pengabdian-list') }}"
                class="nav-link rounded-0 {{ request()->is('dosen/pengabdian-list*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Data Pengabdian
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('dosen/pengabdian-riwayat') }}"
                class="nav-link rounded-0 {{ request()->is('dosen/pengabdian-riwayat*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    Riwayat Pengabdian
                </p>
            </a>
        </li>
    </ul>
</li>
@if (auth()->user()->isKetua())
    @php
        $proposal_pendanaan = \App\Models\Proposal::where('status', 'pendanaan')->count();
        $proposal_mou = \App\Models\Proposal::where('status', 'setuju2')->count();
    @endphp
    <li class="nav-header">Menu Ka. LPPM</li>
    <li class="nav-item">
        <a href="{{ url('dosen/ketua/proposal-pendanaan') }}"
            class="nav-link rounded-0 {{ request()->is('dosen/ketua/proposal-pendanaan*') ? 'active' : '' }}">
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
        <a href="{{ url('dosen/ketua/proposal-mou') }}"
            class="nav-link rounded-0 {{ request()->is('dosen/ketua/proposal-mou*') ? 'active' : '' }}">
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
        <a href="{{ url('dosen/ketua/proposal-riwayat') }}"
            class="nav-link rounded-0 {{ request()->is('dosen/ketua/proposal-riwayat*') ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
                Riwayat Proposal
            </p>
        </a>
    </li>
@endif
@if (auth()->user()->isPeninjau())
    @php
        $proposal_review = \App\Models\Proposal::where([
            ['status', 'proses'],
            ['peninjau_id', auth()->user()->id],
            ['jadwal_id', '!=', null],
        ])->count();
        $proposal_revisi = \App\Models\Proposal::where([
            ['peninjau_id', auth()->user()->id],
            ['status', 'revisi1'],
        ])->count();
    @endphp
    <li class="nav-header">Menu Reviewer</li>
    <li class="nav-item">
        <a href="{{ url('dosen/peninjau/review') }}"
            class="nav-link rounded-0 {{ request()->is('dosen/peninjau/review*') ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
                Data Review
                @if ($proposal_review)
                    <span class="right badge badge-info rounded-0">{{ $proposal_review }}</span>
                @endif
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('dosen/peninjau/revisi') }}"
            class="nav-link rounded-0 {{ request()->is('dosen/peninjau/revisi*') ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
                Data Revisi
                @if ($proposal_revisi)
                    <span class="right badge badge-info rounded-0">{{ $proposal_revisi }}</span>
                @endif
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('dosen/peninjau/riwayat') }}"
            class="nav-link rounded-0 {{ request()->is('dosen/peninjau/riwayat*') ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
                Riwayat Review
            </p>
        </a>
    </li>
@endif
<li class="nav-header">
    Lainnya
</li>
<li class="nav-item">
    <a href="{{ url('dosen/jurnal') }}"
        class="nav-link rounded-0 {{ request()->is('dosen/jurnal*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Publikasi Jurnal
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dosen/buku') }}" class="nav-link rounded-0 {{ request()->is('dosen/buku*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Buku Ajar
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dosen/makalah') }}"
        class="nav-link rounded-0 {{ request()->is('dosen/makalah*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Pemakalah Forum Ilmiah
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dosen/hki') }}" class="nav-link rounded-0 {{ request()->is('dosen/hki*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            HKI
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('dosen/luaran') }}"
        class="nav-link rounded-0 {{ request()->is('dosen/luaran*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Luaran Lain
        </p>
    </a>
</li>
