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
                <h5>Add a new Author</h5>
            </div>


            <p class="text-center mt-5">
                <a href="{{route('authors.index')}}" class="btn btn-outline-secondary">Back to all Books</a>
            </p>
            <div class="col-sm-4 offset-4">
                <form action="{{route('authors.store')}}" method="post">
                    @csrf
                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="author-surname">Surname:</label>
                        <input  type="text" id="author-surname" class="form-control" name="surname">
                    </div>

                    <div style="margin-bottom: 25px" class="form-group">
                        <label for="author-name">Name::</label>
                        <input  type="text" id="author-name" class="form-control" name="name">
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


