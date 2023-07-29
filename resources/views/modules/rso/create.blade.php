<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Rso</x-slot:title>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create New Rso</h6>
                    <form id="rsoForm" action="{{ route('rso.store') }}" method="POST">
                        @csrf

                        <!-- Distribution House -->
                        <div class="row mb-3">
                            <label for="dd_house" class="col-sm-3 col-form-label">Distribution House ({{ count($houses) }})</label>
                            <div class="col-sm-9">
                                <select name="dd_house" class="form-select @error('dd_house') is-invalid @enderror" id="dd_house">
                                    <option value="">-- Select Distribution House --</option>
                                    @if(count($houses) > 0)
                                        @foreach($houses as $house)
                                            <option value="{{ $house->code }}">{{ $house->code .' - '. $house->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('dd_house') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Supervisor -->
                        <div class="row mb-3">
                            <label for="supervisor" class="col-sm-3 col-form-label">Supervisor ({{ count($supervisors) }})</label>
                            <div class="col-sm-9">
                                <select name="supervisor" class="form-select @error('supervisor') is-invalid @enderror" id="supervisor">
                                    <option value="">-- Select Supervisor --</option>
                                    @if(count($supervisors) > 0)
                                        @foreach($supervisors as $supervisor)
                                            <option value="{{ $supervisor->pool_number }}">{{ $supervisor->pool_number .' - '. \App\Models\User::firstWhere('id', $supervisor->user_id)->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('supervisor') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- User -->
                        <div class="row mb-3">
                            <label for="user_id" class="col-sm-3 col-form-label">User</label>
                            <div class="col-sm-9">
                                <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" id="user_id">
                                    <option value="">-- Select User --</option>
                                    @if(count($users) > 0)
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->phone .' - '. $user->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                                <small class="text-muted">User Left: <strong class="{{ count($users) < 1 ? 'text-danger' : 'text-success'}}">{{ count($users) }}</strong></small>
                            </div>
                        </div>

                        <!-- Route -->
                        <div class="row mb-3">
                            <label for="routes" class="col-sm-3 col-form-label">Route</label>
                            <div class="col-sm-9">
                                <select name="routes[]" class="select-2 form-select @error('routes') is-invalid @enderror" id="routes" multiple>
                                    <option value="">-- Select Route --</option>
                                    @if(count($routes) > 0)
                                        @foreach($routes as $route)
                                            <option value="{{ $route->code }}">{{ $route->code .' - '. $route->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('routes') <span class="text-danger">{{ $message }}</span> @enderror
                                <small class="text-muted">Route Left: <strong class="{{ count($routes) < 1 ? 'text-danger' : 'text-success'}}">{{ count($routes) }}</strong></small>
                            </div>
                        </div>

                        <!-- Rso Code -->
                        <div class="row mb-3">
                            <label for="rso_code" class="col-sm-3 col-form-label">Rso Code</label>
                            <div class="col-sm-9">
                                <input name="rso_code" id="rso_code" type="text"
                                       class="form-control @error('rso_code') is-invalid @enderror" value="{{ old('rso_code') }}"
                                       placeholder="Enter Rso Code">
                                @error('rso_code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Itop Number -->
                        <div class="row mb-3">
                            <label for="itop_number" class="col-sm-3 col-form-label">Itop Number</label>
                            <div class="col-sm-9">
                                <input name="itop_number" id="itop_number" type="number"
                                       class="form-control @error('itop_number') is-invalid @enderror" value="{{ old('itop_number') }}"
                                       placeholder="Enter Itop Number">
                                @error('itop_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Pool Number -->
                        <div class="row mb-3">
                            <label for="pool_number" class="col-sm-3 col-form-label">Pool Number</label>
                            <div class="col-sm-9">
                                <input name="pool_number" id="pool_number" type="number"
                                       class="form-control @error('pool_number') is-invalid @enderror" value="{{ old('pool_number') }}"
                                       placeholder="Enter Pool Number">
                                @error('pool_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Personal Number -->
                        <div class="row mb-3">
                            <label for="personal_number" class="col-sm-3 col-form-label">Personal Number</label>
                            <div class="col-sm-9">
                                <input name="personal_number" id="personal_number" type="number"
                                       class="form-control @error('personal_number') is-invalid @enderror" value="{{ old('personal_number') }}"
                                       placeholder="Enter Personal Number">
                                @error('personal_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- RID -->
                        <div class="row mb-3">
                            <label for="rid" class="col-sm-3 col-form-label">RID</label>
                            <div class="col-sm-9">
                                <input name="rid" id="rid" type="text" class="form-control @error('rid') is-invalid @enderror"
                                       value="{{ old('rid') }}" placeholder="Enter RID">
                                @error('rid') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Father Name -->
                        <div class="row mb-3">
                            <label for="father_name" class="col-sm-3 col-form-label">Father Name</label>
                            <div class="col-sm-9">
                                <input name="father_name" id="father_name" type="text" class="form-control @error('father_name') is-invalid @enderror"
                                       value="{{ old('father_name') }}" placeholder="Enter Father Name">
                                @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Mother Name -->
                        <div class="row mb-3">
                            <label for="mother_name" class="col-sm-3 col-form-label">Mother Name</label>
                            <div class="col-sm-9">
                                <input name="mother_name" id="mother_name" type="text" class="form-control @error('mother_name') is-invalid @enderror"
                                       value="{{ old('mother_name') }}" placeholder="Enter Mother Name">
                                @error('mother_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Division -->
                        <div class="row mb-3">
                            <label for="division" class="col-sm-3 col-form-label">Division</label>
                            <div class="col-sm-9">
                                <input name="division" id="division" type="text" class="form-control @error('division') is-invalid @enderror"
                                       value="{{ old('division') }}" placeholder="Enter Division">
                                @error('division') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- District -->
                        <div class="row mb-3">
                            <label for="district" class="col-sm-3 col-form-label">District</label>
                            <div class="col-sm-9">
                                <input name="district" id="district" type="text" class="form-control @error('district') is-invalid @enderror"
                                       value="{{ old('district') }}" placeholder="Enter District">
                                @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Thana -->
                        <div class="row mb-3">
                            <label for="thana" class="col-sm-3 col-form-label">Thana</label>
                            <div class="col-sm-9">
                                <input name="thana" id="thana" type="text" class="form-control @error('thana') is-invalid @enderror"
                                       value="{{ old('thana') }}" placeholder="Enter Thana">
                                @error('thana') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="row mb-3">
                            <label for="address" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input name="address" id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                       value="{{ old('address') }}" placeholder="Enter Address">
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Blood Group -->
                        <div class="row mb-3">
                            <label for="blood_group" class="col-sm-3 col-form-label">Blood Group</label>
                            <div class="col-sm-9">
                                <select name="blood_group" class="form-select @error('blood_group') is-invalid @enderror" id="blood_group">
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

                        <!-- SR-No -->
                        <div class="row mb-3">
                            <label for="sr_no" class="col-sm-3 col-form-label">SR-No</label>
                            <div class="col-sm-9">
                                <input name="sr_no" id="sr_no" type="text"
                                       class="form-control @error('sr_no') is-invalid @enderror" value="{{ old('sr_no') }}"
                                       placeholder="Enter SR-No">
                                @error('sr_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Account Number -->
                        <div class="row mb-3">
                            <label for="account_number" class="col-sm-3 col-form-label">Account Number</label>
                            <div class="col-sm-9">
                                <input name="account_number" id="account_number" type="number"
                                       class="form-control @error('account_number') is-invalid @enderror" value="{{ old('account_number') }}"
                                       placeholder="Enter Account Number">
                                @error('account_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Bank Name -->
                        <div class="row mb-3">
                            <label for="bank_name" class="col-sm-3 col-form-label">Bank Name</label>
                            <div class="col-sm-9">
                                <input name="bank_name" id="bank_name" type="text"
                                       class="form-control @error('bank_name') is-invalid @enderror" value="{{ old('bank_name') }}"
                                       placeholder="Enter Bank Name">
                                @error('bank_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Brunch Name -->
                        <div class="row mb-3">
                            <label for="brunch_name" class="col-sm-3 col-form-label">Brunch Name</label>
                            <div class="col-sm-9">
                                <input name="brunch_name" id="brunch_name" type="text"
                                       class="form-control @error('brunch_name') is-invalid @enderror" value="{{ old('brunch_name') }}"
                                       placeholder="Enter Brunch Name">
                                @error('brunch_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Routing Number -->
                        <div class="row mb-3">
                            <label for="routing_number" class="col-sm-3 col-form-label">Routing Number</label>
                            <div class="col-sm-9">
                                <input name="routing_number" id="routing_number" type="number"
                                       class="form-control @error('routing_number') is-invalid @enderror" value="{{ old('routing_number') }}"
                                       placeholder="Enter Routing Number">
                                @error('routing_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Salary -->
                        <div class="row mb-3">
                            <label for="salary" class="col-sm-3 col-form-label">Salary</label>
                            <div class="col-sm-9">
                                <input name="salary" id="salary" type="number"
                                       class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary') }}"
                                       placeholder="Enter Salary">
                                @error('salary') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="row mb-3">
                            <label for="education" class="col-sm-3 col-form-label">Education</label>
                            <div class="col-sm-9">
                                <input name="education" id="education" type="text"
                                       class="form-control @error('education') is-invalid @enderror" value="{{ old('education') }}"
                                       placeholder="e.g SSC/HSC/Dakhil">
                                @error('education') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Marital Status -->
                        <div class="row mb-3">
                            <label for="marital_status" class="col-sm-3 col-form-label">Marital Status</label>
                            <div class="col-sm-9">
                                <select name="marital_status" class="form-select @error('marital_status') is-invalid @enderror" id="marital_status">
                                    <option value="">-- Select Marital Status --</option>
                                    <option value="married">Married</option>
                                    <option value="unmarried">Unmarried</option>
                                </select>
                                @error('marital_status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="row mb-3">
                            <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror" id="gender">
                                    <option value="">-- Select Gender --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="others">Others</option>
                                </select>
                                @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- D.O.B -->
                        <div class="row mb-3">
                            <label for="dob" class="col-sm-3 col-form-label">D.O.B</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="dob" id="dob" type="text" class="flatpickr form-control @error('dob') is-invalid @enderror" placeholder="Select date">
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- NID -->
                        <div class="row mb-3">
                            <label for="nid" class="col-sm-3 col-form-label">NID</label>
                            <div class="col-sm-9">
                                <input name="nid" id="nid" type="number"
                                       class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid') }}"
                                       placeholder="Enter NID Number">
                                @error('nid') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Residential Rso -->
                        <div class="row mb-3">
                            <label for="residential_rso" class="col-sm-3 col-form-label">Residential Rso</label>
                            <div class="col-sm-9">
                                <select name="residential_rso" class="form-select @error('residential_rso') is-invalid @enderror" id="residential_rso">
                                    <option value="">-- Select Residential Rso --</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                @error('residential_rso') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Joining Date -->
                        <div class="row mb-3">
                            <label for="joining_date" class="col-sm-3 col-form-label">Joining Date</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="joining_date" id="joining_date" type="text" class="flatpickr form-control @error('joining_date') is-invalid @enderror" placeholder="Select date">
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('joining_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2">Create New Rso</button>
                        <a href="{{ route('rso.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
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
                                <p>Rso: <strong>{{ $failure->values()['itop_number'] }}</strong></p>
                                <p>Error type: <strong>{{ \Illuminate\Support\Str::title($failure->attribute()) }}</strong></p>
                                <p>Error msg: {{ $failure->errors()[0] }} </p>
                                <p>Row number : {{ $failure->row() }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="card-body">
                    <h6 class="card-title">Import Rso</h6>
                    <form class="row gy-2 gx-3 align-items-center" action="{{ route('rso.import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label class="visually-hidden" for="autoSizingInput">Name</label>
                            <input name="import_rso" type="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary w-100 mt-2">Import Rso</button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('rso.sample.file.download') }}" class="nav-link text-muted">Download sample file.</a>
        </div>
    </div>

</x-app-layout>
