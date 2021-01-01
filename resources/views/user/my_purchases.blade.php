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
        <h3>Purchase history</h3>

        <div class="row">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong>{{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>


        <div class="card shopping-cart">
            <div class="card-header bg-light text-light">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Shipping cart
                <a href="{{ route('books.index') }}" class="btn btn-outline-info btn-sm pull-right">Continue shopping</a>
                {{-- <a href="{{route('user.index_user')}}" class="btn btn-outline-info btn-sm pull-right">Continue
                shopping</a> --}}
                <div class="clearfix"></div>
            </div>

            <div class="card-body">
                @foreach($orders as $order)
                    <p class="d-none">{{ $total += $order->book->price }}</p>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-2 text-center">
                            <img class="img-responsive" src="{{ asset($order->book->image) }}" alt="prewiew" width="120" height="180">
                        </div>
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                            <h4 class="book-name"><strong>{{ $order->book->book_name }}</strong></h4>
                            <h4>
                                <small>Genre: {{ $order->book->genre->genre_name }}</small>
                            </h4>
                        </div>
                        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                            <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                                <h6><strong>{{$order->book->price}}$<span class="text-muted"> x </span></strong></h6>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4">
                                {{-- <form action="{{ route('buy', ['order' => $order]) }}" method="post">
                                    @csrf
                                    @method('put')

                                    <button type="submit" class="btn btn-outline-success btn-xs">
                                        Buy
                                    </button>
                                </form> --}}
                            </div>
                            <div class="col-2 col-sm-2 col-md-2 text-right">
                                <form action="{{ route('fromKorzina', ['order' => $order]) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <button type="submit" class="btn btn-outline-danger btn-xs">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="card-footer">
                <div class="pull-right" style="margin: 10px">
                    <div class="pull-right" style="margin: 5px">
                        Total price: <b>{{ $total }}$</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
