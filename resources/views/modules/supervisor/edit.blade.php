<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update Supervisor</x-slot:title>

    <div id="supervisorUpdateErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Update Supervisor</h6>
            <form id="supervisorUpdateForm" action="{{ route('supervisor.update', $supervisor->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Distribution House -->
                <div class="row mb-3">
                    <label for="dd_house_id" class="col-sm-3 col-form-label">Distribution House</label>
                    <div class="col-sm-9">
                        <select name="dd_house_id" class="form-select @error('dd_house_id') is-invalid @enderror" id="dd_house_id">
                            <option value="">-- Select Distribution House --</option>
                            @if(count($houses) > 0)
                                @foreach($houses as $house)
                                    <option @selected($supervisor->dd_house_id === $house->id) value="{{ $house->id }}">{{ $house->code .' - '. $house->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('dd_house_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Assign User -->
                <div class="row mb-3">
                    <label for="get_user" class="col-sm-3 col-form-label">Assign User</label>
                    <div class="col-sm-9">
                        <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" id="get_user">
                            <option value="">-- Select User --</option>
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    <option @selected($supervisor->user_id === $user->id) value="{{ $user->id }}">{{ $user->phone .' - '. $user->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Pool Number -->
                <div class="row mb-3">
                    <label for="pool_number" class="col-sm-3 col-form-label">Pool Number</label>
                    <div class="col-sm-9">
                        <input name="pool_number" id="pool_number" type="number"
                               class="form-control @error('pool_number') is-invalid @enderror" value="{{ old('pool_number', $supervisor->pool_number) }}"
                               placeholder="Enter Pool Number">
                        @error('pool_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Father Name -->
                <div class="row mb-3">
                    <label for="father_name" class="col-sm-3 col-form-label">Father Name</label>
                    <div class="col-sm-9">
                        <input name="father_name" id="father_name" type="text" class="form-control @error('father_name') is-invalid @enderror"
                               value="{{ old('father_name', $supervisor->father_name) }}" placeholder="Enter Father Name">
                        @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Mother Name -->
                <div class="row mb-3">
                    <label for="mother_name" class="col-sm-3 col-form-label">Mother Name</label>
                    <div class="col-sm-9">
                        <input name="mother_name" id="mother_name" type="text" class="form-control @error('mother_name') is-invalid @enderror"
                               value="{{ old('mother_name', $supervisor->mother_name) }}" placeholder="Enter Mother Name">
                        @error('mother_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Division -->
                <div class="row mb-3">
                    <label for="division" class="col-sm-3 col-form-label">Division</label>
                    <div class="col-sm-9">
                        <input name="division" id="division" type="text" class="form-control @error('division') is-invalid @enderror"
                               value="{{ old('division', $supervisor->division) }}" placeholder="Enter Division">
                        @error('division') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- District -->
                <div class="row mb-3">
                    <label for="district" class="col-sm-3 col-form-label">District</label>
                    <div class="col-sm-9">
                        <input name="district" id="district" type="text" class="form-control @error('district') is-invalid @enderror"
                               value="{{ old('district', $supervisor->district) }}" placeholder="Enter District">
                        @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Thana -->
                <div class="row mb-3">
                    <label for="thana" class="col-sm-3 col-form-label">Thana</label>
                    <div class="col-sm-9">
                        <input name="thana" id="thana" type="text" class="form-control @error('thana') is-invalid @enderror"
                               value="{{ old('thana', $supervisor->thana) }}" placeholder="Enter Thana">
                        @error('thana') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="row mb-3">
                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                        <input name="address" id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                               value="{{ old('address', $supervisor->address) }}" placeholder="Enter Address">
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- NID -->
                <div class="row mb-3">
                    <label for="nid" class="col-sm-3 col-form-label">NID</label>
                    <div class="col-sm-9">
                        <input name="nid" id="nid" type="number"
                               class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid', $supervisor->nid) }}"
                               placeholder="Enter NID Number">
                        @error('nid') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- D.O.B -->
                <div class="row mb-3">
                    <label for="dob" class="col-sm-3 col-form-label">D.O.B</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input name="dob" id="dob" value="{{ $supervisor->dob }}" type="text" class="flatpickr form-control @error('dob') is-invalid @enderror" placeholder="Select date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                        </div>
                        @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Joining Date -->
                <div class="row mb-3">
                    <label for="joining_date" class="col-sm-3 col-form-label">Joining Date</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input name="joining_date" value="{{ $supervisor->joining_date }}" id="joining_date" type="text" class="flatpickr form-control @error('joining_date') is-invalid @enderror" placeholder="Select date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                        </div>
                        @error('joining_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="row mb-3">
                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select name="status" class="form-select @error('status') is-invalid @enderror" id="status">
                            <option value="">-- Select Status --</option>
                            <option {{ $supervisor->status == 1 ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $supervisor->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Save Changes</button>
                <a href="{{ route('supervisor.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                // Dependent dropdown [DD House => user]
                $(document).on('change','#dd_house_id',function (){
                    const houseId = $(this).val();

                    if (houseId === '')
                    {
                        $('#get_user').html('<option value="">-- Select User --</option>');
                    }

                    // Get user by dd house
                    $.ajax({
                        url: "{{ route('supervisor.get.users.by.dd.house') }}/" + houseId,
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: () => {
                            $('#loading').show();
                        },
                        complete: () => {
                            $('#loading').hide();
                        },
                        success: function (response){
                            $('#get_user').find('option:not(:first)').remove();

                            $.each(response.users, function (key, value){
                                $('#get_user').append('<option value="'+ value.id +'">' + value.phone + ' - ' + value.name + '</option>')
                            });
                        }
                    });
                });
            });
        </script>
    @endpush

</x-app-layout>
