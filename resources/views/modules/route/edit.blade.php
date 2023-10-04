<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update Route</x-slot:title>

    <div id="routeUpdateErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Update Route</h6>
            <form id="routeUpdateForm" action="{{ route('route.update', $route->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Distribution House -->
                <div class="row mb-3">
                    <label for="dd_house_id" class="col-sm-3 col-form-label">Distribution House</label>
                    <div class="col-sm-9">
                        <select name="dd_house_id" class="form-select @error('dd_house_id') is-invalid @enderror" id="dd_house_id">
                            <option value="">-- Select Distribution House --</option>
                            @if(count($houses) > 0)
                                @foreach($houses as $house)
                                    <option {{ $route->dd_house_id == $house->id ? 'selected' : '' }} value="{{ $house->id }}">{{ $house->code .' - '. $house->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('dd_house_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Route Code -->
                <div class="row mb-3">
                    <label for="code" class="col-sm-3 col-form-label">Route Code</label>
                    <div class="col-sm-9">
                        <input name="code" id="code" type="text" class="form-control @error('code') is-invalid @enderror"
                               value="{{ old('code', $route->code) }}"
                               placeholder="Enter Route Code">
                        @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Route Name -->
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Route Name</label>
                    <div class="col-sm-9">
                        <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $route->name) }}" placeholder="Enter Route Name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="row mb-3">
                    <label for="description" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <input name="description" id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                               value="{{ old('description', $route->description) }}" placeholder="Enter Description">
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Weekdays -->
                <div class="row mb-3">
                    <label for="weekdays" class="col-sm-3 col-form-label">Weekdays</label>
                    <div class="col-sm-9">
                        <input name="weekdays" id="weekdays" type="text" class="form-control @error('weekdays') is-invalid @enderror"
                               value="{{ old('weekdays', $route->weekdays) }}" placeholder="Enter Weekdays">
                        @error('weekdays') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Market Length -->
                <div class="row mb-3">
                    <label for="length" class="col-sm-3 col-form-label">Market Length</label>
                    <div class="col-sm-9">
                        <input name="length" id="length" type="number"
                               class="form-control @error('length') is-invalid @enderror" value="{{ old('length', $route->length) }}"
                               placeholder="Enter Market Length">
                        @error('length') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="row mb-3">
                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select name="status" class="form-select @error('status') is-invalid @enderror" id="status">
                            <option value="">-- Select Status --</option>
                            <option {{ $route->status == 1 ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $route->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Save Changes</button>
                <a href="{{ route('route.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {

                // Validation
                // $("#routeUpdateForm").validate({
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
