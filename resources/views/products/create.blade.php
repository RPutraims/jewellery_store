<x-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">{{ __('Create a new product!') }}</h2>
    </x-slot>

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

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Create New Product') }}</h4>
                        </div>
                        <div class="card-body">
                            
                            <!-- Category Selection -->
                            <div class="mb-3">
                                <label for="category_id" class="form-label">{{ __('Category') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('category_id') is-invalid @enderror" 
                                        id="category_id" name="category_id" required>
                                    <option value="">{{ __('Select a category') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Product Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Product Name') }} <span class="text-danger">*</span></label>
                                <input type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    maxlength="255" 
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                        id="description" 
                                        name="description" 
                                        rows="4" 
                                        required 
                                        minlength="10">{{ old('description') }}</textarea>
                                <div class="form-text">{{ __('Minimum 10 characters required') }}</div>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label">{{ __('Price') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                        class="form-control @error('price') is-invalid @enderror" 
                                        id="price" 
                                        name="price" 
                                        value="{{ old('price') }}" 
                                        step="0.01" 
                                        min="0" 
                                        required>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sale Price (Optional) -->
                            <div class="mb-3">
                                <label for="sale_price" class="form-label">{{ __('Sale Price (Optional)') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                        class="form-control @error('sale_price') is-invalid @enderror" 
                                        id="sale_price" 
                                        name="sale_price" 
                                        value="{{ old('sale_price') }}" 
                                        step="0.01" 
                                        min="0">
                                </div>
                                <div class="form-text">{{ __('Leave empty if not on sale') }}</div>
                                @error('sale_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Photo Upload -->
                            <div class="mb-3">
                                <label for="photo" class="form-label">{{ __('Product Photo') }} <span class="text-danger">*</span></label>
                                <input type="file" 
                                    class="form-control @error('photo') is-invalid @enderror" 
                                    id="photo" 
                                    name="photo" 
                                    accept=".webp" 
                                    required>
                                <div class="form-text">{{ __('Only WebP format allowed. Maximum file size: 2MB') }}</div>
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
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

                            <!-- Available Materials -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('Available Materials') }} <span class="text-danger">*</span></label>

                                <div class="container-fluid px-0">
                                    <div class="row">
                                        @foreach($materials as $index => $material)
                                            <div class="col-md-4">
                                                <div class="form-check mb-2">
                                                    <input
                                                        class="form-check-input @error('material_ids') is-invalid @enderror"
                                                        type="checkbox"
                                                        name="material_ids[]"
                                                        id="material_{{ $material->id }}"
                                                        value="{{ $material->id }}"
                                                        data-price="{{ $material->price_increment }}"
                                                        {{ is_array(old('material_ids')) && in_array($material->id, old('material_ids')) ? 'checked' : '' }}
                                                    >
                                                    <label class="form-check-label" for="material_{{ $material->id }}">
                                                        {{ $material->material_name }}
                                                        @if($material->price_increment > 0)
                                                            (+${{ number_format($material->price_increment, 2) }})
                                                        @endif
                                                        <small class="text-muted d-block">{{ $material->material_description }}</small>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                @error('material_ids')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                @error('material_ids.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Available Sizes -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('Available Sizes') }} <span class="text-danger">*</span></label>

                                <div class="container-fluid px-0">
                                    <div class="row">
                                        @foreach($sizes as $index => $size)
                                            <div class="col-md-4">
                                                <div class="form-check mb-2">
                                                    <input
                                                        class="form-check-input @error('size_ids') is-invalid @enderror"
                                                        type="checkbox"
                                                        name="size_ids[]"
                                                        id="size_{{ $size->id }}"
                                                        value="{{ $size->id }}"
                                                        data-price="{{ $size->price_increment }}"
                                                        {{ is_array(old('size_ids')) && in_array($size->id, old('size_ids')) ? 'checked' : '' }}
                                                    >
                                                    <label class="form-check-label" for="size_{{ $size->id }}">
                                                        {{ $size->size_value }}
                                                        @if($size->price_increment > 0)
                                                            (+${{ number_format($size->price_increment, 2) }})
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> {{ __('Back to Products') }}
                                </a>
                                <div>
                                    <button type="reset" class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-undo"></i> {{ __('Reset') }}
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> {{ __('Create Product') }}
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