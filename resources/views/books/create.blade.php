<!DOCTYPE html>
<html lang="en">
<head>
    @include('books.head')
    <title>Add Book</title>
</head>
<body>
<div class="container">

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="col-md-12 text-center">
                <h5>Add a new Book</h5>
            </div>


            <p class="text-center mt-5">
                <a href="{{route('books.index')}}" class="btn btn-outline-secondary">Back to all Books</a>
            </p>
            <div class="col-sm-4 offset-4">
                <form action="{{route('books.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="book-name">Book Name:</label>
                        <input  type="text" id="book-name" class="form-control" name="book_name">
                    </div>

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="book-text">Book Text:</label>
                        <input  type="text" id="book_text" class="form-control" name="book_text">
                    </div>

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="book-price">Price:</label>
                        <input  type="text" id="book-price" class="form-control" name="price">
                    </div>

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="book-genre">Genre:</label>
                        <select name="genre_id" id="book-genre" class="form-control form-control-lg">
                        @foreach($genres as $gen)
                            <option value="{{$gen->id}}">{{$gen->genre_name}}</option>
                        @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="book-author">Author:</label>
                        <select name="authors[]" id="book-author" class="form-control form-control-lg" multiple>
                            @foreach($authors as $author)
                                <option value="{{$author->id}}">{{$author->surname}} {{$author->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="book-image">Image</label>
                        <input  type="file" id="book-image" class="form-control" name="image">
                    </div>

                    <div class="form-group">
                        <button type = "submit" class="btn btn-success">ADD</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
</body>
</html>

