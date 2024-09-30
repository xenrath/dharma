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
<li class="nav-item">
    <a href="{{ url('dosen/proposal') }}"
        class="nav-link rounded-0 {{ request()->is('dosen/proposal*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Data Proposal
        </p>
    </a>
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
@if (auth()->user()->isKetua())
    @php
        $ketua_proposal = \App\Models\Proposal::where('status', 'pendanaan')->count();
    @endphp
    <li class="nav-header">Menu Ka. LPPM</li>
    <li class="nav-item">
        <a href="{{ url('dosen/ketua/proposal') }}"
            class="nav-link rounded-0 {{ request()->is('dosen/ketua/proposal*') ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
                Data Proposal
                @if ($ketua_proposal)
                    <span class="right badge badge-info rounded-0">{{ $ketua_proposal }}</span>
                @endif
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('dosen/ketua/riwayat') }}"
            class="nav-link rounded-0 {{ request()->is('dosen/ketua/riwayat*') ? 'active' : '' }}">
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
