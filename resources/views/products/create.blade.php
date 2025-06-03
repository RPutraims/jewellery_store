<x-layout>
    <x-slot name="title">
        Create New Product
    </x-slot>

    <h1>Create A New Product</h1>

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
                            <h4>Create New Product</h4>
                        </div>
                        <div class="card-body">
                            
                            <!-- Category Selection -->
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select @error('category_id') is-invalid @enderror" 
                                        id="category_id" name="category_id" required>
                                    <option value="">Select a category</option>
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
                                <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
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
                                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                        id="description" 
                                        name="description" 
                                        rows="4" 
                                        required 
                                        minlength="10">{{ old('description') }}</textarea>
                                <div class="form-text">Minimum 10 characters required</div>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
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
                                <label for="sale_price" class="form-label">Sale Price (Optional)</label>
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
                                <div class="form-text">Leave empty if not on sale</div>
                                @error('sale_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Photo Upload -->
                            <div class="mb-3">
                                <label for="photo" class="form-label">Product Photo <span class="text-danger">*</span></label>
                                <input type="file" 
                                    class="form-control @error('photo') is-invalid @enderror" 
                                    id="photo" 
                                    name="photo" 
                                    accept=".webp" 
                                    required>
                                <div class="form-text">Only WebP format allowed. Maximum file size: 2MB</div>
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

                            <!-- Submit Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to Products
                                </a>
                                <div>
                                    <button type="reset" class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-undo"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Create Product
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