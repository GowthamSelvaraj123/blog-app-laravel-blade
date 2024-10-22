<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;


class BlogController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
    
        // Assuming you're searching by the 'title' field, you can change this as needed
        $results = Blog::where('title', 'like', "%$search%")
        ->orWhere('description', 'like', "%$search%")
        ->paginate(10); // Change the number to your desired items per page
    
        // Return the results to the view
        return view('blogs.index', ['blogs' => $results]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }
        $blogs = Blog::with('categories')->orderBy('created_at')->paginate(4);
        return view('blogs.index', [
            'blogs' => $blogs
        ]);
    }
    public function welcome()
    {
        $blogs = Blog::all();
        $categories = Category::all();
        return view('welcome', compact('blogs', 'categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }
        $categories = Category::all();
        return view('blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request->all());
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255', 
        ]);
        $imagePath = 'default-image-path.jpg';
                $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        ///dd($imagePath);
        $blog = Blog::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'author' => $request->input('author'),
            'image' => $imagePath,
            'category_id' => $request->input('category'),
        ]);
        return redirect()->route('blogs.index')->with('success', 'Blog added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255', 
        ]);
        $imagePath = 'default-image-path.jpg';
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName;
        $blog = Blog::findOrFail($id);
        $blog->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'author' => $request->input('author'),
            'image' => $imagePath,
            'category_id' => $request->input('category'),
        ]);
        return redirect()->route('blogs.index')->with('success', 'Blog added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }
    public function import(Request $request)
    {
        $request->validate([
            'blogs_file' => 'required|file|mimes:csv,txt',
        ]);
    
        $path = $request->file('blogs_file')->store('uploads');
        Log::info('Uploaded file path: ' . $path);
        
        if (!Storage::exists($path)) {
            Log::error('File not found: ' . $path);
            return redirect()->back()->with('error', 'File not found.');
        }
        
        $fileContent = Storage::get($path);
        $rows = explode(PHP_EOL, $fileContent);
        $blogs = [];
    
        foreach ($rows as $key => $row) {
            if (empty(trim($row))) {
                continue;
            }
            
            $data = str_getcsv($row);
            
            if (count($data) < 5) {
                Log::warning('Skipping row due to insufficient data: ' . $row);
                continue; // Skip rows that don't have enough data
            }
    
            // Extract data
            $title = trim($data[0], '" ');
            $description = trim($data[1], '" ');
            $author = trim($data[2], '" ');
            $image = trim($data[3], '" ');
            $categoryTitle = trim($data[4], '" ');
    
            // Check if the category already exists or create a new one
            $existingCategory = Category::where('title', $categoryTitle)->first();
    
            if (!$existingCategory) {
                // Create a new category if it doesn't exist
                $existingCategory = Category::create(['title' => $categoryTitle]);
                Log::info('Created new category: ' . $categoryTitle);
            }
    
            // Prepare blog data for insertion
            $blogs[] = [
                'title' => $title,
                'description' => $description,
                'author' => $author,
                'image' => $image,
                'category_id' => $existingCategory->id, // Use the ID of the existing or newly created category
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        // Insert new blogs in bulk if any
        if (!empty($blogs)) {
            Blog::insert($blogs);
            Log::info('Inserted blogs: ' . count($blogs));
            Storage::delete($path); // Optionally delete the uploaded file
            return redirect()->back()->with('success', 'Blogs imported successfully.');
        }
    
        return redirect()->back()->with('error', 'No blogs to import.');
    }
}
