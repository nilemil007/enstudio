<x-app-layout>

    <!-- Title -->
    <x-slot:title>Settings</x-slot:title>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Settings</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="shera-partner-tab" data-bs-toggle="tab" href="#sheraPartner" role="tab" aria-controls="sheraPartner" aria-selected="false">Shera Partner</a>
                </li>
            </ul>
            <div class="tab-content border border-top-0 p-3" id="myTabContent">
                <!-- General -->
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <form class="general-tab" action="{{ route('settings.general') }}" method="POST">
                    @csrf

                        <!-- DRC Code -->
                        <div class="row mb-3">
                            <label for="drc_code" class="col-sm-3 col-form-label">DRC Code</label>
                            <div class="col-sm-9">
                                <input name="drc_code" id="tags" value="{{ $setting->drc_code ?? null }}">
                            </div>
                        </div>

                        <!-- Exclude DRC Activation -->
                        <div class="row mb-3">
                            <label for="exclude_drc_act" class="col-sm-3 col-form-label">Exclude DRC Activation</label>
                            <div class="col-sm-9">
                                <!-- Exclude From Core Activaton -->
                                <div class="form-check form-switch">
                                    <input name="exclude_from_core_act" value="yes" @checked(!empty($setting->exclude_from_core_act)) class="form-check-input" type="checkbox" role="switch" id="exclude_from_core_act">
                                    <label class="form-check-label" for="exclude_from_core_act">Exclude From Core Activaton</label>
                                </div>

                                <!-- Exclude From Live Activaton -->
                                <div class="form-check form-switch">
                                    <input name="exclude_from_live_act" value="yes" @checked(!empty($setting->exclude_from_live_act)) class="form-check-input" type="checkbox" role="switch" id="exclude_from_live_act">
                                    <label class="form-check-label" for="exclude_from_live_act">Exclude From Live Activaton</label>
                                </div>
                            </div>
                        </div>

                        <!-- Default Product -->
                        <div class="row mb-3">
                            <label for="exclude_drc_act" class="col-sm-3 col-form-label">Default Product</label>
                            <div class="col-sm-9">
                                <!-- Desh Standard -->
                                <div class="form-check form-switch">
                                    <input name="product_code[]" value="MMST" @checked(in_array('MMST', $setting->product_code ?? [])) class="form-check-input" type="checkbox" role="switch" id="mmst">
                                    <label class="form-check-label" for="mmst">Desh Standard</label>
                                </div>

                                <!-- SIM SWAP -->
                                <div class="form-check form-switch">
                                    <input name="product_code[]" value="SIMSWAP" @checked(in_array('SIMSWAP', $setting->product_code ?? [])) class="form-check-input" type="checkbox" role="switch" id="simswap">
                                    <label class="form-check-label" for="simswap">SIM SWAP</label>
                                </div>

                                <!-- SIM SWAP E-voucher -->
                                <div class="form-check form-switch">
                                    <input name="product_code[]" value="EV-SWAP" @checked(in_array('EV-SWAP', $setting->product_code ?? [])) class="form-check-input" type="checkbox" role="switch" id="ev_swap">
                                    <label class="form-check-label" for="ev_swap">SIM SWAP E-voucher</label>
                                </div>

                                <!-- Special Mass Market Standard -->
                                <div class="form-check form-switch">
                                    <input name="product_code[]" value="MMSTS" @checked(in_array('MMSTS', $setting->product_code ?? [])) class="form-check-input" type="checkbox" role="switch" id="mmsts">
                                    <label class="form-check-label" for="mmsts">Special Mass Market Standard</label>
                                </div>
                            </div>
                        </div>

                        <!-- Default DD House -->
                        <div class="row mb-3">
                            <label for="dd_house" class="col-sm-3 col-form-label">Default DD House</label>
                            <div class="col-sm-9">
                                <select name="dd_house[]" class="select-2 form-select" id="dd_house" multiple>
                                    @if(count($ddHouses) > 0)
                                        @foreach($ddHouses as $house)
                                            <option
                                                @if(!empty($setting->dd_house))
                                                    @foreach ($setting->dd_house as $dd)
                                                        @selected($dd == $house->id)
                                                    @endforeach
                                                @endif
                                                value="{{ $house->id }}">{{ $house->code .' - '. $house->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Save Changes</button>
                    </form>
                </div>
                <!-- General End -->

                <!-- Shera Partner -->
                <div class="tab-pane fade" id="sheraPartner" role="tabpanel" aria-labelledby="shera-partner-tab">
                    <form class="shera-partner-tab" action="" method="POST">
                    @csrf

                        <!-- Shera Partner Day -->
                        <div class="row mb-3">
                            <label for="shera_partner_day" class="col-sm-3 col-form-label">Shera Partner Day</label>
                            <div class="col-sm-9">
                                <input name="shera_partner_day" id="shera_partner_day" type="number" class="form-control @error('shera_partner_day') is-invalid @enderror"
                                       placeholder="e.g. 10/20/30">
                                @error('shera_partner_day') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Shera Partner Percent -->
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Shera Partner Percent</label>
                            <div class="col-sm-9">
                                <input name="shera_partner_percent" id="shera_partner_percent" type="number" class="form-control @error('shera_partner_percent') is-invalid @enderror"
                                       placeholder="e.g. 30%/65%">
                                @error('shera_partner_percent') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Save Changes</button>
                    </form>
                </div>
                <!-- Shera Partner End -->
            </div>
        </div>
    </div>

</x-app-layout>
