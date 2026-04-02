@extends('frontend.layouts.app')

@section('title', $service->{'title_' . app()->getLocale()})

@section('content')
{{-- Inner Page Hero --}}
<section class="inner-page-hero">
    <div class="inner-hero-bg" style="background-image: url('{{ $service->image ? asset('storage/' . $service->image) : asset('images/defaults/service-placeholder.jpg') }}')"></div>
    <div class="inner-hero-overlay"></div>
    <div class="container position-relative" style="z-index: 2; padding-top:80px">
        <div class="inner-hero-content" data-aos="fade-up">
            <span class="section-suptitle text-white opacity-75">{{ __('خدمات الصفوة') }}</span>
            <h1 class="inner-title">{{ $service->{'title_' . app()->getLocale()} }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb custom-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('الرئيسية') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('services.index') }}">{{ __('خدماتنا') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $service->{'title_' . app()->getLocale()} }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

{{-- Service Detail Content --}}
<section class="section-legendary">
    <div class="container">
        <div class="row g-5">
            {{-- Main Content --}}
            <div class="col-lg-8" data-aos="fade-up">
                <div class="content-card-premium p-4 p-md-5">
                    <div class="service-icon-box mb-4">
                        <i class="{{ $service->icon ?: 'fas fa-rocket' }}"></i>
                    </div>
                    <h2 class="fw-black mb-4">{{ $service->{'title_' . app()->getLocale()} }}</h2>
                    <div class="typography-rich">
                        {!! $service->{'content_' . app()->getLocale()} !!}
                    </div>
                </div>

                {{-- Gallery Section --}}
                @if($service->images->count() > 0)
                    <div class="mt-4" data-aos="fade-up">
                        <div class="service-gallery-grid">
                            @foreach($service->images as $img)
                                @if($loop->index < 3)
                                    <a href="{{ asset('storage/' . $img->image) }}" 
                                       data-fancybox="service-gallery" 
                                       class="gallery-grid-item {{ $loop->index == 0 ? 'item-large' : 'item-small' }}">
                                        <img src="{{ asset('storage/' . $img->image) }}" alt="gallery-{{ $loop->index }}">
                                        
                                        @if($loop->index == 2 && $service->images->count() > 3)
                                            <div class="gallery-more-overlay">
                                                <span>+{{ $service->images->count() - 3 }}</span>
                                            </div>
                                        @endif
                                    </a>
                                @else
                                    {{-- Hidden images for Fancybox gallery --}}
                                    <a href="{{ asset('storage/' . $img->image) }}" 
                                       data-fancybox="service-gallery" 
                                       class="d-none"></a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4" data-aos="fade-left">
                <div class="sidebar-legendary">
                    <div class="sidebar-widget p-4 mb-4">
                        <h5 class="fw-black mb-3 border-bottom pb-2">{{ __('خدمات أخرى') }}</h5>
                        <ul class="list-unstyled">
                            @php $otherServices = \App\Models\Service::where('id', '!=', $service->id)->where('status','published')->take(5)->get(); @endphp
                            @foreach($otherServices as $os)
                                <li class="mb-2">
                                    <a href="{{ route('services.show', $os->slug) }}" class="d-flex align-items-center gap-2 p-2 hover-bg-light rounded-3 transition-base">
                                        <i class="fas fa-chevron-left text-accent fs-xs"></i>
                                        <span>{{ $os->{'title_' . app()->getLocale()} }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-widget p-4 cta-widget text-center">
                        <i class="fas fa-headset fs-1 text-accent mb-3"></i>
                        <h5 class="fw-black text-white">{{ __('هل لديك مشروع؟') }}</h5>
                        <p class="text-white opacity-75 mb-4">{{ __('نحن هنا لمساعدتك في تحقيق أهدافك بأفضل الطرق الممكنة.') }}</p>
                        <a href="{{ route('contact') }}" class="btn-legendary w-100 py-3">{{ __('اطلب استشارة') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .fw-black { font-weight: 900; }
    .sidebar-legendary { position: sticky; top: 110px; }
    .sidebar-widget { background: #fff; border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); }
    .cta-widget { background: var(--primary-dark); }
    .hover-bg-light:hover { background: var(--off-white); }
    .fs-xs { font-size: 0.75rem; }
    
    .content-card-premium { background: #fff; border-radius: 30px; border: 1px solid rgba(0,0,0,0.05); }

    /* Gallery Grid Refinement */
    .service-gallery-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        grid-template-rows: 200px 200px;
        gap: 15px;
        border-radius: 30px;
        overflow: hidden;
    }
    @media (max-width: 768px) {
        .service-gallery-grid {
            grid-template-columns: 1fr;
            grid-template-rows: 300px 150px 150px;
        }
    }
    .gallery-grid-item {
        position: relative;
        display: block;
        overflow: hidden;
        border-radius: 15px;
        background: #f1f5f9;
        transition: transform 0.3s ease;
        cursor: pointer;
    }
    .gallery-grid-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .gallery-grid-item:hover img {
        transform: scale(1.08);
    }
    .gallery-grid-item.item-large {
        grid-row: span 2;
    }
    @media (max-width: 768px) {
        .gallery-grid-item.item-large { grid-row: span 1; }
    }
    .gallery-more-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 2rem;
        font-weight: 900;
        pointer-events: none;
        backdrop-filter: blur(4px);
    }
</style>
@endpush
