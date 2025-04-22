@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product</h2>

    <form action="{{ url('/admin/update/' . $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3" required>{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $product->price }}" required>
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            <img src="{{ asset('storage/' . $product->image_path) }}" width="100"><br><br>
            <label>Change Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
    </form>
</div>
@endsection
