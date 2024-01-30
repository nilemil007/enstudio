<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update Rso</x-slot:title>

    <div id="rsoUpdateErrMsg" class="alert alert-danger err-msg d-none"></div>

    <form id="rsoUpdateForm" action="{{ route('rso.update', $rso->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <p>{{ mt_rand(1000000,9999999) }}</p>

        <div class="card mb-3 border-success">
            <div class="card-header text-bg-success">Basic Information</div>
            <div style="background-color: #a3ffb22e" class="card-body">
                <!-- Distribution House -->
                <div class="row mb-3">
                    <label for="dd_house_id" class="col-sm-3 col-form-label">Distribution House</label>
                    <div class="col-sm-9">
                        <p>{{ $rso->ddHouse->code.' - '.$rso->ddHouse->name }}</p>
                    </div>
                </div>

                <!-- Supervisor -->
                <div class="row mb-3">
                    <label for="get_supervisor" class="col-sm-3 col-form-label">Supervisor</label>
                    <div class="col-sm-9">
                        <p>{{ $rso->supervisor->pool_number.' - '.$rso->supervisor->user->name }}</p>
                    </div>
                </div>

                <!-- Route -->
                <div class="row mb-3">
                    <label for="get_routes" class="col-sm-3 col-form-label">Route</label>
                    <div class="col-sm-9">
                        @foreach($rso->route as $route)
                            <p>{{ $route->code.' - '.$route->name }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3 border-success">
            <div class="card-header text-bg-success">Primary Information</div>
            <div style="background-color: #a3ffb22e" class="card-body">
                <!-- Rso Code -->
                <div class="row mb-3">
                    <label for="rso_code" class="col-sm-3 col-form-label">Rso Code</label>
                    <div class="col-sm-9"><p>{{ $rso->rso_code }}</p></div>
                </div>

                <!-- Itop Number -->
                <div class="row mb-3">
                    <label for="itop_number" class="col-sm-3 col-form-label">Itop Number</label>
                    <div class="col-sm-9"><p>{{ $rso->itop_number }}</p></div>
                </div>

                <!-- Pool Number -->
                <div class="row mb-3">
                    <label for="pool_number" class="col-sm-3 col-form-label">Pool Number</label>
                    <div class="col-sm-9"><p>{{ $rso->pool_number }}</p></div>
                </div>

                <!-- SR-No -->
                <div class="row mb-3">
                    <label for="sr_no" class="col-sm-3 col-form-label">SR-No</label>
                    <div class="col-sm-9"><p>{{ $rso->sr_no }}</p></div>
                </div>

                <!-- Residential Rso -->
                <div class="row mb-3">
                    <label for="residential_rso" class="col-sm-3 col-form-label">Residential Rso <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="residential_rso" class="form-select" id="residential_rso">
                            <option value="">-- Select Residential Rso --</option>
                            <option @selected($rso->residential_rso == 'yes') value="yes">Yes</option>
                            <option @selected($rso->residential_rso == 'no') value="no">No</option>
                        </select>
                        @error('residential_rso') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Joining Date -->
                <div class="row mb-3">
                    <label for="joining_date" class="col-sm-3 col-form-label">Joining Date</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input name="joining_date" id="joining_date" type="text" value="{{ $rso->joining_date }}" class="flatpickr form-control @error('joining_date') is-invalid @enderror" placeholder="Select date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                <i data-feather="calendar"></i>
                            </span>
                        </div>
                        @error('joining_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3 border-success">
            <div class="card-header text-bg-success">Temporary Employment Contract</div>
            <div style="background-color: #a3ffb22e" class="card-body">
                <!-- Date -->
                <div class="row mb-3">
                    <label for="date" class="col-sm-3 col-form-label">Date</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input name="date" id="date" value="{{ $rso->date }}" type="text" class="flatpickr form-control" placeholder="Select date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                <i data-feather="calendar"></i>
                            </span>
                        </div>
                        @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- RID -->
                <div class="row mb-3">
                    <label for="rid" class="col-sm-3 col-form-label">RID</label>
                    <div class="col-sm-9">
                        <input name="rid" id="rid" type="text" class="form-control" value="{{ old('name', $rso->rid) }}" placeholder="Enter RID">
                    </div>
                </div>

                <!-- Rso Name -->
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Rso Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="name" id="name" type="text" class="form-control" value="{{ old('name', $rso->name) }}" placeholder="Enter Rso Name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Father Name -->
                <div class="row mb-3">
                    <label for="father_name" class="col-sm-3 col-form-label">Father Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="father_name" id="father_name" type="text" class="form-control" value="{{ old('father_name', $rso->father_name) }}" placeholder="Enter Father Name">
                        @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Mother Name -->
                <div class="row mb-3">
                    <label for="mother_name" class="col-sm-3 col-form-label">Mother Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="mother_name" id="mother_name" type="text" class="form-control" value="{{ old('mother_name', $rso->mother_name) }}" placeholder="Enter Mother Name">
                        @error('mother_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Division -->
                <div class="row mb-3">
                    <label for="division" class="col-sm-3 col-form-label">Division <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="division" id="division" type="text" class="form-control" value="{{ old('division', $rso->division) }}" placeholder="Enter Division">
                        @error('division') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- District -->
                <div class="row mb-3">
                    <label for="district" class="col-sm-3 col-form-label">District <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="district" id="district" type="text" class="form-control" value="{{ old('district', $rso->district) }}" placeholder="Enter District">
                        @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Thana -->
                <div class="row mb-3">
                    <label for="thana" class="col-sm-3 col-form-label">Thana <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="thana" id="thana" type="text" class="form-control" value="{{ old('thana', $rso->thana) }}" placeholder="Enter Thana">
                        @error('thana') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Present Address -->
                <div class="row mb-3">
                    <label for="present_address" class="col-sm-3 col-form-label">Present Address <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="present_address" id="present_address" type="text" class="form-control" value="{{ old('present_address', $rso->present_address) }}" placeholder="Enter Present Address">
                        @error('present_address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Permanent Address -->
                <div class="row mb-3">
                    <label for="permanent_address" class="col-sm-3 col-form-label">Permanent Address <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="permanent_address" id="permanent_address" type="text" class="form-control" value="{{ old('permanent_address', $rso->permanent_address) }}" placeholder="Enter Permanent Address">
                        @error('permanent_address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Witness Name -->
                <div class="row mb-3">
                    <label for="witness_name" class="col-sm-3 col-form-label">Witness Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="witness_name" id="witness_name" type="text" class="form-control" value="{{ old('witness_name', $rso->witness_name) }}" placeholder="Enter Witness Name">
                        @error('witness_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Witness Number -->
                <div class="row mb-3">
                    <label for="witness_number" class="col-sm-3 col-form-label">Witness Number <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="witness_number" id="witness_number" type="number" class="form-control" value="{{ old('witness_number', $rso->witness_number) }}" placeholder="Enter Witness Number">
                        @error('witness_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Salary -->
                <div class="row mb-3">
                    <label for="salary" class="col-sm-3 col-form-label">Salary <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="salary" id="salary" type="number" class="form-control" value="{{ old('salary', $rso->salary) }}" placeholder="Enter Salary">
                        @error('salary') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Employee Signature -->
                <div class="row mb-3">
                    <label for="employee_signature" class="col-sm-3 col-form-label">Employee Signature <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="employee_signature" id="employee_signature" type="file" class="form-control" accept="image/png">
                        @error('employee_signature') <span class="text-danger">{{ $message }}</span> @enderror
                        <img class="mt-3" src="{{ url('public/assets/images/rso/documents/'.$rso->employee_signature) }}" alt="Employee Signature">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3 border-success">
            <div class="card-header text-bg-success">Personal Information</div>
            <div style="background-color: #a3ffb22e" class="card-body">
                <!-- Personal Number -->
                <div class="row mb-3">
                    <label for="personal_number" class="col-sm-3 col-form-label">Personal Number <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="personal_number" id="personal_number" type="number" class="form-control" value="{{ old('personal_number', $rso->personal_number) }}" placeholder="Enter Personal Number">
                        @error('personal_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- D.O.B -->
                <div class="row mb-3">
                    <label for="dob" class="col-sm-3 col-form-label">Date Of Birth <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input name="dob" id="dob" type="text" value="{{ $rso->dob }}" class="flatpickr form-control" placeholder="Select date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                <i data-feather="calendar"></i>
                            </span>
                        </div>
                        @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- NID -->
                <div class="row mb-3">
                    <label for="nid" class="col-sm-3 col-form-label">NID <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="nid" id="nid" type="number" class="form-control" value="{{ old('nid', $rso->nid) }}" placeholder="Enter NID Number">
                        @error('nid') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Blood Group -->
                <div class="row mb-3">
                    <label for="blood_group" class="col-sm-3 col-form-label">Blood Group <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="blood_group" class="form-select" id="blood_group">
                            <option value="">-- Select Blood Group --</option>
                            <option @selected($rso->blood_group == 'a+') value="a+">A+</option>
                            <option @selected($rso->blood_group == 'a-') value="a-">A-</option>
                            <option @selected($rso->blood_group == 'b+') value="b+">B+</option>
                            <option @selected($rso->blood_group == 'b-') value="b-">B-</option>
                            <option @selected($rso->blood_group == 'ab+') value="ab+">AB+</option>
                            <option @selected($rso->blood_group == 'ab-') value="ab-">AB-</option>
                            <option @selected($rso->blood_group == 'o+') value="o+">O+</option>
                            <option @selected($rso->blood_group == 'o-') value="o-">O-</option>
                        </select>
                        @error('blood_group') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Marital Status -->
                <div class="row mb-3">
                    <label for="marital_status" class="col-sm-3 col-form-label">Marital Status <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="marital_status" class="form-select" id="marital_status">
                            <option value="">-- Select Marital Status --</option>
                            <option @selected($rso->marital_status == 'married') value="married">Married</option>
                            <option @selected($rso->marital_status == 'unmarried') value="unmarried">Unmarried</option>
                        </select>
                        @error('marital_status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Nationality -->
                <div class="row mb-3">
                    <label for="nationality" class="col-sm-3 col-form-label">Nationality</label>
                    <div class="col-sm-9">
                        <p>{{ $rso->nationality }}</p>
                    </div>
                </div>

                <!-- Religion -->
                <div class="row mb-3">
                    <label for="religion" class="col-sm-3 col-form-label">Religion</label>
                    <div class="col-sm-9">
                        <p>{{ $rso->religion }}</p>
                    </div>
                </div>

                <!-- Gender -->
                <div class="row mb-3">
                    <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                    <div class="col-sm-9">
                        <p>{{ $rso->gender }}</p>
                    </div>
                </div>

                <!-- Place Of Birth -->
                <div class="row mb-3">
                    <label for="place_of_birth" class="col-sm-3 col-form-label">Place Of Birth</label>
                    <div class="col-sm-9">
                        <p>{{ $rso->place_of_birth }}</p>
                    </div>
                </div>

                <!-- Rso Image -->
                <div class="row mb-3">
                    <label for="rso_image" class="col-sm-3 col-form-label">Rso Image <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="rso_image" id="rso_image" type="file" class="form-control" accept="image/jpeg, image/png">
                        @error('rso_image') <span class="text-danger">{{ $message }}</span> @enderror
                        <img class="mt-3" src="{{ url('public/assets/images/rso/documents/'.$rso->rso_image) }}" alt="Rso Image" width="150">
                    </div>
                </div>
            </div>
        </div>

        <div x-data="{education: ''}" class="card mb-3 border-success">
            <div class="card-header text-bg-success">Education Information</div>
            <div style="background-color: #a3ffb22e" class="card-body">
                <!-- Education -->
                <div class="row mb-3">
                    <label for="education" class="col-sm-3 col-form-label">Examination</label>
                    <div class="col-sm-9">
                        <p>{{ \Illuminate\Support\Str::title(\Illuminate\Support\Str::before($rso->education, '.')) }} ({{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::before($rso->education, '.')) }})</p>
                    </div>
                </div>

                <!-- Serial Number -->
                <div class="row mb-3" x-cloak x-show="education === 'junior school certificate.jsc' || education === 'higher secondary certificate.hsc' || education === 'dakhil examination.dakhil' || education === 'higher secondary certificate.hsc.technical' || education === 'secondary school certificate.ssc.1999' || education === 'secondary school certificate.ssc'">
                    <label for="serial_number" class="col-sm-3 col-form-label">Serial Number</label>
                    <div class="col-sm-9">
                        <input name="serial_number" id="serial_number" type="number" class="form-control" value="{{ old('serial_number', $rso->serial_number) }}" placeholder="e.g 0017394">
                        <small class="text-muted">Enter serial number here.</small>
                    </div>
                </div>

                <!-- DBJSC Number -->
                <div class="row mb-3" x-cloak x-show="education === 'junior school certificate.jsc'">
                    <label for="dbjsc" class="col-sm-3 col-form-label">DBJSC Number</label>
                    <div class="col-sm-9">
                        <input name="dbjsc" id="dbjsc" type="number" class="form-control" value="{{ old('dbjsc', $rso->dbjsc) }}" placeholder="e.g 0017394">
                        <small class="text-muted">Enter seven digit DBJSC number here.</small>
                    </div>
                </div>

                <!-- DBCSC Number -->
                <div class="row mb-3" x-cloak x-show="education === 'secondary school certificate.ssc' || examination === 'secondary school certificate.ssc.1999'">
                    <label for="dbcsc" class="col-sm-3 col-form-label">DBCSC Number</label>
                    <div class="col-sm-9">
                        <input name="dbcsc" id="dbcsc" type="number" class="form-control" value="{{ old('dbcsc') }}" placeholder="e.g 0017394">
                        <small class="text-muted">Enter seven digit DBCSC number here.</small>
                    </div>
                </div>

                <!-- DBCHC Number -->
                <div class="row mb-3" x-cloak x-show="education === 'higher secondary certificate.hsc'">
                    <label for="dbchc" class="col-sm-3 col-form-label">DBCHC Number</label>
                    <div class="col-sm-9">
                        <input name="dbchc" id="dbchc" type="number" class="form-control" value="{{ old('dbchc') }}" placeholder="e.g 0017394">
                        <small class="text-muted">Enter seven digit DBCHC number here.</small>
                    </div>
                </div>

                <!-- MBCD Number -->
                <div class="row mb-3" x-cloak x-show="education === 'dakhil examination.dakhil'">
                    <label for="mbcd" class="col-sm-3 col-form-label">MBCD Number</label>
                    <div class="col-sm-9">
                        <input name="mbcd" id="mbcd" type="number" class="form-control" value="{{ old('mbcd') }}" placeholder="e.g 0017394">
                        <small class="text-muted">Enter seven digit MBCD number here.</small>
                    </div>
                </div>

                <!-- Student ID Number -->
                <div class="row mb-3" x-cloak x-show="education === 'secondary school certificate.ssc.bou'">
                    <label for="student_id" class="col-sm-3 col-form-label">Student ID Number</label>
                    <div class="col-sm-9">
                        <input name="student_id" id="student_id" type="number" class="form-control" value="{{ old('student_id') }}" placeholder="e.g 0017394">
                        <small class="text-muted">Enter seven digit Student ID number here.</small>
                    </div>
                </div>

                <!-- Registration Number -->
                <div class="row mb-3" x-cloak x-show="education === 'junior school certificate.jsc' || education === 'higher secondary certificate.hsc' || education === 'dakhil examination.dakhil' || education === 'higher secondary certificate.hsc.technical' || education === 'secondary school certificate.ssc.1999' || education === 'secondary school certificate.ssc'">
                    <label for="registration_no" class="col-sm-3 col-form-label">Registration Number</label>
                    <div class="col-sm-9">
                        <input name="registration_no" id="registration_no" type="number" class="form-control" value="{{ old('registration_no') }}" placeholder="e.g 0017394">
                        <small class="text-muted">Enter seven digit Registration number here.</small>
                    </div>
                </div>

                <!-- Board -->
                <div class="row mb-3">
                    <label for="board" class="col-sm-3 col-form-label">Board</label>
                    <div class="col-sm-9">
                        <input name="board" id="board" type="text" class="form-control" value="{{ old('board') }}" placeholder="e.g 0017394">
                    </div>
                </div>

                <!-- Session -->
                <div class="row mb-3" x-cloak x-show="education === 'junior school certificate.jsc' || education === 'higher secondary certificate.hsc' || education === 'dakhil examination.dakhil' || education === 'higher secondary certificate.hsc.technical' || education === 'secondary school certificate.ssc.1999' || education === 'secondary school certificate.ssc'">
                    <label for="session" class="col-sm-3 col-form-label">Session</label>
                    <div class="col-sm-9">
                        <input name="session" id="session" type="text" class="form-control" value="{{ old('session') }}" placeholder="e.g 0017394">
                    </div>
                </div>

                <!-- Examination -->
                <div class="row mb-3" x-cloak x-show="education === 'junior school certificate.jsc' || education === 'higher secondary certificate.hsc' || education === 'dakhil examination.dakhil' || education === 'higher secondary certificate.hsc.technical' || education === 'secondary school certificate.ssc.1999' || education === 'secondary school certificate.ssc'">
                    <label for="examination" class="col-sm-3 col-form-label">Examination</label>
                    <div class="col-sm-9">
                        <input name="examination" id="examination" type="number" class="form-control" value="{{ old('examination') }}" placeholder="e.g 0017394">
                    </div>
                </div>

                <!-- Institute Name -->
                <div class="row mb-3" x-cloak x-show="education === 'junior school certificate.jsc' || education === 'higher secondary certificate.hsc' || education === 'dakhil examination.dakhil' || education === 'higher secondary certificate.hsc.technical' || education === 'secondary school certificate.ssc.1999' || education === 'secondary school certificate.ssc'">
                    <label for="institute_name" class="col-sm-3 col-form-label">Isntitute Name</label>
                    <div class="col-sm-9">
                        <input name="institute_name" id="institute_name" type="text" class="form-control" value="{{ old('institute_name') }}" placeholder="e.g 0017394">
                    </div>
                </div>

                <!-- Certificate Thana -->
                <div class="row mb-3" x-cloak x-show="education === 'junior school certificate.jsc' || education === 'higher secondary certificate.hsc' || education === 'dakhil examination.dakhil' || education === 'secondary school certificate.ssc.1999' || education === 'secondary school certificate.ssc'">
                    <label for="certificate_thana" class="col-sm-3 col-form-label">Certificate Thana</label>
                    <div class="col-sm-9">
                        <input name="certificate_thana" id="certificate_thana" type="text" class="form-control" value="{{ old('certificate_thana') }}" placeholder="e.g 0017394">
                    </div>
                </div>

                <!-- Roll No -->
                <div class="row mb-3" x-cloak x-show="education === 'junior school certificate.jsc' || education === 'higher secondary certificate.hsc' || education === 'dakhil examination.dakhil' || education === 'higher secondary certificate.hsc.technical' || education === 'secondary school certificate.ssc.1999' || education === 'secondary school certificate.ssc'">
                    <label for="roll_no" class="col-sm-3 col-form-label">Roll No</label>
                    <div class="col-sm-9">
                        <input name="roll_no" id="roll_no" type="number" class="form-control" value="{{ old('roll_no') }}" placeholder="e.g 0017394">
                    </div>
                </div>

                <!-- Subject -->
                <div class="row mb-3" x-cloak x-show="education === 'higher secondary certificate.hsc' || education === 'secondary school certificate.ssc.1999' || education === 'secondary school certificate.ssc'">
                    <label for="subject" class="col-sm-3 col-form-label">Subject</label>
                    <div class="col-sm-9">
                        <input name="subject" id="subject" type="text" class="form-control" value="{{ old('subject') }}" placeholder="e.g 0017394">
                    </div>
                </div>

                <!-- Division -->
                <div class="row mb-3" x-cloak x-show="education === 'secondary school certificate.ssc.1999'">
                    <label for="edu_division" class="col-sm-3 col-form-label">Division</label>
                    <div class="col-sm-9">
                        <input name="edu_division" id="edu_division" type="text" class="form-control" value="{{ old('edu_division') }}" placeholder="e.g 0017394">
                    </div>
                </div>

                <!-- GPA -->
                <div class="row mb-3" x-cloak x-show="education === 'junior school certificate.jsc' || education === 'higher secondary certificate.hsc' || education === 'dakhil examination.dakhil' || education === 'higher secondary certificate.hsc.technical' || education === 'secondary school certificate.ssc'">
                    <label for="gpa" class="col-sm-3 col-form-label">G.P.A</label>
                    <div class="col-sm-9">
                        <input name="gpa" id="gpa" type="text" class="form-control" value="{{ old('gpa') }}" placeholder="e.g 0017394">
                    </div>
                </div>

                <!-- DOB In Reg Card -->
                <div class="row mb-3" x-cloak x-show="education === 'junior school certificate.jsc' || education === 'dakhil examination.dakhil' || education === 'secondary school certificate.ssc.1999' || education === 'secondary school certificate.ssc'">
                    <label for="dob_in_reg_card" class="col-sm-3 col-form-label">DOB In Reg Card</label>
                    <div class="col-sm-9">
                        <input name="dob_in_reg_card" id="dob_in_reg_card" type="text" class="form-control" value="{{ old('dob_in_reg_card') }}" placeholder="e.g 0017394">
                    </div>
                </div>

                <!-- Month Of -->
                <div class="row mb-3" x-cloak x-show="education === 'higher secondary certificate.hsc.technical' || education === 'secondary school certificate.ssc.1999'">
                    <label for="month_of" class="col-sm-3 col-form-label">Month Of</label>
                    <div class="col-sm-9">
                        <input name="month_of" id="month_of" type="text" class="form-control" value="{{ old('month_of') }}" placeholder="e.g 0017394">
                    </div>
                </div>

                <!-- Issue Date -->
                <div class="row mb-3" x-cloak x-show="education === 'higher secondary certificate.hsc.technical'">
                    <label for="issue_date" class="col-sm-3 col-form-label">Issue Date</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input name="issue_date" id="issue_date" type="text" class="flatpickr form-control" placeholder="Select date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                        </div>
                    </div>
                </div>

                <!-- Publish Date -->
                <div class="row mb-3" x-cloak x-show="education === 'junior school certificate.jsc' || education === 'higher secondary certificate.hsc' || education === 'dakhil examination.dakhil' || education === 'higher secondary certificate.hsc.technical' || education === 'secondary school certificate.ssc.1999' || education === 'secondary school certificate.ssc'">
                    <label for="publish_date" class="col-sm-3 col-form-label">Publish Date</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input name="publish_date" id="publish_date" type="text" class="flatpickr form-control" placeholder="Select date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <!-- Account Number -->
        <div class="row mb-3">
            <label for="account_number" class="col-sm-3 col-form-label">Account Number</label>
            <div class="col-sm-9">
                <input name="account_number" id="account_number" type="text"
                       class="form-control @error('account_number') is-invalid @enderror" value="{{ old('account_number', $rso->account_number) }}"
                       placeholder="Enter Account Number">
                @error('account_number') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Bank Name -->
        <div class="row mb-3">
            <label for="bank_name" class="col-sm-3 col-form-label">Bank Name</label>
            <div class="col-sm-9">
                <input name="bank_name" id="bank_name" type="text"
                       class="form-control @error('bank_name') is-invalid @enderror" value="{{ old('bank_name', $rso->bank_name) }}"
                       placeholder="Enter Bank Name">
                @error('bank_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Brunch Name -->
        <div class="row mb-3">
            <label for="brunch_name" class="col-sm-3 col-form-label">Brunch Name</label>
            <div class="col-sm-9">
                <input name="brunch_name" id="brunch_name" type="text"
                       class="form-control @error('brunch_name') is-invalid @enderror" value="{{ old('brunch_name', $rso->brunch_name) }}"
                       placeholder="Enter Brunch Name">
                @error('brunch_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Routing Number -->
        <div class="row mb-3">
            <label for="routing_number" class="col-sm-3 col-form-label">Routing Number</label>
            <div class="col-sm-9">
                <input name="routing_number" id="routing_number" type="number"
                       class="form-control @error('routing_number') is-invalid @enderror" value="{{ old('routing_number', $rso->routing_number) }}"
                       placeholder="Enter Routing Number">
                @error('routing_number') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>


        <!-- Education -->
        <div class="row mb-3">
            <label for="education" class="col-sm-3 col-form-label">Education</label>
            <div class="col-sm-9">
                <input name="education" id="education" type="text"
                       class="form-control @error('education') is-invalid @enderror" value="{{ old('education', $rso->education) }}"
                       placeholder="e.g SSC/HSC/Dakhil">
                @error('education') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>



        <!-- Resigning Date -->
        <div class="row mb-3">
            <label for="resigning_date" class="col-sm-3 col-form-label">Resigning Date</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <input name="resigning_date" id="resigning_date" type="text" value="{{ $rso->resigning_date }}" class="flatpickr form-control @error('resigning_date') is-invalid @enderror" placeholder="Select date">
                    <span class="input-group-text input-group-addon" data-toggle>
                            <i data-feather="calendar"></i>
                        </span>
                </div>
                @error('resigning_date') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Status -->
        <div class="row mb-3">
            <label for="status" class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
                <select name="status" class="form-select @error('status') is-invalid @enderror" id="status">
                    <option value="">-- Select Status --</option>
                    <option {{ $rso->status == 1 ? 'selected' : '' }} value="1">Active</option>
                    <option {{ $rso->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                </select>
                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Save Changes</button>
        <a href="{{ route('rso.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
    </form>


    @push('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('change','#dd_house_id',function (){
                    const id = $(this).val();

                    if (id === '')
                    {
                        $('#getSupervisor').html('<option value="">-- Select Supervisor --</option>');
                        $('#getUser').html('<option value="">-- Select User --</option>');
                        $('#getRoutes').html('<option value="">-- Select Routes --</option>');
                    }

                    // Get user, supervisors, route by dd house
                    $.ajax({
                        url: "{{ route('rso.get.users.supervisors.routes.by.dd.house') }}/" + id,
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: () => {
                            $('#loading').show();
                        },
                        complete: () => {
                            $('#loading').hide();
                        },
                        success: (response) => {
                            $('#getSupervisor').find('option:not(:first)').remove();
                            $('#getUser').find('option:not(:first)').remove();
                            $('#getRoutes').find('option:not(:first)').remove();

                            $.each(response.supervisor, function (key, value){
                                console.log(value);
                                $('#getSupervisor').append('<option value="'+ value.id +'">' + value.pool_number + ' - ' + value.user.name + '</option>')
                            });

                            $.each(response.user, function (key, value){
                                $('#getUser').append('<option value="'+ value.id +'">' + value.username + ' - ' + value.name + '</option>')
                            });

                            $.each(response.route, function (key, value){
                                $('#getRoutes').append('<option value="'+ value.id +'">' + value.code + ' - ' + value.name + '</option>')
                            });
                        }
                    });
                });
            });
        </script>
    @endpush

</x-app-layout>
