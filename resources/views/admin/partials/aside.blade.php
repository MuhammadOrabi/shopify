<div class="side-menu" id="left-side-menu">
    <aside class="menu m-t-30 m-l-10">
        <p class="menu-label">General</p>
        <ul class="menu-list">
            <li>
                <a href="{{ url('/admin/dashboard') }}" class="{{ Nav::hasSegment('dashboard', 2) }}">
                    <span class="icon"><font-awesome-icon class="p-t-5" icon="tachometer-alt" fixed-width/></span>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="">
                    <span class="icon" ><font-awesome-icon class="p-t-5" icon="chart-bar" fixed-width/></span>
                    Stats
                </a>
            </li>
        </ul>
        <p class="menu-label">Content</p>
        <ul class="menu-list">
            <li>
                <a href="{{ url('/admin/categories') }}" class="{{ Nav::hasSegment('categories', 2) }}">
                    <span class="icon" ><font-awesome-icon class="p-t-5" icon="list-ul" fixed-width/></span>
                    Categories
                </a>
            </li>
            <li>
                <a href="" class="">
                    <span class="icon"><i class="fa fa-fw m-r-10 fa-picture-o"></i></span>Media
                </a>
            </li>
        </ul>
        <p class="menu-label">Administration</p>
        <ul class="menu-list">
            @can('view', 'App\Models\Admin')
                <li>
                    <a href="{{ url('/admin/admins') }}" class="{{ Nav::hasSegment('admins', 2) }}">
                        <span class="icon" ><font-awesome-icon class="p-t-5" icon="user-tie" fixed-width/></span>
                        Admins
                    </a>
                </li>
            @endcan
            <li>
                <a class="has-submenu" href="#">
                    <span class="icon" ><font-awesome-icon class="p-t-5" icon="users" fixed-width/></span>
                    Vendor Users
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
                    <span class="icon" ><font-awesome-icon class="p-t-5" icon="cogs" fixed-width/></span>
                    Settings
                </a>
            </li>
        </ul>
    </aside>
</div>
