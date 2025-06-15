<x-layout>
    <x-slot name="header">
        <h2 class="text-white w-full h-full p-4 flex flex-col space-y-4 font-bold text-3xl leading-tight">
            {{ __('Products') }}
        </h2>
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