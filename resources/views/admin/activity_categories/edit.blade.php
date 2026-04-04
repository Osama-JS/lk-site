@extends('admin.layouts.master')

@section('title', 'تعديل تصنيف نشاط')
@section('page_title', 'تعديل تصنيف نشاط')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.activities.index') }}" class="text-decoration-none text-muted">الأنشطة</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.activity-categories.index') }}" class="text-decoration-none text-muted">التصنيفات</a></li>
    <li class="breadcrumb-item active" aria-current="page">تعديل: {{ $activityCategory->name_ar }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-edit text-warning me-2"></i> تعديل بيانات التصنيف</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.activity-categories.update', $activityCategory->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">الاسم (عربي) <span class="text-danger">*</span></label>
                            <input type="text" name="name_ar" class="form-control @error('name_ar') is-invalid @enderror"
                                   value="{{ old('name_ar', $activityCategory->name_ar) }}" required>
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">الاسم (إنجليزي)</label>
                            <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror"
                                   value="{{ old('name_en', $activityCategory->name_en) }}">
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">الترتيب</label>
                                <input type="number" name="order" class="form-control"
                                       value="{{ old('order', $activityCategory->order ?? 0) }}">
                                <small class="text-muted">لتحديد ترتيب الظهور (رقم أصغر = يظهر أولاً)</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">الحالة <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    <option value="1" {{ old('status', $activityCategory->status) == '1' ? 'selected' : '' }}>مفعل</option>
                                    <option value="0" {{ old('status', $activityCategory->status) == '0' ? 'selected' : '' }}>معطل</option>
                                </select>
                            </div>
                        </div>

                        {{-- Info: linked activities --}}
                        @if($activityCategory->activities()->count() > 0)
                            <div class="alert alert-info d-flex align-items-center gap-2" style="border-radius:10px;">
                                <i class="fas fa-info-circle"></i>
                                <span>هذا التصنيف مرتبط بـ <strong>{{ $activityCategory->activities()->count() }}</strong> نشاط. لا يمكن حذفه.</span>
                            </div>
                        @endif

                        <div class="text-end mt-4">
                            <a href="{{ route('admin.activity-categories.index') }}" class="btn btn-secondary px-4 me-2">إلغاء</a>
                            <button type="submit" class="btn btn-warning px-4 text-white"><i class="fas fa-save me-2"></i> حفظ التعديلات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Side Info Card --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0" style="border-radius: 15px; background: linear-gradient(135deg, #4f46e5, #7c3aed); color: white;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i> معلومات التصنيف</h6>
                    <ul class="list-unstyled mb-0" style="font-size: 0.875rem;">
                        <li class="mb-2"><i class="fas fa-hashtag me-2 opacity-75"></i> رقم التعريف: {{ $activityCategory->id }}</li>
                        <li class="mb-2"><i class="fas fa-link me-2 opacity-75"></i> Slug: <code style="background:rgba(255,255,255,0.15); padding:2px 6px; border-radius:4px;">{{ $activityCategory->slug }}</code></li>
                        <li class="mb-2"><i class="fas fa-clipboard-list me-2 opacity-75"></i> عدد الأنشطة: {{ $activityCategory->activities()->count() }}</li>
                        <li><i class="far fa-clock me-2 opacity-75"></i> آخر تحديث: {{ $activityCategory->updated_at->format('Y/m/d') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
