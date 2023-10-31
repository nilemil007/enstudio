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

                        <hr class="mt-4 mb-4">

                        <!-- SIM -->
                        <div class="row">
                            <div class="text-center"><h2>SIM</h2></div>
                            <!-- MMST (STD) -->
                            <div class="col-md-12 col-lg-6 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <h6 class="card-title mb-0">MMST (STD)</h6>
                                            <p class="text-success" style="font-weight: bold">Lifting Price: 241</p>
                                            <p class="text-success" style="font-weight: bold">Lifting Value: 241000</p>
                                        </div>
                                        <!-- MMST Quantity -->
                                        <div class="row mb-3">
                                            <label for="mmst_qty" class="col-sm-3 col-form-label">Quantity</label>
                                            <div class="col-sm-9">
                                                <input name="details[mmst_qty]" id="mmst_qty" type="number" class="form-control" value="{{ old('mmst_qty') }}" placeholder="Enter Quantity">
                                                <input name="details[mmst_lifting_price]" type="hidden" id="mmst_lifting_price">
                                                <input name="details[mmst_value]" type="hidden" id="mmst_value">
                                            </div>
                                        </div>

                                        <!-- Cash/Credit -->
                                        <div class="row mb-3">
                                            <label for="mmst_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                            <div class="col-sm-6">
                                                <select name="details[mmst_remarks]" class="form-select" id="mmst_remarks">
                                                    <option value="cash" selected>Cash</option>
                                                    <option value="credit" >Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MMSTS (Duplicate Dail) -->
                            <div class="col-md-12 col-lg-6 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <h6 class="card-title mb-0">MMSTS (Duplicate Dail)</h6>
                                            <p class="text-success" style="font-weight: bold">Lifting Price: 241</p>
                                            <p class="text-success" style="font-weight: bold">Lifting Value: 241000</p>
                                        </div>
                                        <!-- MMSTS Quantity -->
                                        <div class="row mb-3">
                                            <label for="mmsts_qty" class="col-sm-3 col-form-label">Quantity</label>
                                            <div class="col-sm-9">
                                                <input name="details[mmsts_qty]" id="mmsts_qty" type="number" class="form-control" value="{{ old('mmsts_qty') }}" placeholder="Enter Quantity">
                                                <input name="details[mmsts_lifting_price]" type="hidden" id="mmsts_lifting_price">
                                                <input name="details[mmsts_value]" type="hidden" id="mmsts_value">
                                            </div>
                                        </div>

                                        <!-- Cash/Credit -->
                                        <div class="row mb-3">
                                            <label for="mmsts_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                            <div class="col-sm-9">
                                                <select name="details[mmsts_remarks]" class="form-select" id="mmsts_remarks">
                                                    <option value="cash" selected>Cash</option>
                                                    <option value="credit" >Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- SIM SWAP (RBSP) -->
                            <div class="col-md-12 col-lg-6 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <h6 class="card-title mb-0">SIM SWAP (RBSP)</h6>
                                            <p class="text-success" style="font-weight: bold">Lifting Price: 241</p>
                                            <p class="text-success" style="font-weight: bold">Lifting Value: 241000</p>
                                        </div>
                                        <!-- SIM SWAP Quantity -->
                                        <div class="row mb-3">
                                            <label for="sim_swap_qty" class="col-sm-3 col-form-label">Quantity</label>
                                            <div class="col-sm-9">
                                                <input name="details[sim_swap_qty]" id="sim_swap_qty" type="number" class="form-control" value="{{ old('sim_swap_qty') }}" placeholder="Enter Quantity">
                                                <input name="details[sim_swap_lifting_price]" type="hidden" id="sim_swap_lifting_price">
                                                <input name="details[sim_swap_value]" type="hidden" id="sim_swap_value">
                                            </div>
                                        </div>

                                        <!-- Cash/Credit -->
                                        <div class="row mb-3">
                                            <label for="sim_swap_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                            <div class="col-sm-9">
                                                <select name="details[sim_swap_remarks]" class="form-select" id="sim_swap_remarks">
                                                    <option value="cash" selected>Cash</option>
                                                    <option value="credit" >Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- SIM SWAP EV -->
                            <div class="col-md-12 col-lg-6 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <h6 class="card-title mb-0">SIM SWAP EV</h6>
                                            <p class="text-success" style="font-weight: bold">Lifting Price: 241</p>
                                            <p class="text-success" style="font-weight: bold">Lifting Value: 241000</p>
                                        </div>
                                        <!-- SIM SWAP EV Quantity -->
                                        <div class="row mb-3">
                                            <label for="sim_swap_ev_qty" class="col-sm-3 col-form-label">Quantity</label>
                                            <div class="col-sm-9">
                                                <input name="details[sim_swap_ev_qty]" id="sim_swap_ev_qty" type="number" class="form-control" value="{{ old('sim_swap_ev_qty') }}" placeholder="Enter Quantity">
                                                <input name="details[sim_swap_ev_lifting_price]" type="hidden" id="sim_swap_ev_lifting_price">
                                                <input name="details[sim_swap_ev_value]" type="hidden" id="sim_swap_ev_value">
                                            </div>
                                        </div>

                                        <!-- Cash/Credit -->
                                        <div class="row mb-3">
                                            <label for="sim_swap_ev_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                            <div class="col-sm-9">
                                                <select name="details[sim_swap_ev_remarks]" class="form-select" id="sim_swap_ev_remarks">
                                                    <option value="cash" selected>Cash</option>
                                                    <option value="credit" >Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-4">

                        <!-- Scratch Card -->
                        <div class="row">
                            <div class="text-center"><h2>Scratch Card</h2></div>
                            <!-- SC 10Tk -->
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">SC 10Tk</h6>
                                        <!-- SC 10Tk Quantity -->
                                        <div class="row mb-3">
                                            <label for="sc10_qty" class="col-sm-3 col-form-label">Quantity</label>
                                            <div class="col-sm-9">
                                                <input name="details[sc10_qty]" id="sc10_qty" type="number" class="form-control" value="{{ old('sc10_qty') }}" placeholder="Enter Quantity">
                                                <input name="details[sc10_lifting_price]" type="hidden" id="sc10_lifting_price">
                                                <input name="details[sc10_lifting_value]" type="hidden" id="sc10_lifting_value">
                                                <input name="details[sc10_face_value]" type="hidden" id="sc10_face_value">
                                            </div>
                                        </div>

                                        <!-- Cash/Credit -->
                                        <div class="row mb-3">
                                            <label for="sc10_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                            <div class="col-sm-9">
                                                <select name="details[sc10_remarks]" class="form-select" id="sc10_remarks">
                                                    <option value="cash" selected>Cash</option>
                                                    <option value="credit" >Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- SCV 14Tk -->
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">SCV 14Tk</h6>
                                        <!-- SCV 14Tk Quantity -->
                                        <div class="row mb-3">
                                            <label for="scv14_qty" class="col-sm-3 col-form-label">Quantity</label>
                                            <div class="col-sm-9">
                                                <input name="details[scv14_qty]" id="scv14_qty" type="number" class="form-control" value="{{ old('scv14_qty') }}" placeholder="Enter Quantity">
                                                <input name="details[scv14_lifting_price]" type="hidden" id="scv14_lifting_price">
                                                <input name="details[scv14_lifting_value]" type="hidden" id="scv14_lifting_value">
                                                <input name="details[scv14_face_value]" type="hidden" id="scv14_face_value">
                                            </div>
                                        </div>

                                        <!-- Cash/Credit -->
                                        <div class="row mb-3">
                                            <label for="scv14_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                            <div class="col-sm-9">
                                                <select name="details[scv14_remarks]" class="form-select" id="scv14_remarks">
                                                    <option value="cash" selected>Cash</option>
                                                    <option value="credit" >Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- SCD 14Tk -->
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">SCD 14Tk</h6>
                                        <!-- SCV 14Tk Quantity -->
                                        <div class="row mb-3">
                                            <label for="scd14_qty" class="col-sm-3 col-form-label">Quantity</label>
                                            <div class="col-sm-9">
                                                <input name="details[scd14_qty]" id="scd14_qty" type="number" class="form-control" value="{{ old('scd14_qty') }}" placeholder="Enter Quantity">
                                                <input name="details[scd14_lifting_price]" type="hidden" id="scd14_lifting_price">
                                                <input name="details[scd14_lifting_value]" type="hidden" id="scd14_lifting_value">
                                                <input name="details[scd14_face_value]" type="hidden" id="scd14_face_value">
                                            </div>
                                        </div>

                                        <!-- Cash/Credit -->
                                        <div class="row mb-3">
                                            <label for="scd14_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                            <div class="col-sm-9">
                                                <select name="details[scd14_remarks]" class="form-select" id="scd14_remarks">
                                                    <option value="cash" selected>Cash</option>
                                                    <option value="credit" >Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- SCV 19Tk -->
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">SCV 19Tk</h6>
                                        <!-- SCV 19Tk Quantity -->
                                        <div class="row mb-3">
                                            <label for="scv19_qty" class="col-sm-3 col-form-label">Quantity</label>
                                            <div class="col-sm-9">
                                                <input name="details[scv19_qty]" id="scv19_qty" type="number" class="form-control" value="{{ old('scv19_qty') }}" placeholder="Enter Quantity">
                                                <input name="details[scv19_lifting_price]" type="hidden" id="scv19_lifting_price">
                                                <input name="details[scv19_lifting_value]" type="hidden" id="scv19_lifting_value">
                                                <input name="details[scv19_face_value]" type="hidden" id="scv19_face_value">
                                            </div>
                                        </div>

                                        <!-- Cash/Credit -->
                                        <div class="row mb-3">
                                            <label for="scv19_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                            <div class="col-sm-9">
                                                <select name="details[scv19_remarks]" class="form-select" id="scv19_remarks">
                                                    <option value="cash" selected>Cash</option>
                                                    <option value="credit" >Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- SCD 19Tk -->
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">SCD 19Tk</h6>
                                        <!-- SCV 19Tk Quantity -->
                                        <div class="row mb-3">
                                            <label for="scd19_qty" class="col-sm-3 col-form-label">Quantity</label>
                                            <div class="col-sm-9">
                                                <input name="details[scd19_qty]" id="scd19_qty" type="number" class="form-control" value="{{ old('scd19_qty') }}" placeholder="Enter Quantity">
                                                <input name="details[scd19_lifting_price]" type="hidden" id="scd19_lifting_price">
                                                <input name="details[scd19_lifting_value]" type="hidden" id="scd19_lifting_value">
                                                <input name="details[scd19_face_value]" type="hidden" id="scd19_face_value">
                                            </div>
                                        </div>

                                        <!-- Cash/Credit -->
                                        <div class="row mb-3">
                                            <label for="scd19_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                            <div class="col-sm-9">
                                                <select name="details[scd19_remarks]" class="form-select" id="scd19_remarks">
                                                    <option value="cash" selected>Cash</option>
                                                    <option value="credit" >Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- SC 20Tk -->
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">SC 20Tk</h6>
                                        <!-- SC 20Tk Quantity -->
                                        <div class="row mb-3">
                                            <label for="sc20_qty" class="col-sm-3 col-form-label">Quantity</label>
                                            <div class="col-sm-9">
                                                <input name="details[sc20_qty]" id="sc20_qty" type="number" class="form-control" value="{{ old('sc20_qty') }}" placeholder="Enter Quantity">
                                                <input name="details[sc20_lifting_price]" type="hidden" id="sc20_lifting_price">
                                                <input name="details[sc20_lifting_value]" type="hidden" id="sc20_lifting_value">
                                                <input name="details[sc20_face_value]" type="hidden" id="sc20_face_value">
                                            </div>
                                        </div>

                                        <!-- Cash/Credit -->
                                        <div class="row mb-3">
                                            <label for="sc20_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                            <div class="col-sm-9">
                                                <select name="details[sc20_remarks]" class="form-select" id="sc20_remarks">
                                                    <option value="cash" selected>Cash</option>
                                                    <option value="credit" >Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- SC 29Tk -->
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">SC 29Tk</h6>
                                        <!-- SC 29Tk Quantity -->
                                        <div class="row mb-3">
                                            <label for="sc29_qty" class="col-sm-3 col-form-label">Quantity</label>
                                            <div class="col-sm-9">
                                                <input name="details[sc29_qty]" id="sc29_qty" type="number" class="form-control" value="{{ old('sc29_qty') }}" placeholder="Enter Quantity">
                                                <input name="details[sc29_lifting_price]" type="hidden" id="sc29_lifting_price">
                                                <input name="details[sc29_lifting_value]" type="hidden" id="sc29_lifting_value">
                                                <input name="details[sc29_face_value]" type="hidden" id="sc29_face_value">
                                            </div>
                                        </div>

                                        <!-- Cash/Credit -->
                                        <div class="row mb-3">
                                            <label for="sc29_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                            <div class="col-sm-9">
                                                <select name="details[sc29_remarks]" class="form-select" id="sc29_remarks">
                                                    <option value="cash" selected>Cash</option>
                                                    <option value="credit" >Credit</option>
                                                </select>
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
