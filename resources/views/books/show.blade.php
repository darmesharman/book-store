<!DOCTYPE html>
<html lang="en">
<head>
    @include('books.head')
</head>
<body>
<div class="container">

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="col-md-12 text-center">
                <h5>Info about Book </h5>
            </div>

            @if(session('success'))
                <div class="row">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong>{{session('success')}}
                            <button type="button" class="close" data-dismiss ="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                </div>
            @endif

            <p class="text-center mt-5">
                <a href="{{route('books.index')}}" class="btn btn-primary">GO BACK</a>
            </p>

            <div class="card mb-3" style="max-width: 800px;margin-left: 170px;">
                @csrf
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{ asset($book->image) }}" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{$book->book_name}}</h5>
                            <p class="card-text">{{$book->book_text}}</p>
                            <p class="card-text">Genre: {{ $book->genre->genre_name}}</p>
                            <p class="card-text"> Price: ${{$book->price}}</p>
                            <p class="card-text">
                            <label> Authors:</label>
                            <ul>
                                @foreach($book->authors as $author)
                                    <li>{{$author->surname}} {{$author->name}}</li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-end">
                <form action="{{ route('toKorzina') }}" method="post" class="d-inline justify-content-end">
                    @csrf

                    <input type="hidden" name="book" value="{{ $book->id }}">
                    <input type="submit" name="order" class="btn btn-warning" value="ADD TO BASKET">
                    <input type="submit" name="order" class="btn btn-success" value="BUY NOW">
                </form>
            </div>
        </div>

    </div>
</div>


</body>
</html>

