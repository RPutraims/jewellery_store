<div class="card mb-3 shadow-sm"> 
    <div class="card-body"> 
        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="card-img-top mb-3" style="height: 350px; object-fit: cover;">
        <h5 class="card-title">{{ $product->name }}</h5> 
        <h6 class="card-subtitle mb-2 text-muted">{{ $product->category->name }}</h6> 
        <p class="card-text">{{ $product->description }}</p> 
        <ul class="list-unstyled mb-3"> 
            <li><strong>{{ __('Price') }}:</strong> 
                @if($product->sale_price)
                    <span class="text-decoration-line-through text-muted">${{ number_format($product->price, 2) }}</span>
                    <span class="text-danger fw-bold">${{ number_format($product->sale_price, 2) }}</span>
                @else
                    ${{ number_format($product->price, 2) }}
                @endif
            </li> 
            <li><strong>{{ __('Category:') }}</strong> {{ $product->category->name }}</li> 
            <li><strong>{{ __('Added:') }}</strong> {{ $product->created_at?->format('Y-m-d') }}</li> 
        </ul> 
        @auth
            <a href="{{ route('products.show', ['product' => $product->id]) }}" class="btn btn-primary">{{ __('Add To Cart') }}</a>
            <a href="{{ route('products.show', ['product' => $product->id, 'action' => 'buy']) }}" class="btn btn-primary">{{ __('Buy Now') }}</a>

            @if(auth()->user()->role === 'admin') {{-- or use any other admin check you have --}}
                <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-primary">{{ __('Edit product') }}</a>

                <form action="{{ route('products.delete', ['product' => $product->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('Delete product') }}</button>
                </form>
            @endif
        @else
            <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Add To Cart') }}</a>
            <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Buy Now') }}</a>
        @endauth


    </div> 
</div>