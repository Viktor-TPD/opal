<x-layout>

    <h1>New Category</h1>
    
    <x-errors />
    
    <form method="post" action="{{ route('categories.store') }}">
    
    <x-categories.form :category="$category" />
    
    </form>
    
</x-layout>