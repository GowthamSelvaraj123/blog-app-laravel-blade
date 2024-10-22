<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }
        return view('category.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }

        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        Category::create([
            'title' => $request->input('title'),
        ]);
        return redirect()->route('categories.index')->with('success', 'Blog added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }

        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $category = Category::findOrFail($id);
        $category->update([
            'title' => $request->input('title')
        ]);
        return redirect()->route('categories.index')->with('success', 'Blog added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Blog deleted successfully!');
    }
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'categories_file' => 'required|file|mimes:csv,txt',
        ]);
    
        // Store the uploaded file temporarily
        $path = $request->file('categories_file')->store('uploads');
        Log::info('Uploaded file path: ' . $path);
    
        // Use the Storage facade to read the file
        if (!Storage::exists($path)) {
            Log::error('File not found: ' . $path);
            return redirect()->back()->with('error', 'File not found.');
        }
    
        // Read the CSV file
        $fileContent = Storage::get($path);
        $rows = explode(PHP_EOL, $fileContent);
    
        // Create an array for the new categories
        $categories = [];
    
        foreach ($rows as $key => $row) {
            // Skip empty lines
            if (empty(trim($row))) {
                continue;
            }
    
            // Convert CSV row into an array
            $data = str_getcsv($row);
    
            foreach ($data as $title) {
                // Remove surrounding quotes
                $title = trim($title, '" ');
    
                // Check if the title is not empty after trimming
                if (empty($title)) {
                    Log::info('Skipping empty title');
                    continue; // Skip empty titles
                }
    
                // Log the title being processed
                Log::info('Processing title: ' . $title);
    
                // Check if the category already exists
                $existingCategory = Category::where('title', $title)->first();
                if ($existingCategory) {
                    // If it exists, update it (if needed)
                    $existingCategory->updated_at = now(); // Update the updated_at timestamp
                    $existingCategory->save();
                    Log::info('Updated existing category: ' . $title);
                } else {
                    // If it doesn't exist, prepare to insert
                    $categories[] = [
                        'title' => $title,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    Log::info('Added new category: ' . $title);
                }
            }
        }
    
        // Insert new categories in bulk if any
        if (!empty($categories)) {
            Category::insert($categories);
            Log::info('Inserted categories: ' . count($categories));
            Storage::delete($path); // Optionally delete the uploaded file
            return redirect()->back()->with('success', 'Categories imported successfully.');
        }
    
        return redirect()->back()->with('error', 'No categories to import.');
    }    
    
}
