<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Replace</x-slot:title>

    <div id="replaceErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Create new entry</h6>
            <form class="itopReplaceForm" action="{{ route('itop-replace.store') }}" method="POST">
                @csrf

                @if(auth()->user()->role == 'superadmin')
                <!-- User -->
                <div class="row mb-3">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">User</label>
                    <div class="col-sm-9">
                        <select name="user_id" class="form-select" id="user_id">
                            <option value="">-- Select User --</option>
                            @foreach( $users as $user )
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                @else
                        <input name="user_id" type="hidden" value="{{ auth()->id() }}">
                @endif

                <!-- Replace Number -->
                <div class="row mb-3">
                    <label for="itop_number" class="col-sm-3 col-form-label">Replace Number</label>
                    <div class="col-sm-9">
                        <input name="itop_number" id="itop_number" type="number" class="form-control" value="{{ old('itop_number') }}"
                               placeholder="Enter Replace Number">
                    </div>
                </div>

                @if(auth()->user()->role == 'superadmin')
                <!-- Serial Number -->
                <div class="row mb-3">
                    <label for="serial_number" class="col-sm-3 col-form-label">Serial Number</label>
                    <div class="col-sm-9">
                        <input name="serial_number" id="serial_number" type="number" class="form-control  @error('serial_number') is-invalid @enderror" value="{{ old('serial_number') }}"
                               placeholder="Enter Serial Number">
                        @error('serial_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                @endif

                <!-- Balance -->
                <div class="row mb-3">
                    <label for="balance" class="col-sm-3 col-form-label">Balance</label>
                    <div class="col-sm-9">
                        <input name="balance" id="balance" type="number" class="form-control" value="{{ old('balance') }}"
                               placeholder="Enter Balance">
                    </div>
                </div>

                <!-- Reason -->
                <div class="row mb-3">
                    <label for="reason" class="col-sm-3 col-form-label">Replace Reason</label>
                    <div class="col-sm-9">
                        <select name="reason" class="form-select" id="reason">
                            <option value="sim-lost">Sim Lost</option>
                            <option value="stolen">Stolen</option>
                            <option value="damaged">Damaged</option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div class="row mb-3">
                    <label for="description" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <input name="description" id="description" type="text" class="form-control" value="{{ old('description') }}"
                               placeholder="Enter Description" aria-label="Description">
                    </div>
                </div>


                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create New Replace</button>
                    <a href="{{ route('itop-replace.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('submit','.itopReplaceForm', function (e){
                    e.preventDefault();

                    const data = new FormData(this);
                    const url = $(this).attr('action');
                    const redirect = "{{ route('itop-replace.index') }}";

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: data,
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
                            $('.btn-submit').prop('disabled', true).text('Creating...');
                        },
                        success: function (response){
                            $('.btn-submit').prop('disabled', false).text('Create New Replace');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                window.location.href = redirect;
                            });
                        },
                        error: function (e){
                            const err = JSON.parse(e.responseText);

                            $.each(err.errors,function (key,value){
                                $('#replaceErrMsg').find('li').remove();
                                $('.err-msg').removeClass('d-none').append('<li>' + value + '</li>');
                            });

                            $('.btn-submit').prop('disabled', false).text('Create New Replace');
                        },
                    });
                })

                $('.itopReplaceForm').validate({
                    rules: {
                        user_id: {
                            required: true,
                        },
                        itop_number: {
                            required: true,
                            number: true,
                            maxlength: 11,
                            minlength: 11,
                        },
                        serial_number: {
                            required: true,
                            number: true,
                            maxlength: 18,
                            minlength: 18,
                        },
                        balance: {
                            required: true,
                            number: true,
                            maxlength: 6,
                        },
                    },
                    messages: {
                        user_id: {
                            required: 'একজন ইউজার সিলেক্ট করতে হবে।',
                        },
                        itop_number: {
                            required: 'রিপ্লেস এর আইটপ নাম্বার দিন।',
                            number: 'শুধুমাত্র নাম্বার প্রযোজ্য।',
                            maxlength: 'নাম্বার ১১ সংখ্যার বেশী হয়েছে।',
                            minlength: 'নাম্বার ১১ সংখ্যার কম হয়েছে।',
                        },
                        serial_number: {
                            required: 'SWAP এর সিরিয়াল নাম্বার দিন।',
                            number: 'শুধুমাত্র নাম্বার প্রযোজ্য।',
                            maxlength: 'সিরিয়াল নাম্বার ১৮ সংখ্যার বেশী হয়েছে।',
                            minlength: 'সিরিয়াল নাম্বার ১৮ সংখ্যার কম হয়েছে।',
                        },
                        balance: {
                            required: 'ব্যালেন্স উল্লেখ করুন।',
                            number: 'শুধুমাত্র নাম্বার প্রযোজ্য।',
                            maxlength: 'ব্যালেন্স ৬ সংখ্যার বেশী হয়েছে।',
                        },
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
                        if ($(element).prop('type') !== 'checkbox' && $(element).prop('type') !== 'radio') {
                            $( element ).addClass( "is-invalid" );
                        }
                    },
                    unhighlight: function(element, errorClass){
                        if ($(element).prop('type') !== 'checkbox' && $(element).prop('type') !== 'radio') {
                            $( element ).removeClass( "is-invalid" );
                        }
                    },
                });
            });
        </script>
    @endpush
</x-app-layout>
