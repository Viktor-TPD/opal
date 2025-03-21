<x-layout>
    <article class="loginContainer">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <h2>Login to your Account</h2>

            <label for="email">Email:</label>
            <input
                type="email"
                name="email"
                required
                value="{{ old('email') }}">

            <label for="password">Password:</label>
            <input
                type="password"
                name="password"
                required>

            <button type="submit">Log in</button>

            <!-- Validation Errors -->
            @if ($errors->any())
            <ul class="error-container">
                @foreach ($errors->all() as $error)
                <div class="error-text-container">
                    <img class="warningIcon" src="{{ asset('images/warning.svg') }}">
                    <li class="error-item">{{ $error }}</li>
                </div>
                @endforeach
            </ul>
            @endif

        </form>
    </article>
</x-layout>