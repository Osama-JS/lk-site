<footer class="footer-legendary">
    <div class="container">
        <div class="row g-5">
            {{-- Brand --}}
            <div class="col-lg-4 footer-brand">
                <h4>{{ setting('company_name_' . app()->getLocale(), __('مصنع لك للمنسوجات')) }}</h4>
                <p class="mb-4" style="color:rgba(255,255,255,0.5); font-size:0.9rem; line-height:1.8;">
                    {{ setting('company_tagline_' . app()->getLocale(), __('الجودة في كل خيط، والتميز في كل نسج')) }}
                </p>
                <div class="d-flex gap-2">
                    @php
                        $socials = [
                            'facebook' => ['url' => setting('facebook_url'), 'icon' => 'fab fa-facebook-f'],
                            'twitter' => ['url' => setting('twitter_url'), 'icon' => 'fab fa-x-twitter'],
                            'instagram' => ['url' => setting('instagram_url'), 'icon' => 'fab fa-instagram'],
                            'linkedin' => ['url' => setting('linkedin_url'), 'icon' => 'fab fa-linkedin-in'],
                            'tiktok' => ['url' => setting('tiktok_url'), 'icon' => 'fab fa-tiktok'],
                            'snapchat' => ['url' => setting('snapchat_url'), 'icon' => 'fab fa-snapchat-ghost'],
                        ];
                    @endphp
                    @foreach($socials as $name => $data)
                        @if($data['url'])
                            <a href="{{ $data['url'] }}" class="social-link" target="_blank" aria-label="{{ $name }}"><i class="{{ $data['icon'] }}"></i></a>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-lg-2 col-md-4 footer-link-group">
                <h5>{{ __('روابط سريعة') }}</h5>
                <ul class="footer-links list-unstyled">
                    <li><a href="{{ route('home') }}">{{ __('الرئيسية') }}</a></li>
                    <li><a href="{{ route('about') }}">{{ __('عن المصنع') }}</a></li>
                    <li><a href="{{ route('services.index') }}">{{ __('خدماتنا') }}</a></li>
                    <li><a href="{{ route('products.index') }}">{{ __('ما نقدمه') }}</a></li>
                    <li><a href="{{ route('contact') }}">{{ __('اتصل بنا') }}</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div class="col-lg-3 col-md-4 footer-link-group">
                <h5>{{ __('خدماتنا') }}</h5>
                <ul class="footer-links list-unstyled">
                    @php $footerServices = \App\Models\Service::where('status','published')->take(5)->get(); @endphp
                    @forelse($footerServices as $svc)
                        <li><a href="{{ route('services.show', $svc->slug) }}">{{ $svc->{'title_' . app()->getLocale()} }}</a></li>
                    @empty
                        <li><span style="opacity:0.4;">{{ __('متوفرة قريباً') }}</span></li>
                    @endforelse
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-lg-3 col-md-4 footer-link-group">
                <h5>{{ __('تواصل معنا') }}</h5>
                <ul class="footer-links list-unstyled">
                    <li class="d-flex gap-3 mb-3">
                        <i class="fas fa-map-marker-alt mt-1" style="color:var(--accent);"></i>
                        <span>{{ setting('company_address_' . app()->getLocale(), __('الرياض، المملكة العربية السعودية')) }}</span>
                    </li>
                    <li class="d-flex gap-3 mb-3">
                        <i class="fas fa-phone-alt mt-1" style="color:var(--accent);"></i>
                        <span dir="ltr">{{ setting('company_phone', '+966 11 987 6543') }}</span>
                    </li>
                    <li class="d-flex gap-3">
                        <i class="fas fa-envelope mt-1" style="color:var(--accent);"></i>
                        <span>{{ setting('company_email', 'info@lk-textiles.com') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <p class="mb-0" style="font-size:0.85rem; opacity:0.4;">© {{ date('Y') }} {{ setting('company_name_' . app()->getLocale(), __('مصنع لك للمنسوجات')) }}. {{ __('جميع الحقوق محفوظة') }}</p>
            <div class="d-flex gap-4" style="font-size:0.85rem;">
                <a href="#" style="color:rgba(255,255,255,0.4);">{{ __('سياسة الخصوصية') }}</a>
                <a href="#" style="color:rgba(255,255,255,0.4);">{{ __('الشروط والأحكام') }}</a>
            </div>
        </div>
    </div>
</footer>
