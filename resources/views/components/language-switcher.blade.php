<div class="dropdown">
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        <i class="bi bi-globe"></i>
        {{ strtoupper(app()->getLocale()) }}
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('lang.switch', 'en') }}">English</a></li>
        <li><a class="dropdown-item {{ app()->getLocale() == 'es' ? 'active' : '' }}" href="{{ route('lang.switch', 'es') }}">Español</a></li>
        <li><a class="dropdown-item {{ app()->getLocale() == 'ca' ? 'active' : '' }}" href="{{ route('lang.switch', 'ca') }}">Català</a></li>
    </ul>
</div>
