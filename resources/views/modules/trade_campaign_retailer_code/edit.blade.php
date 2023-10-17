<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update TCRC</x-slot:title>

    <div id="tcrcUpdateErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Update Trade Campaign Retailer Code</h6>
            <form class="tcrcUpdateForm" action="{{ route('tcrc.update', $tcrc->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Retailer Code -->
                <div class="row mb-3">
                    <label for="retailer_code" class="col-sm-3 col-form-label">Retailer Code</label>
                    <div class="col-sm-9">
                        <input id="retailer_code" name="retailer_code" value="{{ old('retailer_code', $tcrc->retailer_code) }}" class="form-control" type="text" placeholder="Type retailer code...">
                        <small class="text-muted">একটি রিটেইলার কোড প্রদান করুন।</small>
                        @error('retailer_code') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Flag -->
                <div class="row mb-3">
                    <label for="flag" class="col-sm-3 col-form-label">Flag</label>
                    <div class="col-sm-9">
                        <select name="flag" class="form-select" id="flag">
                            <option value="">-- Select Flag --</option>
                            <option @selected($tcrc->flag == 'rso') value="rso">RS0</option>
                            <option @selected($tcrc->flag == 'bp') value="bp">BP</option>
                            <option @selected($tcrc->flag == 'cm') value="cm">CM</option>
                            <option @selected($tcrc->flag == 'drc') value="drc">DRC</option>
                        </select>
                        <small class="text-muted">একটি ফ্ল্যাগ নির্বাচন করুন।</small>
                        @error('flag') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- User -->
                <div class="row mb-3">
                    <label for="user_id" class="col-sm-3 col-form-label">User</label>
                    <div class="col-sm-9">
                        <select name="user_id" class="select-2 form-select" id="user_id">
                            <option value="">-- Select User --</option>
                            @foreach ($users as $user)
                            <option @selected($tcrc->user_id == $user->id) value="{{ $user->id }}">{{ Str::upper($user->role) .' - '. $user->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">একজন ব্যাবহারকারী নির্বাচন করুন।</small>
                        @error('user_id') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Remarks -->
                <div class="row mb-3">
                    <label for="remarks" class="col-sm-3 col-form-label">Remarks</label>
                    <div class="col-sm-9">
                        <input id="remarks" name="remarks" value="{{ old('remarks', $tcrc->remarks) }}" class="form-control" type="text" placeholder="Type remarks...">
                        <small class="text-muted">কোন অতিরিক্ত তথ্য থাকলে সেটি প্রদান করুন।</small>
                        @error('remarks') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Update</button>
                <a href="{{ route('tcrc.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Update Trade Campaign Retailer Code
                // $(document).on('submit','.tcrcUpdateForm', function (e){
                //     e.preventDefault();

                //     $.ajax({
                //         url: $(this).attr('action'),
                //         type: $(this).attr('method'),
                //         data: new FormData(this),
                //         processData: false,
                //         contentType: false,
                //         beforeSend: function (){
                //             $('#tcrcUpdateErrMsg').addClass('d-none').find('li').remove();
                //             $('.btn-submit').prop('disabled', true).text('Updating...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                //         },
                //         success: function (response){
                //             $('.btn-submit').prop('disabled', false).text('Update');
                //             Swal.fire(
                //                 'Success!',
                //                 response.success,
                //                 'success',
                //             ).then((result) => {
                //                 window.location.href = "{{ route('tcrc.index') }}";
                //             });
                //         },
                //         error: function (e){
                //             const err = JSON.parse(e.responseText);

                //             $.each(err.errors,function (key,value){
                //                 $('.err-msg').removeClass('d-none').append('<li>' + value + '</li>');
                //             });

                //             $('.btn-submit').prop('disabled', false).text('Update');
                //         },
                //     });
                // });

                // $('.tcrcForm').validate({
                //     rules: {
                //         retailer_id: {
                //             required: true,
                //         },
                //         flag: {
                //             required: true,
                //         },
                //     },
                //     messages: {
                //         retailer_id: {
                //             required: 'একটি রিটেইলার কোড নির্বাচন করতে হবে।',
                //         },
                //         flag: {
                //             required: 'একটি ফ্ল্যাগ নির্বাচন করতে হবে।',
                //         },
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
                //         if ($(element).prop('type') !== 'checkbox' && $(element).prop('type') !== 'radio') {
                //             $( element ).addClass( "is-invalid" );
                //         }
                //     },
                //     unhighlight: function(element, errorClass){
                //         if ($(element).prop('type') !== 'checkbox' && $(element).prop('type') !== 'radio') {
                //             $( element ).removeClass( "is-invalid" );
                //         }
                //     },
                // });
            });
        </script>
    @endpush

</x-app-layout>
