@extends('layouts.app')

@section('head-content')
    <style>
        .form-delete {
            display: inline-block;
        }
    </style>
@endsection

@section('content')

<div class="content">
    <div class="container">

        <div class="row">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>{{session('success')}}
                    <button type="button" class="close" data-dismiss ="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="row mt-3">
            @if (Auth::user() && Auth::user()->hasRole('admin'))
                <div class="col-md-12 text-center">
                    <div class="text-center my-3">
                        <a class="btn btn-outline-info" href="{{route('users.index')}}" role="button">Users</a>
                    </div>
                </div>
            @endif

            <div class="col-md-12">
                <div class="col-md-12 text-center" style="margin-bottom: 5%;">
                    <h5>All Books</h5>
                    @foreach($genres as $gen)
                        <a class="btn btn-outline-info" href="{{route('books.genre',$gen->id)}}" role="button">{{$gen->genre_name}}</a>
                    @endforeach

                    @auth
                        <a href ="{{ route('korzina') }}" class="btn btn-outline-secondary">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            My basket
                        </a>
                    @endauth
                </div>

                <div class="text-center">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.index', ['order' => 'latest']) }}">Latest</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.index', ['order' => 'alpha']) }}">Alphbetically</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.index', ['order' => 'random']) }}">Random</a>
                        </li>
                    </ul>
                </div>

                @if (Auth::user() && Auth::user()->hasRole('moderator'))
                    <div class="col-md-12 text-center">
                        <div class="text-center my-3">
                            <a href="{{ route('books.create') }}" class="btn btn-outline-secondary"> <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg> Add new Book</a>

                            <a class="btn btn-outline-info" href="{{route('authors.index')}}" role="button">Authors</a>
                            <a class="btn btn-outline-info" href="{{route('genres.index')}}" role="button">Genres</a>

                        </div>
                    </div>
                @endif

                <div class="col-md-12">
                    @foreach ($books as $book)
                        <div class="d-inline-block">
                            <div class="card" style="width: 18rem;  margin-bottom: 10%;">
                                <img src="{{ asset($book->image) }}" style=""  class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{$book->book_name}}</h5>
                                    <p class="card-text">
                                        <h6 class="text-muted">authors:</h6>
                                        @foreach ($book->authors as $author)
                                            <label class="text-muted">{{ $author->name }} {{ $author->surname }}</label>
                                        @endforeach

                                        <label>Genre: {{ $book->genre->genre_name }}</label>
                                        <p>Price: {{ $book->price }}$</p>
                                    </p>
                                    <a href="{{route('books.show', $book->id)}}" class="btn btn-info mb-3">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                                            <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                        Show
                                    </a>
                                    <br>
                                    @if (Auth::user() && Auth::user()->hasRole('admin'))
                                        <a href="{{route('books.edit', $book->id)}}" class="btn btn-success"> <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                                            </svg></a>
                                        <form style="display: inline" class="form-delete" action="{{route('books.destroy',$book->id)}}"  method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                                </svg></button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection


