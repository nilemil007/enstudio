<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New User</x-slot:title>

    <div class="row">
        <div class="col-md-8">

            <div id="userErrMsg" class="alert alert-danger err-msg d-none"></div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create new user</h4>
                </div>
                <div class="card-body">
                    <form class="userForm" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                                <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                       placeholder="Enter full name" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Username -->
                        <div class="row mb-3">
                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input name="username" id="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"
                                       placeholder="Enter username" required>
                                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="row mb-3">
                            <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input name="phone" id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                       placeholder="Enter phone number" required>
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                       placeholder="Enter email address" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="row mb-3">
                            <label for="role" class="col-sm-3 col-form-label">User Role</label>
                            <div class="col-sm-9">
                                <select name="role" class="form-select @error('role') is-invalid @enderror" id="role" required>
                                    <option selected value="">--Select User Roles--</option>
                                    <option value="md">Managing Director</option>
                                    <option value="zm">ZM</option>
                                    <option value="manager">Manager</option>
                                    <option value="supervisor">Supervisor</option>
                                    <option value="rso">Rso</option>
                                    <option value="bp">Bp</option>
                                    <option value="cm">CM</option>
                                    <option value="retailer">Retailer</option>
                                    <option value="accountant">Accountant</option>
                                </select>
                                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- House -->
                        <div class="row mb-3">
                            <label for="dd_house" class="col-sm-3 col-form-label">DD House</label>
                            <div class="col-sm-9">
                                <select name="dd_house[]" class="form-select select-2 @error('dd_house') is-invalid @enderror" id="dd_house" required multiple>
                                    <option value="">--Select DD House--</option>
                                    @foreach($houses as $house)
                                        <option value="{{ $house->id }}">{{ $house->code.' - '.$house->name }}</option>
                                    @endforeach
                                </select>
                                @error('dd_house') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="row mb-3">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"
                                           placeholder="Enter password" required>
                                    <span id="passwordShowHide" class="input-group-text">
                                <i class="link-icon" data-feather="eye"></i>
                            </span>
                                </div>
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="row mb-3">
                            <label for="image" class="col-sm-3 col-form-label">User Image</label>
                            <div class="col-sm-9">
                                <input name="image" id="image" type="file" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>


                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create New User</button>
                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
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
                                <p>User name: <strong>{{ $failure->values()['name'] .'-'. $failure->values()['phone'] }}</strong></p>
                                <p>Error type: <strong>{{ \Illuminate\Support\Str::title($failure->attribute()) }}</strong></p>
                                <p>Error msg: {{ $failure->errors()[0] }} </p>
                                <p>Row number : {{ $failure->row() }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="card-body">
                    <h6 class="card-title">Import users</h6>
                    <form class="row gy-2 gx-3 align-items-center user-import" action="{{ route('user.import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label class="visually-hidden" for="autoSizingInput">Name</label>
                            <input name="import_users" type="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary w-100 mt-2 btn-import-user">Import Users</button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('user.sample.file.download') }}" class="nav-link text-muted">Download sample file.</a>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {

                // Show/Hide password
                $('#passwordShowHide').on('click', function(){
                    const type = $('#password').attr("type");

                    if(type == "password"){
                        $('#password').attr("type","text");
                    }
                    else{
                        $('#password').attr("type","password");
                    }
                });

                // Validation
                $('.userForm').validate({
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

                $.validator.addMethod("password", function(value, element) {
                    return this.optional(element) || /^(?=.*\d)(?=.*[A-Z])(?=.*\W).*$/i.test(value);
                }, 'Password must contain one capital letter,one numerical and one special character');
            });
        </script>
    @endpush

</x-app-layout>
