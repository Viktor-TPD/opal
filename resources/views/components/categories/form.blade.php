@csrf
<article class="editContainer">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}">

    <label for="description">Description</label>
    <textarea name="description"
        id="description">{{ old('description', $category->description ?? '') }}</textarea>

    <button>Save</button>
    <br>
    <a class="linkButton" href="{{ route('categories.index') }}">Back to Categories</a>
</article>