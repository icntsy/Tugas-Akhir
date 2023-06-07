<ul class="vertical-nav-menu">
    <li class="app-sidebar__heading">Dashboard</li>
    <li>
        <a href="{{ route('home') }}" class="@if (Request::is('/')) mm-active @endif">
            <i class="metismenu-icon fa fa-home" aria-hidden="true"></i>
            {{-- <i class="metismenu-icon fa fa-home"></i> --}}
            Home
        </a>
    </li>
    <li class="app-sidebar__heading">Data Antrian</li>
    <li>
        <a href="{{ route('queue.index') }}" class="@if (Request::is('antrian*')) mm-active @endif">

            <i class="metismenu-icon fa fa-clipboard" aria-hidden="true"></i>
            Antrian Periksa
        </a>
    </li>
    <li class="app-sidebar__heading">Data Pemeriksaan</li>
    <li>
        <a href="{{ route('history.index') }}" class="@if (Request::is('history*')) mm-active @endif">
            <i class="metismenu-icon fa fa-medkit" aria-hidden="true"></i>
            Pemeriksaan ANC
        </a>
    </li>
    {{-- <li>
        <a href="{{ route('pregnantmom.index') }}" class="@if (Request::is('ibu-hamil*')) mm-active @endif">
            <i class="metismenu-icon fa fa-portrait"></i>
            Data Ibu Hamil
        </a>
    </li> --}}
    {{-- <li>
        <a href="">
            <i class="metismenu-icon fa fa-clipboard-list"></i>
            Data Rekam Medis
        </a>
    </li> --}}
    <li class="app-sidebar__heading">Data Master</li>
    <li>
        <a href="{{ route('immunization.index') }}" class="@if (Request::is('imunisasi*')) mm-active @endif">
            <i class="metismenu-icon fa fa-clipboard"></i>
            Data Imunisasi
        </a>
    </li>

    <li>
        <a href="{{ route('familyplanning.index') }}" class="@if (Request::is('keluargaberencana*')) mm-active @endif">
            <i class="metismenu-icon fa fa-clipboard-list"></i>
            Data Keluarga Berencana
        </a>
    </li>
    </ul>
