<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Lifting</x-slot:title>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create New Lifting</h6>
                    <form id="cmForm" action="{{ route('lifting.store') }}" method="POST">
                    @csrf

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
                                    @foreach($productAndType as $pat)
                                        <option value="{{ $pat->product_type }}">{{ \Illuminate\Support\Str::upper($pat->product_type) }}</option>
                                    @endforeach
                                    <option value="itopup">I'top-up</option>
                                </select>
                                @error('product_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Product -->
                        <div class="row mb-3" id="liftingProduct">
                            <label for="product" class="col-sm-3 col-form-label">Product</label>
                            <div class="col-sm-9">
                                <select name="product" class="form-select product" id="product">
                                    <option value="">-- Select Product --</option>
                                </select>
                                @error('product') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="row mb-3 d-none" id="liftingQuantity">
                            <label for="qty" class="col-sm-3 col-form-label">Quantity</label>
                            <div class="col-sm-9">
                                <input name="qty" id="qty" type="number" class="form-control" value="{{ old('qty') }}" placeholder="Enter Quantity">
                                @error('qty') <span class="text-danger">{{ $message }}</span> @else <small class="text-success" id="showPrice" style="font-weight: bold"></small> @enderror
                            </div>
                        </div>

                        <!-- Price -->
                        <input name="price" id="price" type="hidden">

                        <!-- Itop Up -->
                        <input name="itopup" id="itopup" type="hidden">

                        <!-- Total Amount -->
                        <div class="row mb-3 d-none" id="liftingTotalAmount">
                            <label for="total_amount" class="col-sm-3 col-form-label">Total Amount</label>
                            <div class="col-sm-9">
                                <input name="total_amount" id="total_amount" type="number" class="form-control" value="{{ old('total_amount') }}"
                                       placeholder="Enter Total Amount">
                                @error('total_amount') <span class="text-danger">{{ $message }}</span> @else <small class="text-success" id="showItopUp" style="font-weight: bold"></small> @enderror
                            </div>
                        </div>

                        <!-- Cash/Credit -->
                        <div class="row mb-3">
                            <label for="remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                            <div class="col-sm-9">
                                <select name="remarks" class="form-select" id="remarks">
                                    <option value="cash" selected>Cash</option>
                                    <option value="credit" >Credit</option>
                                </select>
                                @error('remarks') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create New Lifting</button>
                        <a href="{{ route('lifting.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Lifting Detail's</h6>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                let liftingPrice = '';
                let faceValue = '';

                $(document).on('change','.product',function (){
                    const product = $(this).val();
                    $('#qty').val('');
                    $('#showPrice').text('');

                    $.ajax({
                        url: "{{ route('lifting.get.price.by.product') }}/" + product,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(response){
                            liftingPrice = response.liftingPrice;
                            // faceValue = response.faceValue;
                        },
                    });
                });

                // Calculate itop-up amount
                $(document).on('keyup','#total_amount',function (){
                    const totAmount = $(this).val();
                    const ddId = $('#dd_house_id').val();
                    const date = $('#lifting_date').val();

                    $.ajax({
                        url: "{{ route('lifting.get.itop.amount') }}/" + totAmount + '/' + ddId + '/' + date,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(response){
                            $('#itopup').val(response.itopup);
                            $('#showItopUp').text('I\'top-up: ' + response.itopup);
                        },
                    });
                });

                // Get price from quantity
                $(document).on('keyup','#qty',function (){
                    const qty = $(this).val();
                    // const fValue = qty*faceValue;
                    const liftingValue = qty*liftingPrice;
                    $('#price').val(liftingValue);
                    $('#showPrice').text('Lifting Value: '+liftingValue+' | '+'Lifting Price: '+liftingPrice);
                });

                // Get product by type
                $(document).on('change','#product_type',function (){
                    const type = $(this).val();
                    $('#qty').val('');
                    $('#showPrice').text('');

                    if (type === '')
                    {
                        $('.product').html('<option value="">-- Select Product --</option>');
                        $('#liftingQuantity, #liftingPrice').addClass('d-none');
                    }else if (type !== 'itopup'){
                        $('#liftingItopup, #liftingTotalAmount').addClass('d-none');
                        $('#liftingQuantity, #liftingPrice, #liftingProduct').removeClass('d-none');
                    }else{
                        $('#liftingQuantity, #liftingPrice, #liftingProduct').addClass('d-none');
                        $('#liftingItopup, #liftingTotalAmount').removeClass('d-none');
                    }

                    $.ajax({
                        url: "{{ route('lifting.get.product.by.type') }}/" + type,
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: function (){
                            $('.product').find('option:not(:first)').remove();
                        },
                        success: function(response){
                            if(response.products.length)
                            {
                                $.each(response.products, function (key, value){
                                    $('.product').append('<option value="'+ value.product +'">' + value.product + '</option>')
                                });
                            }
                        },
                    });
                });
            });
        </script>
    @endpush

</x-app-layout>
