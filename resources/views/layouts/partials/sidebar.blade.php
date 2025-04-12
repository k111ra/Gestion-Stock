<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo/ministere-justice.png.jpg') }}" alt="Logo Ministère de la Justice"
                    style="height: 75px;">
            </span>
        </a>
    </div>
    <span class="app-brand-text menu-text fw-bolder ms-2 text-center">Gestion de Stock</span>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Tableau de bord -->
        <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
            <a href="/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Tableau de bord</div>
            </a>
        </li>

        <!-- Gestion des Stocks -->
        <li class="menu-item {{ request()->is('stocks*') ? 'active' : '' }}">
            <a href="/stocks" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Stocks">Gestion des Stocks</div>
            </a>
        </li>

        <!-- Gestion des Entrées et Sorties -->
        <li class="menu-item {{ request()->is('mouvements*') ? 'active' : '' }}">
            <a href="/mouvements" class="menu-link">
                <i class="menu-icon tf-icons bx bx-transfer"></i>
                <div data-i18n="Mouvements">Entrées & Sorties</div>
            </a>
        </li>

        <!-- Gestion des Produits -->
        <li class="menu-item {{ request()->is('produits*') ? 'active' : '' }}">
            <a href="/produits" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Produits">Gestion des Produits</div>
            </a>
        </li>

        <!-- Gestion des Fournisseurs -->
        <li class="menu-item {{ request()->is('fournisseurs*') ? 'active' : '' }}">
            <a href="/fournisseurs" class="menu-link">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div data-i18n="Fournisseurs">Fournisseurs</div>
            </a>
        </li>

        {{-- <!-- Alertes et Notifications -->
        <li class="menu-item {{ request()->is('alertes*') ? 'active' : '' }}">
            <a href="/alertes" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bell"></i>
                <div data-i18n="Alertes">Alertes & Notifications</div>
            </a>
        </li> --}}

        <!-- Gestion des Utilisateurs -->
        <li class="menu-item {{ request()->is('utilisateurs*') ? 'active' : '' }}">
            <a href="/utilisateurs" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Utilisateurs">Utilisateurs</div>
            </a>
        </li>

        <!-- Paramètres -->
        <li class="menu-item {{ request()->is('parametres*') ? 'active' : '' }}">
            <a href="/parametres" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Paramètres">Paramètres</div>
            </a>
        </li>
    </ul>
</aside>
