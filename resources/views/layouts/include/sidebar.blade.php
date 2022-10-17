<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a href="{{ route('home') }}"><img class="img-fluid for-light"
                    src="{{ filePath(getSystemSetting('type_logo')) }}" alt="{{ getSystemSetting('type_name') }}"><img
                    class="img-fluid for-dark" src="{{ filePath(getSystemSetting('type_logo')) }}"
                    alt="{{ getSystemSetting('type_name') }}"></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('home') }}">
                <img class="img-fluid" src="{{ filePath(getSystemSetting('type_logo')) }}"
                    alt="{{ getSystemSetting('type_name') }}"></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="{{ route('dashboard') }}"><img class="img-fluid"
                                src="{{ filePath(getSystemSetting('type_logo')) }}"
                                alt="{{ getSystemSetting('type_name') }}"></a>
                        <div class="mobile-back text-end"><span>@translate(Back)</span>
                            <i class="fa fa-angle-right ps-2" aria-hidden="true"> </i>
                        </div>
                    </li>

                    <li class="sidebar-list">
                        <a class="{{ request()->is('dashboard') ? 'active' : 'rumon' }}  sidebar-link sidebar-title link-nav "
                            href="{{ route('dashboard') }}">
                            <span>Dashboard </span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{ request()->is('dashboard/user*') || request()->is('dashboard/module*') || request()->is('dashboard/permission*') || request()->is('dashboard/group*') ? 'active' : null }}"
                            href="#">

                            <span>User Managment </span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="{{ request()->is('dashboard/user*') ? 'active' : null }}"
                                    href="{{ route('users.index') }}">Users</a></li>
                            <li><a class="{{ request()->is('dashboard/user/create*') ? 'active' : null }}"
                                    href="{{ route('users.create') }}">Add New User</a></li>
                            <li><a class="{{ request()->is('dashboard/group*') ? 'active' : null }}"
                                    href="{{ route('groups.index') }}">Roles</a></li>
                            <li><a class="{{ request()->is('dashboard/group/create') ? 'active' : null }}"
                                    href="{{ route('groups.create') }}">Add New Role</a></li>
                            <li><a class="{{ request()->is('dashboard/module*') ? 'active' : null }}"
                                    href="{{ route('modules.index') }}">Permissions</a></li>
                            <li><a class="{{ request()->is('dashboard/permission*') ? 'active' : null }}"
                                    href="{{ route('permissions.index') }}">Permissions aita only developer </a></li>
                        </ul>
                    </li>

                    @if (getSystemSetting('google_analytics_active') == 'Yes')
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title" href="{{ route('analytics.dashboard') }}">

                                <span class="03">Analytics Dashboard </span></a>
                        </li>
                    @endif


                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{ request()->is('dashboard/social/credential*') || request()->is('dashboard/google*') ? 'active' : null }}"
                            href="#">
                            <span class="03">Third party</span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="{{ request()->is('dashboard/social/credential*') ? 'active' : null }}"
                                    href="{{ route('social.credebtial') }}">Social Login</a></li>
                            <li><a class="{{ request()->is('dashboard/google/analytics*') ? 'active' : null }}"
                                    href="{{ route('google.analytics') }}">Google Analytics</a></li>

                        </ul>
                    </li>


                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{ request()->is('dashboard/seo') ? 'active' : null }}"
                            href="#">

                            <span class="03">Seo</span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="{{ request()->is('dashboard/seo') ? 'active' : null }}"
                                    href="{{ route('seo.setup') }}">Setup</a></li>

                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('dashboard/pages*') || request()->is('dashboard/content*') ? 'active' : null }}"
                            href="{{ route('pages.index') }}">
                            <span> Page Managment</span> </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('dashboard/menu*') ? 'active' : null }} "
                            href="{{ route('menu') }}">
                            <span> Manu Setup</span>
                        </a>
                    </li>

                  

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">

                            <span class="03">Settings</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('system.setting') }}">System Settings</a></li>
                            <li><a href="{{ route('site.setting') }}">Cms Settings</a></li>
                            <li><a href="{{ route('smtp.create') }}">Mail Setup</a></li>
                            <li><a href="{{ route('currencies.index') }}">Currency Settings</a></li>
                        </ul>


                    </li>


                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
