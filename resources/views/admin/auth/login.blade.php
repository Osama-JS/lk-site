<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('تسجيل الدخول') }} | {{ setting('company_name_' . app()->getLocale(), __('مصنع لك')) }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap 5 RTL -->
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    @else
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    @endif

    <style>
        :root {
            --primary: {{ setting('theme_primary_color', '#1a1a2e') }};
            --primary-dark: {{ setting('theme_primary_dark', '#0f0f1a') }};
            --accent: {{ setting('theme_accent_color', '#0ea5e9') }};
            --accent-light: {{ setting('theme_accent_light', '#38bdf8') }};
            --glass-bg: rgba(255, 255, 255, 0.02);
            --glass-border: rgba(255, 255, 255, 0.08);
            --radius: 24px;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background-color: var(--primary-dark);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
            color: #fff;
            position: relative;
        }

        /* Animated Background Elements */
        .bg-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.4;
            animation: move 20s infinite alternate;
        }
        .shape-1 {
            width: 400px;
            height: 400px;
            background: var(--accent);
            top: -100px;
            left: -100px;
        }
        .shape-2 {
            width: 300px;
            height: 300px;
            background: var(--primary);
            bottom: -50px;
            right: -50px;
            animation-delay: -5s;
        }

        @keyframes move {
            from { transform: translate(0, 0); }
            to { transform: translate(100px, 100px); }
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: var(--glass-bg);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            padding: 3rem 2.5rem;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.6);
            animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
            position: relative;
            z-index: 10;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-logo-v3 {
            width: 70px;
            height: 70px;
            background: var(--accent);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            font-weight: 900;
            color: #fff;
            box-shadow: 0 10px 20px rgba(14, 165, 233, 0.3);
            font-family: 'Inter', sans-serif;
        }

        .login-title {
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .login-subtitle {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-label {
            font-weight: 700;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 0.7rem;
            display: block;
        }

        .input-group-premium {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group-premium i {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.3);
            transition: all 0.3s;
        }

        [dir="rtl"] .input-group-premium i {
            left: auto;
            right: 1.2rem;
        }

        .form-control-premium {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            padding: 1rem 1.2rem;
            padding-left: 3.2rem;
            color: #fff;
            transition: all 0.3s;
            width: 100%;
            font-size: 0.95rem;
        }

        [dir="rtl"] .form-control-premium {
            padding-left: 1.2rem;
            padding-right: 3.2rem;
        }

        .form-control-premium:focus {
            background: rgba(255, 255, 255, 0.06);
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
            outline: none;
            color: #fff;
        }

        .form-control-premium:focus + i {
            color: var(--accent);
        }

        .btn-submit-premium {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 14px;
            padding: 1.1rem;
            font-weight: 800;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .btn-submit-premium:hover {
            background: var(--accent-light);
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(14, 165, 233, 0.4);
        }

        .alert-error-premium {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            padding: 1rem;
            border-radius: 14px;
            margin-bottom: 2rem;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .login-footer {
            margin-top: 2.5rem;
            text-align: center;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.25);
            line-height: 1.6;
        }

        .form-check-input {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .form-check-input:checked {
            background-color: var(--accent);
            border-color: var(--accent);
        }
    </style>
</head>
<body>
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>

    <div class="login-card">
        <div class="brand-section">
            <div class="brand-logo-v3">
                @if(setting('company_logo'))
                    <img src="{{ asset('storage/' . setting('company_logo')) }}" alt="LK" style="width:40px;height:auto;">
                @else
                    LK
                @endif
            </div>
            <h1 class="login-title">{{ setting('company_name_' . app()->getLocale(), __('مصنع لك للمنسوجات')) }}</h1>
            <p class="login-subtitle">{{ __('بوابة الإدارة والتحكم') }}</p>
        </div>

        @if($errors->any())
            <div class="alert-error-premium">
                <i class="fas fa-circle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label">{{ __('البريد الإلكتروني') }}</label>
                <div class="input-group-premium">
                    <input type="email" name="email" class="form-control-premium" placeholder="admin@example.com" required value="{{ old('email') }}" autofocus>
                    <i class="fas fa-envelope"></i>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">{{ __('كلمة المرور') }}</label>
                <div class="input-group-premium">
                    <input type="password" name="password" class="form-control-premium" placeholder="••••••••" required>
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label text-sm opacity-50" for="remember" style="font-size: 0.8rem;">
                        {{ __('تذكرني') }}
                    </label>
                </div>
                <a href="#" class="text-decoration-none" style="color:var(--accent); font-size: 0.8rem; font-weight: 600; opacity:0.8;">{{ __('نسيت كلمة المرور؟') }}</a>
            </div>

            <button type="submit" class="btn-submit-premium">
                <span>{{ __('دخول للنظام') }}</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <div class="login-footer">
            &copy; {{ date('Y') }} {{ setting('company_name_' . app()->getLocale(), __('مصنع لك للمنسوجات')) }}<br>
            {{ __('بنيت بأحدث تقنيات الويب للتصنيع الحديث') }}
        </div>
    </div>

    <!-- Diagnostic Tag (v4.3) -->
    <div style="position:fixed; bottom:5px; left:5px; font-size:10px; opacity:0.2; color:#fff;">v4.3-login</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

