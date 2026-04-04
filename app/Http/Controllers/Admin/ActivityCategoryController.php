<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActivityCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityCategory::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name_ar', 'like', "%{$search}%")
                  ->orWhere('name_en', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $categories = $query->orderBy('order')->paginate(10);

        return view('admin.activity_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.activity_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'status' => 'required|in:1,0',
            'order' => 'nullable|integer',
        ]);

        // Generate slug
        $slugBase = $request->name_en ?? $request->name_ar;
        $slugBase = preg_replace('/[^a-zA-Z0-9\x{0621}-\x{064A}\s]/u', '', $slugBase);
        $validated['slug'] = Str::slug($slugBase);
        
        if(empty($validated['slug'])) {
            $validated['slug'] = 'cat-' . time();
        }

        $count = ActivityCategory::where('slug', $validated['slug'])->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        ActivityCategory::create($validated);

        return redirect()->route('admin.activity-categories.index')
            ->with('success', 'تم إضافة التصنيف بنجاح');
    }

    public function edit($id)
    {
        $activityCategory = ActivityCategory::findOrFail($id);
        return view('admin.activity_categories.edit', compact('activityCategory'));
    }

    public function update(Request $request, $id)
    {
        $activityCategory = ActivityCategory::findOrFail($id);
        
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'status' => 'required|in:1,0',
            'order' => 'nullable|integer',
        ]);

        $activityCategory->update($validated);

        return redirect()->route('admin.activity-categories.index')
            ->with('success', 'تم تحديث التصنيف بنجاح');
    }

    public function destroy($id)
    {
        $activityCategory = ActivityCategory::findOrFail($id);
        
        if ($activityCategory->activities()->count() > 0) {
            return redirect()->route('admin.activity-categories.index')
                ->with('error', 'لا يمكن حذف التصنيف لوجود أنشطة مرتبطة به');
        }

        $activityCategory->delete();
        return redirect()->route('admin.activity-categories.index')
            ->with('success', 'تم حذف التصنيف بنجاح');
    }
}
