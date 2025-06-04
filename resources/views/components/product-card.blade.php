<div class="card mb-3 shadow-sm"> 
    <div class="card-body"> 
        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="card-img-top mb-3" style="height: 350px; object-fit: cover;">
        <h5 class="card-title">{{ $product->name }}</h5> 
        <h6 class="card-subtitle mb-2 text-muted">{{ $product->category->name }}</h6> 
        <p class="card-text">{{ $product->description }}</p> 
        <ul class="list-unstyled mb-3"> 
            <li><strong>Price:</strong> 
                @if($product->sale_price)
                    <span class="text-decoration-line-through text-muted">${{ number_format($product->price, 2) }}</span>
                    <span class="text-danger fw-bold">${{ number_format($product->sale_price, 2) }}</span>
                @else
                    ${{ number_format($product->price, 2) }}
                @endif
            </li> 
            <li><strong>Category:</strong> {{ $product->category->name }}</li> 
            <li><strong>Added:</strong> {{ $product->created_at?->format('Y-m-d') }}</li> 
        </ul> 
        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Add To Cart</a>
        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Buy Now</a> 
    </div> 
</div>