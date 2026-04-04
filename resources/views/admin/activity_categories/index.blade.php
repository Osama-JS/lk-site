@extends('admin.layouts.master')

@section('title', 'إدارة تصنيفات الأنشطة')
@section('page_title', 'تصنيفات الأنشطة')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.activities.index') }}" class="text-decoration-none text-muted">الأنشطة</a></li>
    <li class="breadcrumb-item active" aria-current="page">تصنيفات الأنشطة</li>
@endsection

@section('action_button')
    <a href="{{ route('admin.activity-categories.create') }}" class="btn btn-primary shadow-sm" style="border-radius: 10px; font-weight: 600;">
        <i class="fas fa-plus me-1"></i> تصنيف جديد
    </a>
@endsection

@section('content')
    {{-- Stats (Simplified for categories) --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <x-admin-stat-card title="إجمالي التصنيفات" value="{{ \App\Models\ActivityCategory::count() }}" icon="fas fa-tags" color="primary"/>
        </div>
        <div class="col-md-6">
            <x-admin-stat-card title="مفعل" value="{{ \App\Models\ActivityCategory::where('status', '1')->count() }}" icon="fas fa-check-circle" color="success"/>
        </div>
    </div>

    {{-- Filter --}}
    <x-admin-filter-card :action="route('admin.activity-categories.index')" :expanded="request()->has('search') || request()->has('status')">
        <div class="col-md-8">
            <label class="form-label text-sm">بحث (الاسم)</label>
            <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="ابحث باسم التصنيف...">
        </div>
        <div class="col-md-4">
            <label class="form-label text-sm">الحالة</label>
            <select name="status" class="form-select">
                <option value="">الكل</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>مفعل</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>معطل</option>
            </select>
        </div>
    </x-admin-filter-card>

    {{-- Table --}}
    <div class="table-card">
        <div class="table-card-header">
            <h6><i class="fas fa-list me-2 text-primary"></i> قائمة التصنيفات</h6>
            <span class="badge" style="background:#ede9fe;color:#4f46e5;font-size:0.8rem;padding:6px 12px;border-radius:20px;">
                {{ $categories->total() }} سجل
            </span>
        </div>
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="25%">الاسم (عربي)</th>
                    <th width="25%">الاسم (إنجليزي)</th>
                    <th width="15%">عدد الأنشطة</th>
                    <th width="10%">الترتيب</th>
                    <th width="10%">الحالة</th>
                    <th width="10%" class="text-end">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td><div class="row-num">{{ $loop->iteration }}</div></td>
                        <td>
                            <div class="fw-bold text-dark">{{ $category->name_ar }}</div>
                        </td>
                        <td>{{ $category->name_en ?? '-' }}</td>
                        <td>
                            <span class="badge bg-secondary rounded-pill">{{ $category->activities()->count() }}</span>
                        </td>
                        <td>{{ $category->order ?? 0 }}</td>
                        <td>
                            @if($category->status == '1')
                                <span class="status-badge published">مفعل</span>
                            @else
                                <span class="status-badge draft">معطل</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('admin.activity-categories.edit', $category->id) }}" class="action-btn action-btn-edit">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>
                                @if($category->activities()->count() == 0)
                                    <button type="button" class="action-btn action-btn-delete"
                                            onclick="confirmDelete('{{ route('admin.activity-categories.destroy', $category->id) }}', '{{ $category->name_ar }}')">
                                        <i class="fas fa-trash"></i> حذف
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="fas fa-tags"></i></div>
                                <h6>لا توجد تصنيفات</h6>
                                <p>لم يتم إضافة أي تصنيفات أنشطة بعد</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination-container">
            <div class="text-muted text-sm">عرض {{ $categories->firstItem() ?? 0 }} إلى {{ $categories->lastItem() ?? 0 }} من أصل {{ $categories->total() }} سجل</div>
            <div>{{ $categories->withQueryString()->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
@endsection
