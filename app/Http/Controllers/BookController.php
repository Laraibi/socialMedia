<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = Book::all();
        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
        $request->validate(['Name' => 'required', 'Author' => 'required']);
        $book = new Book($request->only('Name', 'Author'));
        $book->save();
        return response()->json($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(request $request)
    {
        //
        $request->validate(['book_id' => 'required|Numeric']);
        $book = Book::find($request->book_id);
        if ($book) {
            return response()->json($book);
        } else {
            return response('Book Inexistant', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request)
    {
        //
        $request->validate(['book_id' => 'required|Numeric', 'name' => 'required', 'author' => 'required']);
        $book = Book::find($request->book_id);
        if ($book) {
            $book->Name = $request->name;
            $book->Author = $request->author;
            $book->save();
            return response()->json($book);
        } else {
            return response('Book Inexistant', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //

        $request->validate(['book_id' => 'required|Numeric']);
        $book = Book::find($request->book_id);
        if ($book) {
            $book->delete();
            return response()->json('Book Deleted');
        } else {
            return response('Book Inexistant', 404);
        }
    }
}
