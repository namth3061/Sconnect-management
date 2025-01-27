<li class="nav-item static-item">
    <a class="nav-link static-item disabled" href="#" tabindex="-1">
        <span class="default-icon">{{ __('config_assetment.assets') }}</span>
        <span class="mini-icon">-</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link " data-bs-toggle="collapse" href="#sidebar-asset" role="button" aria-expanded="false"
       aria-controls="sidebar-asset">
        <i class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 512 512">
                <path d="M184 0c30.9 0 56 25.1 56 56l0 400c0 30.9-25.1 56-56 56c-28.9 0-52.7-21.9-55.7-50.1c-5.2 1.4-10.7 2.1-16.3 2.1c-35.3 0-64-28.7-64-64c0-7.4 1.3-14.6 3.6-21.2C21.4 367.4 0 338.2 0 304c0-31.9 18.7-59.5 45.8-72.3C37.1 220.8 32 207 32 192c0-30.7 21.6-56.3 50.4-62.6C80.8 123.9 80 118 80 112c0-29.9 20.6-55.1 48.3-62.1C131.3 21.9 155.1 0 184 0zM328 0c28.9 0 52.6 21.9 55.7 49.9c27.8 7 48.3 32.1 48.3 62.1c0 6-.8 11.9-2.4 17.4c28.8 6.2 50.4 31.9 50.4 62.6c0 15-5.1 28.8-13.8 39.7C493.3 244.5 512 272.1 512 304c0 34.2-21.4 63.4-51.6 74.8c2.3 6.6 3.6 13.8 3.6 21.2c0 35.3-28.7 64-64 64c-5.6 0-11.1-.7-16.3-2.1c-3 28.2-26.8 50.1-55.7 50.1c-30.9 0-56-25.1-56-56l0-400c0-30.9 25.1-56 56-56z"/>
            </svg>
        </i>
        <span class="item-name">{{ __('config_assetment.sidebar.config_assetment.title') }}</span>
        <i class="right-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </i>
    </a>
    <ul class="sub-nav collapse" id="sidebar-asset" data-bs-parent="#sidebar">
        <li class="nav-item">
            <a class="nav-link {{ activeRoute(route('asset.config_assetment')) }}" href="{{ route('asset.config_assetment') }}">
                <i class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                        </g>
                    </svg>
                </i>
                <i class="sidenav-mini-icon"> A </i>
                <span class="item-name">{{ __('config_assetment.sidebar.config_assetment.list') }}</span>
            </a>
        </li>
    </ul>
</li>
