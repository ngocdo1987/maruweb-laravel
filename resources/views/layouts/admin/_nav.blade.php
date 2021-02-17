<span>
    <ul class="menu js__accordion">
        @can('manage dashboard')
            <li class="{{ Request::segment(2) == 'dashboard' ? 'current' : '' }}">
                <a class="waves-effect parent-item js__control" href="{{ route('admin.dashboard') }}" onclick="window.location = '{{ route('admin.dashboard') }}';">
                    <i class="menu-icon ti-dashboard"></i>
                    <span>{{ __('Dashboard') }}</span>
                </a>
            </li>
        @endcan

        @can('manage users')
            <li class="{{ Request::segment(2) == 'users' ? 'current' : '' }}">
                <a class="waves-effect parent-item js__control" href="{{ route('admin.users.index') }}" onclick="window.location = '{{ route('admin.users.index') }}';">
                    <i class="menu-icon ti-user"></i>
                    <span>{{ __('User management') }}</span>
                </a>
            </li>
        @endcan

        @can('manage admins')
            <li class="{{ Request::segment(2) == 'admins' ? 'current' : '' }}">
                <a class="waves-effect parent-item js__control" href="{{ route('admin.admins.index') }}" onclick="window.location = '{{ route('admin.admins.index') }}';">
                    <i class="menu-icon ti-user"></i>
                    <span>{{ __('Admin management') }}</span>
                </a>
            </li>
        @endcan

        @can('manage common settings')
            <li class="{{ Request::segment(2) == 'commonSettings' ? 'current' : '' }}">
                <a class="waves-effect parent-item js__control" href="{{ route('admin.commonSettings.index') }}" onclick="window.location = '{{ route('admin.commonSettings.index') }}';">
                    <i class="menu-icon ti-settings"></i>
                    <span>{{ __('List common settings') }}</span>
                </a>
            </li>
        @endcan
    </ul>
</span>