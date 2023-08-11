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
                    <label for="retailer_id" class="col-sm-3 col-form-label">Retailer Code</label>
                    <div class="col-sm-9">
                        <select name="retailer_id" class="select-2 form-select" id="retailer_id">
                            <option value="">-- Select Retailer Code --</option>
                            @if(count($retailers) > 0)
                                @foreach($retailers as $retailer)
                                    <option @selected($tcrc->retailer_id == $retailer->id) value="{{ $retailer->id }}">{{ $retailer->dd_house .' - '. $retailer->code .' - '. $retailer->itop_number }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('retailer_id') <span class="text-danger">{{ $message }}</span> @enderror
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
                            <option @selected($tcrc->flag == 'tmo') value="tmo">TMO</option>
                        </select>
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
                // Create Trade Campaign Retailer Code
                $(document).on('submit','.tcrcUpdateForm', function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
                            $('#tcrcUpdateErrMsg').addClass('d-none').find('li').remove();
                            $('.btn-submit').prop('disabled', true).text('Updating...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                        },
                        success: function (response){
                            $('.btn-submit').prop('disabled', false).text('Update');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                window.location.href = "{{ route('tcrc.index') }}";
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
                })

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
