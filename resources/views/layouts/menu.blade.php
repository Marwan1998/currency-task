<li class="nav-item">
    <a href="{{ route('currencies.index') }}"
       class="nav-link {{ Request::is('currencies*') ? 'active' : '' }}">
        <p>Currencies</p>
    </a>
</li>






<li class="nav-item">
    <a href="{{ route('tableCurrencies.index') }}"
       class="nav-link {{ Request::is('tableCurrencies*') ? 'active' : '' }}">
        <p>Table Currencies</p>
    </a>
</li>


