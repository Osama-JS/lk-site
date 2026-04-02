<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        // Stats
        $stats = [
            'total' => Service::count(),
            'published' => Service::where('status', 'published')->count(),
            'draft' => Service::where('status', 'draft')->count(),
        ];

        // Filtering
        $query = Service::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title_ar', 'like', "%{$search}%")
                  ->orWhere('title_en', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $services = $query->latest()->paginate(15);
        return view('admin.services.index', compact('services', 'stats'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_ar' => 'required|max:255',
            'title_en' => 'required|max:255',
            'description_ar' => 'required',
            'description_en' => 'required',
            'content_ar' => 'required',
            'content_en' => 'required',
            'icon' => 'nullable|max:50',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:published,draft',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($request->title_en);
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $service = Service::create($validated);

        // Handle Gallery Images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('services/gallery', 'public');
                $service->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('admin.services.index')
            ->with('success', 'تم إنشاء الخدمة بنجاح');
    }

    public function edit(Service $service)
    {
        $service->load('images');
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title_ar' => 'required|max:255',
            'title_en' => 'required|max:255',
            'description_ar' => 'required',
            'description_en' => 'required',
            'content_ar' => 'required',
            'content_en' => 'required',
            'icon' => 'nullable|max:50',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:published,draft',
            'order' => 'nullable|integer',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        $validated['updated_by'] = auth()->id();

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($validated);

        // Handle Gallery Images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('services/gallery', 'public');
                $service->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('admin.services.index')
            ->with('success', 'تم تحديث الخدمة بنجاح');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        // Delete gallery images from storage
        foreach ($service->images as $img) {
            Storage::disk('public')->delete($img->image);
        }

        $service->delete();
        return redirect()->route('admin.services.index')
            ->with('success', 'تم حذف الخدمة بنجاح');
    }

    /**
     * Delete a specific gallery image (AJAX)
     */
    public function deleteImage(Request $request, $id)
    {
        try {
            $image = \App\Models\ServiceImage::findOrFail($id);
            Storage::disk('public')->delete($image->image);
            $image->delete();

            return response()->json(['success' => true, 'message' => 'تم حذف الصورة بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء الحذف'], 500);
        }
    }
}
