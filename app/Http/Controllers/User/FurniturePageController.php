<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Furniture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Image;


class FurniturePageController extends Controller
{
    /**
     * Display a listing of the furniture items.
     */
    public function index()
    {
        $furniture = Furniture::where('is_deleted', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.furniture.index', [
            'furniture' => $furniture
        ]);
    }

    /**
     * Show the form for creating a new furniture item.
     */
    public function create()
    {
        return view('user.furniture.create');
    }

    /**
     * Store a newly created furniture item in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'stock' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048|dimensions:min_width=300,min_height=300'
    ]);

    // أنشئ قطعة الأثاث بدون الصورة
    $furniture = Furniture::create([
        'name' => $validated['name'],
        'description' => $validated['description'] ?? null,
        'stock' => $validated['stock'],
        'price' => $validated['price'],
                'user_id' => auth()->id() // Add this line

    ]);

    // ثم أضف الصورة باستخدام العلاقة polymorphic
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('furniture', 'public');

        $furniture->image()->create([
            'path' => $imagePath,
            'is_primary' => true
        ]);
    }

    return redirect()->route('user.furniture.index')
        ->with('success', 'Furniture item created successfully.');
}


    /**
     * Display the specified furniture item.
     */
    public function show(string $id)
    {
        $furniture = Furniture::findOrFail($id);

        return view('user.furniture.show', [
            'item' => $furniture
        ]);
    }
    public function myFurniture()
{
    $furnitures = auth()->user()->furnitures()->paginate(10);
    // $furniture = Furniture::all();
    return view('user.furniture.myfurniture', compact('furnitures'));
}

    /**
     * Show the form for editing the specified furniture item.
     */
    public function edit(string $id)
    {
        $furniture = Furniture::findOrFail($id);

        return view('user.furniture.edit', [
            'furniture' => $furniture
        ]);
    }

    /**
     * Update the specified furniture item in storage.
     */
    public function update(Request $request, string $id)
{
    $furniture = Furniture::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'stock' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048|dimensions:min_width=300,min_height=300'
    ]);

    $furniture->update([
        'name' => $validated['name'],
        'description' => $validated['description'] ?? null,
        'stock' => $validated['stock'],
        'price' => $validated['price'],
    ]);

    if ($request->hasFile('image')) {
        // حذف الصورة القديمة إن وجدت
        if ($furniture->image) {
            Storage::disk('public')->delete($furniture->image->path);
            $furniture->image()->delete();
        }

        $imagePath = $request->file('image')->store('furniture', 'public');

        $furniture->image()->create([
            'path' => $imagePath,
            'is_primary' => true
        ]);
    }

    return redirect()->route('user.furniture.index')
        ->with('success', 'Furniture item updated successfully.');
}


    /**
     * Remove the specified furniture item from storage.
     */
    public function destroy(string $id)
    {
        $furniture = Furniture::findOrFail($id);

        // For soft delete
        $furniture->update(['is_deleted' => true]);

        // If you want to permanently delete with image cleanup:
        /*
        if ($furniture->image) {
            Storage::disk('public')->delete($furniture->image);
        }
        $furniture->delete();
        */

        return redirect()->route('user.furniture.index')
            ->with('success', 'Furniture item deleted successfully.');
    }
}
