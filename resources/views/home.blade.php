@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            @if (auth()->user()->is_admin)
                             <a href="{{ route('products.create') }}" class="btn btn-info">Add New Product</a>
                                <hr>
                        @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Sl</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Price Type</th>
                                <th scope="col">Eur Price</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->price_type }}</td>
                                    <td>{{ $product->price_eur }}</td>
                                    <td>
                                        <a href="{{ route('products.edit',$product->id) }}" class="btn btn-success" >edit</a>
                                        <a href="{{ route('products.delete',$product->id) }}" class="btn btn-success" >Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="2">No Products Found</th>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
