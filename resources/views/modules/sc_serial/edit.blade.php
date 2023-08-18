<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update SC Serial</x-slot:title>

    <div id="scSerialUpdateErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Update Scratch Card Serial Number</h6>
            <form id="scSerialUpdateForm" action="{{ route('sc-serial.update', $sc_serial->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Serial -->
                <div class="row mb-3">
                    <label for="serial" class="col-sm-3 col-form-label">Serial</label>
                    <div class="col-sm-9">
                        <input name="serial" id="serial" type="number" class="form-control @error('serial') is-invalid @enderror"
                               value="{{ old('serial', $sc_serial->serial) }}"
                               placeholder="Enter Serial Number">
                        @error('serial') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Save Changes</button>
                <a href="{{ route('sc-serial.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {

                // Update Route
                $(document).on('submit','#scSerialUpdateForm',function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
                            $('#scSerialUpdateErrMsg').addClass('d-none').find('li').remove();
                            $('.btn-submit').prop('disabled', true).text('Saving...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                        },
                        success: function (response){
                            $('.btn-submit').prop('disabled', false).text('Save Changes');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                window.location.href = "{{ route('sc-serial.index') }}";
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
                $("#scSerialUpdateForm").validate({
                    rules: {
                        serial: 'required',
                    },
                    messages: {
                        serial: 'Serial number is required.'
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
