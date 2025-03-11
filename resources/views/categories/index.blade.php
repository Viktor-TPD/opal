<x-layout>
    <section class="index-layout">
        <aside class="index-sidebar"> 
            <div class="sidebar-top">
               <h1 class="sidebar-title">Categories</h1>
               <a href="{{ route('categories.create') }}" class="add-new-item">+ Add New Category</a>
              <h1 class="sidebar-title">Search:</h1>
                 <form action="{{ route('categories.index') }}" method="GET" class="search-form">
                <div class="search-container">
                    <select name="search_field" class="search-select">
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
                    class="search-input"
                >
                <button type="submit" class="search-button">Search</button>
                @if(request('search'))
                    <a href="{{ route('categories.index') }}" class="clear-search">Clear search</a>
                @endif
            </div>
        </form>
    </div>
    <section class="navbar-footer">
        <a href="{{ route('home')}}" class="nav-link">Home</a>
        <a href="{{ route('products.index')}}" class="nav-link">Products</a>
        @if(auth()->check() && auth()->user()->isAdmin())
            <a href="{{ route('users.index') }}">Users Management</a>
        @endif
    </section>
    </aside>

        <!-- Main Content -->
        <div class="index-content">
            @if($categories->count() > 0)
                <div class="index-table-container">
                    <table class="index-table">
                        <thead>
                            <tr>
                                <th>Name</th>    
                                <th>Description</th>
                                <th>Edit</th>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        <a href="{{ route('categories.show', $category->id) }}" class="category-link">
                                            {{ $category->name }}
                                        </a>
                                    </td>
                                    <td>{{ $category->description }}</td>
                                    <td><a href="{{ route('categories.edit', $category->id) }}" class="category-link">
                                            Edit</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="pagination-container">
                    {{ $categories->links('vendor/pagination/bootstrap-4') }}
                </div>
            @else
                <p class="no-results">No categories found.</p>
            @endif
        </div>
    </section>
</x-layout>