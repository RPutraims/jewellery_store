<x-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">{{ __('Reviews') }}</h2>
    </x-slot>

    <div class="d-flex justify-content-between align-items-center mb-4">
    <div x-data="{ open: false }" class="relative inline-block text-left">
        <!-- Filter Button -->
        <button
            @click="open = !open"
            class="btn btn-outline-primary"
            type="button"
        >
            {{ __('Filter') }}
        </button>

        <!-- Dropdown Form -->
        <div
            x-show="open"
            @click.away="open = false"
            x-transition
            class="absolute z-50 mt-2 w-80 bg-white border rounded shadow-lg p-4"
        >
            <form method="GET" action="{{ route('reviews.byFilter') }}" class="space-y-4">
                <!-- Sort -->
                <div>
                    <label for="sort" class="form-label">{{ __('Sort by') }}</label>
                    <select name="sort" id="sort" class="form-select w-full">
                        <option value="">-- {{ __('Select') }} --</option>
                        <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>{{ __('Date (Oldest First)') }}</option>
                        <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>{{ __('Date (Newest First)') }}</option>
                        <option value="rating_asc" {{ request('sort') == 'rating_asc' ? 'selected' : '' }}>{{ __('Rating (Low to High)') }}</option>
                        <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>{{ __('Rating (High to Low)') }}</option>
                    </select>
                </div>

                <!-- Product Filter -->
                <div>
                    <label class="form-label">{{ __('Filter by Products') }}</label>
                    <div class="border p-2 rounded overflow-y-auto" style="max-height: 150px;">
                        @foreach ($products as $product)
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    name="products[]"
                                    value="{{ $product->id }}"
                                    class="form-check-input"
                                    {{ in_array($product->id, request()->input('products', [])) ? 'checked' : '' }}
                                >
                                <label class="form-check-label">{{ $product->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit" class="btn btn-primary w-full">{{ __('Apply Filters') }}</button>
                </div>
            </form>
        </div>
</div>

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
        <div class="alert alert-info">{{ __('No reviews yet, be the first!') }}</div>
    @endif
</x-layout>
