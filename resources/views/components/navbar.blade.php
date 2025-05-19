@vite(['resources/css/app.css', 'resources/js/app.js'])
<nav class="bg-purple shadow">
    <div class="max-w-7xl mx-auto px-8 sm:px-12 lg:px-20">
        <div class="flex items-center justify-between h-20">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20">
            </a>
            <div class="flex space-x-4">
                @auth
                    <a href="{{ route('profile') }}" class="text-gold text-lg hover:underline">Profile</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-gold text-lg hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gold text-lg">Sign In</a>
                    <a href="{{ route('register') }}" class="text-gold text-lg ">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
