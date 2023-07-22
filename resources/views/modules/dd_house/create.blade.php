<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New House</x-slot:title>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create new house</h6>
                    <form id="ddHouseForm" action="{{ route('dd-house.store') }}" method="POST">
                        @csrf

                        <!-- Cluster Name -->
                        <div class="row mb-3">
                            <label for="cluster_name" class="col-sm-3 col-form-label">Cluster Name</label>
                            <div class="col-sm-9">
                                <input name="cluster_name" id="cluster_name" type="text" class="form-control @error('cluster_name') is-invalid @enderror"
                                       value="{{ old('cluster_name') }}"
                                       placeholder="Enter Cluster Name">
                                @error('cluster_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Region -->
                        <div class="row mb-3">
                            <label for="region" class="col-sm-3 col-form-label">Region</label>
                            <div class="col-sm-9">
                                <input name="region" id="region" type="text" class="form-control @error('region') is-invalid @enderror"
                                       value="{{ old('region') }}"
                                       placeholder="Enter Region">
                                @error('region') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- DD Code -->
                        <div class="row mb-3">
                            <label for="code" class="col-sm-3 col-form-label">DD Code</label>
                            <div class="col-sm-9">
                                <input name="code" id="code" type="text" class="form-control @error('code') is-invalid @enderror"
                                       value="{{ old('code') }}" placeholder="Enter DD Code">
                                @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- DD Name -->
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">DD Name</label>
                            <div class="col-sm-9">
                                <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" placeholder="Enter DD Name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                       placeholder="Enter email address">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
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

                        <!-- Address -->
                        <div class="row mb-3">
                            <label for="address" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input name="address" id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                       value="{{ old('address') }}" placeholder="Enter Address">
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Proprietor Name -->
                        <div class="row mb-3">
                            <label for="proprietor_name" class="col-sm-3 col-form-label">Proprietor Name</label>
                            <div class="col-sm-9">
                                <input name="proprietor_name" id="proprietor_name" type="text"
                                       class="form-control @error('proprietor_name') is-invalid @enderror" value="{{ old('proprietor_name') }}"
                                       placeholder="Enter Proprietor Name">
                                @error('proprietor_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Proprietor Number -->
                        <div class="row mb-3">
                            <label for="proprietor_number" class="col-sm-3 col-form-label">Proprietor Number</label>
                            <div class="col-sm-9">
                                <input name="proprietor_number" id="proprietor_number" type="number"
                                       class="form-control @error('proprietor_number') is-invalid @enderror" value="{{ old('proprietor_number') }}"
                                       placeholder="Enter Proprietor Number">
                                @error('proprietor_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- POC Name -->
                        <div class="row mb-3">
                            <label for="poc_name" class="col-sm-3 col-form-label">POC Name</label>
                            <div class="col-sm-9">
                                <input name="poc_name" id="poc_name" type="text"
                                       class="form-control @error('poc_name') is-invalid @enderror" value="{{ old('poc_name') }}"
                                       placeholder="Enter POC Name">
                                @error('poc_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- POC Number -->
                        <div class="row mb-3">
                            <label for="poc_number" class="col-sm-3 col-form-label">POC Number</label>
                            <div class="col-sm-9">
                                <input name="poc_number" id="poc_number" type="number"
                                       class="form-control @error('poc_number') is-invalid @enderror" value="{{ old('poc_number') }}"
                                       placeholder="Enter POC Number">
                                @error('poc_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- TIN Number -->
                        <div class="row mb-3">
                            <label for="tin_number" class="col-sm-3 col-form-label">TIN Number</label>
                            <div class="col-sm-9">
                                <input name="tin_number" id="tin_number" type="number"
                                       class="form-control @error('tin_number') is-invalid @enderror" value="{{ old('tin_number') }}"
                                       placeholder="Enter TIN Number">
                                @error('tin_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- BIN Number -->
                        <div class="row mb-3">
                            <label for="bin_number" class="col-sm-3 col-form-label">BIN Number</label>
                            <div class="col-sm-9">
                                <input name="bin_number" id="bin_number" type="text"
                                       class="form-control @error('bin_number') is-invalid @enderror" value="{{ old('bin_number') }}"
                                       placeholder="Enter BIN Number">
                                @error('bin_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Latitude -->
                        <div class="row mb-3">
                            <label for="latitude" class="col-sm-3 col-form-label">Latitude</label>
                            <div class="col-sm-9">
                                <input name="latitude" id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror"
                                       value="{{ old('latitude') }}" placeholder="Enter Latitude">
                                @error('latitude') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Longitude -->
                        <div class="row mb-3">
                            <label for="longitude" class="col-sm-3 col-form-label">Longitude</label>
                            <div class="col-sm-9">
                                <input name="longitude" id="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror"
                                       value="{{ old('longitude') }}" placeholder="Enter Longitude">
                                @error('longitude') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- BTS Code -->
                        <div class="row mb-3">
                            <label for="bts_code" class="col-sm-3 col-form-label">BTS Code</label>
                            <div class="col-sm-9">
                                <input name="bts_code" id="bts_code" type="text" class="form-control @error('bts_code') is-invalid @enderror"
                                       value="{{ old('bts_code') }}" placeholder="Enter BTS Code">
                                @error('bts_code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Lifting Date -->
                        <div class="row mb-3">
                            <label for="lifting_date" class="col-sm-3 col-form-label">Lifting Date</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="lifting_date" id="lifting_date" type="text" class="flatpickr form-control @error('lifting_date') is-invalid @enderror" placeholder="Select date">
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('lifting_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2">Create New House</button>
                        <a href="{{ route('dd-house.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
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
                                <p>House name: <strong>{{ $failure->values()['dd_name'] .'-'. $failure->values()['dd_code'] }}</strong></p>
                                <p>Error type: <strong>{{ \Illuminate\Support\Str::title($failure->attribute()) }}</strong></p>
                                <p>Error msg: {{ $failure->errors()[0] }} </p>
                                <p>Row number : {{ $failure->row() }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="card-body">
                    <h6 class="card-title">Import dd house</h6>
                    <form class="row gy-2 gx-3 align-items-center" action="{{ route('dd-house.import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label class="visually-hidden" for="autoSizingInput">Name</label>
                            <input name="import_house" type="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary w-100 mt-2">Import House</button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('dd-house.sample.file.download') }}" class="nav-link text-muted">Download sample file.</a>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {

                $("#ddHouseForm").validate({

                    rules: {
                        cluster_name: {
                            required: true,
                            maxlength: 30,
                        },
                        region: {
                            required: true,
                            maxlength: 20,
                        },
                        code: {
                            required: true,
                            maxlength: 10,
                        },
                        name: {
                            required: true,
                            maxlength: 100,
                            minlength: 3,
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        district: {
                            required: true,
                            maxlength: 20,
                        },
                        address: {
                            required: true,
                            maxlength: 150,
                        },
                        proprietor_name: {
                            required: true,
                            maxlength: 100,
                            minlength: 3,
                        },
                        proprietor_number: {
                            required: true,
                            number: true,
                            maxlength: 11,
                            minlength: 11,
                        },
                        poc_name: {
                            required: true,
                            maxlength: 100,
                            minlength: 3,
                        },
                        poc_number: {
                            required: true,
                            number: true,
                            maxlength: 11,
                            minlength: 11,
                        },
                        tin_number: {
                            required: true,
                        },
                        bin_number: {
                            required: true,
                        },
                        latitude: {
                            pattern: /^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/
                        },
                        longitude: {
                            pattern: /^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/
                        },
                        bts_code: {
                            required: true,
                            minlength: 7,
                        },
                        lifting_date: {
                            required: true,
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
                    submitHandler: function(form) {
                        form.submit();
                    },
                });

            });
        </script>
    @endpush

</x-app-layout>
