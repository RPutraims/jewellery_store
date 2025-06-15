<div class="card mb-3 shadow-sm rounded-lg">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3">
            {{-- Info --}}
            <div class="w-full md:w-1/5 pe-md-3 mb-3 mb-md-0">

                @if ($review->title)
                    <h5 class="card-title fw-bold text-dark mb-1">{{ $review->title }}</h5>
                @endif

                <div class="mb-2 text-warning">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star"></i>
                    @endfor
                </div>

                <div class="mb-1">
                    <small class="text-muted">{{ __('Product:') }}</small><br>
                    <a href="{{ route('products.show', $review->product->id) }}" class="fw-bold text-primary text-decoration-none hover:underline">
                        {{ $review->product->name }}
                    </a>
                </div>

                <div class="mb-1">
                    <small class="text-muted">{{ __('Reviewed by:') }}</small><br>
                    <span class="fw-semibold text-dark">{{ $review->user->name }}</span>
                </div>

                <small class="text-muted">{{ __('Posted on') }} {{ $review->created_at->format('M d, Y') }}</small>
            </div>

            {{-- Photo --}}
            @if ($review->photo)
                <div class="w-full md:w-4/5 d-flex justify-content-center align-items-center p-1">
                    <img src="{{ asset('storage/' . $review->photo) }}"
                         alt="Review photo"
                         class="img-fluid rounded shadow-sm"
                         style="max-height: 200px; width: auto;">
                </div>
            @endif
        </div>

        {{-- Review text --}}
        <hr class="my-3">
        <div class="mt-3">
            <p class="card-text text-break text-secondary">{{ $review->review_text }}</p>
        </div>
    </div>
</div>

