<x-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">Products</h2>
    </x-slot>

    <h1 class="mb-4">Edit Products</h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Product') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="category_id" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>

                                <div class="col-md-6">
                                    <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $product->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                                <div class="col-md-6">
                                    <input id="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $product->price) }}" required>

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="sale_price" class="col-md-4 col-form-label text-md-end">{{ __('Sale Price') }}</label>

                                <div class="col-md-6">
                                    <input id="sale_price" type="number" step="0.01" class="form-control @error('sale_price') is-invalid @enderror" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
                                    <small class="form-text text-muted">Optional: Leave empty if no sale price</small>

                                    @error('sale_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="photo" class="col-md-4 col-form-label text-md-end">{{ __('Photo') }}</label>

                                <div class="col-md-6">
                                    @if($product->photo)
                                        <div class="mb-2">
                                            <img src="{{ Storage::url($product->photo) }}" alt="Current photo" class="img-thumbnail" style="max-width: 200px;">
                                            <p class="text-muted mt-1">Current photo</p>
                                        </div>
                                    @endif
                                    
                                    <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" accept="image/webp">
                                    <small class="form-text text-muted">Leave empty to keep current photo. Only .webp files allowed, max 2MB</small>

                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="materials" class="col-md-4 col-form-label text-md-end">{{ __('Materials') }}</label>

                                <div class="col-md-6">
                                    <div class="form-check-container" style="max-height: 150px; overflow-y: auto; border: 1px solid #ced4da; padding: 10px; border-radius: 4px;">
                                        @foreach($materials as $material)
                                            <div class="form-check">
                                                <input class="form-check-input @error('material_ids') is-invalid @enderror" 
                                                    type="checkbox" 
                                                    name="material_ids[]" 
                                                    value="{{ $material->id }}" 
                                                    id="material_{{ $material->id }}"
                                                    {{ in_array($material->id, old('material_ids', $selectedMaterials)) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="material_{{ $material->id }}">
                                                    {{ $material->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small class="form-text text-muted">Select at least one material</small>

                                    @error('material_ids')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="sizes" class="col-md-4 col-form-label text-md-end">{{ __('Sizes') }}</label>

                                <div class="col-md-6">
                                    <div class="form-check-container" style="max-height: 150px; overflow-y: auto; border: 1px solid #ced4da; padding: 10px; border-radius: 4px;">
                                        @foreach($sizes as $size)
                                            <div class="form-check">
                                                <input class="form-check-input @error('size_ids') is-invalid @enderror" 
                                                    type="checkbox" 
                                                    name="size_ids[]" 
                                                    value="{{ $size->id }}" 
                                                    id="size_{{ $size->id }}"
                                                    {{ in_array($size->id, old('size_ids', $selectedSizes)) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="size_{{ $size->id }}">
                                                    {{ $size->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small class="form-text text-muted">Select at least one size</small>

                                    @error('size_ids')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Product') }}
                                    </button>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary ml-2">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>