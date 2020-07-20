<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $books = Book::latest()->paginate(10);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => "required|min:8",
            'description' => "required|min:5",
            'author' => "required|min:8",
            'publisher' => "required|min:8",
            'price' => "required",
            'stock' => "required",
            'cover' => "nullable|mimes:jpeg,png,bmp",
        ]);

       $cover = $request->file('cover');
        if($request->hasFile('cover')){
            $path =$cover->store('books-covers', 'public');
        
        }
        $path = 'book-covers/AXZRAPBfc4uLe9u8aZanAIO5rpzpG2RPubW3s4Qo.png';

         
        Book::create(array_merge($data,[
            'cover' => $path,
            'slug' => Str::slug($request->get('title')),
            'created_by' => Auth()->user()->id,
            'status' => $request->save_action
        ]));

        $status = $request->save_action === "PUBLISH" ? 'Book succesfully saved and published' : 'Book saved as draft';
    return redirect()->route('books.create')->with('status',$status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
