@vite(['resources/css/app.css', 'resources/js/app.js'])

<nav class="bg-purple text-white w-full h-full p-4 flex flex-col space-y-4">
    <!-- Logo -->
    <div class="mb-6 text-center">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-24 mx-auto">
        </a>
    </div>

    <!-- Auth Links -->
    <div>
        @auth
            <a href="{{ route('profile.edit') }}" class="block py-2 px-4 text-gold hover:bg-gold hover:text-purple rounded-md transition duration-200">
                <i class="fa-solid fa-user mr-2"></i> User Profile
            </a>
        @else
            <a href="{{ route('login') }}" class="block py-2 px-4 text-gold hover:bg-gold hover:text-purple rounded-md transition duration-200">
                <i class="fa-solid fa-right-to-bracket mr-2"></i> Sign In
            </a>
            <a href="{{ route('register') }}" class="block py-2 px-4 text-gold hover:bg-gold hover:text-purple rounded-md transition duration-200">
                <i class="fa-solid fa-user-plus mr-2"></i> Register
            </a>
        @endauth
    </div>

    <hr class="border-t border-gold opacity-20">

    @auth
        <form action="{{ route('logout') }}" method="POST" class="inline-block w-full">
            @csrf
            <button type="submit" class="w-full text-left py-2 px-4 text-gold hover:bg-gold hover:text-purple rounded-md transition duration-200">
                <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
            </button>
        </form>
    @endauth

    <hr class="border-t border-gold opacity-20">

    <!-- Products Dropdown -->
    <div x-data="{ open: false }">
        <button @click="open = !open"
                class="w-full text-left py-2 px-4 text-gold text-lg hover:bg-gold hover:text-purple rounded-md transition duration-200">
            <i class="fa-solid fa-gem mr-2"></i> Products
        </button>

        

        <div x-show="open" x-transition class="mt-2 pl-4 space-y-1">
            <a href="{{ route('products.index', ['sort' => 'product_rating']) }}"
               class="block px-2 py-1 text-sm hover:bg-gold hover:text-purple rounded-md transition duration-200">
                All Products
            </a>
            <h4 class="font-semibold text-sm text-gold">Men's</h4>
            @foreach ($categories as $category)
                @php $name = Str::lower($category->category_name); @endphp
                @if(Str::contains($name, 'men') && !Str::contains($name, 'women'))
                    <a href="{{ route('products.byCategory', $category->id) }}"
                       class="block px-2 py-1 text-sm hover:bg-gold hover:text-purple rounded-md transition duration-200">
                        {{ $category->category_name }}
                    </a>
                @endif
            @endforeach

            <h4 class="font-semibold text-sm mt-3 text-gold">Women's</h4>
            @foreach ($categories as $category)
                @php $name = Str::lower($category->category_name); @endphp
                @if(Str::contains($name, 'women'))
                    <a href="{{ route('products.byCategory', $category->id) }}"
                       class="block px-2 py-1 text-sm hover:bg-gold hover:text-purple rounded-md transition duration-200">
                        {{ $category->category_name }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>

    <hr class="border-t border-gold opacity-20">

    <!-- Reviews Dropdown -->
    <div x-data="{ open: false }">
        <button @click="open = !open"
                class="w-full text-left py-2 px-4 text-gold text-lg hover:bg-gold hover:text-purple rounded-md transition duration-200">
            <i class="fa-solid fa-star mr-2"></i> Reviews
        </button>

        <div x-show="open" x-transition class="mt-2 pl-4 space-y-1">
            <a href="{{ route('reviews.index', ['sort' => 'product_rating']) }}"
               class="block px-2 py-1 text-sm hover:bg-gold hover:text-purple rounded-md transition duration-200">
                All reviews
            </a>
            @auth
                <a href="{{ route('reviews.create') }}"
                   class="block px-2 py-1 text-sm hover:bg-gold hover:text-purple rounded-md transition duration-200">
                    Create New Review
                </a>
            @endauth
        </div>
    </div>

    <hr class="border-t border-gold opacity-20">

    <!-- Shopping Cart -->
    <a href="{{ route('cart.index') }}"
       class="block py-2 px-4 text-gold hover:bg-gold hover:text-purple rounded-md transition duration-200">
        <i class="fa-solid fa-cart-shopping mr-2"></i> Shopping Cart
    </a>

    <!-- Create Listing -->
    @auth
        @can('create', App\Models\Product::class)
            <a class="block py-2 px-4 text-gold hover:bg-gold hover:text-purple rounded-md transition duration-200"
               href="{{ route('products.create') }}">
                <i class="fa-solid fa-plus-circle mr-2"></i> Create Listing
            </a>
        @endcan
    @endauth

