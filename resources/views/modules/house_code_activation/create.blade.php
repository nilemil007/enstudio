<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Record</x-slot:title>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <li class="alert alert-danger">{{ $error }}</li>
        @endforeach
    @endif

    <div class="row">
        <div class="col-md-12">

            <div id="hcaErrMsg" class="alert alert-danger err-msg d-none"></div>

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create new Record</h6>
                    <form id="hcaForm" action="{{ route('hca.store') }}" method="POST">
                        @csrf

                        @if(auth()->user()->role == 'superadmin')
                        <!-- User Name -->
                        <div class="row mb-3">
                            <label for="user_id" class="col-sm-3 col-form-label">User Name</label>
                            <div class="col-sm-9">
                                <select name="user_id" class="form-select" id="user_id">
                                    <option value="">-- Select User --</option>
                                    @if(count($users) > 0)
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->phone .' - '. \Illuminate\Support\Str::upper($user->role) .' - '. $user->name }}</option>
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
                            <label for="retailer_code" class="col-sm-3 col-form-label">Retailer Code</label>
                            <div class="col-sm-9">
                                <select name="retailer_code" class="select-2 form-select" id="retailer_code">
                                    <option value="">-- Select Retailer Code --</option>
                                    @if(count($retailers) > 0)
                                        @foreach($retailers as $retailer)
                                            <option value="{{ $retailer->code }}">{{ $retailer->dd_house .' - '. $retailer->code . ' - ' . $retailer->itop_number }}</option>
                                        @endforeach
                                    @endif
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

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create</button>
                        <a href="{{ route('hca.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {

                // Create HCA Entry
                $(document).on('submit','#hcaForm',function (e){
                    e.preventDefault();

                    const data = new FormData($(this)[0]);
                    const url = $(this).attr('action');
                    const type = $(this).attr('method');
                    const redirect = "{{ route('hca.index') }}";

                    $.ajax({
                        url: url,
                        type: type,
                        data: data,
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
                            $('.btn-submit').prop('disabled', true).text('Creating...');
                        },
                        success: function (response){
                            $('.btn-submit').prop('disabled', false).text('Create');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                window.location.href = redirect;
                            });
                        },
                        error: function (e){
                            const err = JSON.parse(e.responseText);

                            $.each(err.errors,function (key,value){
                                $('#hcaErrMsg').find('li').remove();
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
