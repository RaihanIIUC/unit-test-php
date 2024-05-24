@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Product Edit') }}</div>

                    <div class="card-body">

                        <form action="{{ route('products.update',$product->id) }}" method="post" >
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="name" value="{{ $product->name }}" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" value="{{ $product->price }}" class="form-control" id="price" placeholder="Price" name="price">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
