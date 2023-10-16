<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New TCRC</x-slot:title>

    <div id="tcrcErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Create New Trade Campaign Retailer Code</h6>
            <form class="tcrcForm" action="{{ route('tcrc.store') }}" method="POST">
                @csrf

                <!-- Retailer Code -->
                <div class="row mb-3">
                    <label for="retailer_id" class="col-sm-3 col-form-label">Retailer Code</label>
                    <div class="col-sm-9">
                        <select name="retailer_id" class="select-2 form-select @error('retailer_id') is-invalid @enderror" id="retailer_id">
                            <option value="">-- Select Retailer Code --</option>
                            @if(count($retailers) > 0)
                                @foreach($retailers as $retailer)
                                    <option value="{{ $retailer->id }}">{{ $retailer->ddHouse->code .' - '. $retailer->code .' - '. $retailer->itop_number }}</option>
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
                        <select name="flag" class="form-select @error('flag') is-invalid @enderror" id="flag">
                            <option value="">-- Select Flag --</option>
                            <option value="rso">RS0</option>
                            <option value="bp">BP</option>
                            <option value="cm">CM</option>
                        </select>
                    </div>
                </div>

                <!-- User -->
                <div class="row mb-3">
                    <label for="setUsers" class="col-sm-3 col-form-label">User</label>
                    <div class="col-sm-9">
                        <select name="user_id" class="form-select @error('users') is-invalid @enderror" id="setUsers">
                            <option value="">-- Select User --</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create</button>
                    <a href="{{ route('tcrc.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {

                // Create Trade Campaign Retailer Code
                $(document).on('submit','.tcrcForm', function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
                            $('#tcrcErrMsg').addClass('d-none').find('li').remove();
                            $('.btn-submit').prop('disabled', true).text('Creating...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                        },
                        success: function (response){
                            $('.btn-submit').prop('disabled', false).text('Create');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                location.reload();
                            });
                        },
                        error: function (e){
                            const err = JSON.parse(e.responseText);

                            $.each(err.errors,function (key,value){
                                $('.err-msg').removeClass('d-none').append('<li>' + value + '</li>');
                            });

                            $('.btn-submit').prop('disabled', false).text('Create');
                        },
                    });
                });

                // Get users by flag
                $(document).on('change','#flag',function (){
                    const flag = $(this).val();

                    if (flag === '')
                    {
                        $('#setUsers').html('<option value="">-- Select User --</option>');
                    }

                    // Get supervisor by dd house
                    $.ajax({
                        url: "{{ route('tcrc.get.users') }}/" + flag,
                        type: 'POST',
                        dataType: 'JSON',
                        success: function (response){
                            $('#setUsers').find('option:not(:first)').remove();

                            $.each(response.users, function (key, value){
                                $('#setUsers').append('<option value="'+ value.id +'">' + value.name +' - '+ value.username + '</option>')
                            });
                        }
                    });

                    // Get user by dd house
                    $.ajax({
                        url: "{{ route('bp.get.user.by.dd.house') }}/" + houseId,
                        type: 'POST',
                        dataType: 'JSON',
                        success: function (response){
                            $('#get_user').find('option:not(:first)').remove();

                            $.each(response.user, function (key, value){
                                $('#get_user').append('<option value="'+ value.id +'">' + value.phone + ' - ' + value.name + '</option>')
                            });
                        }
                    });
                });

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
