<x-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">{{ __('Product page') }}</h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid md:grid-cols-2 gap-8">
            <!-- image -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($product->photo)
                    <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" 
                        class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                    </div>
                @endif
            </div>

            <!-- Details -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <nav class="text-sm mb-4">
                    <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">{{ __('Home') }}</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-500">{{ $product->name }}</span>
                </nav>

                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                
                <div class="mb-6">
                    <div class="flex items-center space-x-4">
                        @if($product->sale_price)
                            <span class="text-3xl font-bold text-red-600" id="display-price">${{ number_format($product->sale_price, 2) }}</span>
                            <span class="text-xl text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                            <span class="bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded">
                                {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% OFF
                            </span>
                        @else
                            <span class="text-3xl font-bold text-gray-900" id="display-price">${{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">{{ __('Description') }}</h3>
                    <p class="text-gray-600">{{ $product->description }}</p>
                </div>
                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <!-- Material Selection -->
                    @if($product->materials->count() > 0)
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Material') }} <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($product->materials as $material)
                                    <label class="relative">
                                        <input type="radio" name="material_id" value="{{ $material->id }}" 
                                            class="sr-only peer material-option"
                                            data-price-adjustment="{{ $material->pivot->price_increment + $material->price_increment }}"
                                            required>
                                        <div class="border-2 border-gray-200 rounded-lg p-3 cursor-pointer 
                                                peer-checked:border-blue-500 peer-checked:bg-blue-50 
                                                hover:border-gray-300 transition-colors">
                                            <div class="font-medium">{{ $material->material_name }}</div>
                                            @if($material->pivot->price_increment + $material->price_increment > 0)
                                                <div class="text-sm text-green-600">
                                                    +${{ number_format($material->pivot->price_increment + $material->price_increment, 2) }}
                                                </div>
                                            @endif
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('material_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    @if($product->sizes->count() > 0)
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Size') }} <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                                @foreach($product->sizes->sortBy('size') as $size)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="size_id" value="{{ $size->id }}"
                                            class="sr-only peer" required>
                                        
                                        <div class="border-2 border-gray-200 rounded-lg p-3 cursor-pointer 
                                                peer-checked:border-blue-500 peer-checked:bg-blue-50 
                                                hover:border-gray-300 transition-colors">
                                            <div>{{ $size->size_value }}</div>
                                            @if($size->pivot->price_increment > 0)
                                                <div class="text-xs text-green-600 mt-1">
                                                    +${{ number_format($size->pivot->price_increment, 2) }}
                                                </div>
                                            @endif
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('size_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif




                    <!-- Quantity -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Quantity') }}</label>
                        <select name="quantity" class="border border-gray-300 rounded-lg px-3 py-2 w-20">
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Add to cart button -->
                    <div class="flex space-x-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        @if(request('action') === 'buy')
                            <input type="hidden" name="redirect_to_cart" value="1"> 
                        @endif
                        <button type="submit" 
                                class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg font-medium 
                                    hover:bg-blue-700 transition-colors flex items-center justify-center">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            {{ __('Add to Cart') }}
                        </button>
                        
                        <button type="button" 
                                class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg font-medium 
                                    hover:bg-gray-300 transition-colors">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                </form>

                <!-- Product Features -->
                <div class="mt-8 border-t pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="flex items-center">
                            <i class="fas fa-shipping-fast text-blue-600 mr-3"></i>
                            <div>
                                <div class="font-medium">{{ __('Free Shipping') }}</div>
                                <div class="text-sm text-gray-500">{{ __('On orders over $100') }}</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-undo text-blue-600 mr-3"></i>
                            <div>
                                <div class="font-medium">{{ __('30-Day Returns') }}</div>
                                <div class="text-sm text-gray-500">{{ __('Easy returns policy') }}</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-certificate text-blue-600 mr-3"></i>
                            <div>
                                <div class="font-medium">{{ __('Authentic') }}</div>
                                <div class="text-sm text-gray-500">{{ __('100% genuine products') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Update price when material or size is selected
        const basePrice = {{ $product->sale_price ?? $product->price }};
        const displayPrice = document.getElementById('display-price');
        const materialOptions = document.querySelectorAll('.material-option');
        const sizeOptions = document.querySelectorAll('.size-option');

        function updatePrice() {
            let totalPrice = basePrice;
            
            // Add material adjustment
            const selectedMaterial = document.querySelector('.material-option:checked');
            if (selectedMaterial) {
                totalPrice += parseFloat(selectedMaterial.dataset.priceAdjustment);
            }
            
            // Add size adjustment
            const selectedSize = document.querySelector('.size-option:checked');
            if (selectedSize) {
                totalPrice += parseFloat(selectedSize.dataset.priceAdjustment);
            }
            
            if (displayPrice) {
                displayPrice.textContent = '$' + totalPrice.toFixed(2);
            }
        }

        // Add event listeners
        materialOptions.forEach(option => {
            option.addEventListener('change', updatePrice);
        });
        
        sizeOptions.forEach(option => {
            option.addEventListener('change', updatePrice);
        });
    </script>

</x-layout>