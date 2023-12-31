<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update BTS</x-slot:title>

    <div id="btsUpdateErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Update BTS</h6>
            <form id="btsUpdateForm" action="{{ route('bts.update', $bt->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Distribution House -->
                <div class="row mb-3">
                    <label for="dd_house" class="col-sm-3 col-form-label">Distribution House <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="dd_house" class="form-select @error('dd_house') is-invalid @enderror" id="dd_house">
                            <option value="">-- Select Distribution House --</option>
                            @if(count($houses) > 0)
                                @foreach($houses as $house)
                                    <option @selected($bt->dd_house == $house->code) value="{{ $house->code }}">{{ $house->code .' - '. $house->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('dd_house') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Site Id -->
                <div class="row mb-3">
                    <label for="site_id" class="col-sm-3 col-form-label">Site Id <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="site_id" id="site_id" type="text"
                               class="form-control @error('site_id') is-invalid @enderror" value="{{ old('site_id', $bt->site_id) }}"
                               placeholder="Enter Site Id">
                        @error('site_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- BTS Code -->
                <div class="row mb-3">
                    <label for="bts_code" class="col-sm-3 col-form-label">BTS Code <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="bts_code" id="bts_code" type="text"
                               class="form-control @error('bts_code') is-invalid @enderror" value="{{ old('bts_code', $bt->bts_code) }}"
                               placeholder="Enter BTS Code">
                        @error('bts_code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Division -->
                <div class="row mb-3">
                    <label for="division" class="col-sm-3 col-form-label">Division <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="division" id="division" type="text" class="form-control @error('division') is-invalid @enderror"
                               value="{{ old('division', $bt->division) }}" placeholder="Enter Division">
                        @error('division') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- District -->
                <div class="row mb-3">
                    <label for="district" class="col-sm-3 col-form-label">District <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="district" id="district" type="text" class="form-control @error('district') is-invalid @enderror"
                               value="{{ old('district', $bt->district) }}" placeholder="Enter District">
                        @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Thana -->
                <div class="row mb-3">
                    <label for="thana" class="col-sm-3 col-form-label">Thana <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="thana" id="thana" type="text" class="form-control @error('thana') is-invalid @enderror"
                               value="{{ old('thana', $bt->thana) }}" placeholder="Enter Thana">
                        @error('thana') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="row mb-3">
                    <label for="address" class="col-sm-3 col-form-label">Address <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="address" id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                               value="{{ old('address', $bt->address) }}" placeholder="Enter Address">
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Network Mode -->
                <div class="row mb-3">
                    <label for="network_mode" class="col-sm-3 col-form-label">Network Mode <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="network_mode" id="network_mode" type="text" class="form-control @error('network_mode') is-invalid @enderror"
                               value="{{ old('network_mode', $bt->network_mode) }}" placeholder="Enter Network Mode">
                        @error('network_mode') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Longitude -->
                <div class="row mb-3">
                    <label for="longitude" class="col-sm-3 col-form-label">Longitude</label>
                    <div class="col-sm-9">
                        <input name="longitude" id="longitude" type="text"
                               class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude', $bt->longitude) }}"
                               placeholder="Enter Longitude">
                        @error('longitude') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Latitude -->
                <div class="row mb-3">
                    <label for="latitude" class="col-sm-3 col-form-label">Latitude</label>
                    <div class="col-sm-9">
                        <input name="latitude" id="latitude" type="text"
                               class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude', $bt->latitude) }}"
                               placeholder="Enter Latitude">
                        @error('latitude') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- 2G on air Date -->
                <div class="row mb-3">
                    <label for="two_g_on_air_date" class="col-sm-3 col-form-label">2G On Air Date</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input name="two_g_on_air_date" id="two_g_on_air_date" type="text" value="{{ $bt->two_g_on_air_date }}" class="flatpickr form-control @error('two_g_on_air_date') is-invalid @enderror" placeholder="Select date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                <i data-feather="calendar"></i>
                            </span>
                        </div>
                        @error('two_g_on_air_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- 3G on air Date -->
                <div class="row mb-3">
                    <label for="three_g_on_air_date" class="col-sm-3 col-form-label">3G On Air Date</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input name="three_g_on_air_date" id="three_g_on_air_date" value="{{ $bt->three_g_on_air_date }}" type="text" class="flatpickr form-control @error('three_g_on_air_date') is-invalid @enderror" placeholder="Select date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                        </div>
                        @error('three_g_on_air_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- 4G on air Date -->
                <div class="row mb-3">
                    <label for="four_g_on_air_date" class="col-sm-3 col-form-label">4G On Air Date</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input name="four_g_on_air_date" id="four_g_on_air_date" value="{{ $bt->four_g_on_air_date }}" type="text" class="flatpickr form-control @error('four_g_on_air_date') is-invalid @enderror" placeholder="Select date">
                            <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                        </div>
                        @error('four_g_on_air_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Urban Rural -->
                <div class="row mb-3">
                    <label for="urban_rural" class="col-sm-3 col-form-label">Urban Rural <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input name="urban_rural" id="urban_rural" type="text" class="form-control @error('urban_rural') is-invalid @enderror"
                               value="{{ old('urban_rural', $bt->urban_rural) }}" placeholder="Enter Urban Rural">
                        @error('urban_rural') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Save Changes</button>
                <a href="{{ route('bts.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>

</x-app-layout>
