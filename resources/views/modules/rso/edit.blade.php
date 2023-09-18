<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update Rso</x-slot:title>

    <div id="rsoUpdateErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Update Rso</h6>
            <form id="rsoUpdateForm" action="{{ route('rso.update', $rso->id) }}" method="POST">
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
                                    <option {{ $rso->dd_house_id == $house->id ? 'selected' : '' }} value="{{ $house->id }}">{{ $house->code .' - '. $house->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('dd_house_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Supervisor -->
                <div class="row mb-3">
                    <label for="supervisor_id" class="col-sm-3 col-form-label">Supervisor</label>
                    <div class="col-sm-9">
                        <select name="supervisor_id" class="form-select @error('supervisor_id') is-invalid @enderror" id="supervisor_id">
                            <option value="">-- Select Supervisor --</option>
                            @if(count($supervisors) > 0)
                                @foreach($supervisors as $supervisor)
                                    <option {{ $rso->supervisor_id == $supervisor->id ? 'selected' : '' }} value="{{ $supervisor->id }}">{{ $supervisor->pool_number .' - '. \App\Models\User::firstWhere('id', $supervisor->user_id)->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('supervisor_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- User -->
                <div class="row mb-3">
                    <label for="user_id" class="col-sm-3 col-form-label">User</label>
                    <div class="col-sm-9">
                        <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" id="user_id">
                            <option value="">-- Select User --</option>
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    <option @selected($rso->user_id == $user->id) value="{{ $user->id }}">{{ $user->phone .' - '. $user->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                        <small class="text-muted">User Left: <strong class="{{ count($users) < 1 ? 'text-danger' : 'text-success'}}">{{ count($users) }}</strong></small>
                    </div>
                </div>

                <!-- Route -->
                <div class="row mb-3">
                    <label for="routes" class="col-sm-3 col-form-label">Route</label>
                    <div class="col-sm-9">
                        <select name="routes[]" class="select-2 form-select @error('routes') is-invalid @enderror" id="routes" multiple>
                            <option value="">-- Select Route --</option>
                            @if(count($routes) > 0)
                                @foreach($routes as $route)
                                    <option
                                        @if(!empty($rso->routes))
                                            @foreach ($rso->routes as $rsoRoute)
                                                @selected($rsoRoute == $route->code)
                                            @endforeach
                                        @endif
                                        value="{{ $route->code }}">{{ $route->code .' - '. $route->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('routes') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Rso Code -->
                <div class="row mb-3">
                    <label for="rso_code" class="col-sm-3 col-form-label">Rso Code</label>
                    <div class="col-sm-9">
                        <input name="rso_code" id="rso_code" type="text"
                               class="form-control @error('rso_code') is-invalid @enderror" value="{{ old('rso_code', $rso->rso_code) }}"
                               placeholder="Enter Rso Code">
                        @error('rso_code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Itop Number -->
                <div class="row mb-3">
                    <label for="itop_number" class="col-sm-3 col-form-label">Itop Number</label>
                    <div class="col-sm-9">
                        <input name="itop_number" id="itop_number" type="number"
                               class="form-control @error('itop_number') is-invalid @enderror" value="{{ old('itop_number', $rso->itop_number) }}"
                               placeholder="Enter Itop Number">
                        @error('itop_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Pool Number -->
                <div class="row mb-3">
                    <label for="pool_number" class="col-sm-3 col-form-label">Pool Number</label>
                    <div class="col-sm-9">
                        <input name="pool_number" id="pool_number" type="number"
                               class="form-control @error('pool_number') is-invalid @enderror" value="{{ old('pool_number', $rso->pool_number) }}"
                               placeholder="Enter Pool Number">
                        @error('pool_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Personal Number -->
                <div class="row mb-3">
                    <label for="personal_number" class="col-sm-3 col-form-label">Personal Number</label>
                    <div class="col-sm-9">
                        <input name="personal_number" id="personal_number" type="number"
                               class="form-control @error('personal_number') is-invalid @enderror" value="{{ old('personal_number', $rso->personal_number) }}"
                               placeholder="Enter Personal Number">
                        @error('personal_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- RID -->
                <div class="row mb-3">
                    <label for="rid" class="col-sm-3 col-form-label">RID</label>
                    <div class="col-sm-9">
                        <input name="rid" id="rid" type="text" class="form-control @error('rid') is-invalid @enderror"
                               value="{{ old('rid', $rso->rid) }}" placeholder="Enter RID">
                        @error('rid') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Father Name -->
                <div class="row mb-3">
                    <label for="father_name" class="col-sm-3 col-form-label">Father Name</label>
                    <div class="col-sm-9">
                        <input name="father_name" id="father_name" type="text" class="form-control @error('father_name') is-invalid @enderror"
                               value="{{ old('father_name', $rso->father_name) }}" placeholder="Enter Father Name">
                        @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Mother Name -->
                <div class="row mb-3">
                    <label for="mother_name" class="col-sm-3 col-form-label">Mother Name</label>
                    <div class="col-sm-9">
                        <input name="mother_name" id="mother_name" type="text" class="form-control @error('mother_name') is-invalid @enderror"
                               value="{{ old('mother_name', $rso->mother_name) }}" placeholder="Enter Mother Name">
                        @error('mother_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Division -->
                <div class="row mb-3">
                    <label for="division" class="col-sm-3 col-form-label">Division</label>
                    <div class="col-sm-9">
                        <input name="division" id="division" type="text" class="form-control @error('division') is-invalid @enderror"
                               value="{{ old('division', $rso->division) }}" placeholder="Enter Division">
                        @error('division') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- District -->
                <div class="row mb-3">
                    <label for="district" class="col-sm-3 col-form-label">District</label>
                    <div class="col-sm-9">
                        <input name="district" id="district" type="text" class="form-control @error('district') is-invalid @enderror"
                               value="{{ old('district', $rso->district) }}" placeholder="Enter District">
                        @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Thana -->
                <div class="row mb-3">
                    <label for="thana" class="col-sm-3 col-form-label">Thana</label>
                    <div class="col-sm-9">
                        <input name="thana" id="thana" type="text" class="form-control @error('thana') is-invalid @enderror"
                               value="{{ old('thana', $rso->thana) }}" placeholder="Enter Thana">
                        @error('thana') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="row mb-3">
                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                        <input name="address" id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                               value="{{ old('address', $rso->address) }}" placeholder="Enter Address">
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Blood Group -->
                <div class="row mb-3">
                    <label for="blood_group" class="col-sm-3 col-form-label">Blood Group</label>
                    <div class="col-sm-9">
                        <select name="blood_group" class="form-select @error('blood_group') is-invalid @enderror" id="blood_group">
                            <option value="">-- Select Blood Group --</option>
                            <option {{ $rso->blood_group == 'a+' ? 'selected' : '' }} value="a+">A+</option>
                            <option {{ $rso->blood_group == 'a-' ? 'selected' : '' }} value="a-">A-</option>
                            <option {{ $rso->blood_group == 'b+' ? 'selected' : '' }} value="b+">B+</option>
                            <option {{ $rso->blood_group == 'b-' ? 'selected' : '' }} value="b-">B-</option>
                            <option {{ $rso->blood_group == 'ab+' ? 'selected' : '' }} value="ab+">AB+</option>
                            <option {{ $rso->blood_group == 'ab-' ? 'selected' : '' }} value="ab-">AB-</option>
                            <option {{ $rso->blood_group == 'o+' ? 'selected' : '' }} value="o+">O+</option>
                            <option {{ $rso->blood_group == 'o-' ? 'selected' : '' }} value="o-">O-</option>
                        </select>
                        @error('blood_group') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- SR-No -->
                <div class="row mb-3">
                    <label for="sr_no" class="col-sm-3 col-form-label">SR-No</label>
                    <div class="col-sm-9">
                        <input name="sr_no" id="sr_no" type="text"
                               class="form-control @error('sr_no', $rso->sr_no) is-invalid @enderror" value="{{ old('sr_no', $rso->sr_no) }}"
                               placeholder="Enter SR-No">
                        @error('sr_no') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Account Number -->
                <div class="row mb-3">
                    <label for="account_number" class="col-sm-3 col-form-label">Account Number</label>
                    <div class="col-sm-9">
                        <input name="account_number" id="account_number" type="text"
                               class="form-control @error('account_number') is-invalid @enderror" value="{{ old('account_number', $rso->account_number) }}"
                               placeholder="Enter Account Number">
                        @error('account_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Bank Name -->
                <div class="row mb-3">
                    <label for="bank_name" class="col-sm-3 col-form-label">Bank Name</label>
                    <div class="col-sm-9">
                        <input name="bank_name" id="bank_name" type="text"
                               class="form-control @error('bank_name') is-invalid @enderror" value="{{ old('bank_name', $rso->bank_name) }}"
                               placeholder="Enter Bank Name">
                        @error('bank_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Brunch Name -->
                <div class="row mb-3">
                    <label for="brunch_name" class="col-sm-3 col-form-label">Brunch Name</label>
                    <div class="col-sm-9">
                        <input name="brunch_name" id="brunch_name" type="text"
                               class="form-control @error('brunch_name') is-invalid @enderror" value="{{ old('brunch_name', $rso->brunch_name) }}"
                               placeholder="Enter Brunch Name">
                        @error('brunch_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Routing Number -->
                <div class="row mb-3">
                    <label for="routing_number" class="col-sm-3 col-form-label">Routing Number</label>
                    <div class="col-sm-9">
                        <input name="routing_number" id="routing_number" type="number"
                               class="form-control @error('routing_number') is-invalid @enderror" value="{{ old('routing_number', $rso->routing_number) }}"
                               placeholder="Enter Routing Number">
                        @error('routing_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Salary -->
                <div class="row mb-3">
                    <label for="salary" class="col-sm-3 col-form-label">Salary</label>
                    <div class="col-sm-9">
                        <input name="salary" id="salary" type="number"
                               class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary', $rso->salary) }}"
                               placeholder="Enter Salary">
                        @error('salary') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Education -->
                <div class="row mb-3">
                    <label for="education" class="col-sm-3 col-form-label">Education</label>
                    <div class="col-sm-9">
                        <input name="education" id="education" type="text"
                               class="form-control @error('education') is-invalid @enderror" value="{{ old('education', $rso->education) }}"
                               placeholder="e.g SSC/HSC/Dakhil">
                        @error('education') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Marital Status -->
                <div class="row mb-3">
                    <label for="marital_status" class="col-sm-3 col-form-label">Marital Status</label>
                    <div class="col-sm-9">
                        <select name="marital_status" class="form-select @error('marital_status') is-invalid @enderror" id="marital_status">
                            <option value="">-- Select Marital Status --</option>
                            <option {{ $rso->marital_status == 'married' ? 'selected' : '' }} value="married">Married</option>
                            <option {{ $rso->marital_status == 'unmarried' ? 'selected' : '' }} value="unmarried">Unmarried</option>
                        </select>
                        @error('marital_status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Gender -->
                <div class="row mb-3">
                    <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                    <div class="col-sm-9">
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror" id="gender">
                            <option value="">-- Select Gender --</option>
                            <option @selected($rso->gender == 'Male') value="male">Male</option>
                            <option @selected($rso->gender == 'Female') value="female">Female</option>
                            <option @selected($rso->gender == 'Others') value="others">Others</option>
                        </select>
                        @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- D.O.B -->
                <div class="row mb-3">
                    <label for="dob" class="col-sm-3 col-form-label">D.O.B</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input name="dob" id="dob" type="text" class="flatpickr form-control @error('dob') is-invalid @enderror" value="{{ $rso->dob }}" placeholder="Select date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                <i data-feather="calendar"></i>
                            </span>
                        </div>
                        @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- NID -->
                <div class="row mb-3">
                    <label for="nid" class="col-sm-3 col-form-label">NID</label>
                    <div class="col-sm-9">
                        <input name="nid" id="nid" type="number"
                               class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid', $rso->nid) }}"
                               placeholder="Enter NID Number">
                        @error('nid') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Residential Rso -->
                <div class="row mb-3">
                    <label for="residential_rso" class="col-sm-3 col-form-label">Residential Rso</label>
                    <div class="col-sm-9">
                        <select name="residential_rso" class="form-select @error('residential_rso') is-invalid @enderror" id="residential_rso">
                            <option value="">-- Select Residential Rso --</option>
                            <option {{ $rso->residential_rso == 'Yes' ? 'selected' : '' }} value="Yes">Yes</option>
                            <option {{ $rso->residential_rso == 'No' ? 'selected' : '' }} value="No">No</option>
                        </select>
                        @error('residential_rso') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Joining Date -->
                <div class="row mb-3">
                    <label for="joining_date" class="col-sm-3 col-form-label">Joining Date</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input name="joining_date" id="joining_date" type="text" value="{{ $rso->joining_date }}" class="flatpickr form-control @error('joining_date') is-invalid @enderror" placeholder="Select date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                <i data-feather="calendar"></i>
                            </span>
                        </div>
                        @error('joining_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Resigning Date -->
                <div class="row mb-3">
                    <label for="resigning_date" class="col-sm-3 col-form-label">Resigning Date</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input name="resigning_date" id="resigning_date" type="text" value="{{ $rso->resigning_date }}" class="flatpickr form-control @error('resigning_date') is-invalid @enderror" placeholder="Select date">
                            <span class="input-group-text input-group-addon" data-toggle>
                            <i data-feather="calendar"></i>
                        </span>
                        </div>
                        @error('resigning_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="row mb-3">
                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select name="status" class="form-select @error('status') is-invalid @enderror" id="status">
                            <option value="">-- Select Status --</option>
                            <option {{ $rso->status == 1 ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $rso->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Save Changes</button>
                <a href="{{ route('rso.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                // Update Rso
                $(document).on('submit','#rsoUpdateForm',function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
                            $('#rsoUpdateErrMsg').addClass('d-none').find('li').remove();
                            $('.btn-submit').prop('disabled', true).text('Saving...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                        },
                        success: function (response){
                            $('.btn-submit').prop('disabled', false).text('Save Changes');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                window.location.href = "{{ route('rso.index') }}";
                            });
                        },
                        error: function (e){
                            const err = JSON.parse(e.responseText);

                            $.each(err.errors,function (key,value){
                                $('.err-msg').removeClass('d-none').append('<li>' + value + '</li>');
                            });

                            $('.btn-submit').prop('disabled', false).text('Save Changes');
                        },
                    });
                });

                // Validation
                // $("#rsoUpdateForm").validate({
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
