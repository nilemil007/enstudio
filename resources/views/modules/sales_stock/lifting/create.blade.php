<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Lifting</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <form id="cmForm" action="{{ route('lifting.store') }}" method="POST">
                @csrf
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title m-0">Create New Lifting</h6>
                </div>
                <div class="card-body dynamic-section">
                    <div class="card mb-3 bg-secondary bg-gradient">
                        <div class="card-header">
                            <div class="card-title m-0">DD House & Date</div>
                        </div>
                        <div class="card-body">
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
                                    @error('lifting_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Distribution House -->
                            <div class="row mb-3">
                                <label for="dd_house_id" class="col-sm-3 col-form-label">DD House</label>
                                <div class="col-sm-9">
                                    <select name="dd_house_id" class="form-select" id="dd_house_id" >
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
                        </div>
                    </div>

                    <div class="card mb-3 bg-secondary bg-gradient">
                        <div class="card-header">
                            <div class="card-title m-0">SIM . MMST</div>
                        </div>
                        <div class="card-body">
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
                                    @error('qty')
                                    <span class="text-danger">{{ $message }}</span>
                                    @else
                                        <small class="text-light" id="showPrice" style="font-weight: bold"></small>
                                        @enderror
                                </div>
                            </div>

                            <!-- Price -->
                        {{--                        <input name="price" id="price" type="hidden">--}}
                        {{--                        <input name="lifting_price" id="liftingPrice" type="hidden">--}}
                        {{--                        <input name="product_lifting_price" id="productLiftingPrice" type="hidden">--}}

                        <!-- Itop Up -->
                        {{--                        <input name="itopup" id="itopup" type="hidden">--}}

                            <!-- Bank Deposit -->
                            <div class="row mb-3 d-none" id="liftingTotalAmount">
                                <label for="bank_deposit" class="col-sm-3 col-form-label">Bank Deposit</label>
                                <div class="col-sm-9">
                                    <input name="bank_deposit" id="bank_deposit" type="number" class="form-control" value="{{ old('bank_deposit') }}"
                                           placeholder="Enter Bank Deposit">
                                    @error('bank_deposit') <span class="text-danger">{{ $message }}</span> @else <small class="text-light" id="showItopUp" style="font-weight: bold"></small> @enderror
                                </div>
                            </div>

                            <!-- Cash/Credit -->
                            <div class="row mb-3">
                                <label for="remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                <div class="col-sm-9">
                                    <select name="remarks" class="form-select" id="remarks">
                                        <option value="">- Select Mode -</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Credit" >Credit</option>
                                    </select>
                                    @error('remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create New Lifting</button>
                    <span>
                        <button class="btn btn-sm btn-success add-more-section" type="button">Add More Section</button>
                        <a href="{{ route('lifting.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </span>
                </div>
            </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Add More Section
                $('.add-more-section').click(function () {
                    $('.dynamic-section').append(`
                    <div class="card mb-3 bg-secondary bg-gradient">
                        <div class="card-header">
                            <div class="card-title m-0">SIM . SWAP</div>
                        </div>
                        <div class="card-body">
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
                                    @error('qty')<span class="text-danger">{{ $message }}</span>@else<small class="text-light" id="showPrice" style="font-weight: bold"></small>@enderror
                                </div>
                            </div>

                            <!-- Bank Deposit -->
                            <div class="row mb-3 d-none" id="liftingTotalAmount">
                                <label for="bank_deposit" class="col-sm-3 col-form-label">Bank Deposit</label>
                                <div class="col-sm-9">
                                    <input name="bank_deposit" id="bank_deposit" type="number" class="form-control" value="{{ old('bank_deposit') }}" placeholder="Enter Bank Deposit">
                                    @error('bank_deposit') <span class="text-danger">{{ $message }}</span> @else <small class="text-light" id="showItopUp" style="font-weight: bold"></small> @enderror
                                </div>
                            </div>

                            <!-- Cash/Credit -->
                            <div class="row mb-3">
                                <label for="remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                <div class="col-sm-9">
                                    <select name="remarks" class="form-select" id="remarks">
                                        <option value="">- Select Mode -</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Credit" >Credit</option>
                                    </select>
                                    @error('remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-danger bg-gradient remove-section">Remove Section</button>
                        </div>
                    </div>
                    `);
                });
                $(document).on('click','.remove-section',function (){
                    $(this).parent().parent().remove();
                });


                var productLiftingPrice = '';
                var price = '';

                // Get lifting price by product.
                $(document).on('change','.product',function (){
                    const product = $(this).val();
                    $('#qty').val('');
                    $('#showPrice').text('');

                    $.ajax({
                        url: "{{ route('lifting.get.price.by.product') }}/" + product,
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: () => {
                            $('#loading').show();
                        },
                        complete: () => {
                            $('#loading').hide();
                        },
                        success: function(response){
                            productLiftingPrice = response.productLiftingPrice;
                            price = response.price;
                        },
                    });
                });

                // Calculate itop-up amount
                $(document).on('blur','#bank_deposit',function (){
                    var bankDeposit = $(this).val();
                    var ddId = $('#dd_house_id').val();
                    var date = $('#lifting_date').val();

                    $.ajax({
                        url: "{{ route('lifting.get.itop.amount') }}/" + bankDeposit + '/' + ddId + '/' + date,
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: () => {
                            $('#loading').show();
                        },
                        complete: () => {
                            $('#loading').hide();
                        },
                        success: function(response){
                            $('#itopup').val(response.itopup);
                            $('#showItopUp').text('I\'top-up: ' + response.itopup);
                        },
                    });
                });

                // Get price from quantity
                $(document).on('blur','#qty',function (){
                    const qty = $(this).val();
                    if(qty.length < 1)
                    {
                        $('#showPrice').text('');
                        $('#price').removeAttr('value');
                        $('#liftingPrice').removeAttr('value');
                        $('#productLiftingPrice').removeAttr('value');
                    }else{
                        $('#price').val(qty*price);
                        $('#liftingPrice').val(qty*productLiftingPrice);
                        $('#productLiftingPrice').val(productLiftingPrice);
                        $('#showPrice').text('').append('<p>' + 'Product Lifting Price: ' + productLiftingPrice +'</p>').append('<p>' + 'Price: ' + qty*price +'</p>').append('<p>' + 'Lifting Price: ' + qty*productLiftingPrice +'</p>');
                    }
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
                            $('#loading').show();
                            $('.product').find('option:not(:first)').remove();
                        },
                        complete: () => {
                            $('#loading').hide();
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
