@extends('frontend.layouts.app')

@section('title', __('الرئيسية') . ' - ' . setting('company_name_' . app()->getLocale(), 'LK'))

@section('content')

{{-- ================================================================
     HERO SECTION
     ================================================================ --}}
<section class="hero-section">
    <div class="swiper heroSwiper" style="height: 100%;">
        <div class="swiper-wrapper">
            @forelse($sliders as $slider)
                <div class="swiper-slide">
                    <div class="hero-slide-item">
                        <div class="hero-slide-bg" style="background-image: url('{{ $slider->image && Storage::disk('public')->exists($slider->image) ? asset('storage/' . $slider->image) : asset('images/defaults/service-placeholder.jpg') }}');"></div>
                        <div class="hero-overlay-legend"></div>
                        <div class="container position-relative" style="z-index:10;">
                            <div class="hero-content-wrap">
                                <div class="hero-badge">
                                    <i class="fas fa-industry"></i>
                                    {{ setting('company_name_' . app()->getLocale(), __('مصنع لك للمنسوجات')) }}
                                </div>
                                <h1 class="hero-title-mega">
                                    {{ $slider->{'title_' . app()->getLocale()} }}
                                    <span class="stroked-text">{{ $slider->{'subtitle_' . app()->getLocale()} }}</span>
                                </h1>
                                <p class="hero-description">{{ setting('company_tagline_' . app()->getLocale(), __('الجودة في كل خيط، والتميز في كل نسج')) }}</p>
                                <div class="hero-btn-group">
                                    <a href="{{ $slider->link ?: route('services.index') }}" class="btn-primary-site">
                                        {{ $slider->{'button_text_' . app()->getLocale()} ?: __('اكتشف خدماتنا') }}
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                    <a href="{{ route('contact') }}" class="btn-outline-site">
                                        <i class="fab fa-whatsapp"></i>
                                        {{ __('تواصل معنا') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="swiper-slide">
                    <div class="hero-slide-item">
                        <div class="hero-slide-bg" style="background-image: url('{{ asset('images/defaults/service-placeholder.jpg') }}');"></div>
                        <div class="hero-overlay-legend"></div>
                        <div class="container position-relative" style="z-index:10;">
                            <div class="hero-content-wrap">
                                <div class="hero-badge">
                                    <i class="fas fa-industry"></i>
                                    {{ setting('company_name_' . app()->getLocale(), __('مصنع لك للمنسوجات')) }}
                                </div>
                                <h1 class="hero-title-mega">
                                    {{ setting('company_tagline_' . app()->getLocale(), __('الجودة في كل خيط')) }}
                                    <span class="stroked-text">{{ __('والتميز في كل نسج') }}</span>
                                </h1>
                                <p class="hero-description">{{ __('نقدم لكم أفضل خدمات تصنيع الملابس والمنسوجات بأعلى المعايير وأحدث التقنيات') }}</p>
                                <div class="hero-btn-group">
                                    <a href="{{ route('services.index') }}" class="btn-primary-site">
                                        {{ __('اكتشف خدماتنا') }}
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                    <a href="{{ route('contact') }}" class="btn-outline-site">
                                        <i class="fab fa-whatsapp"></i>
                                        {{ __('تواصل معنا') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="swiper-pagination"></div>
        <!-- Navigation Arrows -->
        <div class="swiper-button-next" style="z-index: 999; display: flex !important; opacity: 1 !important; visibility: visible !important;"></div>
        <div class="swiper-button-prev" style="z-index: 999; display: flex !important; opacity: 1 !important; visibility: visible !important;"></div>
    </div>
</section>

{{-- ================================================================
     FACTORY FEATURES — مميزات المصنع
     ================================================================ --}}
<section class="features-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-badge"><i class="fas fa-star"></i> {{ __('لماذا نحن') }}</span>
            <h2 class="section-title mx-auto" style="max-width:600px;">{{ __('مميزات المصنع') }}</h2>
        </div>
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="0">
                <div class="feature-icon"><i class="fas fa-award"></i></div>
                <h4>{{ __('جودة التصنيع') }}</h4>
                <p>{{ __('نؤمن أننا شركاء في نجاح منتجك بجودة تصنيعنا') }}</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                <h4>{{ __('سرعة التنفيذ') }}</h4>
                <p>{{ __('نفهم احتياجاتك وننفذها بدقة، لتوفير الوقت والالتزام بمواعيد التسليم') }}</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon"><i class="fas fa-users-cog"></i></div>
                <h4>{{ __('الخبرة والكفاءة') }}</h4>
                <p>{{ __('فريق من المتخصصين لننجز العمل باحترافية وإتقان') }}</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon"><i class="fas fa-hand-holding-usd"></i></div>
                <h4>{{ __('أسعار تنافسية') }}</h4>
                <p>{{ __('خبرتنا تمكننا من توفير الوقت والجهد، وتقديم أسعار تنافسية لعملائنا') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- ================================================================
     ABOUT — عن المصنع
     ================================================================ --}}
@if($about)
<section class="about-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="about-image-wrap">
                    <img src="{{ $about->image ? asset('storage/' . $about->image) : asset('images/defaults/service-placeholder.jpg') }}" alt="{{ __('عن المصنع') }}">
                    <div class="about-experience-badge" data-aos="zoom-in" data-aos-delay="300">
                        <span class="number">5+</span>
                        <span class="label">{{ __('سنوات الخبرة') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="section-badge"><i class="fas fa-industry"></i> {{ __('عن المصنع') }}</span>
                <h2 class="section-title">{{ $about->{'title_' . app()->getLocale()} }}</h2>
                <div class="typography-rich mb-4">
                    {!! Str::limit(strip_tags($about->{'content_' . app()->getLocale()}), 400) !!}
                </div>

                {{-- Service Categories Grid --}}
                <div class="service-category-grid">
                    @php $aboutServices = App\Models\Service::where('status','published')->orderBy('order')->take(6)->get(); @endphp
                    @foreach($aboutServices as $svc)
                        <a href="{{ route('services.show', $svc->slug) }}" class="service-category-card">
                            <div class="cat-icon mb-2"><i class="{{ $svc->icon ?: 'fas fa-tshirt' }}" style="font-size:1.5rem; color:var(--accent);"></i></div>
                            <div class="cat-title">{{ $svc->{'title_' . app()->getLocale()} }}</div>
                        </a>
                    @endforeach
                </div>

                <a href="{{ route('contact') }}" class="btn-primary-site mt-4">
                    <i class="fab fa-whatsapp"></i>
                    {{ __('تواصل معنا الآن') }}
                </a>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ================================================================
     STATISTICS — الاحصائيات
     ================================================================ --}}
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            @forelse($counters as $counter)
                <div class="stat-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="stat-icon-wrapper-premium">
                        <i class="{{ $counter->icon ?? 'fas fa-chart-line' }}"></i>
                    </div>
                    <div class="stat-number-mega stat-number"
                         data-target="{{ $counter->value }}"
                         data-suffix="+">0+</div>
                    <div class="stat-title-premium">
                        {{ $counter->{'title_' . app()->getLocale()} }}
                    </div>
                </div>
            @empty
                {{-- Default stats if no counters exist --}}
                <div class="stat-item" data-aos="fade-up">
                    <div class="stat-icon-wrapper-premium"><i class="fas fa-users"></i></div>
                    <div class="stat-number-mega stat-number" data-target="40" data-suffix="+">0+</div>
                    <div class="stat-title-premium">{{ __('عميل') }}</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-icon-wrapper-premium"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-number-mega stat-number" data-target="150" data-suffix="+">0+</div>
                    <div class="stat-title-premium">{{ __('مشاريع منتهية') }}</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-icon-wrapper-premium"><i class="fas fa-calendar-alt"></i></div>
                    <div class="stat-number-mega stat-number" data-target="5" data-suffix="+">0+</div>
                    <div class="stat-title-premium">{{ __('سنوات الخبرة') }}</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-icon-wrapper-premium"><i class="fas fa-industry"></i></div>
                    <div class="stat-number-mega stat-number" data-target="3" data-suffix="+">0+</div>
                    <div class="stat-title-premium">{{ __('خطوط الإنتاج') }}</div>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ================================================================
     SERVICES — خدماتنا
     ================================================================ --}}
<section class="services-section">
    <div class="container">
        <div class="row align-items-end mb-5">
            <div class="col-lg-7" data-aos="fade-up">
                <span class="section-badge"><i class="fas fa-cogs"></i> {{ __('خدماتنا') }}</span>
                <h2 class="section-title">{{ __('ما نقدمه لعملائنا') }}</h2>
                <p class="section-subtitle">{{ __('نقدم خدمات تصنيع متكاملة بأعلى معايير الجودة العالمية') }}</p>
            </div>
            <div class="col-lg-5 text-lg-end mb-4" data-aos="fade-up" data-aos-delay="100">
                <a href="{{ route('services.index') }}" class="btn-primary-site">
                    {{ __('جميع الخدمات') }}
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>

        <div class="service-grid-legendary">
            @forelse($services as $service)
                <div class="service-card-v3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                    <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('images/defaults/service-placeholder.jpg') }}" class="service-cover" alt="{{ $service->{'title_' . app()->getLocale()} }}">
                    <div class="service-float-body">
                        <div class="service-icon-box">
                            <i class="{{ $service->icon ?: 'fas fa-tshirt' }}"></i>
                        </div>
                        <h3 class="fw-black mb-2" style="font-size:1.2rem;">{{ $service->{'title_' . app()->getLocale()} }}</h3>
                        <p class="mb-3" style="font-size:0.9rem;">{{ Str::limit($service->{'description_' . app()->getLocale()}, 120) }}</p>
                        <a href="{{ route('services.show', $service->slug) }}" class="btn-primary-site" style="padding:0.5rem 1.5rem; font-size:0.85rem;">
                            {{ __('التفاصيل') }}
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 py-5 text-center" style="opacity:0.5;">
                    <i class="fas fa-tshirt" style="font-size:3rem; margin-bottom:1rem; display:block;"></i>
                    <p>{{ __('سيتم إضافة الخدمات قريباً') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ================================================================
     FEATURED PRODUCTS — منتجاتنا
     ================================================================ --}}
@if($products->count() > 0)
<section class="section-padding" style="background: var(--gray-50);">
    <div class="container">
        <div class="row align-items-end mb-5">
            <div class="col-lg-7" data-aos="fade-up">
                <span class="section-badge"><i class="fas fa-box-open"></i> {{ __('منتجاتنا') }}</span>
                <h2 class="section-title">{{ __('أبرز المنتجات') }}</h2>
            </div>
            <div class="col-lg-5 text-lg-end mb-4" data-aos="fade-up" data-aos-delay="100">
                <a href="{{ route('products.index') }}" class="btn-primary-site">{{ __('عرض الكل') }} <i class="fas fa-arrow-left"></i></a>
            </div>
        </div>

        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                    <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
                        <div class="product-card-home">
                            <div class="product-card-home-img-wrap" style="position:relative;">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->{'title_' . app()->getLocale()} }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100" style="background:var(--gray-100);">
                                        <i class="fas fa-box" style="font-size:2rem; opacity:0.2;"></i>
                                    </div>
                                @endif
                                @if($product->discount && $product->price)
                                    <span class="product-sale-badge">{{ __('خصم') }}</span>
                                @endif
                            </div>
                            <div class="product-card-home-body">
                                @if($product->agency)
                                    <span class="product-agency-tag">{{ $product->agency->{'name_' . app()->getLocale()} }}</span>
                                @endif
                                <h4 class="product-card-home-title">{{ $product->{'title_' . app()->getLocale()} }}</h4>
                                @if($product->price)
                                    <div class="d-flex align-items-center gap-2">
                                        @if($product->discount)
                                            <span class="text-decoration-line-through small" style="opacity:0.4;">{{ number_format($product->price, 2) }}</span>
                                            <span class="fw-black" style="color:var(--accent);">{{ number_format($product->final_price, 2) }} {{ __('ر.س') }}</span>
                                        @else
                                            <span class="fw-black" style="color:var(--accent);">{{ number_format($product->price, 2) }} {{ __('ر.س') }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ================================================================
     CTA SECTION — تواصل معنا
     ================================================================ --}}
<section class="cta-section">
    <div class="cta-content" data-aos="zoom-in">
        <h2>{{ __('جاهزون للتصنيع.. دائماً جاهزون') }}</h2>
        <p>{{ __('نحن هنا لتحويل أفكارك إلى منتجات عالية الجودة. فريقنا المتخصص بانتظارك.') }}</p>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('whatsapp_number', '+966555555555')) }}" class="btn-cta-white" target="_blank">
            <i class="fab fa-whatsapp" style="font-size:1.3rem;"></i>
            {{ __('تواصل معنا عبر واتساب') }}
        </a>
    </div>
</section>

{{-- ================================================================
     ACTIVITIES / NEWS — أنشطتنا
     ================================================================ --}}
<section class="section-padding" style="background: var(--white);">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3">
            <div data-aos="fade-up">
                <span class="section-badge"><i class="fas fa-newspaper"></i> {{ __('آخر الأخبار') }}</span>
                <h2 class="section-title mb-0">{{ __('أحدث أنشطتنا') }}</h2>
            </div>
            <a href="{{ route('activities.index') }}" class="btn-primary-site" data-aos="fade-up" data-aos-delay="100">
                {{ __('جميع الأنشطة') }}
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="row g-4">
            @forelse($activities as $activity)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="activity-card-minimal" style="position:relative;">
                        <div class="activity-date">{{ $activity->created_at->format('d M, Y') }}</div>
                        <img src="{{ $activity->image ? asset('storage/' . $activity->image) : asset('images/defaults/service-placeholder.jpg') }}" class="activity-img" alt="{{ $activity->{'title_' . app()->getLocale()} }}">
                        <div class="p-4">
                            <h4 class="fw-bold" style="font-size:1.1rem; margin-bottom:0.75rem;">{{ $activity->{'title_' . app()->getLocale()} }}</h4>
                            <p style="color:var(--gray-500); font-size:0.9rem;">{{ Str::limit($activity->{'description_' . app()->getLocale()}, 100) }}</p>
                            <a href="{{ route('activities.show', $activity->slug) }}" class="text-accent fw-bold" style="font-size:0.9rem;">{{ __('اقرأ المزيد') }} <i class="fas fa-arrow-left" style="font-size:0.7rem;"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 py-5 text-center" style="opacity:0.5;">
                    <i class="fas fa-newspaper" style="font-size:2.5rem; margin-bottom:1rem; display:block;"></i>
                    <p>{{ __('لا توجد أنشطة حالياً') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    function initHeroSwiper() {
        if (window.lkSwiperReady) return true;
        
        const heroContainer = document.querySelector('.heroSwiper');
        const heroSlides = document.querySelectorAll('.heroSwiper .swiper-slide');
        const diag = document.getElementById('lk-diagnostic');
        
        console.log('LK-v4.5 Slider Check:', { 
            swiperExists: typeof Swiper !== 'undefined',
            container: !!heroContainer,
            slides: heroSlides.length 
        });

        if (typeof Swiper !== 'undefined' && heroContainer && heroSlides.length > 0) {
            try {
                window.lkSwiper = new Swiper('.heroSwiper', {
                    loop: heroSlides.length > 1,
                    speed: 1000,
                    autoplay: { 
                        delay: 5000, 
                        disableOnInteraction: false 
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: { 
                        el: '.swiper-pagination', 
                        clickable: true 
                    },
                    on: {
                        init: function() {
                            console.log('LK-v4.5 Slider: READY');
                            if(diag) diag.innerHTML = 'v4.5 JS: SLIDER OK';
                            if(diag) diag.style.background = '#e0f2fe';
                        }
                    }
                });
                window.lkSwiperReady = true;
                return true;
            } catch (e) {
                console.error('LK-v4.5 Slider Error:', e);
                if(diag) diag.innerHTML = 'v4.5 JS: SLIDER ERROR';
                return false;
            }
        }
        return false;
    }

    function startSliderLogic() {
        if (!initHeroSwiper()) {
            let attempts = 0;
            const timer = setInterval(() => {
                attempts++;
                if (initHeroSwiper() || attempts > 30) {
                    clearInterval(timer);
                    if (!window.lkSwiperReady) console.warn('LK-v4.5 Slider: Initialization failed after 30 attempts');
                }
            }, 500);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', startSliderLogic);
    } else {
        startSliderLogic();
    }
</script>
@endpush
