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

                    <table class="table">
  <thead>
    <tr>
      <th scope="col">Sl</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Eur Price</th>
    </tr>
  </thead>
  <tbody>
   @forelse($products as $product)
   <tr>
      <th scope="row">1</th>
      <td>{{ $product->name }}</td>
      <td>{{ $product->price }}</td>
      <td>{{ $product->price_eur }}</td>
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
