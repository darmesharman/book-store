<!DOCTYPE html>
<html lang="en">
<head>
    @include('books.head')
    <title>Add Author</title>
</head>
<body>
<div class="container">

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="col-md-12 text-center">
                <h5>Add a new Genre</h5>
            </div>


            <p class="text-center mt-5">
                <a href="{{route('genres.index')}}" class="btn btn-outline-secondary">Back</a>
            </p>
            <div class="col-sm-4 offset-4">
                <form action="{{route('genres.store')}}" method="post">
                    @csrf

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="genre-name">Genre Name::</label>
                        <input  type="text" id="genre-name" class="form-control" name="genre_name">
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


