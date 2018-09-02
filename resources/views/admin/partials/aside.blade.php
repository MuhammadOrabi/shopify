<div class="side-menu" id="left-side-menu">
    <aside class="menu m-t-30 m-l-10">
        <p class="menu-label">General</p>
        <ul class="menu-list">
            <li>
                <a href="{{ url('/admin/dashboard') }}" target="_blank">
                    <span class="icon"><i class="fa fa-fw m-r-10 fa-dashboard"></i></span>Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="">
                    <span class="icon"><i class="fa fa-fw m-r-10 fa-bar-chart"></i></span>Stats
                </a>
            </li>
        </ul>
        <p class="menu-label">Administration</p>
        <ul class="menu-list">
            <li>
                <a href="{{ url('/admin/admins') }}" class="">
                    <span class="icon"><i class="fa fa-fw m-r-10 fa-gear"></i></span>Admins
                </a>
            </li>
            <li>
                <a class="has-submenu" href="#">
                    <span class="icon"><i class="fa fa-fw m-r-10 fa-list"></i></span>Vendor Users
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ url('/admin/users') }}">
                            Admins
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/users') }}">
                            Users
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/admin/settings') }}" class="">
                    <span class="icon"><i class="fa fa-fw m-r-10 fa-gear"></i></span>Settings
                </a>
            </li>
        </ul>
        <p class="menu-label">Content</p>
        <ul class="menu-list">
            <li>
                <a href="#" class="">
                    <span class="icon"><i class="fa fa-fw m-r-10 fa-info-circle"></i></span>Footer
                </a>
            </li>
            <li>
                <a href="" class="">
                    <span class="icon"><i class="fa fa-fw m-r-10 fa-picture-o"></i></span>Media
                </a>
            </li>
        </ul>
    </aside>
</div>
