<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Basket;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;

class BasketController extends Controller
{

    public function index(User $user)
    {
        $books = Book::all();
        $genres = Genre::all();

        return view('user.my_basket', compact(['books', 'genres', 'user']));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function UserBaskets(User $user)
    {
        $books = Books::all();
        $baskets = Basket::where('user_id', $user->id)->get();

        return view('user.my_basket', compact(['books', 'baskets']));

    }
}
