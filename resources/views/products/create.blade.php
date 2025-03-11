<x-layout>
    <article class="paddingContainer">
        <h1>New Product</h1>

        <x-errors />

        <form method="post" action="{{ route('products.store') }}">

            <x-products.form :product="$product" :categories="$categories" />

        </form>
    </article>
</x-layout>