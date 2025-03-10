<x-layout>

    <h1>{{ $category->name }}</h1>
    
    <p>{{ $category->description }}</p>
    
    <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
    
    <form method="post" action="{{ route('categories.destroy', $category) }}">
    
        @csrf
        @method('DELETE')
    
        <button>DELETE</button>
    
    </form>
    
    <br>
    
    <a href="{{ route('categories.index') }}">Back to Categories</a>
    
</x-layout>