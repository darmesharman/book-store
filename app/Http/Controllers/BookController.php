<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Basket;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;

class BookController extends Controller
{
    use UploadTrait;

    public function index()
    {
        $books = Book::all();
        $genres = Genre::all();

        if (request('search')) {
            $books = $books->filter(function ($book, $key) {
                if (stripos($book->book_name, request('search')) !== false) {
                    return true;
                }
                return false;
            });
        }

        if (request('order') === 'random') {
            $books = $books->shuffle();
        } else if (request('order') === 'alpha') {
            $books = $books->sortBy('book_name');
        } else if (request('order') === 'latest') {
            $books = $books->sortByDesc('created_at');
        }


        return view('books.index', compact(['books', 'genres']));
    }


    public function create()
    {
        $genres = Genre::all();
        $authors = Author::all();
        return view('books.create', compact(['genres','authors']));
    }


    public function store(Request $request)
    {
        $book = new Book();
        $book->book_name = $request->input('book_name');
        $book->book_text = $request->input('book_text');
        $book->price = $request->input('price');
        $book->genre_id = $request->input('genre_id');

        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = 'img/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $book->image = $filePath;
        }

        $book->save();

        $book->authors()->attach($request->input('authors'));

        return redirect()->route('books.index')->with('success', "Your book has been saved!");
    }


    public function show(Book $book)
    {
        $genres = Genre::all();
        return view('books.show', compact(['book', 'genres']));

    }


    public function edit(Book $book)
    {
        $genres = Genre::all();
        $authors = Author::all();
        return view('books.edit', compact(['book', 'genres','authors']));
    }

    public function update(Request $request, Book $book)
    {
        $book->update($request->only('book_name','price','genre_id','book_text'));

        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = 'img/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $book->image = $filePath;
        }

        $book->save();

        $book->authors()->detach(Author::all());
        $book->authors()->attach($request->input('authors'));

        return redirect()->route('books.index')->with('success', "Your book has been edited!");
    }


    public function destroy(Book $book)
    {
        $book->delete();

        return back();
    }

    public function booksByGenre(Genre $genre){
        $genres = Genre::all();
        $books = Book::where('genre_id', $genre->id)->get();

        return view('books.index', compact(['books', 'genres']));

    }

    public function toKorzina(Request $request){
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->book_id = $request->input('book');

        if (request('order') === 'ADD TO BASKET') {
            $order->status = 'korzina';
            $message = 'Book added to basket';
        } else {
            $order->status = 'pokupka';
            $message = 'Thank you for your purchase:)';
        }

        $order->save();

        return back()->with('success', $message);
    }

    public function korzina()
    {
        $orders = Order::where('status', 'korzina')->get();
        $total = 0;

        return view('user.my_basket', compact('orders', 'total'));
    }

    public function buy(Request $request, Order $order)
    {
        $order = Order::find(request('order'));
        $order->status = 'pokupka';
        $order->save();

        return back()->with('success', 'Thank you for your purchase:)');
    }

    public function fromKorzina(Request $request, Order $order)
    {
        $order = Order::find(request('order'));
        $order->delete();

        return back();
    }

    public function checkout()
    {
        foreach(auth()->user()->orders as $order) {
            $order->status = 'pokupka';
            $order->save();
        }

        return back()->with('success', 'Thank you for your purchases\n Happy to see you again:)');
    }

    public function purchases()
    {
        $orders = Order::where('status', 'pokupka')->get();
        $total = 0;

        return view('user.my_purchases', compact('orders', 'total'));
    }
}

