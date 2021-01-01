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
                <h5>Edit a Book with ID:{{$book->id}}</h5>
            </div>


            <p class="text-center mt-5">
                <a href="{{route('books.index')}}" class="btn btn-outline-secondary">Back to all Books</a>
            </p>

            <div class="col-sm-4 offset-4">
                <form action="{{route('books.update',$book->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="book-name">Book Name:</label>
                        <input  type="text" id="book-name" class="form-control"value="{{$book->book_name}}" name="book_name">
                    </div>

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="book-text">Book Text:</label>
                        <input  type="text" id="book-text" class="form-control"value="{{$book->book_name}}" name="book_name">
                    </div>

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="book-price">Price:</label>
                        <input  type="text" id="book-price" class="form-control" value="{{$book->price}}" name="price">
                    </div>

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="book-genre">Genre:</label>
                        <select name="genre_id" id="book-genre" class="form-control form-control-lg">
                        @foreach($genres as $gen)
                            @if($gen->id == $book->genre->id)
                            <option value="{{$gen->id}}" selected>{{$gen->genre_name}}</option>
                            @else
                                <option value="{{$gen->id}}">{{$gen->genre_name}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="book-author">Author:</label>
                        <select name="author_id" id="book-author" class="form-control form-control-lg" multiple>
                            @foreach($authors as $author)
                                @if ($book->authors->contains($author))
                                    <option value="{{$author->id}}" selected>{{$author->surname}} {{$author->name}}</option>
                                @else
                                    <option value="{{$author->id}}">{{$author->surname}} {{$author->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="book-image">Image:</label>
                        <input  type="file" id="book-image" class="form-control" name="image">
                    </div>

                    <div class="form-group">
                        <button type = "submit" class="btn btn-success">EDIT</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

</body>
</html>


