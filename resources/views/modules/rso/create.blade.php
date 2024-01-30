<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Rso</x-slot:title>

    <div id="rsoErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="row">
        <div class="col-md-12">
            <form id="rsoForm" action="{{ route('rso.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card mb-3 border-success">
                    <div class="card-header text-bg-success">Basic Information</div>
                    <div style="background-color: #a3ffb22e" class="card-body">
                        <!-- Distribution House -->
                        <div class="row mb-3">
                            <label for="dd_house_id" class="col-sm-3 col-form-label">Distribution House <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="dd_house_id" class="select-2 form-select" id="dd_house_id">
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

                        <!-- Supervisor -->
                        <div class="row mb-3">
                            <label for="get_supervisor" class="col-sm-3 col-form-label">Supervisor <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="supervisor_id" class="select-2 form-select" id="get_supervisor">
                                    <option value="">-- Select Supervisor --</option>
                                </select>
                                @error('supervisor_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- User -->
                        <div class="row mb-3">
                            <label for="get_user" class="col-sm-3 col-form-label">User <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="user_id" class="select-2 form-select" id="get_user">
                                    <option value="">-- Select User --</option>
                                </select>
                                @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Route -->
                        <div class="row mb-3">
                            <label for="get_routes" class="col-sm-3 col-form-label">Route <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="routes[]" class="select-2 form-select" id="get_routes" multiple>
                                    <option value="">-- Select Route --</option>
                                </select>
                                @error('routes') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3 border-success">
                    <div class="card-header text-bg-success">Primary Information</div>
                    <div style="background-color: #a3ffb22e" class="card-body">
                        <!-- Rso Code -->
                        <div class="row mb-3">
                            <label for="rso_code" class="col-sm-3 col-form-label">Rso Code <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="rso_code" id="rso_code" type="text" class="form-control" value="{{ old('rso_code') }}" placeholder="Enter Rso Code">
                                @error('rso_code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Itop Number -->
                        <div class="row mb-3">
                            <label for="itop_number" class="col-sm-3 col-form-label">Itop Number <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="itop_number" id="itop_number" type="number" class="form-control" value="{{ old('itop_number') }}" placeholder="Enter Itop Number">
                                @error('itop_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Pool Number -->
                        <div class="row mb-3">
                            <label for="pool_number" class="col-sm-3 col-form-label">Pool Number <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="pool_number" id="pool_number" type="number" class="form-control" value="{{ old('pool_number') }}" placeholder="Enter Pool Number">
                                @error('pool_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- SR-No -->
                        <div class="row mb-3">
                            <label for="sr_no" class="col-sm-3 col-form-label">SR-No <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="sr_no" id="sr_no" type="text" class="form-control" value="{{ old('sr_no') }}" placeholder="Enter SR-No">
                                @error('sr_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Residential Rso -->
                        <div class="row mb-3">
                            <label for="residential_rso" class="col-sm-3 col-form-label">Residential Rso <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="residential_rso" class="form-select" id="residential_rso">
                                    <option value="">-- Select Residential Rso --</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                @error('residential_rso') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Joining Date -->
                        <div class="row mb-3">
                            <label for="joining_date" class="col-sm-3 col-form-label">Joining Date <span class="text-danger">*</span></label>
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
                                    <input name="date" id="date" value="{{ now() }}" type="text" class="flatpickr form-control" placeholder="Select date">
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
                                <input name="rid" id="rid" type="text" class="form-control" value="{{ old('rid') }}" placeholder="Enter RID">
                                @error('rid') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Rso Name -->
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Rso Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="name" id="name" type="text" class="form-control" value="{{ old('name') }}" placeholder="Enter Rso Name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Father Name -->
                        <div class="row mb-3">
                            <label for="father_name" class="col-sm-3 col-form-label">Father Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="father_name" id="father_name" type="text" class="form-control" value="{{ old('father_name') }}" placeholder="Enter Father Name">
                                @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Mother Name -->
                        <div class="row mb-3">
                            <label for="mother_name" class="col-sm-3 col-form-label">Mother Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="mother_name" id="mother_name" type="text" class="form-control" value="{{ old('mother_name') }}" placeholder="Enter Mother Name">
                                @error('mother_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Division -->
                        <div class="row mb-3">
                            <label for="division" class="col-sm-3 col-form-label">Division <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="division" id="division" type="text" class="form-control" value="{{ old('division') }}" placeholder="Enter Division">
                                @error('division') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- District -->
                        <div class="row mb-3">
                            <label for="district" class="col-sm-3 col-form-label">District <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="district" id="district" type="text" class="form-control" value="{{ old('district') }}" placeholder="Enter District">
                                @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Thana -->
                        <div class="row mb-3">
                            <label for="thana" class="col-sm-3 col-form-label">Thana <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="thana" id="thana" type="text" class="form-control" value="{{ old('thana') }}" placeholder="Enter Thana">
                                @error('thana') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Present Address -->
                        <div class="row mb-3">
                            <label for="present_address" class="col-sm-3 col-form-label">Present Address <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="present_address" id="present_address" type="text" class="form-control" value="{{ old('present_address') }}" placeholder="Enter Present Address">
                                @error('present_address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Permanent Address -->
                        <div class="row mb-3">
                            <label for="permanent_address" class="col-sm-3 col-form-label">Permanent Address <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="permanent_address" id="permanent_address" type="text" class="form-control" value="{{ old('permanent_address') }}" placeholder="Enter Permanent Address">
                                @error('permanent_address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Witness Name -->
                        <div class="row mb-3">
                            <label for="witness_name" class="col-sm-3 col-form-label">Witness Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="witness_name" id="witness_name" type="text" class="form-control" value="{{ old('witness_name') }}" placeholder="Enter Witness Name">
                                @error('witness_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Witness Number -->
                        <div class="row mb-3">
                            <label for="witness_number" class="col-sm-3 col-form-label">Witness Number <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="witness_number" id="witness_number" type="number" class="form-control" value="{{ old('witness_number') }}" placeholder="Enter Witness Number">
                                @error('witness_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Salary -->
                        <div class="row mb-3">
                            <label for="salary" class="col-sm-3 col-form-label">Salary <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="salary" id="salary" type="number" class="form-control" value="{{ old('salary') }}" placeholder="Enter Salary">
                                @error('salary') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Employee Signature -->
                        <div class="row mb-3">
                            <label for="employee_signature" class="col-sm-3 col-form-label">Employee Signature <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="employee_signature" id="employee_signature" type="file" class="form-control" accept="image/png">
                                @error('employee_signature') <span class="text-danger">{{ $message }}</span> @enderror
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
                                <input name="personal_number" id="personal_number" type="number" class="form-control" value="{{ old('personal_number') }}" placeholder="Enter Personal Number">
                                @error('personal_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- D.O.B -->
                        <div class="row mb-3">
                            <label for="dob" class="col-sm-3 col-form-label">Date Of Birth <span class="text-danger">*</span></label>
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

                        <!-- NID -->
                        <div class="row mb-3">
                            <label for="nid" class="col-sm-3 col-form-label">NID <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="nid" id="nid" type="number" class="form-control" value="{{ old('nid') }}" placeholder="Enter NID Number">
                                @error('nid') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Blood Group -->
                        <div class="row mb-3">
                            <label for="blood_group" class="col-sm-3 col-form-label">Blood Group <span class="text-danger">*</span></label>
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

                        <!-- Marital Status -->
                        <div class="row mb-3">
                            <label for="marital_status" class="col-sm-3 col-form-label">Marital Status <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="marital_status" class="form-select" id="marital_status">
                                    <option value="">-- Select Marital Status --</option>
                                    <option value="married">Married</option>
                                    <option value="unmarried">Unmarried</option>
                                </select>
                                @error('marital_status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Nationality -->
                        <div class="row mb-3">
                            <label for="nationality" class="col-sm-3 col-form-label">Nationality <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="nationality" id="nationality" type="text" class="form-control" value="{{ old('nationality', 'Bangladeshi (By Birth)') }}" placeholder="Enter Nationality">
                                @error('nationality') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Religion -->
                        <div class="row mb-3">
                            <label for="religion" class="col-sm-3 col-form-label">Religion <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="religion" id="religion" type="text" class="form-control" value="{{ old('religion', 'Islam') }}" placeholder="Enter Religion">
                                @error('religion') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="row mb-3">
                            <label for="gender" class="col-sm-3 col-form-label">Gender <span class="text-danger">*</span></label>
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

                        <!-- Place Of Birth -->
                        <div class="row mb-3">
                            <label for="place_of_birth" class="col-sm-3 col-form-label">Place Of Birth <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="place_of_birth" id="place_of_birth" type="text" class="form-control" value="{{ old('place_of_birth') }}" placeholder="Enter Place Of Birth">
                                @error('place_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Rso Image -->
                        <div class="row mb-3">
                            <label for="rso_image" class="col-sm-3 col-form-label">Rso Image <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="rso_image" id="rso_image" type="file" class="form-control" accept="image/jpeg, image/png">
                                @error('rso_image') <span class="text-danger">{{ $message }}</span> @enderror
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
                                <select x-model="education" class="form-select" name="education" id="education">
                                    <option value="" selected>-- Select Examination --</option>
                                    <option value="junior school certificate.jsc">JSC</option>
                                    <option value="secondary school certificate.ssc">SSC</option>
                                    <option value="secondary school certificate.ssc.1999">SSC (1999)</option>
                                    <option value="higher secondary certificate.hsc">HSC</option>
                                    <option value="higher secondary certificate.hsc.technical">HSC (Technical)</option>
                                    <option value="dakhil examination.dakhil">Dakhil</option>
                                    <option value="secondary school certificate.ssc.bou">Bangladesh Open University (SSC)</option>
                                </select>
                                @error('education') <span class="text-danger">{{ $message }}</span> @enderror
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

                <div class="card mb-3 border-success">
                    <div class="card-header text-bg-success">Account Information</div>
                    <div style="background-color: #a3ffb22e" class="card-body">
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

                        <!-- Routing Number -->
                        <div class="row mb-3">
                            <label for="routing_number" class="col-sm-3 col-form-label">Routing Number</label>
                            <div class="col-sm-9">
                                <input name="routing_number" id="routing_number" type="number"
                                       class="form-control" value="{{ old('routing_number') }}" placeholder="Enter Routing Number">
                                @error('routing_number') <span class="text-danger">{{ $message }}</span> @enderror
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
                    </div>
                </div>

                <div class="card mb-3 border-success">
                    <div class="card-header text-bg-success">Nominee Information</div>
                    <div style="background-color: #a3ffb22e" class="card-body">
                        <!-- Nominee Name -->
                        <div class="row mb-3">
                            <label for="nominee_name" class="col-sm-3 col-form-label">Nominee Name (In Bangla) <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="nominee_name" id="nominee_name" type="text"
                                       class="form-control" value="{{ old('nominee_name') }}" placeholder="Nominee Name In Bangla">
                                @error('nominee_name') <span class="text-danger">{{ $message }}</span> @enderror
                                <small class="text-muted">বাংলায় নমিনির পুরো নাম লিখুন।</small>
                            </div>
                        </div>

                        <!-- Relation -->
                        <div class="row mb-3">
                            <label for="nominee_relation" class="col-sm-3 col-form-label">Relation (In Bangla) <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="nominee_relation" id="nominee_relation" type="text"
                                       class="form-control" value="{{ old('nominee_relation') }}" placeholder="Relation In Bangla">
                                @error('nominee_relation') <span class="text-danger">{{ $message }}</span> @enderror
                                <small class="text-muted">RS0র সাথে নমিনির সম্পর্ক।</small>
                            </div>
                        </div>

                        <!-- Contact Number -->
                        <div class="row mb-3">
                            <label for="nominee_contact_no" class="col-sm-3 col-form-label">Contact Number (In Bangla) <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="nominee_contact_no" id="nominee_contact_no" type="text"
                                       class="form-control" value="{{ old('nominee_contact_no') }}" placeholder="Contact Number In Bangla">
                                @error('nominee_contact_no') <span class="text-danger">{{ $message }}</span> @enderror
                                <small class="text-muted">নমিনির মোবাইল নাম্বার লিখুন।</small>
                            </div>
                        </div>

                        <!-- Nominee Address -->
                        <div class="row mb-3">
                            <label for="nominee_address" class="col-sm-3 col-form-label">Nominee Address (In Bangla) <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="nominee_address" id="nominee_address" type="text"
                                       class="form-control" value="{{ old('nominee_address') }}" placeholder="Nominee Address In Bangla">
                                @error('nominee_address') <span class="text-danger">{{ $message }}</span> @enderror
                                <small class="text-muted">বাংলায় নমিনির ঠিকানা লিখুন।</small>
                            </div>
                        </div>

                        <!-- RS0 Name (In Bangla) -->
                        <div class="row mb-3">
                            <label for="rso_name_bangla" class="col-sm-3 col-form-label">RS0 Name (In Bangla) <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="rso_name_bangla" id="rso_name_bangla" type="text"
                                       class="form-control" value="{{ old('rso_name_bangla') }}" placeholder="RS0 Name In Bangla">
                                @error('rso_name_bangla') <span class="text-danger">{{ $message }}</span> @enderror
                                <small class="text-muted">বাংলায় আর এস ও এর নাম লিখুন।</small>
                            </div>
                        </div>

                        <!-- Nominee D.O.B -->
                        <div class="row mb-3">
                            <label for="nominee_dob" class="col-sm-3 col-form-label">Nominee DOB <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input name="nominee_dob" id="nominee_dob" type="text" class="flatpickr form-control" placeholder="Select date">
                                    <span class="input-group-text input-group-addon" data-toggle>
                                <i data-feather="calendar"></i>
                            </span>
                                </div>
                                @error('nominee_dob') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Nominee NID -->
                        <div class="row mb-3">
                            <label for="nominee_nid" class="col-sm-3 col-form-label">Nominee NID <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="nominee_nid" id="nominee_nid" type="number"
                                       class="form-control" value="{{ old('nominee_nid') }}" placeholder="Enter Nominee NID Number">
                                @error('nominee_nid') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Nominee Image -->
                        <div class="row mb-3">
                            <label for="nominee_image" class="col-sm-3 col-form-label">Nominee Image <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="nominee_image" id="nominee_image" type="file" class="form-control" accept="image/png, image/jpeg">
                                @error('nominee_image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Nominee Signature -->
                        <div class="row mb-3">
                            <label for="nominee_signature" class="col-sm-3 col-form-label">Nominee Signature <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="nominee_signature" id="nominee_signature" type="file" class="form-control" accept="image/png">
                                @error('nominee_signature') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Witness Name -->
                        <div class="row mb-3">
                            <label for="nominee_witness_name" class="col-sm-3 col-form-label">Witness Name (In Bangal) <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="nominee_witness_name" id="nominee_witness_name" type="text"
                                       class="form-control" value="{{ old('nominee_witness_name') }}" placeholder="Witness Name In Bangla">
                                @error('nominee_witness_name') <span class="text-danger">{{ $message }}</span> @enderror
                                <small class="text-muted">বাংলায় সাক্ষীর নাম লিখুন।</small>
                            </div>
                        </div>

                        <!-- Witness Designation -->
                        <div class="row mb-3">
                            <label for="nominee_witness_designation" class="col-sm-3 col-form-label">Witness Designation (In Bangal) <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="nominee_witness_designation" id="nominee_witness_designation" type="text"
                                       class="form-control" value="{{ old('nominee_witness_designation') }}" placeholder="Witness Designation In Bangla">
                                @error('nominee_witness_designation') <span class="text-danger">{{ $message }}</span> @enderror
                                <small class="text-muted">বাংলায় সাক্ষীর পদবী লিখুন।</small>
                            </div>
                        </div>

                        <!-- Witness Signature -->
                        <div class="row mb-3">
                            <label for="nominee_witness_signature" class="col-sm-3 col-form-label">Witness Signature <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input name="nominee_witness_signature" id="nominee_witness_signature" type="file" class="form-control" accept="image/png">
                                @error('nominee_witness_signature') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-success me-2 btn-submit">Create New Rso</button>
                <a href="{{ route('rso.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>

        <div class="col-md-12">
            <div class="card mb-3">
                @if(session()->has('import_errors'))
                    @foreach(session()->get('import_errors') as $failure)
                        <div class="card-header">
                            <div class="alert alert-danger">
                                <p>Rso: <strong>{{ $failure->values()['itop_number'] }}</strong></p>
                                <p>Error type: <strong>{{ \Illuminate\Support\Str::title(implode(' ', explode('_', $failure->attribute()))) }}</strong></p>
                                <p>Error msg: {{ $failure->errors()[0] }} </p>
                                <p>Row number : {{ $failure->row() }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="card-body">
                    <h6 class="card-title">Import Rso</h6>
                    <form class="row gy-2 gx-3 align-items-center import-rso" action="{{ route('rso.import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label class="visually-hidden" for="autoSizingInput">Name</label>
                            <input name="import_rso" type="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary w-100 mt-2 btn-import-rso">Import Rso</button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('rso.sample.file.download') }}" class="nav-link text-muted">Download sample file.</a>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('change','#dd_house_id',function (){
                    const houseId = $(this).val();

                    if (houseId === '')
                    {
                        $('#get_supervisor').html('<option value="">-- Select Supervisor --</option>');
                        $('#get_user').html('<option value="">-- Select User --</option>');
                        $('#get_routes').html('<option value="">-- Select Routes --</option>');
                    }

                    // Get user, supervisors, route by dd house
                    $.ajax({
                        url: "{{ route('rso.get.users.supervisors.routes.by.dd.house') }}/" + houseId,
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: () => {
                            $('#loading').show();
                        },
                        complete: () => {
                            $('#loading').hide();
                        },
                        success: (response) => {
                            $('#get_user').find('option:not(:first)').remove();
                            $('#get_supervisor').find('option:not(:first)').remove();
                            $('#get_routes').find('option:not(:first)').remove();

                            $.each(response.user, function (key, value){
                                $('#get_user').append('<option value="'+ value.id +'">' + value.phone + ' - ' + value.name + '</option>')
                            });

                            $.each(response.supervisor, function (key, value){
                                $('#get_supervisor').append('<option value="'+ value.id +'">' + value.pool_number + ' - ' + value.user.name + '</option>')
                            });

                            $.each(response.route, function (key, value){
                                $('#get_routes').append('<option value="'+ value.id +'">' + value.code + ' - ' + value.name + '</option>')
                            });
                        }
                    });
                });

                // Validation
                $('.userForm').validate({
                    rules: {
                        name: {
                            required: true,
                            maxlength: 100,
                            minlength: 3,
                        },
                        username: {
                            required: true,
                            maxlength: 30,
                            minlength: 3,
                        },
                        phone: {
                            required: true,
                            number: true,
                            maxlength: 11,
                            minlength: 11,
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        role: {
                            required: true,
                        },
                        password: {
                            required: true,
                            minlength: 8,
                        },
                        image: {
                            accept: "image/*",
                        },
                    },
                    messages: {

                    },
                });

            });
        </script>
    @endpush

</x-app-layout>
