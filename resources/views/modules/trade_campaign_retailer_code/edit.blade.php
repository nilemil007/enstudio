<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update Replace</x-slot:title>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Update data</h6>
            <form id="itopReplaceUpdateForm" action="{{ route('itop-replace.update', $itop_replace->id) }}" method="POST">
                @csrf
                @method('PATCH')

                @if(auth()->user()->role == 'superadmin')
                <!-- User -->
                <div class="row mb-3">
                    <label for="user_id" class="col-sm-3 col-form-label">User</label>
                    <div class="col-sm-9">
                        <select name="user_id" class="form-select" id="user_id">
                            <option value="">-- Select User --</option>
                            @foreach( $users as $user )
                                <option {{ $itop_replace->user_id == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                @endif

                <!-- Replace Number -->
                <div class="row mb-3">
                    <label for="itop_number" class="col-sm-3 col-form-label">Replace Number</label>
                    <div class="col-sm-9">
                        <input name="itop_number" id="itop_number" type="number" class="form-control" value="{{ old('itop_number', $itop_replace->itop_number) }}"
                               placeholder="Enter Replace Number" {{ $itop_replace->status != 'pending' && auth()->user()->role != 'superadmin' ? 'disabled' : '' }}>
                    </div>
                </div>

                @if(auth()->user()->role == 'superadmin')
                <!-- Serial Number -->
                <div class="row mb-3">
                    <label for="serial_number" class="col-sm-3 col-form-label">Serial Number</label>
                    <div class="col-sm-9">
                        <input name="serial_number" id="serial_number" type="number" class="form-control  @error('serial_number') is-invalid @enderror" value="{{ old('serial_number', $itop_replace->serial_number) }}"
                               placeholder="Enter Serial Number">
                        @error('serial_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                @endif

                <!-- Balance -->
                <div class="row mb-3">
                    <label for="balance" class="col-sm-3 col-form-label">Balance</label>
                    <div class="col-sm-9">
                        <input name="balance" id="balance" type="number" class="form-control" value="{{ old('balance', $itop_replace->balance) }}"
                               placeholder="Enter Balance" {{ $itop_replace->status != 'pending' && auth()->user()->role != 'superadmin' ? 'disabled' : '' }}>
                    </div>
                </div>

                <!-- Reason -->
                <div class="row mb-3">
                    <label for="reason" class="col-sm-3 col-form-label">Replace Reason</label>
                    <div class="col-sm-9">
                        <select name="reason" class="form-select" id="reason" {{ $itop_replace->status != 'pending' && auth()->user()->role != 'superadmin' ? 'disabled' : '' }}>
                            <option {{ $itop_replace->reason == 'sim-lost' ? 'selected' : '' }} value="sim-lost">Sim Lost</option>
                            <option {{ $itop_replace->reason == 'stolen' ? 'selected' : '' }} value="stolen">Stolen</option>
                            <option {{ $itop_replace->reason == 'damaged' ? 'selected' : '' }} value="damaged">Damaged</option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div class="row mb-3">
                    <label for="description" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <input name="description" id="description" type="text" class="form-control" value="{{ old('description', $itop_replace->description) }}"
                               placeholder="Enter Description" {{ $itop_replace->status != 'pending' && auth()->user()->role != 'superadmin' ? 'disabled' : '' }}>
                    </div>
                </div>

                @if(auth()->user()->role == 'superadmin')
                <!-- Pay Amount -->
                <div class="row mb-3">
                    <label for="pay_amount" class="col-sm-3 col-form-label">Pay Amount</label>
                    <div class="col-sm-9">
                        <input name="pay_amount" id="pay_amount" type="number" class="form-control" value="{{ old('pay_amount', $itop_replace->pay_amount) }}"
                               placeholder="Enter paid amount">
                    </div>
                </div>
                @endif

                @if(auth()->user()->role == 'superadmin')
                <!-- Status -->
                <div class="row mb-3">
                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select name="status" class="form-select" id="status">
                            <option {{ $itop_replace->status == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                            <option {{ $itop_replace->status == 'processing' ? 'selected' : '' }} value="processing">Processing</option>
                            <option {{ $itop_replace->status == 'complete' ? 'selected' : '' }} value="complete">Complete</option>
                            <option {{ $itop_replace->status == 'due' ? 'selected' : '' }} value="due">Due</option>
                            <option {{ $itop_replace->status == 'paid' ? 'selected' : '' }} value="paid">Paid</option>
                        </select>
                    </div>
                </div>
                @endif


                <div class="form-footer d-flex">
                    <button type="submit" class="btn btn-sm btn-primary me-2 w-100 d-md-none">Update</button>
                    <button type="submit" class="btn btn-sm btn-primary me-2 d-none d-md-block">Update</button>

                    <a href="{{ route('itop-replace.index') }}" class="btn btn-sm btn-info w-100 d-md-none text-white">Back</a>
                    <a href="{{ route('itop-replace.index') }}" class="btn btn-sm btn-info me-2 d-none d-md-block text-white">Back</a>
                </div>

            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#itopReplaceUpdateForm').validate({
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
