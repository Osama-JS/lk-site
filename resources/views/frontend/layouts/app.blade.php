<!DOCTYPE html>
<html style="overflow-x: hidden;" lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('frontend.layouts.seo')

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 RTL/LTR -->
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    @else
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    @endif

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- AOS Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <!-- Frontend CSS -->
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}?v={{ time() }}">

    {{-- Dynamic Theme Colors --}}
    <style>
        :root {
            --primary: {{ setting('theme_primary_color', '#1a1a2e') }};
            --primary-dark: {{ setting('theme_primary_dark', '#0f0f1a') }};
            --primary-light: {{ setting('theme_primary_light', '#2d2d44') }};
            --accent: {{ setting('theme_accent_color', '#0ea5e9') }};
            --accent-dark: {{ setting('theme_accent_dark', '#0284c7') }};
            --accent-light: {{ setting('theme_accent_light', '#38bdf8') }};
        }
    </style>

    @stack('styles')
</head>
<body>
<!-- LK-v3-{{ time() }} -->

    @include('frontend.layouts.navbar')

    <main>
        @yield('content')
    </main>

    @include('frontend.layouts.footer')

    {{-- WhatsApp Chat Widget --}}
    @php
        $waNumber = preg_replace('/[^0-9]/', '', setting('whatsapp_number', '+966555555555'));
        $waName = setting('company_name_' . app()->getLocale(), __('مصنع لك للمنسوجات'));
    @endphp
    <div class="wa-widget" id="waWidget" style="position:fixed; z-index:99999; pointer-events:all;">
        {{-- Popup Card --}}
        <div class="wa-popup">
            <div class="wa-popup-header">
                <div class="wa-popup-header-inner">
                    <div class="wa-avatar"><i class="fas fa-industry"></i></div>
                    <div class="wa-header-text">
                        <h5>{{ $waName }}</h5>
                        <p><span class="wa-online-dot"></span> {{ __('متصل الآن') }}</p>
                    </div>
                </div>
            </div>
            <div class="wa-popup-body">
                <div class="wa-message-bubble">
                    {{ __('مرحباً بك! 👋') }}<br>
                    {{ __('كيف يمكننا مساعدتك اليوم؟ يسعدنا تلقي استفساراتكم حول خدمات التصنيع والمنسوجات.') }}
                    <div class="wa-message-time">{{ now()->format('h:i A') }}</div>
                </div>
            </div>
            <div class="wa-popup-footer">
                <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode(__('مرحباً، أريد الاستفسار عن خدماتكم')) }}" class="wa-send-btn" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    {{ __('ابدأ المحادثة') }}
                </a>
            </div>
        </div>
        {{-- Toggle Button --}}
        <button class="wa-toggle-btn" id="waToggle" aria-label="WhatsApp">
            <i class="fab fa-whatsapp wa-open-icon"></i>
            <i class="fas fa-times wa-close-icon"></i>
        </button>
    </div>

    {{-- Back to Top --}}
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="fas fa-chevron-up"></i>
    </button>
    <div id="lk-diagnostic" style="position:fixed; bottom:5px; left:5px; font-size:12px; font-weight:bold; color:#0ea5e9; background:#fff; padding:2px 8px; border-radius:4px; z-index:999999; border:1px solid #0ea5e9; box-shadow:0 2px 10px rgba(0,0,0,0.1);">v4.3 INIT...</div>

    <!-- Core LK Scripts (Moved up for priority) -->
    <script>
    /* LK FRONTEND v4.3 - DIAGNOSTIC MODE */
    console.log('LK v4.3 BOOTING...');
    window.addEventListener('DOMContentLoaded', function() {
        console.log('LK v4.3 DOM READY');
        var diag = document.getElementById('lk-diagnostic');
        if(diag) diag.innerHTML = 'v4.3 JS: LOADED';

        var navbar = document.getElementById('siteNavbar');
        var waWidget = document.getElementById('waWidget');
        var waToggle = document.getElementById('waToggle');

        function updateNavbar() {
            var st = window.pageYOffset || document.documentElement.scrollTop;
            if (navbar) {
                if (st > 40) {
                    navbar.classList.add('scrolled');
                    navbar.style.setProperty('background', '#ffffff', 'important');
                    navbar.style.setProperty('box-shadow', '0 10px 30px rgba(0,0,0,0.1)', 'important');
                } else {
                    navbar.classList.remove('scrolled');
                    navbar.style.setProperty('background', 'transparent', 'important');
                    navbar.style.setProperty('box-shadow', 'none', 'important');
                }
            }
        }

        if (waToggle && waWidget) {
            waToggle.onclick = function(e) {
                e.preventDefault();
                e.stopPropagation();
                waWidget.classList.toggle('open');
                console.log('WA Clicked, open=' + waWidget.classList.contains('open'));
            };
        }

        window.addEventListener('scroll', updateNavbar, { passive: true });
        setInterval(updateNavbar, 300);
        updateNavbar();
    });
    </script>

    <!-- Project Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>


    @stack('scripts')
</body>
</html>
