<x-layout>

    <h1>Products</h1>




    <a href="{{ route('home')}}">Home</a>

    <a class="linkButton" href="{{ route('products.create') }}">New Product</a>

    <form action="{{ route('products.index') }}" method="GET" class="search-form">
        <div>
            <select name="search_field">
                <option value="all" {{ request('search_field') == 'all' ? 'selected' : '' }}>All Fields</option>

                @foreach((new \App\Models\Product())->getFillable() as $field)
                <option value="{{ $field }}" {{ request('search_field') == $field ? 'selected' : '' }}>
                    {{ ucfirst($field) }}
                </option>
                @endforeach
            </select>

            <input
                type="text"
                name="search"
                placeholder="Search products..."
                value="{{ request('search') }}">

            <button type="submit">Search</button>

            @if(request('search'))
            <a href="{{ route('products.index') }}">Clear search</a>
            @endif
        </div>
    </form>
    @if($products->count() > 0)
    @foreach ($products as $product)

    <h2><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h2>
    <p>Category: {{ optional($product->category)->name ?? 'Uncategorized' }}</p>
    <p>{{ $product->description }}</p>
    <p>${{ $product->price }}</p>

    @endforeach

    {{ $products->links('vendor/pagination/bootstrap-4') }}

    @else
    <p>No products found.</p>
    @endif

</x-layout>