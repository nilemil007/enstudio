<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Supervisor</x-slot:title>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create new supervisor</h6>
                    <form id="supervisorForm" action="{{ route('supervisor.store') }}" method="POST">
                        @csrf

                        <!-- Distribution House -->
                        <div class="row mb-3">
                            <label for="dd_house_id" class="col-sm-3 col-form-label">Distribution House</label>
                            <div class="col-sm-9">
                                <select name="dd_house_id" class="select-2 form-select" id="dd_house_id">
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

                        <!-- Assign User -->
                        <div class="row mb-3">
                            <label for="set_user" class="col-sm-3 col-form-label">Assign User</label>
                            <div class="col-sm-9">
                                <select name="user_id" class="select-2 form-select" id="set_user">
                                    <option value="">-- Select Supervisor --</option>
                                </select>
                                @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Pool Number -->
                        <div class="row mb-3">
                            <label for="pool_number" class="col-sm-3 col-form-label">Pool Number</label>
                            <div class="col-sm-9">
                                <input name="pool_number" id="pool_number" type="number"
                                       class="form-control" value="{{ old('pool_number') }}"
                                       placeholder="Enter Pool Number">
                                @error('pool_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Father Name -->
                        <div class="row mb-3">
                            <label for="father_name" class="col-sm-3 col-form-label">Father Name</label>
                            <div class="col-sm-9">
                                <input name="father_name" id="father_name" type="text" class="form-control" value="{{ old('father_name') }}" placeholder="Enter Father Name">
                                @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Mother Name -->
                        <div class="row mb-3">
                            <label for="mother_name" class="col-sm-3 col-form-label">Mother Name</label>
                            <div class="col-sm-9">
                                <input name="mother_name" id="mother_name" type="text" class="form-control" value="{{ old('mother_name') }}" placeholder="Enter Mother Name">
                                @error('mother_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Division -->
                        <div class="row mb-3">
                            <label for="division" class="col-sm-3 col-form-label">Division</label>
                            <div class="col-sm-9">
                                <input name="division" id="division" type="text" class="form-control" value="{{ old('division') }}" placeholder="Enter Division">
                                @error('division') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- District -->
                        <div class="row mb-3">
                            <label for="district" class="col-sm-3 col-form-label">District</label>
                            <div class="col-sm-9">
                                <input name="district" id="district" type="text" class="form-control" value="{{ old('district') }}" placeholder="Enter District">
                                @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Thana -->
                        <div class="row mb-3">
                            <label for="thana" class="col-sm-3 col-form-label">Thana</label>
                            <div class="col-sm-9">
                                <input name="thana" id="thana" type="text" class="form-control" value="{{ old('thana') }}" placeholder="Enter Thana">
                                @error('thana') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="row mb-3">
                            <label for="address" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input name="address" id="address" type="text" class="form-control" value="{{ old('address') }}" placeholder="Enter Address">
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- NID -->
                        <div class="row mb-3">
                            <label for="nid" class="col-sm-3 col-form-label">NID</label>
                            <div class="col-sm-9">
                                <input name="nid" id="nid" type="number" class="form-control" value="{{ old('nid') }}" placeholder="Enter NID Number">
                                @error('nid') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- D.O.B -->
                        <div class="row mb-3">
                            <label for="dob" class="col-sm-3 col-form-label">D.O.B</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="dob" id="dob" type="text" class="flatpickr form-control" placeholder="Select date">
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
                                    <input name="joining_date" id="joining_date" type="text" class="flatpickr form-control" placeholder="Select date">
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('joining_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create New Supervisor</button>
                        <a href="{{ route('supervisor.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>
            </div>
        </div>

{{--        <div class="col-md-4">--}}
{{--            <div class="card mb-3">--}}
{{--                @if(session()->has('import_errors'))--}}
{{--                    @foreach(session()->get('import_errors') as $failure)--}}
{{--                        <div class="card-header">--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                <p>Supervisor name: <strong>{{ $failure->values()['dd_name'] .'-'. $failure->values()['dd_code'] }}</strong></p>--}}
{{--                                <p>Error type: <strong>{{ \Illuminate\Support\Str::title($failure->attribute()) }}</strong></p>--}}
{{--                                <p>Error msg: {{ $failure->errors()[0] }} </p>--}}
{{--                                <p>Row number : {{ $failure->row() }}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                @endif--}}

{{--                <div class="card-body">--}}
{{--                    <h6 class="card-title">Import dd house</h6>--}}
{{--                    <form class="row gy-2 gx-3 align-items-center" action="{{ route('supervisor.import') }}" method="post" enctype="multipart/form-data">--}}
{{--                        @csrf--}}

{{--                        <div class="col-12">--}}
{{--                            <label class="visually-hidden" for="autoSizingInput">Name</label>--}}
{{--                            <input name="import_house" type="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>--}}
{{--                        </div>--}}
{{--                        <div class="col-12">--}}
{{--                            <button type="submit" class="btn btn-sm btn-primary w-100 mt-2">Import house</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <a href="{{ route('supervisor.sample.file.download') }}" class="nav-link text-muted">Download sample file.</a>--}}
{{--        </div>--}}
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('change','#dd_house_id',function (){
                    const houseId = $(this).val();

                    if (houseId === '')
                    {
                        $('#set_user').html('<option value="">-- Select User --</option>');
                    }

                    // Get user by dd house
                    $.ajax({
                        url: "{{ route('supervisor.get.users.by.dd.house') }}/" + houseId,
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: () => {
                            $('#loading').show();
                        },
                        complete: () => {
                            $('#loading').hide();
                        },
                        success: function (response){
                            $('#set_user').find('option:not(:first)').remove();

                            $.each(response.users, function (key, value){
                                $('#set_user').append('<option value="'+ value.id +'">' + value.phone + ' - ' + value.name + '</option>')
                            });
                        }
                    });
                });

                // Validation
                $('#supervisorForm').validate({
                    rules: {
                        name: {
                            required: true,
                            maxlength: 100,
                            minlength: 3,
                        },
                        username: {
                            required: true,
                            maxlength: 30,
                            minlength: 3,
                        },
                        phone: {
                            required: true,
                            number: true,
                            maxlength: 11,
                            minlength: 11,
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        role: {
                            required: true,
                        },
                        password: {
                            required: true,
                            minlength: 8,
                        },
                        image: {
                            accept: "image/*",
                        },
                    },
                    messages: {

                    },
                    errorPlacement: function(error, element){
                        error.addClass('invalid-feedback');

                        if (element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        }
                        else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                            error.insertAfter(element.parent().parent());
                        }
                        else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                            error.appendTo(element.parent().parent());
                        }
                        else {
                            error.insertAfter(element);
                        }
                    },
                    highlight: function(element, errorClass){
                        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
                            $( element ).addClass( "is-invalid" );
                        }
                    },
                    unhighlight: function(element, errorClass){
                        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
                            $( element ).removeClass( "is-invalid" );
                        }
                    },
                });
            });
        </script>
    @endpush

</x-app-layout>
