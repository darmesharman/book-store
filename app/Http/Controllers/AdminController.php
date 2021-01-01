<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        $books = Book::all();
        $genres = Genre::all();

        return view('admin.index_book_admin', compact(['books', 'genres']));
    }


    public function create()
    {
        $genres = Genre::all();
        $authors = Author::all();
        return view('admin.create_book_admin', compact(['genres','authors']));
    }


    public function store(Request $request)
    {
        $book = new Book();
        $book->book_name = $request->input('book_name');
        $book->book_text = $request->input('book_text');
        $book->price = $request->input('price');
        $book->genre_id = $request->input('genre_id');
        $book->image = $request->input('image');
        $book->save();
        $book->authors()->sync($request->input('author_id'));
        return redirect()->route('books.index');
        // return redirect()->route('admin.index_book_admin')->with('success', "Your book has been saved!");
    }


    public function show(Book $book)
    {
        $genres = Genre::all();
        return view('admin.show_book_admin', compact(['book', 'genres']));

    }


    public function edit(Book $book)
    {
        $genres = Genre::all();
        $authors = Author::all();
        return view('admin.edit_book_admin', compact(['book', 'genres','authors']));
    }

    public function update(Request $request, Book $book)
    {
        $book->update($request->only('book_name','price','genre_id','book_text','image'));

        return redirect()->route('admin.index')->with('success', "Your book has been updated!");
    }


    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.index')->with('success', "Your book has been deleted!");
    }

    public function booksByGenre(Genre $genre){
        $genres = Genre::all();
        $books = Book::where('genre_id', $genre->id)->get();

        return view('admin.index_book_admin', compact(['books', 'genres']));

    }
}
