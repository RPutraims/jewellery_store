@vite(['resources/css/app.css', 'resources/js/app.js'])
<nav class="bg-purple shadow relative z-50">
    <div class="max-w-7xl mx-auto px-8 sm:px-12 lg:px-20">
        <div class="flex items-center justify-between h-20">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20">
            </a>
            <div class="flex space-x-6 items-center relative group">
                {{-- Products Dropdown --}}
                    @php use Illuminate\Support\Str; @endphp

                    <div 
                        x-data="{ open: false, timer: null }" 
                        @mouseenter="clearTimeout(timer); open = true" 
                        @mouseleave="timer = setTimeout(() => open = false, 300)" 
                        class="relative"
                    >
                        <form method="GET" action="{{ route('products.index') }}">
                            <button 
                                type="submit"
                                class="text-gold text-lg"
                                @click="open = false"
                            >
                                Products
                            </button>
                        </form>

                        <div 
                            x-show="open" 
                            x-transition 
                            class="absolute bg-purple text-white mt-2 py-4 px-6 rounded shadow-lg z-50 w-80 grid grid-cols-2 gap-4"
                            @mouseenter="clearTimeout(timer); open = true"
                            @mouseleave="timer = setTimeout(() => open = false, 300)"
                        >
                            <!-- Men's Categories -->
                            <div>
                                <h3 class="font-semibold mb-2 text-sm text-gold">Men's</h3>
                                @foreach ($categories as $category)
                                    @php
                                        $name = Str::lower($category->category_name);
                                    @endphp
                                    @if(Str::contains($name, 'men') && !Str::contains($name, 'women'))
                                        <a 
                                            href="{{ route('products.byCategory', $category->id) }}" 
                                            class="block px-2 py-1 hover:bg-gold hover:text-purple transition text-sm"
                                        >
                                            {{ $category->category_name }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Women's Categories -->
                            <div>
                                <h3 class="font-semibold mb-2 text-sm text-gold">Women's</h3>
                                @foreach ($categories as $category)
                                    @php
                                        $name = Str::lower($category->category_name);
                                    @endphp
                                    @if(Str::contains($name, 'women'))
                                        <a 
                                            href="{{ route('products.byCategory', $category->id) }}" 
                                            class="block px-2 py-1 hover:bg-gold hover:text-purple transition text-sm"
                                        >
                                            {{ $category->category_name }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>






                {{-- Auth Links --}}
                @auth
                    @can('create', App\Models\Product::class)
                    <a class="nav-link" href="{{ route('products.create') }}">Create Listing</a>
                    @endcan
                    <a href="{{ route('profile.edit') }}" class="text-gold text-lg hover:underline">Profile</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button class="text-gold text-lg hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gold text-lg">Sign In</a>
                    <a href="{{ route('register') }}" class="text-gold text-lg">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
