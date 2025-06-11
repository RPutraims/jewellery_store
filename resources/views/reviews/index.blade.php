<x-layout>
    <x-slot name="title">
        Reviews
    </x-slot>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Reviews</h1>
        <a href="{{ route('reviews.create') }}" class="btn btn-primary btn-lg">Leave a Review</a>
        </a>
    </div>

    @if ($reviews->count())
        <div class="row">
            @foreach ($reviews as $review)
                <div class="col-md-6 col-lg-4">
                    <x-review-card :review="$review" />
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">No reviews yet, be the first!</div>
    @endif
</x-layout>
