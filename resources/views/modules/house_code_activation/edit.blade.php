<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update HCA</x-slot:title>

    <div id="hcaUpdateErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="House Code Activation">Update HCA</h6>
            <form id="hcaUpdateForm" action="{{ route('hca.update', $hca->id) }}" method="POST">
                @csrf
                @method('PATCH')

                    <!-- User Name -->
                    <div class="row mb-3">
                        <label for="user_id" class="col-sm-3 col-form-label">User Name</label>
                        <div class="col-sm-9">
                            <select name="user_id" class="select-2 form-select @error('user_id') is-invalid @enderror" id="user_id">
                                <option value="">-- Select User --</option>
                                @if(count($tradeCampaignRetailerCode) > 0)
                                    @foreach($tradeCampaignRetailerCode as $tcrc)
                                        <option @selected($tcrc->user_id == $hca->user_id) value="{{ $tcrc->user_id }}">
                                            {{ \Illuminate\Support\Str::upper($tcrc->user->role) .' - '. optional($tcrc->user->bp)->pool_number . optional($tcrc->user->cm)->pool_number . optional($tcrc->user->rso)->itop_number .' - '. $tcrc->user->name . ' (' . $tcrc->remarks . ')'  }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Retailer Code -->
                    <div class="row mb-3">
                        <label for="retailer_code" class="col-sm-3 col-form-label">Retailer Code</label>
                        <div class="col-sm-9">
                            <select name="retailer_code" class="retailer_code form-select @error('retailer_code') is-invalid @enderror" id="retailer_code">
                                <option value="">-- Select Retailer Code --</option>

                                @foreach($tcrcRetailerCode as $retCode)
                                    <option @selected($hca->retailer_code == $retCode->retailer_code) value="{{ $retCode->retailer_code }}">{{ $retCode->retailer_code }}</option>
                                @endforeach

                            </select>
                            @error('retailer_code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Activation -->
                    <div class="row mb-3">
                        <label for="activation" class="col-sm-3 col-form-label">Activation</label>
                        <div class="col-sm-9">
                            <input name="activation" id="activation" type="number"
                                   class="form-control @error('activation') is-invalid @enderror" value="{{ old('activation', $hca->activation) }}"
                                   placeholder="Enter Activation">
                            @error('activation') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="row mb-3">
                        <label for="price" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input name="price" id="price" type="number"
                                   class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $hca->price) }}"
                                   placeholder="Enter Price">
                            @error('rice') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Activation Date -->
                    <div class="row mb-3">
                        <label for="activation_date" class="col-sm-3 col-form-label">Activation Date</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input name="activation_date" id="activation_date" value="{{ $hca->activation_date }}" type="text" class="flatpickr form-control @error('activation_date') is-invalid @enderror" placeholder="Select date">
                                <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                            </div>
                            @error('activation_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Save Changes</button>
                <a href="{{ route('hca.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                // Get retailer code by user
                $(document).on('change','#user_id',function (){
                    const userId = $(this).val();

                    if (userId === '')
                    {
                        $('.retailer_code').html('<option value="">-- Select Retailer Code --</option>');
                    }

                    // Get user by dd house
                    $.ajax({
                        url: "{{ route('hca.get.retailer.code') }}/" + userId,
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: () => {
                            $('#loading').show();
                            $('.retailer_code').find('option:not(:first)').remove();
                        },
                        complete: () => {
                            $('#loading').hide();
                        },
                        success: (response) => {
                            $.each(response.tcrc, function (key, value){
                                $('.retailer_code').append('<option value="'+ value.retailer_code +'">' + value.retailer_code + '</option>');
                            });
                        }
                    });
                });

                // Create HCA Entry
                $(document).on('submit','#hcaUpdateForm',function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: () => {
                            $('#loading').show();
                            $('#hcaUpdateErrMsg').addClass('d-none').find('li').remove();
                            $('.btn-submit').prop('disabled', true).text('Saving...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                        },
                        complete: () => {
                            $('#loading').hide();
                        },
                        success: (response) => {
                            $('.btn-submit').prop('disabled', false).text('Save Changes');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                window.location.href = "{{ route('hca.index') }}";
                            });
                        },
                        error: (e) => {
                            const err = JSON.parse(e.responseText);

                            $.each(err.errors,function (key,value){
                                $('.err-msg').removeClass('d-none').append('<li>' + value + '</li>');
                            });

                            $('.btn-submit').prop('disabled', false).text('Save Changes');
                        },
                    });
                });
            });
        </script>
    @endpush

</x-app-layout>
