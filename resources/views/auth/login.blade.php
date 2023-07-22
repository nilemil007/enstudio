<x-guest-layout>

    <x-slot:title>Login</x-slot:title>

    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-4 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-md-12 ps-md-0">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="#" class="noble-ui-logo logo-light d-block mb-2">EN<span>Studio</span></a>
                            <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                            <form id="login" class="forms-sample" method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="login" class="form-label">Login ID</label>
                                    <input type="text" name="login" value="{{ old('login') }}" class="form-control @error('login') is-invalid @enderror" id="login" placeholder="Enter Username, Email or Phone">
                                    @error('login') <small class="text-danger" style="font-weight: bold">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter password">
                                    @error('password') <small class="text-danger" style="font-weight: bold">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" name="remember" type="checkbox" id="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0 text-white w-100">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function(){
                $('#login').validate({
                    rules: {
                        login: {
                            required: true,
                        },
                        password: {
                            required: true,
                        },
                    },
                    messages: {
                        login: {
                            required: 'Login ID is required.',
                        },
                        password: {
                            required: 'Password field is required.'
                        }
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
</x-guest-layout>
