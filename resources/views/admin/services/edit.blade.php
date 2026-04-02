@extends('admin.layouts.master')

@section('title', 'تعديل الخدمة')
@section('page_title', 'الخدمات')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">الخدمات</a></li>
    <li class="breadcrumb-item active" aria-current="page">تعديل: {{ $service->title_ar }}</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title fw-bold mb-0">تحديث بيانات الخدمة</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Titles -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">العنوان (عربي) <span class="text-danger">*</span></label>
                                <input type="text" name="title_ar" class="form-control" value="{{ old('title_ar', $service->title_ar) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">العنوان (إنجليزي)</label>
                                <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $service->title_en) }}">
                            </div>
                        </div>

                        <!-- Descriptions (Short) -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">وصف مختصر (عربي)</label>
                                <textarea name="description_ar" class="form-control" rows="3">{{ old('description_ar', $service->description_ar) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">وصف مختصر (إنجليزي)</label>
                                <textarea name="description_en" class="form-control" rows="3">{{ old('description_en', $service->description_en) }}</textarea>
                            </div>
                        </div>

                        <!-- Content (Full) -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">المحتوى الكامل (عربي)</label>
                                <textarea name="content_ar" id="content_ar" class="form-control" rows="5">{{ old('content_ar', $service->content_ar) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">المحتوى الكامل (إنجليزي)</label>
                                <textarea name="content_en" id="content_en" class="form-control" rows="5">{{ old('content_en', $service->content_en) }}</textarea>
                            </div>
                        </div>

                        <!-- Image & Icon -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">أيقونة (FontAwesome Class)</label>
                                <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">صورة الخدمة</label>
                                <input type="file" name="image" class="form-control" onchange="previewImage(this, 'service-preview')">
                                <div class="mt-2">
                                    @if($service->image)
                                        <img id="service-preview" src="{{ asset('storage/' . $service->image) }}" alt="Preview" style="max-width: 150px; border-radius: 8px;">
                                    @else
                                        <img id="service-preview" src="#" alt="Preview" style="display: none; max-width: 150px; border-radius: 8px;">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Status & Order -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">الحالة</label>
                                <select name="status" class="form-select">
                                    <option value="published" {{ $service->status == 'published' ? 'selected' : '' }}>منشور</option>
                                    <option value="draft" {{ $service->status == 'draft' ? 'selected' : '' }}>مسودة</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">الترتيب</label>
                                <input type="number" name="order" class="form-control" value="{{ old('order', $service->order) }}">
                            </div>
                        </div>

                        <!-- Gallery Images -->
                        <div class="row g-3 mb-4 border-top pt-3">
                            <div class="col-12">
                                <label class="form-label fw-bold small d-block mb-3">معرض الصور الإضافي</label>
                                
                                {{-- Existing Gallery --}}
                                <div class="row g-3 mb-4" id="existing-gallery">
                                    @foreach($service->images as $image)
                                        <div class="col-md-2 col-sm-4 gallery-item-wrapper" id="gallery-item-{{ $image->id }}">
                                            <div class="card shadow-sm border-0 position-relative">
                                                <img src="{{ asset('storage/' . $image->image) }}" class="card-img-top rounded-3" style="height: 100px; object-fit: cover;">
                                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-1" 
                                                        onclick="deleteGalleryImage({{ $image->id }})" style="line-height: 1; width: 24px; height: 24px;">
                                                    <i class="fas fa-times" style="font-size: 10px;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Upload New --}}
                                <div class="upload-area p-4 border-dashed rounded-3 text-center bg-light" style="border: 2px dashed #cbd5e1; cursor: pointer;" onclick="document.getElementById('gallery_input').click()">
                                    <i class="fas fa-images text-primary fs-2 mb-2"></i>
                                    <p class="mb-0 text-muted small">اسحب وأفلت صوراً إضافية هنا أو انقر للاختيار</p>
                                    <input type="file" name="gallery[]" id="gallery_input" class="d-none" multiple onchange="previewGallery(this)">
                                </div>
                                <div id="gallery-preview" class="row g-2 mt-3"></div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-end gap-2 border-top pt-3">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-light px-4">إلغاء</a>
                            <button type="submit" class="btn btn-primary-custom px-4">
                                <i class="fas fa-save me-1"></i> تحديث الخدمة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    /* Admin Service Management Scripts - Minification Safe */

    /* Initialize CKEditor 5 */
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof ClassicEditor !== 'undefined') {
            ClassicEditor.create(document.querySelector('#content_ar'), {
                language: 'ar',
                direction: 'rtl'
            }).catch(function(error) { console.error(error); });

            ClassicEditor.create(document.querySelector('#content_en'))
                .catch(function(error) { console.error(error); });
        }
    });
    
    function previewImage(input, targetId) {
        var preview = document.getElementById(targetId);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewGallery(input) {
        var container = document.getElementById('gallery-preview');
        if (!container) return;
        container.innerHTML = '';
        if (input.files) {
            Array.from(input.files).forEach(function(file) {
                if (!file.type.match('image.*')) return;
                var reader = new FileReader();
                reader.onload = function(e) {
                    var col = document.createElement('div');
                    col.className = 'col-md-2 col-sm-4 position-relative mb-2';
                    col.innerHTML = '<div class="card h-100 shadow-sm border-0 overflow-hidden"><img src="' + e.target.result + '" class="card-img-top rounded-3" style="height: 100px; object-fit: cover;"><div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-25 opacity-0 hover-opacity-100 transition-base"><span class="badge bg-white text-dark rounded-pill shadow-sm small">جديد</span></div></div>';
                    container.appendChild(col);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    function deleteGalleryImage(id) {
        if (typeof Swal === 'undefined') {
            if (confirm('هل أنت متأكد من حذف هذه الصورة؟')) {
                /* Fallback if SweetAlert fails to load */
                console.warn('Swal not found, using fallback');
            }
            return;
        }

        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "سيتم حذف الصورة نهائياً من المعرض!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'نعم، احذف!',
            cancelButtonText: 'إلغاء',
            showLoaderOnConfirm: true,
            customClass: { popup: 'swal2-rtl' },
            preConfirm: function() {
                var deleteUrl = "{{ route('admin.services.delete-image', ':id') }}".replace(':id', id);
                return fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(function(response) {
                    if (!response.ok) throw new Error('فشل الحذف من الخادم');
                    return response.json();
                })
                .catch(function(error) {
                    Swal.showValidationMessage('خطأ: ' + error.message);
                });
            },
            allowOutsideClick: function() { return !Swal.isLoading(); }
        }).then(function(result) {
            if (result.isConfirmed && result.value && result.value.success) {
                var item = document.getElementById('gallery-item-' + id);
                if (item) {
                    item.style.transition = 'opacity 0.3s';
                    item.style.opacity = '0';
                    setTimeout(function() { item.remove(); }, 300);
                }
                Swal.fire({ title: 'تم الحذف!', text: result.value.message, icon: 'success', timer: 1500, showConfirmButton: false });
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        var uploadArea = document.querySelector('.upload-area');
        var galleryInput = document.getElementById('gallery_input');

        if (uploadArea && galleryInput) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(function(eventName) {
                uploadArea.addEventListener(eventName, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }, false);
            });

            uploadArea.addEventListener('dragenter', function() { uploadArea.classList.add('bg-light-primary'); }, false);
            uploadArea.addEventListener('dragover', function() { uploadArea.classList.add('bg-light-primary'); }, false);
            uploadArea.addEventListener('dragleave', function() { uploadArea.classList.remove('bg-light-primary'); }, false);
            uploadArea.addEventListener('drop', function(e) {
                uploadArea.classList.remove('bg-light-primary');
                var dt = e.dataTransfer;
                if (dt.files && dt.files.length > 0) {
                    galleryInput.files = dt.files;
                    previewGallery(galleryInput);
                }
            }, false);
        }
    });
</script>

<style>
    .bg-light-primary { background-color: rgba(14, 165, 233, 0.1) !important; border-color: var(--accent) !important; }
    .transition-base { transition: all 0.3s ease; }
    .hover-opacity-100:hover { opacity: 1 !important; }
</style>
@endpush
