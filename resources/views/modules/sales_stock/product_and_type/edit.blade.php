<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Update product and type</h6>
                    <form id="productTypeForm" action="{{ route('productType.update', $productType->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Product Type -->
                        <div class="row mb-3">
                            <label for="product_type" class="col-sm-3 col-form-label">Product Type</label>
                            <div class="col-sm-9">
                                <input name="product_type" id="product_type" type="text" class="form-control" value="{{ old('product_type', $productType->product_type) }}" placeholder="Enter Product Type">
                                @error('product_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Product -->
                        <div class="row mb-3">
                            <label for="product" class="col-sm-3 col-form-label">Product</label>
                            <div class="col-sm-9">
                                <input name="product" id="product" type="text" class="form-control" value="{{ old('product', $productType->product) }}" placeholder="Enter Product">
                                @error('product') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Lifting Price -->
                        <div class="row mb-3">
                            <label for="lifting_price" class="col-sm-3 col-form-label">Lifting Price</label>
                            <div class="col-sm-9">
                                <input name="lifting_price" id="lifting_price" step="any" type="number" class="form-control" value="{{ old('lifting_price', $productType->lifting_price) }}" placeholder="Enter Lifting Price">
                                @error('lifting_price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Retailer Price -->
                        <div class="row mb-3">
                            <label for="retailer_price" class="col-sm-3 col-form-label">Retailer Price</label>
                            <div class="col-sm-9">
                                <input name="retailer_price" id="retailer_price" step="any" type="number" class="form-control" value="{{ old('retailer_price', $productType->retailer_price) }}" placeholder="Enter Retailer Price">
                                @error('retailer_price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Update</button>
                        <a href="{{ route('productType.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Validation
                // $('#productTypeForm').validate({
                //     rules: {
                //         product_type: {
                //             required: true,
                //         },
                //         product: {
                //             required: true,
                //         },
                //         lifting_price: {
                //             required: true,
                //         },
                //         retailer_price: {
                //             required: true,
                //         },
                //     },
                //     messages: {
                //         product_type: {
                //             required: true,
                //         },
                //     },
                // });
            });
        </script>
    @endpush

</x-app-layout>