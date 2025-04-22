@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($products))
        <ul class="list-group mb-3">
            @foreach($products as $product)
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        <strong>{{ $product->name }}</strong><br>
                        <small>${{ $product->price }}</small>
                    </div>
                </li>
            @endforeach
        </ul>

        <form action="{{ url('/cart/send') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Your Email</label>
                <input type="email" name="email" required class="form-control">
            </div>
            <button class="btn btn-primary" type="submit">Send Order Request</button>
        </form>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
