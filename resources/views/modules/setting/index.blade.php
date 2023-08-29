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

                        {{-- <input type="hidden" name="id" value="{{ $setting->id }}"> --}}

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
