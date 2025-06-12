<x-app-layout>
    <x-slot name="header">
        <h2 class="text-white w-full h-full p-4 flex flex-col space-y-4 font-semibold text-xl leading-tight">
            {{ __('Welcome to HMJewellery') }}
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <!-- Image at the top -->
            <div class="w-full h-[500px] overflow-hidden rounded-t-lg mb-8">
                <img src="{{ asset('images/index_backg.webp') }}" alt="Store Background"
                     class="w-full h-full object-contain">
            </div>

            <!-- Text content below the image -->
            <div class="p-8 text-center bg-white">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-4">
                    Welcome to Our Store!
                </h1>
                <p class="text-lg sm:text-xl text-gray-700 mb-8 max-w-2xl mx-auto">
                    Discover a world of unique products and exceptional quality.
                </p>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-gray-900 bg-yellow-500 hover:bg-yellow-600 transition duration-300 ease-in-out transform hover:scale-105">
                    Start Shopping
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

</x-app-layout>

