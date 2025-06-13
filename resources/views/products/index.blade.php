<x-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">{{ __('Products') }}</h2>
    </x-slot>

    @if ($products->count())
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-6 col-lg-4">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">{{ __('No products available.') }}</div>
    @endif
</x-layout>