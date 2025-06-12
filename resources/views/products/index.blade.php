<x-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">Products</h2>
    </x-slot>

    <h1 class="mb-4">Products</h1>

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