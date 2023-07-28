<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update HCA</x-slot:title>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="House Code Activation">Update HCA</h6>
            <form id="hcaUpdateForm" action="{{ route('hca.update', $hca->id) }}" method="POST">
                @csrf
                @method('PATCH')

                    <!-- User Name -->
                    <div class="row mb-3">
                        <label for="user_id" class="col-sm-3 col-form-label">User Name</label>
                        <div class="col-sm-9">
                            <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" id="user_id">
                                <option value="">-- Select User --</option>
                                @if(count($users) > 0)
                                    @foreach($users as $user)
                                        <option @selected( $hca->user_id == $user->id ) value="{{ $user->id }}">{{ $user->phone .' - '. $user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Retailer Code -->
                    <div class="row mb-3">
                        <label for="retailer_code" class="col-sm-3 col-form-label">Retailer Code</label>
                        <div class="col-sm-9">
                            <select name="retailer_code" class="select-2 form-select @error('retailer_code') is-invalid @enderror" id="retailer_code">
                                <option value="">-- Select Retailer Code --</option>
                                @if(count($retailers) > 0)
                                    @foreach($retailers as $retailer)
                                        <option @selected($hca->retailer_code == $retailer->code) value="{{ $retailer->code }}">{{ $retailer->code .' - '. $retailer->itop_number }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('retailer_code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Activation -->
                    <div class="row mb-3">
                        <label for="activation" class="col-sm-3 col-form-label">Activation</label>
                        <div class="col-sm-9">
                            <input name="activation" id="activation" type="number"
                                   class="form-control @error('activation') is-invalid @enderror" value="{{ old('activation', $hca->activation) }}"
                                   placeholder="Enter Activation">
                            @error('activation') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="row mb-3">
                        <label for="price" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input name="price" id="price" type="number"
                                   class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $hca->price) }}"
                                   placeholder="Enter Price">
                            @error('rice') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Activation Date -->
                    <div class="row mb-3">
                        <label for="activation_date" class="col-sm-3 col-form-label">Activation Date</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input name="activation_date" id="activation_date" value="{{ $hca->activation_date }}" type="text" class="flatpickr form-control @error('activation_date') is-invalid @enderror" placeholder="Select date">
                                <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                            </div>
                            @error('activation_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                <button type="submit" class="btn btn-sm btn-primary me-2">Save Changes</button>
                <a href="{{ route('hca.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {

                // Validation
                // $("#hcaUpdateForm").validate({
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
