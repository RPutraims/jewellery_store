<x-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">Shopping cart</h2>
    </x-slot>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(empty($cart))
            <div class="text-center py-16">
                <i class="fas fa-shopping-cart text-gray-400 text-6xl mb-4"></i>
                <h2 class="text-2xl font-semibold text-gray-600 mb-4">Your cart is empty</h2>
                <p class="text-gray-500 mb-8">Add some beautiful jewelry to get started!</p>
                <a href="{{ route('products.index') }}" 
                class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    Continue Shopping
                </a>
            </div>
        @else
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @foreach($cart as $cartKey => $item)
                            <div class="p-6 border-b border-gray-200 last:border-b-0">
                                <div class="flex items-center space-x-4">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        @if($item['product_photo'])
                                            <img src="{{ asset('storage/' . $item['product_photo']) }}" 
                                                alt="{{ $item['product_name'] }}"
                                                class="w-20 h-20 object-cover rounded-lg">
                                        @else
                                            <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Details -->
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $item['product_name'] }}</h3>
                                        
                                        @if($item['material_name'])
                                            <p class="text-sm text-gray-600">Material: {{ $item['material_name'] }}</p>
                                        @endif
                                        
                                        @if($item['size_name'])
                                            <p class="text-sm text-gray-600">Size: {{ $item['size_name'] }}</p>
                                        @endif
                                        
                                        <p class="text-lg font-semibold text-gray-900 mt-2">
                                            ${{ number_format($item['price'], 2) }}
                                        </p>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center space-x-2">
                                        <form action="{{ route('cart.update', $cartKey) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                            <button type="submit" 
                                                    class="w-8 h-8 bg-gray-100 text-gray-600 rounded-full hover:bg-gray-200 transition-colors"
                                                    {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                <span class="fas fa-minus inline-block w-4 h-4 text-xs"></span>
                                            </button>
                                        </form>
                                        
                                        <span class="w-12 text-center font-medium">{{ $item['quantity'] }}</span>
                                        
                                        <form action="{{ route('cart.update', $cartKey) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                            <button type="submit" 
                                                    class="w-8 h-8 bg-gray-100 text-gray-600 rounded-full hover:bg-gray-200 transition-colors">
                                                <span class="fas fa-plus inline-block w-4 h-4 text-xs"></span>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Item Total -->
                                    <div class="text-right">
                                        <p class="text-lg font-semibold text-gray-900">
                                            ${{ number_format($item['total'], 2) }}
                                        </p>
                                        <form action="{{ route('cart.remove', $cartKey) }}" method="POST" class="inline mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-800 transition-colors text-sm">
                                                <i class="fas fa-trash mr-1"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Continue Shopping -->
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" 
                        class="text-blue-600 hover:text-blue-800 font-medium">
                            <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                        </a>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Summary</h2>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal ({{ $totals['item_count'] }} items)</span>
                                <span class="font-medium">${{ number_format($totals['subtotal'], 2) }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax</span>
                                <span class="font-medium">${{ number_format($totals['tax'], 2) }}</span>
                            </div>
                            
                            <div class="border-t pt-3">
                                <div class="flex justify-between text-lg font-semibold">
                                    <span>Total</span>
                                    <span>${{ number_format($totals['total'], 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <button class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium mt-6 hover:bg-blue-700 transition-colors">
                            Proceed to Checkout
                        </button>

                        <form action="{{ route('cart.clear') }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full bg-gray-200 text-gray-800 py-2 rounded-lg font-medium hover:bg-gray-300 transition-colors"
                                    onclick="return confirm('Are you sure you want to clear your cart?')">
                                Clear Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

</x-layout>