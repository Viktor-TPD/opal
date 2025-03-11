<x-layout>
    <article class="paddingContainer">
        <article class="showContainer">
            <article class="editContainer">
                <h1>{{ $category->name }}</h1>

                <p>{{ $category->description }}</p>

                <a class="linkButton" href=" {{ route('categories.edit', $category->id) }}">Edit</a>

                <form method="post" action="{{ route('categories.destroy', $category) }}">

                    @csrf
                    @method('DELETE')

                    <button>DELETE</button>

                </form>

                <br>

                <a class="linkButton" href="{{ route('categories.index') }}">Back to Categories</a>
            </article>
        </article>
    </article>
</x-layout>