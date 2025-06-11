<x-layout>
    <x-slot name="title">
        Create new review
    </x-slot>

    <h1>Add a review!</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('reviews.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Leave a review :D</h4>
                        </div>
                        <div class="card-body">
                            
                            <!-- Product Selection -->
                            <div class="mb-3">
                                <label for="product_id" class="form-label text-gray-700">Select product to leave review for <span class="text-danger">*</span></label>
                                <select class="form-select @error('product_id') is-invalid @enderror rounded-md focus:ring-blue-500 focus:border-blue-500"
                                        id="product_id" name="product_id" required>
                                    <option value="">Select a product</option>
                                    @foreach($product as $product)
                                        <option value="{{ $product->id }}"
                                                {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Review title -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="title" 
                                    name="title" 
                                    value="{{ old('title') }}" 
                                    maxlength="255" 
                                    required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Comment -->
                            <div class="mb-3">
                                <label for="review_text" class="form-label">Comment </label>
                                <textarea class="form-control @error('review_text') is-invalid @enderror" 
                                        id="review_text" 
                                        name="review_text" 
                                        rows="4" 
                                        required 
                                        minlength="10">{{ old('review_text') }}</textarea>
                            </div>

                            <!-- Photo Upload -->
                            <div class="mb-3">
                                <label for="photo" class="form-label">Product Photo</label>
                                <input type="file" 
                                    class="form-control @error('photo') is-invalid @enderror" 
                                    id="photo" 
                                    name="photo" 
                                    accept=".webp">
                                <div class="form-text">Only WebP format allowed. Maximum file size: 2MB</div>

                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Rating -->
                            <div class="mb-3">
                                <label class="form-label d-block">Rating <span class="text-danger">*</span></label>
                                <div class="@error('rating') is-invalid @enderror d-flex gap-3">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" 
                                                type="radio" 
                                                name="rating" 
                                                id="rating{{ $i }}" 
                                                value="{{ $i }}" 
                                                {{ old('rating') == $i ? 'checked' : '' }} 
                                                required>
                                            <label class="form-check-label" for="rating{{ $i }}">
                                                {{ $i }} 
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                                @error('rating')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Photo Preview -->
                            <div class="mb-3">
                                <img id="photo-preview" 
                                    src="#" 
                                    alt="Photo Preview" 
                                    class="img-thumbnail" 
                                    style="max-width: 200px; display: none;">
                            </div>

                                @error('material_ids')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                @error('material_ids.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('reviews.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to Reviews
                                </a>
                                <div>
                                    <button type="reset" class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-undo"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Submit review
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>
        document.getElementById('photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('photo-preview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
</x-layout>