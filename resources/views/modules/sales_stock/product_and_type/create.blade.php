<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Entry</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create new product and type</h6>
                    <form id="productTypeForm" action="{{ route('productType.store') }}" method="POST">
                    @csrf

                        <!-- Product Type -->
                        <div class="row mb-3">
                            <label for="product_type" class="col-sm-3 col-form-label">Product Type</label>
                            <div class="col-sm-9">
                                <select name="product_type" id="product_type" class="form-select">
                                    <option value="">- Select Product Type -</option>
                                    <option value="sim">Sim</option>
                                    <option value="scratch_card">Scratch Card</option>
                                    <option value="device">Device</option>
                                </select>
                                @error('product_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Product -->
                        <div class="row mb-3">
                            <label for="product" class="col-sm-3 col-form-label">Product</label>
                            <div class="col-sm-9">
                                <input name="product" id="product" type="text" class="form-control" value="{{ old('product') }}" placeholder="Enter Product">
                                @error('product') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="row mb-3">
                            <label for="price" class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input name="price" id="price" type="number" step="any" class="form-control" value="{{ old('price') }}" placeholder="Enter Price">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Lifting Price -->
                        <div class="row mb-3">
                            <label for="lifting_price" class="col-sm-3 col-form-label">Lifting Price</label>
                            <div class="col-sm-9">
                                <input name="lifting_price" id="lifting_price" type="number" step="any" class="form-control" value="{{ old('lifting_price') }}" placeholder="Enter Lifting Price">
                                @error('lifting_price') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="sameAsPrice">
                                    <label class="form-check-label" for="sameAsPrice">
                                        Same as price
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Retailer Price -->
                        <div class="row mb-3">
                            <label for="retailer_price" class="col-sm-3 col-form-label">Retailer Price</label>
                            <div class="col-sm-9">
                                <input name="retailer_price" id="retailer_price" type="number" step="any" class="form-control" value="{{ old('retailer_price') }}" placeholder="Enter Retailer Price">
                                @error('retailer_price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create</button>
                        <a href="{{ route('productType.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {

            if($('#sameAsPrice').is(":checked"))
            {
                alert('Checked');
            }
            
            });
        </script>
    @endpush

</x-app-layout>