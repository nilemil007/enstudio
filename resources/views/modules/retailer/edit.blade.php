<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update Retailer</x-slot:title>

    <div id="retailerUpdateErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Update Retailer</h6>
            <form id="retailerUpdateForm" action="{{ route('retailer.update', $retailer->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Distribution House -->
                <div class="row mb-3">
                    <label for="dd_house" class="col-sm-3 col-form-label">Distribution House <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="dd_house" class="form-select @error('dd_house') is-invalid @enderror" id="dd_house">
                            <option value="">-- Select Distribution House --</option>
                            @if(count($houses) > 0)
                                @foreach($houses as $house)
                                    <option @selected($retailer->dd_house == $house->code) value="{{ $house->code }}">{{ $house->code .' - '. $house->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('dd_house') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- User -->
                <div class="row mb-3">
                    <label for="user_id" class="col-sm-3 col-form-label">User</label>
                    <div class="col-sm-9">
                        <select name="user_id" class="select-2 form-select @error('user_id') is-invalid @enderror" id="user_id">
                            <option value="">-- Select User --</option>
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    <option @selected($retailer->user_id == $user->id) value="{{ $user->id }}">{{ $user->name .' - '. $user->phone }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Rso -->
                <div class="row mb-3">
                    <label for="rso_id" class="col-sm-3 col-form-label">Rso <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="rso_id" class="form-select @error('rso_id') is-invalid @enderror" id="rso_id">
                            <option value="">-- Select Rso --</option>
                            @if(count($rsos) > 0)
                                @foreach($rsos as $rso)
                                    <option @selected($retailer->rso_id == $rso->id) value="{{ $rso->id }}">{{ $rso->rso_code .' - '. $rso->itop_number }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('rso_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Supervisor -->
                <div class="row mb-3">
                    <label for="supervisor" class="col-sm-3 col-form-label">Supervisor <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="supervisor" class="form-select @error('supervisor') is-invalid @enderror" id="supervisor">
                            <option value="">-- Select Supervisor --</option>
                            @if(count($supervisors) > 0)
                                @foreach($supervisors as $supervisor)
                                    <option @selected($retailer->supervisor == $supervisor->pool_number) value="{{ $supervisor->pool_number }}">{{ $supervisor->pool_number .' - '. \App\Models\User::firstWhere('id', $supervisor->user_id)->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('supervisor') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- BTS Code -->
                <div class="row mb-3">
                    <label for="bts_code" class="col-sm-3 col-form-label">BTS Code</label>
                    <div class="col-sm-9">
                        <select name="bts_code" class="form-select @error('bts_code') is-invalid @enderror" id="bts_code">
                            <option value="">-- Select BTS Code --</option>
                                    @if(count($btsCode) > 0)
                                        @foreach($btsCode as $bts)
                                            <option @selected($retailer->bts_code == $bts->bts_code) value="{{ $bts->bts_code }}">{{ $bts->bts_code .' - '. \Illuminate\Support\Str::limit($bts->address, 80) }}</option>
                                        @endforeach
                                    @endif
                        </select>
                        @error('bts_code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Route -->
                <div class="row mb-3">
                    <label for="route" class="col-sm-3 col-form-label">Route <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="route" class="select-2 form-select @error('route') is-invalid @enderror" id="route">
                            <option value="">-- Select Route --</option>
                            @if(count($routes) > 0)
                                @foreach($routes as $route)
                                    <option @selected($retailer->route == $route->code) value="{{ $route->code }}">{{ $route->code .' - '. $route->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('route') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Retailer Code -->
                <div class="row mb-3">
                    <label for="code" class="col-sm-3 col-form-label">Retailer Code <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="code" id="code" type="text"
                               class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $retailer->code) }}"
                               placeholder="Enter Retailer Code">
                        @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Retailer Name -->
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Retailer Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="name" id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $retailer->name) }}"
                               placeholder="Enter Retailer Name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Retailer Type -->
                <div class="row mb-3">
                    <label for="type" class="col-sm-3 col-form-label">Retailer Type <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="type" id="type" type="text"
                               class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $retailer->type) }}"
                               placeholder="Enter Retailer Type">
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Enabled -->
                <div class="row mb-3">
                    <label for="enabled" class="col-sm-3 col-form-label">Enabled <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="enabled" class="form-select @error('enabled') is-invalid @enderror" id="enabled">
                            <option value="">-- Select Enabled --</option>
                            <option @selected($retailer->enabled == 'Y') value="Y">Yes</option>
                            <option @selected($retailer->enabled == 'N') value="N">No</option>
                        </select>
                        @error('enabled') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Sim Seller -->
                <div class="row mb-3">
                    <label for="sim_seller" class="col-sm-3 col-form-label">Sim Seller <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="sim_seller" class="form-select @error('sim_seller') is-invalid @enderror" id="sim_seller">
                            <option value="">-- Select Sim Seller --</option>
                            <option @selected($retailer->sim_seller == 'Y') value="Y">Yes</option>
                            <option @selected($retailer->sim_seller == 'N') value="N">No</option>
                        </select>
                        @error('sim_seller') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Itop Number -->
                <div class="row mb-3">
                    <label for="itop_number" class="col-sm-3 col-form-label">Itop Number <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="itop_number" id="itop_number" type="number"
                               class="form-control @error('itop_number') is-invalid @enderror" value="{{ old('itop_number', $retailer->itop_number) }}"
                               placeholder="Enter Itop Number">
                        @error('itop_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Service Point -->
                <div class="row mb-3">
                    <label for="service_point" class="col-sm-3 col-form-label">Service Point <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="service_point" id="service_point" type="text"
                               class="form-control @error('service_point') is-invalid @enderror" value="{{ old('service_point', $retailer->service_point) }}"
                               placeholder="Enter Service Point">
                        @error('service_point') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Owner Name -->
                <div class="row mb-3">
                    <label for="owner_name" class="col-sm-3 col-form-label">Owner Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="owner_name" id="owner_name" type="text"
                               class="form-control @error('owner_name') is-invalid @enderror" value="{{ old('owner_name', $retailer->owner_name) }}"
                               placeholder="Enter Owner Name">
                        @error('owner_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Contact Number -->
                <div class="row mb-3">
                    <label for="contact_no" class="col-sm-3 col-form-label">Contact Number <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="contact_no" id="contact_no" type="number"
                               class="form-control @error('contact_no') is-invalid @enderror" value="{{ old('contact_no', $retailer->contact_no) }}"
                               placeholder="Enter Contact Number">
                        @error('contact_no') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Own Shop -->
                <div class="row mb-3">
                    <label for="own_shop" class="col-sm-3 col-form-label">Own Shop <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="own_shop" class="form-select @error('own_shop') is-invalid @enderror" id="own_shop">
                            <option value="">-- Select Own Shop --</option>
                            <option @selected($retailer->own_shop == 'Y') value="Y">Yes</option>
                            <option @selected($retailer->own_shop == 'N') value="N">No</option>
                        </select>
                        @error('own_shop') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- District -->
                <div class="row mb-3">
                    <label for="district" class="col-sm-3 col-form-label">District <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="district" id="district" type="text" class="form-control @error('district') is-invalid @enderror"
                               value="{{ old('district', $retailer->district) }}" placeholder="Enter District">
                        @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Thana -->
                <div class="row mb-3">
                    <label for="thana" class="col-sm-3 col-form-label">Thana <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="thana" id="thana" type="text" class="form-control @error('thana') is-invalid @enderror"
                               value="{{ old('thana', $retailer->thana) }}" placeholder="Enter Thana">
                        @error('thana') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="row mb-3">
                    <label for="address" class="col-sm-3 col-form-label">Address <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="address" id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                               value="{{ old('address', $retailer->address) }}" placeholder="Enter Address">
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Blood Group -->
                <div class="row mb-3">
                    <label for="blood_group" class="col-sm-3 col-form-label">Blood Group <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="blood_group" class="form-select @error('blood_group') is-invalid @enderror" id="blood_group">
                            <option value="">-- Select Blood Group --</option>
                            <option @selected($retailer->blood_group == 'a+') value="a+">A+</option>
                            <option @selected($retailer->blood_group == 'a-') value="a-">A-</option>
                            <option @selected($retailer->blood_group == 'b+') value="b+">B+</option>
                            <option @selected($retailer->blood_group == 'b-') value="b-">B-</option>
                            <option @selected($retailer->blood_group == 'ab+') value="ab+">AB+</option>
                            <option @selected($retailer->blood_group == 'ab-') value="ab-">AB-</option>
                            <option @selected($retailer->blood_group == 'o+') value="o+">O+</option>
                            <option @selected($retailer->blood_group == 'o-') value="o-">O-</option>
                        </select>
                        @error('blood_group') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Trade License No -->
                <div class="row mb-3">
                    <label for="trade_license_no" class="col-sm-3 col-form-label">Trade License No</label>
                    <div class="col-sm-9">
                        <input name="trade_license_no" id="trade_license_no" type="text"
                               class="form-control @error('trade_license_no') is-invalid @enderror" value="{{ old('trade_license_no', $retailer->trade_license_no) }}"
                               placeholder="Enter Trade License No">
                        @error('trade_license_no') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Others Operator -->
                <div class="row mb-3">
                    <label for="" class="col-sm-3 col-form-label">Others Operator</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <label class="form-check form-switch">
                                    <input name="others_operator[]" class="form-check-input" type="checkbox" value="Gp" @checked(in_array('Gp', $retailer->others_operator ?? []))>
                                    <span class="form-check-label">Gp</span>
                                </label>
                            </div>

                            <div class="col">
                                <label class="form-check form-switch">
                                    <input name="others_operator[]" value="Robi" class="form-check-input" type="checkbox" @checked(in_array('Robi', $retailer->others_operator ?? []))>
                                    <span class="form-check-label">Robi</span>
                                </label>
                            </div>

                            <div class="col">
                                <label class="form-check form-switch">
                                    <input name="others_operator[]" value="Aritel" class="form-check-input" type="checkbox" @checked(in_array('Aritel', $retailer->others_operator ?? []))>
                                    <span class="form-check-label">Aritel</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Longitude -->
                <div class="row mb-3">
                    <label for="longitude" class="col-sm-3 col-form-label">Longitude</label>
                    <div class="col-sm-9">
                        <input name="longitude" id="longitude" type="text"
                               class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude', $retailer->longitude) }}"
                               placeholder="Enter Longitude">
                        @error('longitude') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Latitude -->
                <div class="row mb-3">
                    <label for="latitude" class="col-sm-3 col-form-label">Latitude</label>
                    <div class="col-sm-9">
                        <input name="latitude" id="latitude" type="text"
                               class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude', $retailer->latitude) }}"
                               placeholder="Enter Latitude">
                        @error('latitude') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Device Name -->
                <div class="row mb-3">
                    <label for="device_name" class="col-sm-3 col-form-label">Device Name</label>
                    <div class="col-sm-9">
                        <input name="device_name" id="device_name" type="text"
                               class="form-control @error('device_name') is-invalid @enderror" value="{{ old('device_name', $retailer->device_name) }}"
                               placeholder="Enter Device Name">
                        @error('device_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Device Serial No -->
                <div class="row mb-3">
                    <label for="device_sn" class="col-sm-3 col-form-label">Device Serial No</label>
                    <div class="col-sm-9">
                        <input name="device_sn" id="device_sn" type="text"
                               class="form-control @error('device_sn') is-invalid @enderror" value="{{ old('device_sn', $retailer->device_sn) }}"
                               placeholder="Enter Device Serial No">
                        @error('device_sn') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Scanner Serial No -->
                <div class="row mb-3">
                    <label for="scanner_sn" class="col-sm-3 col-form-label">Scanner Serial No</label>
                    <div class="col-sm-9">
                        <input name="scanner_sn" id="scanner_sn" type="text"
                               class="form-control @error('scanner_sn') is-invalid @enderror" value="{{ old('scanner_sn', $retailer->scanner_sn) }}"
                               placeholder="Enter Scanner Serial No">
                        @error('scanner_sn') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Device Password -->
                <div class="row mb-3">
                    <label for="password" class="col-sm-3 col-form-label">Device Password</label>
                    <div class="col-sm-9">
                        <input name="password" id="password" type="number"
                               class="form-control @error('password') is-invalid @enderror" value="{{ old('password', $retailer->password) }}"
                               placeholder="Enter Device Password">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Trade Camping Code -->
                <div class="row mb-3">
                    <label for="hca" class="col-sm-3 col-form-label">Trade Camping Code</label>
                    <div class="col-sm-9">
                        <select name="hca" class="form-select @error('hca') is-invalid @enderror" id="hca">
                            <option value="">-- Trade Camping Code --</option>
                            <option @selected($retailer->hca == 'rso') value="rso">RS0</option>
                            <option @selected($retailer->hca == 'bp') value="bp">BP</option>
                            <option @selected($retailer->hca == 'tmo') value="tmo">TMO</option>
                        </select>
                    </div>
                </div>

                <!-- NID -->
                <div class="row mb-3">
                    <label for="nid" class="col-sm-3 col-form-label">NID <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="nid" id="nid" type="number"
                               class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid', $retailer->nid) }}"
                               placeholder="Enter NID Number">
                        @error('nid') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- NID Upload -->
                <div class="row mb-3">
                    <label for="nid_upload" class="col-sm-3 col-form-label">NID Upload</label>
                    <div class="col-sm-9">
                        <input name="nid_upload" id="nid_upload" type="file" class="form-control @error('nid_upload') is-invalid @enderror" accept="image/*">
                        @error('nid_upload') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Save Changes</button>
                <a href="{{ route('retailer.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                // Update Retailer
                $(document).on('submit','#retailerUpdateForm',function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
                            $('#retailerUpdateErrMsg').addClass('d-none').find('li').remove();
                            $('.btn-submit').prop('disabled', true).text('Saving...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                        },
                        success: function (response){
                            $('.btn-submit').prop('disabled', false).text('Save Change');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                window.location.href = "{{ route('retailer.index') }}";
                            });
                        },
                        error: function (e){
                            const err = JSON.parse(e.responseText);

                            $.each(err.errors,function (key,value){
                                $('.err-msg').removeClass('d-none').append('<li>' + value + '</li>');
                            });

                            $('.btn-submit').prop('disabled', false).text('Save Change');
                        },
                    });
                });

                // Validation
                // $("#retailerUpdateForm").validate({
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
