<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $categorys = Category::all();
        return view('category.index', compact('categorys'));
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
        return redirect()->route('categorys.index')->with('success', 'Blog added successfully.');
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
        return redirect()->route('categorys.index')->with('success', 'Blog added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categorys.index')->with('success', 'Blog deleted successfully!');
    }
}
