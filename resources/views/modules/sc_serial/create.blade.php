<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Serial</x-slot:title>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create New Serial</h6>
                    <form id="routeForm" action="{{ route('sc-serial.store') }}" method="POST">
                        @csrf

                        <!-- First Serial -->
                        <div class="row mb-3">
                            <label for="f_serial" class="col-sm-3 col-form-label">First Serial</label>
                            <div class="col-sm-9">
                                <input name="f_serial" id="f_serial" type="number" class="form-control @error('f_serial') is-invalid @enderror"
                                       value="{{ old('f_serial') }}"
                                       placeholder="Enter First Serial">
                                @error('f_serial') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Last Serial -->
                        <div class="row mb-3">
                            <label for="l_serial" class="col-sm-3 col-form-label">Last Serial</label>
                            <div class="col-sm-9">
                                <input name="l_serial" id="l_serial" type="number" class="form-control @error('l_serial') is-invalid @enderror"
                                       value="{{ old('l_serial') }}"
                                       placeholder="Enter Last Serial">
                                @error('l_serial') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create</button>
                        <a href="{{ route('sc-serial.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
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
                                <p>Route name: <strong>{{ $failure->values()['route_name'] .'-'. $failure->values()['route_code'] }}</strong></p>
                                <p>Error type: <strong>{{ \Illuminate\Support\Str::title($failure->attribute()) }}</strong></p>
                                <p>Error msg: {{ $failure->errors()[0] }} </p>
                                <p>Row number : {{ $failure->row() }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="card-body">
                    <h6 class="card-title">Import route</h6>
                    <form class="row gy-2 gx-3 align-items-center import-route" action="{{ route('route.import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label class="visually-hidden" for="autoSizingInput">Name</label>
                            <input name="import_route" type="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary w-100 mt-2 btn-import-route">Import Route</button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('route.sample.file.download') }}" class="nav-link text-muted">Download sample file.</a>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {

                {{--// Create Route--}}
                {{--$(document).on('submit','#routeForm',function (e){--}}
                {{--    e.preventDefault();--}}

                {{--    $.ajax({--}}
                {{--        url: $(this).attr('action'),--}}
                {{--        type: $(this).attr('method'),--}}
                {{--        data: new FormData(this),--}}
                {{--        processData: false,--}}
                {{--        contentType: false,--}}
                {{--        beforeSend: function (){--}}
                {{--            $('.btn-submit').prop('disabled', true).text('Creating...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');--}}
                {{--        },--}}
                {{--        success: function (response){--}}
                {{--            $('.btn-submit').prop('disabled', false).text('Create New Route');--}}
                {{--            Swal.fire(--}}
                {{--                'Success!',--}}
                {{--                response.success,--}}
                {{--                'success',--}}
                {{--            ).then((result) => {--}}
                {{--                window.location.href = "{{ route('route.index') }}";--}}
                {{--            });--}}
                {{--        },--}}
                {{--        error: function (e){--}}
                {{--            console.log(e.responseText);--}}
                {{--            $('.btn-submit').prop('disabled', false).text('Create New Route');--}}
                {{--        },--}}
                {{--    });--}}
                {{--});--}}

                {{--// Import Route--}}
                {{--$(document).on('submit','.import-route',function (e){--}}
                {{--    e.preventDefault();--}}

                {{--    $.ajax({--}}
                {{--        url: $(this).attr('action'),--}}
                {{--        type: $(this).attr('method'),--}}
                {{--        data: new FormData(this),--}}
                {{--        processData: false,--}}
                {{--        contentType: false,--}}
                {{--        beforeSend: function (){--}}
                {{--            $('.btn-import-route').prop('disabled', true).text('Importing...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');--}}
                {{--        },--}}
                {{--        success: function (response){--}}
                {{--            $('.btn-import-route').prop('disabled', false).text('Import Route');--}}
                {{--            Swal.fire(--}}
                {{--                'Success!',--}}
                {{--                response.success,--}}
                {{--                'success',--}}
                {{--            ).then((result) => {--}}
                {{--                window.location.href = "{{ route('route.index') }}";--}}
                {{--            });--}}
                {{--        },--}}
                {{--        error: function (e){--}}
                {{--            console.log(e.responseText);--}}
                {{--            $('.btn-import-route').prop('disabled', false).text('Import Route');--}}
                {{--        },--}}
                {{--    });--}}
                {{--});--}}

                // $("#routeForm").validate({
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
