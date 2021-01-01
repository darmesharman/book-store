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
                <h5>Edit Author with ID:{{$author->id}}</h5>
            </div>


            <p class="text-center mt-5">
                <a href="{{route('authors.index')}}" class="btn btn-outline-secondary">Back</a>
            </p>

            <div class="col-sm-4 offset-4">
                <form action="{{route('authors.update',$author->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="author-surname">Surname:</label>
                        <input  type="text" id="author-surname" class="form-control"value="{{$author->surname}}" name="surname">
                    </div>

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="author_name">Name:</label>
                        <input  type="text" id="author-name" class="form-control" value="{{$author->name}}" name="name">
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



