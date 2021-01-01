<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{

    public function index()
    {
        $genres = Genre::all();
        return view('admin.index_genre', compact(['genres']));
    }

    public function create()
    {
        return view('admin.create_genre');
    }

    public function store(Request $request)
    {
        $genre = new Genre();
        $genre-> genre_name = $request->input('genre_name');


        $genre->save();

        return redirect()->route('genres.index')->with('success', "Your genre has been saved!");
    }

    public function show(Genre $genre)
    {
        //
    }


    public function edit(Genre $genre)
    {
        return view('admin.edit_genre', compact(['genre']));
    }

    public function update(Request $request, Genre $genre)
    {
        $genre->update($request->only('genre_name'));

        return redirect()->route('genres.index')->with('success', " Genre has been updated!");
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genres.index')->with('success', "Genre has been deleted!");
    }
}
