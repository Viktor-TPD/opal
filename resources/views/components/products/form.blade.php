@csrf
<article class="editContainer">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}">

    <label for="description">Description</label>
    <textarea
        name="description"
        id="description">{{ old('description', $product->description ?? '') }}</textarea>

    <label for="price">Price</label>
    <input type="text" name="price" id="price"
        value="{{ old('price', $product->price ?? '') }}">

    <label for="category_id">Category</label>
    <select name="category_id" id="category_id">
        <option value="">-- Select Category --</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
    </select>

    <button>Save</button>
    <br>
    <a class="linkButton" href=" {{ route('products.index') }}">Back to Products</a>
</article>