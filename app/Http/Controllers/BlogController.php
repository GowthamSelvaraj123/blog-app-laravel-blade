<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class BlogController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
    
        // Assuming you're searching by the 'title' field, you can change this as needed
        $results = Blog::where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->get();
    
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
        $blogs = Blog::orderBy('created_at')->paginate(2);
        return view('blogs.index', [
            'blogs' => $blogs
        ]);
        //return view('blogs.index', compact('blogs'));
    }
    public function welcome()
    {
        $blogs = Blog::all();
        return view('welcome', compact('blogs'));
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
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|exists:categories,id',
        ]);
        $imagePath = 'default-image-path.jpg';
                $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        ///dd($imagePath);
        Blog::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'author' => $request->input('author'),
            'image' => $imagePath,
            'category' => $request->input('category'),
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
}
