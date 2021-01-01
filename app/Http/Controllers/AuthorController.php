<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function index()
    {
        $authors = Author::all();
        return view('admin.index_author', compact(['authors']));
    }


    public function create()
    {

        return view('admin.create_author');
    }


    public function store(Request $request)
    {
        $author = new Author();
        $author-> surname = $request->input('surname');
        $author-> name = $request->input('name');


        $author->save();

        return redirect()->route('authors.index')->with('success', "Author has been saved!");
    }

    public function show(Author $author)
    {

    }


    public function edit(Author $author)
    {
        return view('admin.edit_author', compact(['author']));
    }

    public function update(Request $request, Author $author)
    {
        $author->update($request->only('surname','name'));

        return redirect()->route('authors.index')->with('success', " Author has been updated!");
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', "Author has been deleted!");
    }
}
