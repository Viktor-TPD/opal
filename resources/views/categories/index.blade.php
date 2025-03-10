<x-layout>

    <h1>Categories</h1>

    <a href="{{ route('home')}}">Home</a>
    
    <a href="{{ route('categories.create') }}">New Category</a>
    
    <form action="{{ route('categories.index') }}" method="GET" class="search-form">
        <div>
            <select name="search_field">
                <option value="all" {{ request('search_field') == 'all' ? 'selected' : '' }}>All Fields</option>
                
                @foreach((new \App\Models\Category())->getFillable() as $field)
                    <option value="{{ $field }}" {{ request('search_field') == $field ? 'selected' : '' }}>
                        {{ ucfirst($field) }}
                    </option>
                @endforeach
            </select>
            
            <input 
                type="text" 
                name="search" 
                placeholder="Search categories..." 
                value="{{ request('search') }}"
            >
            
            <button type="submit">Search</button>
            
            @if(request('search'))
                <a href="{{ route('categories.index') }}">Clear search</a>
            @endif
        </div>
    </form>
    
    @if($categories->count() > 0)
        @foreach ($categories as $category)
    
            <h2><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></h2>
            <p>{{ $category->description }}</p>
    
        @endforeach
    
        {{ $categories->links('vendor/pagination/simple-default') }}
    
    @else
        <p>No categories found.</p>
    @endif
    
    </x-layout>