<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update User</x-slot:title>

    <div id="userUpdateErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <!-- General Information -->
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">General Information</a>
                </li>
                <!-- Change Password -->
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
                </li>
            </ul>
            <div class="tab-content border border-top-0 p-3" id="myTabContent">
                <!-- General Information -->
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form class="userUpdateForm" action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                        <!-- Name -->
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                                <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}"
                                       placeholder="Enter full name" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Username -->
                        <div class="row mb-3">
                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input name="username" id="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}"
                                       placeholder="Enter username" required>
                                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="row mb-3">
                            <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input name="phone" id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}"
                                       placeholder="Enter phone number" required>
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}"
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
                                    <option {{ $user->role == 'superadmin' ? 'selected' : '' }} value="superadmin">Super Admin</option>
                                    <option {{ $user->role == 'md' ? 'selected' : '' }} value="md">Managing Director</option>
                                    <option {{ $user->role == 'zm' ? 'selected' : '' }} value="zm">ZM</option>
                                    <option {{ $user->role == 'manager' ? 'selected' : '' }} value="manager">Manager</option>
                                    <option {{ $user->role == 'supervisor' ? 'selected' : '' }} value="supervisor">Supervisor</option>
                                    <option {{ $user->role == 'rso' ? 'selected' : '' }} value="rso">Rso</option>
                                    <option {{ $user->role == 'bp' ? 'selected' : '' }} value="bp">Bp</option>
                                    <option {{ $user->role == 'merchandiser' ? 'selected' : '' }} value="merchandiser">Merchandiser</option>
                                    <option {{ $user->role == 'retailer' ? 'selected' : '' }} value="retailer">Retailer</option>
                                    <option {{ $user->role == 'accountant' ? 'selected' : '' }} value="accountant">Accountant</option>
                                </select>
                                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- House -->
                        <div class="row mb-3">
                            <label for="dd_house" class="col-sm-3 col-form-label">DD House</label>
                            <div class="col-sm-9">
                                <select name="dd_house" class="form-select @error('dd_house') is-invalid @enderror" id="dd_house" required>
                                    <option selected value="">--Select DD House--</option>
                                    <option @selected(auth()->user()->role == 'superadmin') value="0">All Houses</option>
                                    @foreach($houses as $house)
                                        <option @selected( $user->dd_house == $house->id) value="{{ $house->id }}">{{ $house->code.' - '.$house->name }}</option>
                                    @endforeach
                                </select>
                                @error('dd_house') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="row mb-3">
                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select name="status" class="form-select @error('status') is-invalid @enderror" id="status">
                                    <option selected value="">--Select Status--</option>
                                    <option {{ $user->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                    <option {{ $user->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="row mb-3">
                            <label for="image" class="col-sm-3 col-form-label">User Image</label>
                            <div class="col-sm-9">
                                <input name="image" id="image" type="file" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror

                                @if($user->image)
                                    <div class="mt-3">
                                        <img src="{{ asset($user->image) }}" alt="user image" width="100">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Update</button>
                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>

                <!-- Change Password -->
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <form id="userUpdateForm" action="{{ route('user.password.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                        <!-- Current Password -->
                        <div class="row mb-3">
                            <label for="current_password" class="col-sm-3 col-form-label">Current Password</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="current_password" id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter current password">
                                    <span id="currentPasswordShowHide" class="input-group-text">
                                                <i class="link-icon" data-feather="eye"></i>
                                            </span>
                                </div>
                                @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="row mb-3">
                            <label for="password" class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter new password">
                                    <span id="newPasswordShowHide" class="input-group-text">
                                                <i class="link-icon" data-feather="eye"></i>
                                            </span>
                                </div>
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="password_confirmation" id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter confirm password">
                                    <span id="confirmPasswordShowHide" class="input-group-text">
                                                <i class="link-icon" data-feather="eye"></i>
                                            </span>
                                </div>
                                @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2">Update password</button>
                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Create Users
                $(document).on('submit','.userUpdateForm',function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
                            $('#userUpdateErrMsg').addClass('d-none').find('li').remove();
                            $('.btn-submit').prop('disabled', true).text('Updating...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                        },
                        success: function (response){
                            $('.btn-submit').prop('disabled', false).text('Update');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                window.location.href = "{{ route('user.index') }}";
                            });
                        },
                        error: function (e){
                            const err = JSON.parse(e.responseText);

                            $.each(err.errors,function (key,value){
                                $('.err-msg').removeClass('d-none').append('<li>' + value + '</li>');
                            });

                            $('.btn-submit').prop('disabled', false).text('Update');
                        },
                    });
                });

                // Show/Hide current password
                $('#currentPasswordShowHide').on('click', function(){
                    const type = $('#current_password').attr("type");

                    if(type == "password"){
                        $('#current_password').attr("type","text");
                    }
                    else{
                        $('#current_password').attr("type","password");
                    }
                });

                // Show/Hide new password
                $('#newPasswordShowHide').on('click', function(){
                    const type = $('#password').attr("type");

                    if(type == "password"){
                        $('#password').attr("type","text");
                    }
                    else{
                        $('#password').attr("type","password");
                    }
                });

                // Show/Hide confirm password
                $('#confirmPasswordShowHide').on('click', function(){
                    const type = $('#password_confirmation').attr("type");

                    if(type == "password"){
                        $('#password_confirmation').attr("type","text");
                    }
                    else{
                        $('#password_confirmation').attr("type","password");
                    }
                });

                // Validation
                $('.userUpdateForm').validate({
                    rules: {
                        dd_house: {required: true},
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
