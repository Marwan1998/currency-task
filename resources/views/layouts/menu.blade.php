

<li class="nav-item">
    <a href="{{ route('currenciesInfos.index') }}"
       class="nav-link {{ Request::is('currenciesInfos*') ? 'active' : '' }}">
        <p>Currencies Infos</p>
    </a>
</li>





<li class="nav-item">
    <a href="{{ route('currencies.index') }}"
       class="nav-link {{ Request::is('currencies*') ? 'active' : '' }}">
        <p>Currencies</p>
    </a>
</li>






