@extends('admin.layouts.master')

@section('title', 'إضافة تصنيف نشاط')
@section('page_title', 'إضافة تصنيف نشاط')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.activities.index') }}" class="text-decoration-none text-muted">الأنشطة</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.activity-categories.index') }}" class="text-decoration-none text-muted">التصنيفات</a></li>
    <li class="breadcrumb-item active" aria-current="page">إضافة تصنيف</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-plus-circle text-primary me-2"></i> بيانات التصنيف الجديد</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.activity-categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">الاسم (عربي) <span class="text-danger">*</span></label>
                            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">الاسم (إنجليزي)</label>
                            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">الترتيب</label>
                                <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                                <small class="text-muted">لتحديد ترتيب الظهور (رقم أصغر = يظهر أولاً)</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">الحالة <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>مفعل</option>
                                    <option value="0" {{ old('status', '0') == '0' ? 'selected' : '' }}>معطل</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('admin.activity-categories.index') }}" class="btn btn-secondary px-4 me-2">إلغاء</a>
                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i> حفظ التصنيف</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
