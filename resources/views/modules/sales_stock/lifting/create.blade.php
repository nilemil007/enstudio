<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Lifting</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <form id="cmForm" action="{{ route('lifting.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Create Liftings</h6>
                    </div>
                    <div class="card-body">
                        <!-- DD House/Lifting Date -->
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">DD House / Date</h6>
                                        <div class="row mb-3">
                                            <label for="dd_house_id" class="col-sm-3 col-form-label">DD House</label>
                                            <div class="col-sm-9">
                                                <select name="dd_house_id" class="form-select" id="dd_house_id">
                                                    <option value="">Select House</option>
                                                    @foreach($houses as $house)
                                                        <option value="{{ $house->id }}">{{ $house->code.' - '.$house->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('dd_house_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <!-- Lifting Date -->
                                        <div class="row mb-3">
                                            <label for="lifting_date" class="col-sm-3 col-form-label">Lifting Date</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input name="lifting_date" id="lifting_date" type="text" class="flatpickr form-control" placeholder="Select date">
                                                    <span class="input-group-text input-group-addon" data-toggle>
                                                        <i data-feather="calendar"></i>
                                                    </span>
                                                </div>
                                                @error('lifting_date') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach($productType as $type)
{{--                            <hr class="mt-4 mb-4">--}}
                            <div class="row">
                                <div class="text-center mb-3 mt-3 text-secondary">
                                    <h2>
                                        {{ \Illuminate\Support\Str::upper(implode(' ', explode('_', $type->product_type))) }}
                                    </h2>
                                </div>

                                @foreach(\App\Models\ProductAndType::getProduct($type->product_type) as $product)
                                    <div class="col-md-12 col-lg-6 mb-2">
                                        <div class="card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <h6 class="card-title mb-0">{{ \Illuminate\Support\Str::upper(implode(' ', explode('_', $product->product))) }}</h6>
                                                <p class="text-success" style="font-weight: bold">Lifting Price: 241</p>
                                                <p class="text-success" style="font-weight: bold">Lifting Value: 241000</p>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="{{ \Illuminate\Support\Str::lower($product->product) }}" class="col-sm-3 col-form-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input name="details[{{ \Illuminate\Support\Str::lower($product->product) }}]" id="{{ \Illuminate\Support\Str::lower($product->product) }}" type="number" class="form-control qty" value="{{ old(\Illuminate\Support\Str::lower($product->product)) }}" placeholder="Enter Quantity">
                                                    <input name="details[{{ \Illuminate\Support\Str::lower($product->product) . '_lifting_price' }}]" type="hidden" id="{{ \Illuminate\Support\Str::lower($product->product) . '_lifting_price' }}">
                                                    <input name="details[{{ \Illuminate\Support\Str::lower($product->product) . '_value' }}]" type="hidden" id="{{ \Illuminate\Support\Str::lower($product->product) . '_value' }}">

                                                    @if($type->product_type == 'scratch_card')
                                                    <input name="details[{{ \Illuminate\Support\Str::lower($product->product) . '_lifting_value' }}]" type="hidden" id="{{ \Illuminate\Support\Str::lower($product->product) . '_lifting_value' }}">
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Cash/Credit -->
                                            <div class="row mb-3">
                                                <label for="{{ \Illuminate\Support\Str::lower($product->product) . '_remarks' }}" class="col-sm-3 col-form-label">Cash/Credit</label>
                                                <div class="col-sm-9">
                                                    <select name="details[{{ \Illuminate\Support\Str::lower($product->product) . '_remarks' }}]" class="form-select" id="{{ \Illuminate\Support\Str::lower($product->product) . '_remarks' }}">
                                                        <option value="cash" selected>Cash</option>
                                                        <option value="credit" >Credit</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                @endforeach

                                <input name="details[total_sim_value]" type="hidden" id="total_sim_value">
                            </div>
                        @endforeach

                        <!-- I'top-up Lifting -->
                        <div class="row">
                            <div class="text-center mb-3 mt-3 text-secondary"><h2>Total Amount</h2></div>

                            <div class="col-sm-12 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <h6 class="card-title mb-0">Total Amount</h6>
                                            <p class="text-success" style="font-weight: bold">I'top-up: 1038961</p>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="total_amount" class="col-sm-3 col-form-label">Total Amount</label>
                                            <div class="col-sm-9">
                                                <input name="details[itopup]" id="itopup" type="hidden">
                                                <input name="details[total_amount]" id="total_amount" class="form-control" type="number" placeholder="Total Amount">
                                                @error('total_amount') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create New Lifting</button>
                        <a href="{{ route('lifting.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function (){
                $(document).on('keyup','.qty',function (){
                    var quantity = $(this).attr('id');
                    console.log(id);
                });
            });





            {{--$(document).ready(function() {--}}
            {{--    let liftingPrice = '';--}}
            {{--    let faceValue = '';--}}

            {{--    $(document).on('change','.product',function (){--}}
            {{--        const product = $(this).val();--}}
            {{--        $('#qty').val('');--}}
            {{--        $('#showPrice').text('');--}}

            {{--        $.ajax({--}}
            {{--            url: "{{ route('lifting.get.price.by.product') }}/" + product,--}}
            {{--            type: 'GET',--}}
            {{--            dataType: 'JSON',--}}
            {{--            success: function(response){--}}
            {{--                liftingPrice = response.liftingPrice;--}}
            {{--                // faceValue = response.faceValue;--}}
            {{--            },--}}
            {{--        });--}}
            {{--    });--}}

            {{--    // Calculate itop-up amount--}}
            {{--    $(document).on('keyup','#total_amount',function (){--}}
            {{--        const totAmount = $(this).val();--}}
            {{--        const ddId = $('#dd_house_id').val();--}}
            {{--        const date = $('#lifting_date').val();--}}

            {{--        $.ajax({--}}
            {{--            url: "{{ route('lifting.get.itop.amount') }}/" + totAmount + '/' + ddId + '/' + date,--}}
            {{--            type: 'GET',--}}
            {{--            dataType: 'JSON',--}}
            {{--            success: function(response){--}}
            {{--                $('#itopup').val(response.itopup);--}}
            {{--                $('#showItopUp').text('I\'top-up: ' + response.itopup);--}}
            {{--            },--}}
            {{--        });--}}
            {{--    });--}}

            {{--    // Get price from quantity--}}
            {{--    $(document).on('keyup','#qty',function (){--}}
            {{--        const qty = $(this).val();--}}
            {{--        // const fValue = qty*faceValue;--}}
            {{--        const liftingValue = qty*liftingPrice;--}}
            {{--        $('#price').val(liftingValue);--}}
            {{--        $('#showPrice').text('Lifting Value: '+liftingValue+' | '+'Lifting Price: '+liftingPrice);--}}
            {{--    });--}}

            {{--    // Get product by type--}}
            {{--    $(document).on('change','#product_type',function (){--}}
            {{--        const type = $(this).val();--}}
            {{--        $('#qty').val('');--}}
            {{--        $('#showPrice').text('');--}}

            {{--        if (type === '')--}}
            {{--        {--}}
            {{--            $('.product').html('<option value="">-- Select Product --</option>');--}}
            {{--            $('#liftingQuantity, #liftingPrice').addClass('d-none');--}}
            {{--        }else if (type !== 'itopup'){--}}
            {{--            $('#liftingItopup, #liftingTotalAmount').addClass('d-none');--}}
            {{--            $('#liftingQuantity, #liftingPrice, #liftingProduct').removeClass('d-none');--}}
            {{--        }else{--}}
            {{--            $('#liftingQuantity, #liftingPrice, #liftingProduct').addClass('d-none');--}}
            {{--            $('#liftingItopup, #liftingTotalAmount').removeClass('d-none');--}}
            {{--        }--}}

            {{--        $.ajax({--}}
            {{--            url: "{{ route('lifting.get.product.by.type') }}/" + type,--}}
            {{--            type: 'GET',--}}
            {{--            dataType: 'JSON',--}}
            {{--            beforeSend: function (){--}}
            {{--                $('.product').find('option:not(:first)').remove();--}}
            {{--            },--}}
            {{--            success: function(response){--}}
            {{--                if(response.products.length)--}}
            {{--                {--}}
            {{--                    $.each(response.products, function (key, value){--}}
            {{--                        $('.product').append('<option value="'+ value.product +'">' + value.product + '</option>')--}}
            {{--                    });--}}
            {{--                }--}}
            {{--            },--}}
            {{--        });--}}
            {{--    });--}}
            {{--});--}}
        </script>
    @endpush

</x-app-layout>
