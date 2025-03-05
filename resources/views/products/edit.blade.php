<x-layout>

<h1>Edit Product</h1>

<x-errors />

<form method="post" action="{{ route('products.update', $product) }}">
    @method('PATCH')

<x-products.form :product="$product" :categories="$categories"/>

</form>

</x-layout>