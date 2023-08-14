<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Bp</x-slot:title>

    <div id="bpErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create New Bp</h6>
                    <form id="bpForm" action="{{ route('bp.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <!-- Distribution House -->
                        <div class="row mb-3">
                            <label for="dd_house_id" class="col-sm-3 col-form-label">Distribution House ({{ count($houses) }})</label>
                            <div class="col-sm-9">
                                <select name="dd_house_id" class="form-select @error('dd_house_id') is-invalid @enderror" id="dd_house_id">
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

                        <!-- Supervisor -->
                        <div class="row mb-3">
                            <label for="supervisor" class="col-sm-3 col-form-label">Supervisor</label>
                            <div class="col-sm-9">
                                <select name="supervisor" class="form-select @error('supervisor') is-invalid @enderror" id="supervisor">
                                    <option value="">-- Select Supervisor --</option>
                                    @if(count($supervisors) > 0)
                                        @foreach($supervisors as $supervisor)
                                            <option value="{{ $supervisor->pool_number }}">{{ $supervisor->pool_number .' - '. \App\Models\User::firstWhere('id', $supervisor->user_id)->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('supervisor') <span class="text-danger">{{ $message }}</span> @enderror
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
                                            <option value="{{ $user->id }}">{{ $user->phone .' - '. $user->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                                <small class="text-muted">User Left: <strong class="{{ count($users) < 1 ? 'text-danger' : 'text-success'}}">{{ count($users) }}</strong></small>
                            </div>
                        </div>

                        <!-- Response ID -->
                        <div class="row mb-3">
                            <label for="response_id" class="col-sm-3 col-form-label">Response ID</label>
                            <div class="col-sm-9">
                                <input name="response_id" id="response_id" type="text"
                                       class="form-control @error('response_id') is-invalid @enderror" value="{{ old('response_id') }}"
                                       placeholder="Enter Response ID">
                                @error('response_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="row mb-3">
                            <label for="type" class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-9">
                                <input name="type" id="type" type="text"
                                       class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}"
                                       placeholder="Enter Type">
                                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Pool Number -->
                        <div class="row mb-3">
                            <label for="pool_number" class="col-sm-3 col-form-label">Pool Number</label>
                            <div class="col-sm-9">
                                <input name="pool_number" id="pool_number" type="number"
                                       class="form-control @error('pool_number') is-invalid @enderror" value="{{ old('pool_number') }}"
                                       placeholder="Enter Pool Number">
                                @error('pool_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Personal Number -->
                        <div class="row mb-3">
                            <label for="personal_number" class="col-sm-3 col-form-label">Personal Number</label>
                            <div class="col-sm-9">
                                <input name="personal_number" id="personal_number" type="number"
                                       class="form-control @error('personal_number') is-invalid @enderror" value="{{ old('personal_number') }}"
                                       placeholder="Enter Personal Number">
                                @error('personal_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="row mb-3">
                            <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror" id="gender">
                                    <option value="">-- Select Gender --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="others">Others</option>
                                </select>
                                @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Blood Group -->
                        <div class="row mb-3">
                            <label for="blood_group" class="col-sm-3 col-form-label">Blood Group</label>
                            <div class="col-sm-9">
                                <select name="blood_group" class="form-select @error('blood_group') is-invalid @enderror" id="blood_group">
                                    <option value="">-- Select Blood Group --</option>
                                    <option value="a+">A+</option>
                                    <option value="a-">A-</option>
                                    <option value="b+">B+</option>
                                    <option value="b-">B-</option>
                                    <option value="ab+">AB+</option>
                                    <option value="ab-">AB-</option>
                                    <option value="o+">O+</option>
                                    <option value="o-">O-</option>
                                </select>
                                @error('blood_group') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="row mb-3">
                            <label for="education" class="col-sm-3 col-form-label">Education</label>
                            <div class="col-sm-9">
                                <input name="education" id="education" type="text"
                                       class="form-control @error('education') is-invalid @enderror" value="{{ old('education') }}"
                                       placeholder="e.g SSC/HSC/Dakhil">
                                @error('education') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Father Name -->
                        <div class="row mb-3">
                            <label for="father_name" class="col-sm-3 col-form-label">Father Name</label>
                            <div class="col-sm-9">
                                <input name="father_name" id="father_name" type="text" class="form-control @error('father_name') is-invalid @enderror"
                                       value="{{ old('father_name') }}" placeholder="Enter Father Name">
                                @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Mother Name -->
                        <div class="row mb-3">
                            <label for="mother_name" class="col-sm-3 col-form-label">Mother Name</label>
                            <div class="col-sm-9">
                                <input name="mother_name" id="mother_name" type="text" class="form-control @error('mother_name') is-invalid @enderror"
                                       value="{{ old('mother_name') }}" placeholder="Enter Mother Name">
                                @error('mother_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Division -->
                        <div class="row mb-3">
                            <label for="division" class="col-sm-3 col-form-label">Division</label>
                            <div class="col-sm-9">
                                <input name="division" id="division" type="text" class="form-control @error('division') is-invalid @enderror"
                                       value="{{ old('division') }}" placeholder="Enter Division">
                                @error('division') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- District -->
                        <div class="row mb-3">
                            <label for="district" class="col-sm-3 col-form-label">District</label>
                            <div class="col-sm-9">
                                <input name="district" id="district" type="text" class="form-control @error('district') is-invalid @enderror"
                                       value="{{ old('district') }}" placeholder="Enter District">
                                @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Thana -->
                        <div class="row mb-3">
                            <label for="thana" class="col-sm-3 col-form-label">Thana</label>
                            <div class="col-sm-9">
                                <input name="thana" id="thana" type="text" class="form-control @error('thana') is-invalid @enderror"
                                       value="{{ old('thana') }}" placeholder="Enter Thana">
                                @error('thana') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="row mb-3">
                            <label for="address" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input name="address" id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                       value="{{ old('address') }}" placeholder="Enter Address">
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- NID -->
                        <div class="row mb-3">
                            <label for="nid" class="col-sm-3 col-form-label">NID</label>
                            <div class="col-sm-9">
                                <input name="nid" id="nid" type="number"
                                       class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid') }}"
                                       placeholder="Enter NID Number">
                                @error('nid') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Bank Name -->
                        <div class="row mb-3">
                            <label for="bank_name" class="col-sm-3 col-form-label">Bank Name</label>
                            <div class="col-sm-9">
                                <input name="bank_name" id="bank_name" type="text"
                                       class="form-control @error('bank_name') is-invalid @enderror" value="{{ old('bank_name') }}"
                                       placeholder="Enter Bank Name">
                                @error('bank_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Brunch Name -->
                        <div class="row mb-3">
                            <label for="brunch_name" class="col-sm-3 col-form-label">Brunch Name</label>
                            <div class="col-sm-9">
                                <input name="brunch_name" id="brunch_name" type="text"
                                       class="form-control @error('brunch_name') is-invalid @enderror" value="{{ old('brunch_name') }}"
                                       placeholder="Enter Brunch Name">
                                @error('brunch_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Salary -->
                        <div class="row mb-3">
                            <label for="salary" class="col-sm-3 col-form-label">Salary</label>
                            <div class="col-sm-9">
                                <input name="salary" id="salary" type="number"
                                       class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary') }}"
                                       placeholder="Enter Salary">
                                @error('salary') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Account Number -->
                        <div class="row mb-3">
                            <label for="account_number" class="col-sm-3 col-form-label">Account Number</label>
                            <div class="col-sm-9">
                                <input name="account_number" id="account_number" type="number"
                                       class="form-control @error('account_number') is-invalid @enderror" value="{{ old('account_number') }}"
                                       placeholder="Enter Account Number">
                                @error('account_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- D.O.B -->
                        <div class="row mb-3">
                            <label for="dob" class="col-sm-3 col-form-label">D.O.B</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="dob" id="dob" type="text" class="flatpickr form-control @error('dob') is-invalid @enderror" placeholder="Select date">
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Joining Date -->
                        <div class="row mb-3">
                            <label for="joining_date" class="col-sm-3 col-form-label">Joining Date</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="joining_date" id="joining_date" type="text" class="flatpickr form-control @error('joining_date') is-invalid @enderror" placeholder="Select date">
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('joining_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Resigning Date -->
{{--                        <div class="row mb-3">--}}
{{--                            <label for="resigning_date" class="col-sm-3 col-form-label">Resigning Date</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <div class="input-group">--}}
{{--                                    <input name="resigning_date" id="resigning_date" type="text" value="{{ old('resigning_date') }}" class="flatpickr form-control @error('resigning_date') is-invalid @enderror" placeholder="Select date">--}}
{{--                                    <span class="input-group-text input-group-addon" data-toggle>--}}
{{--                                        <i data-feather="calendar"></i>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                                @error('resigning_date') <span class="text-danger">{{ $message }}</span> @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <!-- Upload Documents -->
                        <div class="row mb-3">
                            <label for="documents" class="col-sm-3 col-form-label">Upload Documents</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="documents" id="documents" type="file" accept="application/pdf">
                                @error('documents') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create New BP</button>
                        <a href="{{ route('bp.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
                @if(session()->has('import_errors'))
                    @foreach(session()->get('import_errors') as $failure)
                        <div class="card-header">
                            <div class="alert alert-danger">
                                <p>BP: <strong>{{ $failure->values()['pool_number'] }}</strong></p>
                                <p>Error type: <strong>{{ \Illuminate\Support\Str::title($failure->attribute()) }}</strong></p>
                                <p>Error msg: {{ $failure->errors()[0] }} </p>
                                <p>Row number : {{ $failure->row() }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="card-body">
                    <h6 class="card-title">Import BP</h6>
                    <form class="row gy-2 gx-3 align-items-center import-bp" action="{{ route('bp.import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label class="visually-hidden" for="autoSizingInput">Name</label>
                            <input name="import_bp" type="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary w-100 mt-2 btn-import-bp">Import BP</button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('bp.sample.file.download') }}" class="nav-link text-muted">Download sample file.</a>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {

                // Create BP
                $(document).on('submit','#bpForm',function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
                            $('#rsoErrMsg').addClass('d-none').find('li').remove();
                            $('.btn-submit').prop('disabled', true).text('Creating...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                        },
                        success: function (response){
                            $('.btn-submit').prop('disabled', false).text('Create New BP');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                window.location.href = "{{ route('bp.index') }}";
                            });
                        },
                        error: function (e){
                            const err = JSON.parse(e.responseText);

                            $.each(err.errors,function (key,value){
                                $('.err-msg').removeClass('d-none').append('<li>' + value + '</li>');
                            });

                            $('.btn-submit').prop('disabled', false).text('Create New BP');
                        },
                    });
                });

                // Import Bp
                $(document).on('submit','.import-bp',function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
                            $('.btn-import-bp').prop('disabled', true).text('Importing...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                        },
                        success: function (response){
                            $('.btn-import-bp').prop('disabled', false).text('Import BP');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                window.location.href = "{{ route('bp.index') }}";
                            });
                        },
                        error: function (e){
                            const err = JSON.parse(e.responseText);

                            $.each(err.errors,function (key,value){
                                $('.err-msg').removeClass('d-none').append('<li>' + value + '</li>');
                            });

                            $('.btn-import-bp').prop('disabled', false).text('Import BP');
                        },
                    });
                });

                // $("#retailerForm").validate({
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
