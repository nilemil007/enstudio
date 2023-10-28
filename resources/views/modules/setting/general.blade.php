<x-app-layout>

    <!-- Title -->
    <x-slot:title>General Setting</x-slot:title>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">General Setting</h4>
        </div>
        <div class="card-body">
            <form class="general-tab" action="{{ route('settings.general.update') }}" method="POST">
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
                        <!-- Exclude From RS0 Activation -->
                        <div class="form-check form-switch">
                            <input name="exclude_from_rso_act" value="yes" @checked(!empty($setting->exclude_from_rso_act)) class="form-check-input" type="checkbox" role="switch" id="exclude_from_rso_act">
                            <label class="form-check-label" for="exclude_from_rso_act">Exclude From RS0 Activation</label>
                        </div>

                        <!-- Exclude From Live Activation -->
                        <div class="form-check form-switch">
                            <input name="exclude_from_live_act" value="yes" @checked(!empty($setting->exclude_from_live_act)) class="form-check-input" type="checkbox" role="switch" id="exclude_from_live_act">
                            <label class="form-check-label" for="exclude_from_live_act">Exclude From Live Activation</label>
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
    </div>

</x-app-layout>
