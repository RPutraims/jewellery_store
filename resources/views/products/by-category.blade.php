@extends('layout')

@section('title', $category->name)

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $category->name }} Products</h1>

    @if($products->isEmpty())
        <p>No products found in this category.</p>
    @else
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($products as $product)
                <li class="bg-white p-4 rounded shadow">
                    <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
