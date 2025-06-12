<x-layout>
    <x-slot name="header">
        <h2 class="text-white w-full h-full p-4 flex flex-col space-y-4 font-semibold text-xl leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <h1 class="text-2xl font-bold mb-4">{{ $category->category_name}} Products</h1>

    @if ($products->count())
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-6 col-lg-4">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">No products available.</div>
    @endif

</x-layout>