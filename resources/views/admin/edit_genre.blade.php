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
                <h5>Edit Genre with ID:{{$genre->id}}</h5>
            </div>


            <p class="text-center mt-5">
                <a href="{{route('genres.index')}}" class="btn btn-outline-secondary">Back</a>
            </p>

            <div class="col-sm-4 offset-4">
                <form action="{{route('genres.update',$genre->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="genre-name">Genre Name:</label>
                        <input  type="text" id="genre-name" class="form-control"value="{{$genre->genre_name}}" name="genre_name">
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



