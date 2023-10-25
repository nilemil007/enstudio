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
                                <input name="product_type" id="product_type" type="text" class="form-control" value="{{ old('product_type') }}" placeholder="Enter Product Type">
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
                // Validation
                $('#productTypeForm').validate({
                    rules: {
                        product_type: {
                            required: true,
                        },
                        product: {
                            required: true,
                        },
                    },
                    messages: {

                    },
                });
            });
        </script>
    @endpush

</x-app-layout>