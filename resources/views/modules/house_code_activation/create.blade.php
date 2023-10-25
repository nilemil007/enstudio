<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Record</x-slot:title>

    <div class="row">
        <div class="col-md-12">

            <div id="hcaErrMsg" class="alert alert-danger err-msg d-none"></div>

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create new Record</h6>
                    <form id="hcaForm" action="{{ route('hca.store') }}" method="POST">
                        @csrf

                        @if(auth()->user()->role == 'superadmin' || auth()->user()->role == 'supervisor')
                        <!-- User -->
                        <div class="row mb-3">
                            <label for="user_id" class="col-sm-3 col-form-label">User</label>
                            <div class="col-sm-9">
                                <select name="user_id" class="select-2 form-select" id="user_id" autofocus>
                                    <option value="">-- Select User --</option>
                                    @if(count($tradeCampaignRetailerCode) > 0)
                                        @foreach($tradeCampaignRetailerCode as $tcrc)
                                            <option value="{{ $tcrc->user_id }}">
                                                {{ \Illuminate\Support\Str::upper($tcrc->user->role) .' - '. optional($tcrc->user->bp)->pool_number . optional($tcrc->user->cm)->pool_number . optional($tcrc->user->rso)->itop_number .' - '. $tcrc->user->name . ' (' . $tcrc->remarks . ')'  }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @else
                                <input name="user_id" type="hidden" value="{{ auth()->id() }}">
                        @endif

                        <!-- Retailer Code -->
                        <div class="row mb-3">
                            <label for="set_retailer_code" class="col-sm-3 col-form-label">Retailer Code</label>
                            <div class="col-sm-9">
                                <select name="retailer_code" class="form-select" id="set_retailer_code">
                                    <option value="">-- Select Retailer Code --</option>
                                </select>
                            </div>
                        </div>

                        <!-- Activation -->
                        <div class="row mb-3">
                            <label for="activation" class="col-sm-3 col-form-label">Activation</label>
                            <div class="col-sm-9">
                                <input name="activation" id="activation" type="number"
                                       class="form-control" value="{{ old('activation') }}"
                                       placeholder="Enter Activation">
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="row mb-3">
                            <label for="price" class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input name="price" id="price" type="number"
                                       class="form-control" value="{{ old('price') }}"
                                       placeholder="Enter Price">
                            </div>
                        </div>

                        <!-- Activation Date -->
                        <div class="row mb-3">
                            <label for="activation_date" class="col-sm-3 col-form-label">Activation Date</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="activation_date" id="activation_date" value="{{ now() }}" type="text" class="flatpickr form-control" placeholder="Select date">
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit btn-submit">Create</button>
                        <a href="{{ route('hca.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Get retailer code by user
                $(document).on('change','#user_id',function (){
                    const userId = $(this).val();

                    if (userId === '')
                    {
                        $('#set_retailer_code').html('<option value="">-- Select Retailer Code --</option>');
                    }

                    // Get user by dd house
                    $.ajax({
                        url: "{{ route('hca.get.retailer.code') }}/" + userId,
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: function (){
                            $('#set_retailer_code').find('option:not(:first)').remove();
                        },
                        success: function (response){
                            $.each(response.tcrc, function (key, value){
                                $('#set_retailer_code').append('<option value="'+ value.retailer_code +'">' + value.retailer_code + '</option>');
                            });
                        }
                    });
                });

                // Create HCA Entry
                $(document).on('submit','#hcaForm',function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
                            $('#hcaErrMsg').addClass('d-none').find('li').remove();
                            $('.btn-submit').prop('disabled', true).text('Creating...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                        },
                        success: function (response){
                            $('.btn-submit').prop('disabled', false).text('Create');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                window.location.href = "{{ route('hca.index') }}";
                            });
                        },
                        error: function (e){
                            const err = JSON.parse(e.responseText);

                            $.each(err.errors,function (key,value){
                                $('.err-msg').removeClass('d-none').append('<li>' + value + '</li>');
                            });

                            $('.btn-submit').prop('disabled', false).text('Create');
                        },
                    });
                });

                // $("#hcaForm").validate({
                //
                //     rules: {
                //         cluster_name: {
                //             required: true,
                //             maxlength: 30,
                //         },
                //         region: {
                //             required: true,
                //             maxlength: 20,
                //         },
                //         code: {
                //             required: true,
                //             maxlength: 10,
                //         },
                //         name: {
                //             required: true,
                //             maxlength: 100,
                //             minlength: 3,
                //         },
                //         email: {
                //             required: true,
                //             email: true,
                //         },
                //         district: {
                //             required: true,
                //             maxlength: 20,
                //         },
                //         address: {
                //             required: true,
                //             maxlength: 150,
                //         },
                //         proprietor_name: {
                //             required: true,
                //             maxlength: 100,
                //             minlength: 3,
                //         },
                //         proprietor_number: {
                //             required: true,
                //             number: true,
                //             maxlength: 11,
                //             minlength: 11,
                //         },
                //         poc_name: {
                //             required: true,
                //             maxlength: 100,
                //             minlength: 3,
                //         },
                //         poc_number: {
                //             required: true,
                //             number: true,
                //             maxlength: 11,
                //             minlength: 11,
                //         },
                //         tin_number: {
                //             required: true,
                //         },
                //         bin_number: {
                //             required: true,
                //         },
                //         latitude: {
                //             pattern: /^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/
                //         },
                //         longitude: {
                //             pattern: /^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/
                //         },
                //         bts_code: {
                //             required: true,
                //             minlength: 7,
                //         },
                //         lifting_date: {
                //             required: true,
                //         },
                //     },
                //     messages: {
                //
                //     },
                //     errorPlacement: function(error, element){
                //         error.addClass('invalid-feedback');
                //
                //         if (element.parent('.input-group').length) {
                //             error.insertAfter(element.parent());
                //         }
                //         else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                //             error.insertAfter(element.parent().parent());
                //         }
                //         else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                //             error.appendTo(element.parent().parent());
                //         }
                //         else {
                //             error.insertAfter(element);
                //         }
                //     },
                //     highlight: function(element, errorClass){
                //         if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
                //             $( element ).addClass( "is-invalid" );
                //         }
                //     },
                //     unhighlight: function(element, errorClass){
                //         if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
                //             $( element ).removeClass( "is-invalid" );
                //         }
                //     },
                //     submitHandler: function(form) {
                //         form.submit();
                //     },
                // });

            });
        </script>
    @endpush

</x-app-layout>
