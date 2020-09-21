<div
    id="m_ver_menu"
    class="m-aside-menu m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-aside-menu"
    data-menu-vertical="false"
    data-menu-scrollable="true" data-menu-dropdown-timeout="500"
>
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <li class="{{ request()->is('user/beranda') ? 'm-menu__item  m-menu__item--active' : 'm-menu__item' }}" aria-haspopup="true">
            <a href='{!! url('user/beranda'); !!}' class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-line-graph"></i>
                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                            Dashboard
                        </span>
                    </span>
                </span>
            </a>
        </li>
        <li class="m-menu__section">
            <h4 class="m-menu__section-text">
                Components
            </h4>
            <i class="m-menu__section-icon flaticon-more-v3"></i>
        </li>
        <li class="{{ request()->is('user/database-harga/*') ? 'm-menu__item  m-menu__item--active' : 'm-menu__item' }}" aria-haspopup="true">
            <a href='{!! url('user/database-harga/index'); !!}' class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-line-graph"></i>
                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                            Database Harga
                        </span>
                    </span>
                </span>
            </a>
        </li>
        <li class="{{ request()->is('user/data-kontrak/*') ? 'm-menu__item  m-menu__item--active' : 'm-menu__item' }}" aria-haspopup="true">
            <a href='{!! url('user/data-kontrak/index'); !!}' class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-line-graph"></i>
                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                            Data Kontrak
                        </span>
                    </span>
                </span>
            </a>
        </li>
        <li class="{{ request()->is('user/inisiasi-pengadaan') ? 'm-menu__item  m-menu__item--active' : 'm-menu__item' }}" aria-haspopup="true">
            <a href='{!! url('user/inisiasi-pengadaan'); !!}' class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-line-graph"></i>
                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                            Inisiasi Pengadaan
                        </span>
                    </span>
                </span>
            </a>
        </li>
        <li class="{{ request()->is('user/inisiasi-pengadaan-sipil/*') ? 'm-menu__item  m-menu__item--submenu m-menu__item--open m-menu__item--expanded' : 'm-menu__item  m-menu__item--submenu' }}" aria-haspopup="true"
            data-menu-submenu-toggle="hover">
            <a href="#" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-layers"></i>
                <span class="m-menu__link-text">
                    Inisiasi Pengadaan Sipil
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                        <a href="#" class="m-menu__link ">
                            <span class="m-menu__link-text">
                                Inisiasi Pengadaan Sipil
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->is('user/inisiasi-pengadaan-sipil/data-master') ? 'm-menu__item  m-menu__item--active' : 'm-menu__item' }}" aria-haspopup="true">
                        <a href='{!! url('user/inisiasi-pengadaan-sipil/data-master'); !!}' class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                Data Master
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->is('user/inisiasi-pengadaan-sipil/pengadaan-sipil') ? 'm-menu__item  m-menu__item--active' : 'm-menu__item' }}" aria-haspopup="true">
                        <a href='{!! url('user/inisiasi-pengadaan-sipil/pengadaan-sipil'); !!}' class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                Pengadaan Sipil
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>

