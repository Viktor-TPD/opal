<x-layout>
    <article class="paddingContainer">
        <article class="editContainer">
            <h1>{{ $product->name }}</h1>

            <p>{{ $product->description }}</p>

            <p>Price: ${{ $product->price }}</p>

            <a class="linkButton" href=" {{ route('products.edit', $product->id) }}">Edit</a>

            <form method="post" action="{{ route('products.destroy', $product) }}">

                @csrf
                @method('DELETE')

                <button>DELETE</button>

            </form>

            <br>

            <a class="linkButton" href=" {{ route('products.index') }}">Back to Products</a>
        </article>
    </article>
</x-layout>