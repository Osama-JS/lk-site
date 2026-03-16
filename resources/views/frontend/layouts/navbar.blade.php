<nav class="site-navbar" id="siteNavbar">
    <div class="navbar-inner">
        {{-- Brand --}}
        <a href="{{ route('home') }}" class="navbar-brand-wrap">
            @if(setting('company_logo'))
                <img src="{{ asset('storage/' . setting('company_logo')) }}" alt="{{ setting('company_name_' . app()->getLocale()) }}" style="height:40px;width:auto;">
            @else
                <div style="width:40px;height:40px;background:var(--accent);border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:900;font-size:1.1rem;">
                    LK
                </div>
            @endif
            <span class="navbar-brand-text d-none d-md-inline">
                {{ setting('company_name_' . app()->getLocale(), __('مصنع لك')) }}
            </span>
        </a>

        {{-- Desktop Nav --}}
        <div class="d-none d-lg-flex align-items-center gap-1">
            <ul class="navbar-nav-wrap">
                <li><a href="{{ route('home') }}" class="nav-link-item {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('الرئيسية') }}</a></li>

                {{-- Services Dropdown --}}
                <li class="has-mega-menu">
                    <a href="{{ route('services.index') }}" class="nav-link-item mega-trigger {{ request()->routeIs('services.*') ? 'active' : '' }}">
                        {{ __('خدماتنا') }}
                        <i class="fas fa-chevron-down ms-1" style="font-size:0.6rem; opacity:0.5;"></i>
                    </a>
                    <div class="mega-menu-v3">
                        <div class="row g-3">
                            @php $megaServices = \App\Models\Service::where('status','published')->orderBy('order')->take(6)->get(); @endphp
                            @foreach($megaServices as $ms)
                                <div class="col-md-4">
                                    <a href="{{ route('services.show', $ms->slug) }}" class="mega-service-item">
                                        <div class="mega-service-icon">
                                            <i class="{{ $ms->icon ?: 'fas fa-tshirt' }}"></i>
                                        </div>
                                        <div>
                                            <span class="d-block fw-bold" style="color:var(--text-heading); font-size:0.9rem;">{{ $ms->{'title_' . app()->getLocale()} }}</span>
                                            <span style="font-size:0.75rem; color:var(--gray-400);">{{ Str::limit($ms->{'description_' . app()->getLocale()}, 40) }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>

                <li><a href="{{ route('products.index') }}" class="nav-link-item {{ request()->routeIs('products.*') ? 'active' : '' }}">{{ __('ما نقدمه') }}</a></li>
                <li><a href="{{ route('about') }}" class="nav-link-item {{ request()->routeIs('about') ? 'active' : '' }}">{{ __('عن المصنع') }}</a></li>
                <li><a href="{{ route('activities.index') }}" class="nav-link-item {{ request()->routeIs('activities.*') ? 'active' : '' }}">{{ __('الأنشطة') }}</a></li>
            </ul>
        </div>

        <div class="d-flex align-items-center gap-2">
            {{-- Contact CTA --}}
            <a href="{{ route('contact') }}" class="navbar-cta">
                <i class="fas fa-phone-alt" style="font-size:0.8rem;"></i>
                <span class="d-none d-sm-inline">{{ __('اتصل بنا') }}</span>
            </a>

            {{-- Language Switcher --}}
            <div class="dropdown">
                <button class="lang-btn" data-bs-toggle="dropdown" aria-label="Language">
                    <i class="fas fa-globe"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2 mt-2" style="border-radius:var(--radius-md); min-width:120px;">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li><a class="dropdown-item rounded-3 py-2" style="font-size:0.9rem;" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Mobile Toggle --}}
            <button class="d-lg-none" id="mobileMenuToggle" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile Menu --}}
<div class="mobile-menu" id="mobileMenu">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <span class="fw-black text-white" style="font-size:1.2rem;">{{ __('القائمة') }}</span>
        <button class="btn text-white p-0" style="font-size:1.5rem;" id="closeMobileMenu"><i class="fas fa-times"></i></button>
    </div>

    <form class="mobile-search-form" action="{{ route('search') }}" method="GET">
        <input type="search" name="q" placeholder="{{ __('ابحث...') }}" value="{{ request('q') }}">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>

    <div class="mobile-nav-links">
        <a href="{{ route('home') }}" class="mobile-nav-link">
            <span>{{ __('الرئيسية') }}</span>
            <i class="fas fa-home" style="font-size:0.9rem; opacity:0.3;"></i>
        </a>

        <a href="#" class="mobile-nav-link" data-submenu="mobileServices">
            <span>{{ __('خدماتنا') }}</span>
            <i class="fas fa-chevron-down" style="font-size:0.8rem; opacity:0.3;"></i>
        </a>
        <div class="mobile-submenu" id="mobileServices">
            @php $mobileServices = \App\Models\Service::where('status','published')->take(5)->get(); @endphp
            @foreach($mobileServices as $svc)
                <a href="{{ route('services.show', $svc->slug) }}">{{ $svc->{'title_' . app()->getLocale()} }}</a>
            @endforeach
            <a href="{{ route('services.index') }}" style="color:var(--accent); font-weight:700;">{{ __('جميع الخدمات') }}</a>
        </div>

        <a href="{{ route('products.index') }}" class="mobile-nav-link">{{ __('ما نقدمه') }}</a>
        <a href="{{ route('about') }}" class="mobile-nav-link">{{ __('عن المصنع') }}</a>
        <a href="{{ route('activities.index') }}" class="mobile-nav-link">{{ __('الأنشطة') }}</a>
        <a href="{{ route('branches.index') }}" class="mobile-nav-link">{{ __('الفروع') }}</a>

        <a href="{{ route('contact') }}" class="mobile-nav-link" style="color:var(--accent);">
            <span>{{ __('تواصل معنا') }}</span>
            <i class="fas fa-phone-alt" style="font-size:0.9rem;"></i>
        </a>
    </div>

    <div class="mt-auto pt-4 d-flex gap-2 flex-wrap justify-content-center" style="border-top:1px solid rgba(255,255,255,0.08);">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a rel="alternate" hreflang="{{ $localeCode }}"
               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
               class="btn btn-sm px-4 rounded-pill {{ app()->getLocale() == $localeCode ? 'text-dark fw-bold' : 'btn-outline-light' }}"
               style="{{ app()->getLocale() == $localeCode ? 'background:var(--accent);' : '' }}">
                {{ $properties['native'] }}
            </a>
        @endforeach
    </div>
</div>
