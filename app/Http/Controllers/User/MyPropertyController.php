<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class MyPropertyController extends Controller
{
public function index()
{
    // Get properties belonging to the current user
    $properties = auth()->user()->properties()
                    ->latest() // Order by newest first
                    ->paginate(10); // Paginate results

    return view('user.property.index', compact('properties'));
}

    public function create()
    {
        return view('user.property.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'price' => 'required|numeric|min:0',
            'area' => 'nullable|numeric|min:0',
            'number' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create property with authenticated user
        $property = auth()->user()->properties()->create($validated);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('properties', 'public');

            $property->images()->create([
                'path' => $path,
                'is_primary' => true
            ]);
        }

        return redirect()->route('user.property.index')
            ->with('success', 'Property created successfully.');
    }
public function update(Request $request, Property $property)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'address' => 'required|string',
        'price' => 'required|numeric|min:0',
        'area' => 'nullable|numeric|min:0',
        'number' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // تحديث بيانات العقار
    $property->update($validated);

    // إذا تم رفع صورة جديدة
    if ($request->hasFile('image')) {
        // حذف الصورة القديمة
        foreach ($property->images as $image) {
            if ($image->is_primary && Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }

        // رفع الصورة الجديدة
        $path = $request->file('image')->store('properties', 'public');

        $property->images()->create([
            'path' => $path,
            'is_primary' => true,
        ]);
    }

    return redirect()->route('user.property.index')->with('success', 'Property updated successfully.');
}

 public function show(Property $property)
{
    $properties = auth()->user()->properties()
                    ->latest() // Order by newest first
                    ->paginate(10); // Paginate results

    return view('user.property.show', compact('properties'));
}

public function edit(Property $property)
{
    return view('user.property.edit', compact('property'));
}

  public function destroy(Property $property)
{
    // Delete associated images
    foreach ($property->images as $image) {
        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }
        $image->delete();
    }

    $property->delete();

    // Return JSON response for AJAX requests
    if (request()->expectsJson()) {
        return response()->json([
            'message' => 'Property deleted successfully.'
        ]);
    }

    // Fallback for non-AJAX requests
    return redirect()->route('user.property.index')
                    ->with('success', 'Property deleted successfully.');
}


}
