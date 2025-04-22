@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage Products</h2>
    <a href="{{ url('/admin/create') }}" class="btn btn-primary mb-3">Add New Product</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Preview</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/' . $product->image_path) }}" width="80"></td>
                    <td>{{ $product->name }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="{{ url('/admin/edit/' . $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ url('/admin/delete/' . $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
