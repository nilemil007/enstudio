<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Serial</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create New Serial</h6>
                    <form id="scSerialForm" action="{{ route('sc-serial.store') }}" method="POST">
                    @csrf

                        <!-- Distribution House -->
                        <div class="row mb-3">
                            <label for="dd_house_id" class="col-sm-3 col-form-label">Distribution House</label>
                            <div class="col-sm-9">
                                <select name="dd_house_id" class="form-select @error('dd_house_id') is-invalid @enderror" id="dd_house_id">
                                    <option value="">-- Select Distribution House --</option>
                                    @if(count($houses) > 0)
                                        @foreach($houses as $house)
                                            <option value="{{ $house->id }}">{{ $house->code .' - '. $house->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('dd_house_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Product Name -->
                        <div class="row mb-3">
                            <label for="product_code" class="col-sm-3 col-form-label">Product Name</label>
                            <div class="col-sm-9">
                                <select name="product_code" class="form-select @error('product_code') is-invalid @enderror" id="product_code">
                                    <option value="">-- Select Product Name --</option>
                                    <option value="scmb09">SCMB-09</option>
                                    <option value="scd09">SCD-09</option>
                                    <option value="mv10">MV-10</option>
                                    <option value="scmb14">SCMB-14</option>
                                    <option value="scd14">SCD-14</option>
                                    <option value="scd14">SCD-14</option>
                                    <option value="scmin19">SCMIN-19</option>
                                    <option value="scd19">SCD-19</option>
                                    <option value="mv20">MV-20</option>
                                    <option value="scmb29">SCMB-29</option>
                                </select>
                                @error('product_code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

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

                        <!-- Product Group -->
                        <div class="row mb-3">
                            <label for="group" class="col-sm-3 col-form-label">Product Group</label>
                            <div class="col-sm-9">
                                <select name="group" class="form-select @error('group') is-invalid @enderror" id="group">
                                    <option value="">-- Select Product Group --</option>
                                    <option value="data">Data</option>
                                    <option value="mixed">Mixed</option>
                                    <option value="voice">Voice</option>
                                </select>
                                @error('group') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create</button>
                        <a href="{{ route('sc-serial.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {

                // Create Scratch Card Serial Number
                $(document).on('submit','#scSerialForm',function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function (){
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
                            console.log(e.responseText);
                            $('.btn-submit').prop('disabled', false).text('Create');
                        },
                    });
                });

                $("#scSerialForm").validate({
                    rules: {
                        f_serial: 'required',
                        l_serial: 'required',
                    },
                    messages: {
                        f_serial: 'Please enter first serial number.',
                        l_serial: 'Please enter last serial number.',
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
