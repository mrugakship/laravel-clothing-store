<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // PUBLIC VIEW
    public function index()
    {
        $products = Product::latest()->get();
        return view('welcome', compact('products'));
    }

    // ADMIN LIST
    public function admin()
    {
        $products = Product::latest()->get();
        return view('admin.index', compact('products'));
    }

    // SHOW CREATE FORM
    public function create()
    {
        return view('admin.create');
    }

    // STORE NEW PRODUCT
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image_path' => $path,
        ]);

        return redirect('/admin')->with('success', 'Product added successfully!');
    }

    // SHOW EDIT FORM
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    // UPDATE PRODUCT
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image_path && Storage::exists('public/' . $product->image_path)) {
                Storage::delete('public/' . $product->image_path);
            }

            $path = $request->file('image')->store('products', 'public');
            $product->image_path = $path;
        }

        $product->save();

        return redirect('/admin')->with('success', 'Product updated successfully!');
    }

    // DELETE PRODUCT
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image
        if ($product->image_path && Storage::exists('public/' . $product->image_path)) {
            Storage::delete('public/' . $product->image_path);
        }

        $product->delete();

        return redirect('/admin')->with('success', 'Product deleted!');
    }
}
