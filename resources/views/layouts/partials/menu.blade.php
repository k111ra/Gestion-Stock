<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div>Tableau de bord</div>
        </a>
    </li>

    @if (auth()->user()->hasPermission('users_read'))
        <li class="menu-item {{ request()->is('users*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>Utilisateurs</div>
            </a>
        </li>
    @endif

    @if (auth()->user()->hasPermission('settings_access'))
        <li class="menu-item {{ request()->is('parametres*') ? 'active' : '' }}">
            <a href="{{ route('parametres.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>Paramètres</div>
            </a>
        </li>
    @endif
</ul>
