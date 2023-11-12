<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update CM</x-slot:title>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Update CM</h6>
            <form id="cmUpdateForm" action="{{ route('cm.update', $cm->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                    <!-- Distribution House -->
                    <div class="row mb-3">
                        <label for="dd_house_id" class="col-sm-3 col-form-label">Distribution House ({{ count($houses) }})</label>
                        <div class="col-sm-9">
                            <select name="dd_house_id" class="form-select" id="dd_house_id">
                                <option value="">-- Select Distribution House --</option>
                                @if(count($houses) > 0)
                                    @foreach($houses as $house)
                                        <option @selected($cm->dd_house_id == $house->id) value="{{ $house->id }}">{{ $house->code .' - '. $house->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('dd_house_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- User -->
                    <div class="row mb-3">
                        <label for="set_user" class="col-sm-3 col-form-label">User</label>
                        <div class="col-sm-9">
                            <select name="user_id" class="form-select" id="set_user">
                                <option value="">-- Select User --</option>
                                @if($users->count() > 0)
                                    @foreach($users as $user)
                                        <option @selected($cm->user_id == $user->id) value="{{ $user->id }}">
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input name="name" id="name" type="text" class="form-control" value="{{ old('name', $cm->name) }}"
                                   placeholder="Enter CM Name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Designation -->
                    <div class="row mb-3">
                        <label for="designation" class="col-sm-3 col-form-label">Designation</label>
                        <div class="col-sm-9">
                            <input name="designation" id="designation" type="text" class="form-control" value="{{ old('designation', $cm->designation) }}"
                                   placeholder="Enter designation">
                            @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Type -->
                    <div class="row mb-3">
                        <label for="type" class="col-sm-3 col-form-label">Type</label>
                        <div class="col-sm-9">
                            <input name="type" id="type" type="text" class="form-control" value="{{ old('type', $cm->type) }}" placeholder="Enter Type">
                            @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Pool Number -->
                    <div class="row mb-3">
                        <label for="pool_number" class="col-sm-3 col-form-label">Pool Number</label>
                        <div class="col-sm-9">
                            <input name="pool_number" id="pool_number" type="number" class="form-control" value="{{ old('pool_number', $cm->pool_number) }}"
                                   placeholder="Enter Pool Number">
                            @error('pool_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Personal Number -->
                    <div class="row mb-3">
                        <label for="personal_number" class="col-sm-3 col-form-label">Personal Number</label>
                        <div class="col-sm-9">
                            <input name="personal_number" id="personal_number" type="number" class="form-control" value="{{ old('personal_number', $cm->personal_number) }}"
                                   placeholder="Enter Personal Number">
                            @error('personal_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Gender -->
                    <div class="row mb-3">
                        <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-9">
                            <select name="gender" class="form-select" id="gender">
                                <option value="">-- Select Gender --</option>
                                <option @selected($cm->gender == 'male') value="male">Male</option>
                                <option @selected($cm->gender == 'female') value="female">Female</option>
                                <option @selected($cm->gender == 'others') value="others">Others</option>
                            </select>
                            @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Blood Group -->
                    <div class="row mb-3">
                        <label for="blood_group" class="col-sm-3 col-form-label">Blood Group</label>
                        <div class="col-sm-9">
                            <select name="blood_group" class="form-select" id="blood_group">
                                <option value="">-- Select Blood Group --</option>
                                <option @selected($cm->blood_group == 'a+') value="a+">A+</option>
                                <option @selected($cm->blood_group == 'a-') value="a-">A-</option>
                                <option @selected($cm->blood_group == 'b+') value="b+">B+</option>
                                <option @selected($cm->blood_group == 'b-') value="b-">B-</option>
                                <option @selected($cm->blood_group == 'ab+') value="ab+">AB+</option>
                                <option @selected($cm->blood_group == 'ab-') value="ab-">AB-</option>
                                <option @selected($cm->blood_group == 'o+') value="o+">O+</option>
                                <option @selected($cm->blood_group == 'o-') value="o-">O-</option>
                            </select>
                            @error('blood_group') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Education -->
                    <div class="row mb-3">
                        <label for="education" class="col-sm-3 col-form-label">Education</label>
                        <div class="col-sm-9">
                            <input name="education" id="education" type="text"
                                   class="form-control" value="{{ old('education', $cm->education) }}" placeholder="e.g SSC/HSC/Dakhil">
                            @error('education') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Father Name -->
                    <div class="row mb-3">
                        <label for="father_name" class="col-sm-3 col-form-label">Father Name</label>
                        <div class="col-sm-9">
                            <input name="father_name" id="father_name" type="text" class="form-control" value="{{ old('father_name', $cm->father_name) }}"
                                   placeholder="Enter Father Name">
                            @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Mother Name -->
                    <div class="row mb-3">
                        <label for="mother_name" class="col-sm-3 col-form-label">Mother Name</label>
                        <div class="col-sm-9">
                            <input name="mother_name" id="mother_name" type="text" class="form-control" value="{{ old('mother_name', $cm->mother_name) }}"
                                   placeholder="Enter Mother Name">
                            @error('mother_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Division -->
                    <div class="row mb-3">
                        <label for="division" class="col-sm-3 col-form-label">Division</label>
                        <div class="col-sm-9">
                            <input name="division" id="division" type="text" class="form-control" value="{{ old('division', $cm->division) }}"
                                   placeholder="Enter Division">
                            @error('division') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- District -->
                    <div class="row mb-3">
                        <label for="district" class="col-sm-3 col-form-label">District</label>
                        <div class="col-sm-9">
                            <input name="district" id="district" type="text" class="form-control" value="{{ old('district', $cm->district) }}"
                                   placeholder="Enter District">
                            @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Thana -->
                    <div class="row mb-3">
                        <label for="thana" class="col-sm-3 col-form-label">Thana</label>
                        <div class="col-sm-9">
                            <input name="thana" id="thana" type="text" class="form-control" value="{{ old('thana', $cm->thana) }}" placeholder="Enter Thana">
                            @error('thana') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="row mb-3">
                        <label for="address" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <input name="address" id="address" type="text" class="form-control" value="{{ old('address', $cm->address) }}"
                                   placeholder="Enter Address">
                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- NID -->
                    <div class="row mb-3">
                        <label for="nid_number" class="col-sm-3 col-form-label">NID</label>
                        <div class="col-sm-9">
                            <input name="nid_number" id="nid_number" type="number" class="form-control" value="{{ old('nid_number', $cm->nid_number) }}"
                                   placeholder="Enter NID Number">
                            @error('nid_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Bank Account Name -->
                    <div class="row mb-3">
                        <label for="bank_account_name" class="col-sm-3 col-form-label">Bank Account Name</label>
                        <div class="col-sm-9">
                            <input name="bank_account_name" id="bank_account_name" type="text" class="form-control"
                                   value="{{ old('bank_account_name', $cm->bank_account_name) }}" placeholder="Enter Bank Account Name">
                            @error('bank_account_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Bank Name -->
                    <div class="row mb-3">
                        <label for="bank_name" class="col-sm-3 col-form-label">Bank Name</label>
                        <div class="col-sm-9">
                            <input name="bank_name" id="bank_name" type="text"
                                   class="form-control" value="{{ old('bank_name', $cm->bank_name) }}" placeholder="Enter Bank Name">
                            @error('bank_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Branch Name -->
                    <div class="row mb-3">
                        <label for="branch_name" class="col-sm-3 col-form-label">Branch Name</label>
                        <div class="col-sm-9">
                            <input name="branch_name" id="branch_name" type="text"
                                   class="form-control" value="{{ old('branch_name', $cm->branch_name) }}" placeholder="Enter Branch Name">
                            @error('branch_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Salary -->
                    <div class="row mb-3">
                        <label for="salary" class="col-sm-3 col-form-label">Salary</label>
                        <div class="col-sm-9">
                            <input name="salary" id="salary" type="number"
                                   class="form-control" value="{{ old('salary', $cm->salary) }}" placeholder="Enter Salary">
                            @error('salary') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Account Number -->
                    <div class="row mb-3">
                        <label for="account_number" class="col-sm-3 col-form-label">Account Number</label>
                        <div class="col-sm-9">
                            <input name="account_number" id="account_number" type="number"
                                   class="form-control" value="{{ old('account_number', $cm->account_number) }}" placeholder="Enter Account Number">
                            @error('account_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Account Type -->
                    <div class="row mb-3">
                        <label for="account_type" class="col-sm-3 col-form-label">Account Type</label>
                        <div class="col-sm-9">
                            <input name="account_type" id="account_type" type="text"
                                   class="form-control" value="{{ old('account_type', $cm->account_type) }}" placeholder="Enter Account Type">
                            @error('account_type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- D.O.B -->
                    <div class="row mb-3">
                        <label for="dob" class="col-sm-3 col-form-label">D.O.B</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input name="dob" id="dob" type="text" class="flatpickr form-control" value="{{ old('dob', $cm->dob) }}" placeholder="Select date">
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
                                <input name="joining_date" id="joining_date" type="text" value="{{ old('joining_date', $cm->joining_date) }}" class="flatpickr form-control" placeholder="Select date">
                                <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                            </div>
                            @error('joining_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Resigning Date -->
                    <div class="row mb-3">
                        <label for="resigning_date" class="col-sm-3 col-form-label">Resigning Date</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input name="resigning_date" id="resigning_date" type="text" value="{{ old('resigning_date', $cm->resigning_date) }}" class="flatpickr form-control" placeholder="Select date">
                                <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                            </div>
                            @error('resigning_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div class="row mb-3">
                        <label for="remarks" class="col-sm-3 col-form-label">Remarks</label>
                        <div class="col-sm-9">
                            <input name="remarks" id="remarks" type="text" class="form-control" value="{{ old('remarks', $cm->remarks) }}" placeholder="Enter Remarks">
                            @error('remarks') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="row mb-3">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select name="status" class="form-select" id="status">
                                <option selected value="">--Select Status--</option>
                                <option @selected($cm->status == 1) value="1">Active</option>
                                <option @selected($cm->status == 0) value="0">Inactive</option>
                            </select>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Upload Documents -->
                    <div class="row mb-3">
                        <label for="documents" class="col-sm-3 col-form-label">Upload Documents</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="documents" id="documents" type="file" accept="application/pdf">
                            @error('documents') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Save Changes</button>
                <a href="{{ route('cm.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                // Dependent dropdown [DD House => supervisor, user]
                $(document).on('change','#dd_house_id',function (){
                    const houseId = $(this).val();

                    if (houseId === '')
                    {
                        $('#set_user').html('<option value="">-- Select User --</option>');
                    }

                    // Get supervisor and user by dd house
                    $.ajax({
                        url: "{{ route('cm.get.users') }}/" + houseId,
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: function (){
                            $('#loading').show();
                            $('#set_user').find('option:not(:first)').remove();
                        },
                        complete: () => {
                            $('#loading').hide();
                        },
                        success: function (response){
                            $.each(response.users, function (key, value){
                                $('#set_user').append('<option value="'+ value.id +'">' + value.name + '</option>')
                            });
                        }
                    });
                });
            });
        </script>
    @endpush

</x-app-layout>
