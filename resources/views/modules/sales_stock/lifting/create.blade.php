<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Lifting</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create New Lifting</h6>
                    <form id="cmForm" action="{{ route('lifting.store') }}" method="POST">
                    @csrf

                        <!-- Distribution House -->
                        <div class="row mb-3">
                            <label for="dd_house_id" class="col-sm-3 col-form-label">Distribution House ({{ count($houses) }})</label>
                            <div class="col-sm-9">
                                <select name="dd_house_id" class="form-select" id="dd_house_id">
                                    <option value="">-- Select Distribution House --</option>
                                    @if(count($houses) > 0)
                                        @foreach($houses as $house)
                                            <option value="{{ $house->id }}">{{ $house->code .' - '. $house->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('dd_house_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Product Type -->
                        <div class="row mb-3">
                            <label for="product_type" class="col-sm-3 col-form-label">Product Type</label>
                            <div class="col-sm-9">
                                <select name="product_type" class="form-select" id="product_type">
                                    <option value="">-- Select Product Type --</option>
                                    <option value="sim">SIM</option>
                                    <option value="sc">Scratch Card</option>
                                    <option value="device">Device</option>
                                    <option value="itopup">I'top-up</option>
                                </select>
                                @error('product_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Product -->
                        <div class="row mb-3">
                            <label for="product" class="col-sm-3 col-form-label">Product</label>
                            <div class="col-sm-9">
                                <select name="product" class="form-select" id="product">
                                    <option value="">-- Select Product --</option>
                                    <option value="mmst">MMST (STD)</option>
                                    <option value="mmsts">MMSTS (Duplicate Dial)</option>
                                    <option value="simswap">SIM SWAP (RBSP)</option>
                                    <option value="simswapev">SIM SWAP EV</option>
                                    <option value="router">Router</option>
                                    <option value="scv14">SCV-14Tk</option>
                                    <option value="scd14">SCD-14Tk</option>
                                    <option value="itopup">I'top-up</option>
                                </select>
                                @error('product') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="row mb-3">
                            <label for="qty" class="col-sm-3 col-form-label">Quantity</label>
                            <div class="col-sm-9">
                                <input name="qty" id="qty" type="number" class="form-control" value="{{ old('qty') }}"
                                       placeholder="Enter Quantity">
                                @error('qty') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="row mb-3">
                            <label for="price" class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input name="price" id="price" type="number" class="form-control" value="{{ old('price') }}" placeholder="Enter Price">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Itop Up -->
                        <div class="row mb-3">
                            <label for="itopup" class="col-sm-3 col-form-label">I'top-Up</label>
                            <div class="col-sm-9">
                                <input name="itopup" id="itopup" type="number" class="form-control" value="{{ old('itopup') }}"
                                       placeholder="Enter I'top-Up">
                                @error('itopup') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Total Amount -->
                        <div class="row mb-3">
                            <label for="total_amount" class="col-sm-3 col-form-label">Total Amount</label>
                            <div class="col-sm-9">
                                <input name="total_amount" id="total_amount" type="number" class="form-control" value="{{ old('total_amount') }}"
                                       placeholder="Enter Total Amount">
                                @error('total_amount') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Lifting Date -->
                        <div class="row mb-3">
                            <label for="lifting_date" class="col-sm-3 col-form-label">Lifting Date</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="lifting_date" id="lifting_date" type="text" value="{{ now() }}" class="flatpickr form-control" placeholder="Select date">
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create New Lifting</button>
                        <a href="{{ route('lifting.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {

                $("#cmForm").validate({

                    rules: {
                        dd_house_id: 'required',
                        name: 'required',
                        pool_number: 'required',
                    },
                    messages: {

                    },
                });
            });
        </script>
    @endpush

</x-app-layout>
