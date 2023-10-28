<x-app-layout>

    <!-- Title -->
    <x-slot:title>Shera Partner Setting</x-slot:title>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Shera Partner Setting</h4>
        </div>
        <div class="card-body">
            <!-- Shera Partner -->
            <form class="shera-partner-tab" action="{{ route('settings.shera.partner.update') }}" method="POST">
            @csrf

                <!-- Shera Partner Day -->
                <div class="row mb-3">
                    <label for="shera_partner_day" class="col-sm-3 col-form-label">Shera Partner Day</label>
                    <div class="col-sm-9">
                        <input name="shera_partner_day" value="{{ $setting->shera_partner_day ?? null }}" id="shera_partner_day" type="number" class="form-control" placeholder="e.g. 10/20/30">
                    </div>
                </div>

                <!-- Shera Partner Percent -->
                <div class="row mb-3">
                    <label for="shera_partner_percentage" class="col-sm-3 col-form-label">Shera Partner Percent</label>
                    <div class="col-sm-9">
                        <input name="shera_partner_percentage" value="{{ $setting->shera_partner_percentage ?? null }}" id="shera_partner_percentage" type="number" class="form-control" placeholder="e.g. 30%/65%">
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Save Changes</button>
            </form>
            <!-- Shera Partner End -->
        </div>
    </div>

</x-app-layout>
