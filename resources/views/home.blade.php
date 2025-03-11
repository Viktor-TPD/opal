<x-layout>
    <section class="index-layout">
        <aside class="index-sidebar dashboard-sidebar"> 
               <h1 class="sidebar-title">Dashboard</h1>
        </aside>

        <!-- Main Content -->
        <div class="index-content">
            <div class="dashboard-container">
                <h1 class="dashboard-title">Welcome to the Management System</h1>
                
                <div class="dashboard-links">
                    <a href="{{ route('products.index') }}" class="dashboard-link">
                        <div class="dashboard-card">
                            <h2>Products</h2>
                            <p>Manage product inventory</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('categories.index') }}" class="dashboard-link">
                        <div class="dashboard-card">
                            <h2>Categories</h2>
                            <p>Organize product categories</p>
                        </div>
                    </a>
                    
                    @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('users.index') }}" class="dashboard-link">
                        <div class="dashboard-card">
                            <h2>Users</h2>
                            <p>Manage system users and permissions</p>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
            <div class="image-container">
                <img src="{{ asset('images/opal.png') }}" alt="Opal Logo">
            </div>
        </div>
    </section>
</x-layout>