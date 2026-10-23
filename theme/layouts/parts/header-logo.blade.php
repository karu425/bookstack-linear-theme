<a href="{{ url('/') }}" data-shortcut="home_view" class="logo bl-logo">
    @if(setting('app-logo', '') !== '' && setting('app-logo', '') !== 'none')
        <img class="logo-image"
             src="{{ setting('app-logo', '') === '' ? url('/logo.png') : url(setting('app-logo', '')) }}"
             alt="{{ setting('app-name-header') ? '' : setting('app-name') }}">
    @elseif(setting('app-name-header'))
        <span class="bl-brand-mark" aria-hidden="true">
            <svg viewBox="0 0 32 32" width="32" height="32" fill="none">
                <path d="M8 7h11l6 6v12H14l-6-6V7Z" stroke="currentColor" stroke-width="1.4"/>
                <path d="M8 7l17 18M19 7v12H8M14 25V13h11" stroke="currentColor" stroke-width="1.1"/>
                <circle cx="19" cy="19" r="2" fill="currentColor"/>
            </svg>
        </span>
    @endif
    @if(setting('app-name-header'))
        <span class="logo-text">{{ setting('app-name') }}</span>
    @endif
</a>
