<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New CM</x-slot:title>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create New CM</h6>
                    <form id="cmForm" action="{{ route('cm.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <!-- Distribution House -->
                        <div class="row mb-3">
                            <label for="dd_house_id" class="col-sm-3 col-form-label">Distribution House ({{ count($houses) }})</label>
                            <div class="col-sm-9">
                                <select name="dd_house_id" class="form-select" id="dd_house_id">
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

                        <!-- User -->
                        <div class="row mb-3">
                            <label for="get_user" class="col-sm-3 col-form-label">User</label>
                            <div class="col-sm-9">
                                <select name="user_id" class="form-select" id="get_user">
                                    <option value="">-- Select User --</option>
                                </select>
                                @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input name="name" id="name" type="text" class="form-control" value="{{ old('name') }}"
                                       placeholder="Enter CM Name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Designation -->
                        <div class="row mb-3">
                            <label for="designation" class="col-sm-3 col-form-label">Designation</label>
                            <div class="col-sm-9">
                                <input name="designation" id="designation" type="text" class="form-control" value="{{ old('designation') }}"
                                       placeholder="Enter designation">
                                @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="row mb-3">
                            <label for="type" class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-9">
                                <input name="type" id="type" type="text" class="form-control" value="{{ old('type') }}" placeholder="Enter Type">
                                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Pool Number -->
                        <div class="row mb-3">
                            <label for="pool_number" class="col-sm-3 col-form-label">Pool Number</label>
                            <div class="col-sm-9">
                                <input name="pool_number" id="pool_number" type="number" class="form-control" value="{{ old('pool_number') }}"
                                       placeholder="Enter Pool Number">
                                @error('pool_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Personal Number -->
                        <div class="row mb-3">
                            <label for="personal_number" class="col-sm-3 col-form-label">Personal Number</label>
                            <div class="col-sm-9">
                                <input name="personal_number" id="personal_number" type="number" class="form-control" value="{{ old('personal_number') }}"
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
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="others">Others</option>
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
                                    <option value="a+">A+</option>
                                    <option value="a-">A-</option>
                                    <option value="b+">B+</option>
                                    <option value="b-">B-</option>
                                    <option value="ab+">AB+</option>
                                    <option value="ab-">AB-</option>
                                    <option value="o+">O+</option>
                                    <option value="o-">O-</option>
                                </select>
                                @error('blood_group') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="row mb-3">
                            <label for="education" class="col-sm-3 col-form-label">Education</label>
                            <div class="col-sm-9">
                                <input name="education" id="education" type="text"
                                       class="form-control" value="{{ old('education') }}" placeholder="e.g SSC/HSC/Dakhil">
                                @error('education') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Father Name -->
                        <div class="row mb-3">
                            <label for="father_name" class="col-sm-3 col-form-label">Father Name</label>
                            <div class="col-sm-9">
                                <input name="father_name" id="father_name" type="text" class="form-control" value="{{ old('father_name') }}"
                                       placeholder="Enter Father Name">
                                @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Mother Name -->
                        <div class="row mb-3">
                            <label for="mother_name" class="col-sm-3 col-form-label">Mother Name</label>
                            <div class="col-sm-9">
                                <input name="mother_name" id="mother_name" type="text" class="form-control" value="{{ old('mother_name') }}"
                                       placeholder="Enter Mother Name">
                                @error('mother_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Division -->
                        <div class="row mb-3">
                            <label for="division" class="col-sm-3 col-form-label">Division</label>
                            <div class="col-sm-9">
                                <input name="division" id="division" type="text" class="form-control" value="{{ old('division') }}"
                                       placeholder="Enter Division">
                                @error('division') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- District -->
                        <div class="row mb-3">
                            <label for="district" class="col-sm-3 col-form-label">District</label>
                            <div class="col-sm-9">
                                <input name="district" id="district" type="text" class="form-control" value="{{ old('district') }}"
                                       placeholder="Enter District">
                                @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Thana -->
                        <div class="row mb-3">
                            <label for="thana" class="col-sm-3 col-form-label">Thana</label>
                            <div class="col-sm-9">
                                <input name="thana" id="thana" type="text" class="form-control" value="{{ old('thana') }}" placeholder="Enter Thana">
                                @error('thana') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="row mb-3">
                            <label for="address" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input name="address" id="address" type="text" class="form-control" value="{{ old('address') }}"
                                       placeholder="Enter Address">
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- NID -->
                        <div class="row mb-3">
                            <label for="nid_number" class="col-sm-3 col-form-label">NID</label>
                            <div class="col-sm-9">
                                <input name="nid_number" id="nid_number" type="number" class="form-control" value="{{ old('nid_number') }}"
                                       placeholder="Enter NID Number">
                                @error('nid_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Bank Account Name -->
                        <div class="row mb-3">
                            <label for="bank_account_name" class="col-sm-3 col-form-label">Bank Account Name</label>
                            <div class="col-sm-9">
                                <input name="bank_account_name" id="bank_account_name" type="text" class="form-control"
                                       value="{{ old('bank_account_name') }}" placeholder="Enter Bank Account Name">
                                @error('bank_account_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Bank Name -->
                        <div class="row mb-3">
                            <label for="bank_name" class="col-sm-3 col-form-label">Bank Name</label>
                            <div class="col-sm-9">
                                <input name="bank_name" id="bank_name" type="text"
                                       class="form-control" value="{{ old('bank_name') }}" placeholder="Enter Bank Name">
                                @error('bank_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Brunch Name -->
                        <div class="row mb-3">
                            <label for="brunch_name" class="col-sm-3 col-form-label">Brunch Name</label>
                            <div class="col-sm-9">
                                <input name="brunch_name" id="brunch_name" type="text"
                                       class="form-control" value="{{ old('brunch_name') }}" placeholder="Enter Brunch Name">
                                @error('brunch_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Salary -->
                        <div class="row mb-3">
                            <label for="salary" class="col-sm-3 col-form-label">Salary</label>
                            <div class="col-sm-9">
                                <input name="salary" id="salary" type="number"
                                       class="form-control" value="{{ old('salary') }}" placeholder="Enter Salary">
                                @error('salary') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Account Number -->
                        <div class="row mb-3">
                            <label for="account_number" class="col-sm-3 col-form-label">Account Number</label>
                            <div class="col-sm-9">
                                <input name="account_number" id="account_number" type="number"
                                       class="form-control" value="{{ old('account_number') }}" placeholder="Enter Account Number">
                                @error('account_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Account Type -->
                        <div class="row mb-3">
                            <label for="account_type" class="col-sm-3 col-form-label">Account Type</label>
                            <div class="col-sm-9">
                                <input name="account_type" id="account_type" type="text"
                                       class="form-control" value="{{ old('account_type') }}" placeholder="Enter Account Type">
                                @error('account_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- D.O.B -->
                        <div class="row mb-3">
                            <label for="dob" class="col-sm-3 col-form-label">D.O.B</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="dob" id="dob" type="text" class="flatpickr form-control" placeholder="Select date">
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
                                    <input name="joining_date" id="joining_date" type="text" class="flatpickr form-control" placeholder="Select date">
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('joining_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Remarks -->
                        <div class="row mb-3">
                            <label for="remarks" class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9">
                                <input name="remarks" id="remarks" type="text" class="form-control" value="{{ old('remarks') }}" placeholder="Enter Remarks">
                                @error('remarks') <span class="text-danger">{{ $message }}</span> @enderror
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

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create New CM</button>
                        <a href="{{ route('cm.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                    </form>
                </div>
            </div>
        </div>

       <div class="col-md-4">
           <div class="card mb-3">
               @if(session()->has('import_errors'))
                   @foreach(session()->get('import_errors') as $failure)
                       <div class="card-header">
                           <div class="alert alert-danger">
                               <p>CM: <strong>{{ $failure->values()['name'] }}</strong></p>
                               <p>Error type: <strong>{{ \Illuminate\Support\Str::title(implode(' ', explode('_', $failure->attribute()))) }}</strong></p>
                               <p>Error msg: {{ $failure->errors()[0] }} </p>
                               <p>Row number : {{ $failure->row() }}</p>
                           </div>
                       </div>
                   @endforeach
               @endif

               <div class="card-body">
                   <h6 class="card-title">Import CM</h6>
                   <form class="row gy-2 gx-3 align-items-center import-cm" action="{{ route('cm.import') }}" method="post" enctype="multipart/form-data">
                       @csrf

                       <div class="col-12">
                           <label class="visually-hidden" for="autoSizingInput">Name</label>
                           <input name="import_cm" type="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                       </div>
                       <div class="col-12">
                           <button type="submit" class="btn btn-sm btn-primary w-100 mt-2 btn-import-cm">Import CM</button>
                       </div>
                   </form>
               </div>
           </div>
           <a href="{{ route('cm.sample.file.download') }}" class="nav-link text-muted">Download sample file.</a>
       </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Dependent dropdown
                $(document).on('change','#dd_house_id',function (){
                    const houseId = $(this).val();

                    if (houseId === '')
                    {
                        $('#get_user').html('<option value="">-- Select User --</option>');
                    }

                    // Get user by dd house
                    $.ajax({
                        url: "{{ route('cm.get.users') }}/" + houseId,
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: function (){
                            $('#get_user').find('option:not(:first)').remove();
                        },
                        success: function (response){
                            $.each(response.users, function (key, value){
                                $('#get_user').append('<option value="'+ value.id +'">' + value.name + '</option>')
                            });
                        }
                    });
                });

                $("#cmForm").validate({

                    rules: {
                        dd_house_id: 'required',
                        name: 'required',
                        pool_number: 'required',
                    },
                    messages: {

                    },
                });
            });
        </script>
    @endpush

</x-app-layout>
