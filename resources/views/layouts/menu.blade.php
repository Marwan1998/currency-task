<li class="nav-item">
    <a href="{{ route('currencies.index') }}"
       class="nav-link {{ Request::is('currencies*') ? 'active' : '' }}">
        <p>@lang('menu.currencies')</p>
    </a>
</li>

@role(['master', 'Admin'])
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
            @lang('menu.admin')
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('roles.index') }}"class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>@lang('menu.roles')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>@lang('menu.users')</p>
            </a>
        </li>

        @role('master')
        <li class="nav-item">
            <a href="{{ route('other.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>@lang('menu.other')</p>
            </a>
        </li>
        @endrole

    </ul>
</li>
@endrole

