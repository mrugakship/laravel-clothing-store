<h2>New Order Query</h2>

<p>Customer Email: {{ $customerEmail }}</p>

<ul>
@foreach($products as $product)
    <li>
        <strong>{{ $product->name }}</strong> - ${{ $product->price }}
    </li>
@endforeach
</ul>
g