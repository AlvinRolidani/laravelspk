<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ $title === 'Dashboard' ? 'active' : '' }}">
        <a href="/" class="menu-link ">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Dashboard">Dashboard</div>
        </a>
    </li>

    <!-- Metode -->
    @if (isset($sub_title))
        <li class="menu-item {{ $title === 'Metode SPK' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Metode SPK">Metode SPK</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ $sub_title === 'SAW' ? 'active' : '' }}">
                    <a href="/metode/saw" class="menu-link ">
                        <div data-i18n="SAW">SAW</div>
                    </a>
                </li>
                <li class="menu-item {{ $sub_title === 'WP' ? 'active' : '' }}">
                    <a href="/metode/wp" class="menu-link">
                        <div data-i18n="WP">WP </div>
                    </a>
                </li>
                <li class="menu-item {{ $sub_title === 'TOPSIS' ? 'active' : '' }}">
                    <a href="/metode/topsis" class="menu-link">
                        <div data-i18n="TOPSIS">TOPSIS
                        </div>
                    </a>
                </li>
                <li class="menu-item {{ $sub_title === 'AHP' ? 'active' : '' }}">
                    <a href="/metode/ahp" class="menu-link">
                        <div data-i18n="AHP">AHP</div>
                    </a>
                </li>

            </ul>

        </li>
    @else
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Metode SPK">Metode SPK</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="metode/saw" class="menu-link ">
                        <div data-i18n="SAW">SAW</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/metode/wp" class="menu-link">
                        <div data-i18n="WP">WP </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/metode/topsis" class="menu-link">
                        <div data-i18n="TOPSIS">TOPSIS
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/metode/ahp" class="menu-link">
                        <div data-i18n="AHP">AHP</div>
                    </a>
                </li>

            </ul>

        </li>
    @endif
</ul>
</aside>
