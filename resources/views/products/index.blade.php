<x-layout>
    <section class="index-layout">
        <aside class="index-sidebar"> 
            <div class="sidebar-top">
               <h1 class="sidebar-title">Products</h1>
               <a href="{{ route('products.create') }}" class="add-new-item">+ Add New Product</a>
              <h1 class="sidebar-title">Search:</h1>
                 <form action="{{ route('products.index') }}" method="GET" class="search-form">
                <div class="search-container">
                    <select name="search_field" class="search-select">
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
                    value="{{ request('search') }}"
                    class="search-input"
                >
                <button type="submit" class="search-button">Search</button>
                @if(request('search'))
                    <a href="{{ route('products.index') }}" class="clear-search">Clear search</a>
                @endif
            </div>
        </form>
    </div>
    <section class="navbar-footer">
        <a href="{{ route('home')}}" class="nav-link">Home</a>
        <a href="{{ route('categories.index')}}" class="nav-link">Categories</a>
        @if(auth()->check() && auth()->user()->isAdmin())
            <a href="{{ route('users.index') }}">Users Management</a>
        @endif
    </section>
    </aside>

        <!-- Main Content -->
        <div class="index-content">
            @if($products->count() > 0)
                <div class="index-table-container">
                    <table class="index-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Edit</th>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <a href="{{ route('products.show', $product->id) }}" class="category-link">
                                            {{ $product->name }}
                                        </a>
                                    </td>
                                    <td>{{ optional($product->category)->name ?? 'Uncategorized' }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>${{ $product->price }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="category-link">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="pagination-container">
                    {{ $products->links('vendor/pagination/bootstrap-4') }}
                </div>
            @else
                <p class="no-results">No products found.</p>
            @endif
        </div>
    </section>
</x-layout>