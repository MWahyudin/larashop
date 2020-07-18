<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('category_images', 'public');
            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'created_by' => Auth()->user()->id,
                'image' => $image_path,
            ]);
        } else {
            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'created_by' => Auth()->user()->id,
            ]);
        }

        return redirect()->route('categories.index')->with('status', 'Category succesfuly added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        
        $data = $request->validate([
            'name' => 'required|min:8',
        ]);

       
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('category_images', 'public');
            Storage::delete('public/'.$category->image);
            $category->update(array_merge($data, [
                'slug' => str::slug($request->name),
                'image' => $image_path,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]));

        }else{
            $category->update(array_merge($data, [
                'slug' => str::slug($request->name),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]));
        }

        // dd($file);

        return redirect()->route('categories.edit', [$category->id])->with('status', 'Succesfuly updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('status','Successfuly deleted');
    }
}
