<li class="nav-item">
    <a href="{{ route('currencies.index') }}"
       class="nav-link {{ Request::is('currencies*') ? 'active' : '' }}">
        <p>Currencies</p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
            Admin
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('roles.index') }}"class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Roles</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Users</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="pages/charts/inline.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Other</p>
            </a>
        </li>

    </ul>
  </li>








{{-- <li class="nav-item">
    <a href="pages/charts/chartjs.html" class="nav-link">
      <i class="far fa-circle nav-icon"></i>
      <p>Permisstions
      </p>
    </a>
</li> --}}
