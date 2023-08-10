<x-app-layout>

    <!-- Title -->
    <x-slot:title>Update TCRC</x-slot:title>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Update Trade Campaign Retailer Code</h6>
            <form class="tcrcForm" action="{{ route('tcrc.update', $tcrc->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Retailer Code -->
                <div class="row mb-3">
                    <label for="retailer_id" class="col-sm-3 col-form-label">Retailer Code</label>
                    <div class="col-sm-9">
                        <select name="retailer_id" class="select-2 form-select" id="retailer_id">
                            <option value="">-- Select Retailer Code --</option>
                            @if(count($retailers) > 0)
                                @foreach($retailers as $retailer)
                                    <option @selected($tcrc->retailer_id == $retailer->id) value="{{ $retailer->id }}">{{ $retailer->dd_house .' - '. $retailer->code .' - '. $retailer->itop_number }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('retailer_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Flag -->
                <div class="row mb-3">
                    <label for="flag" class="col-sm-3 col-form-label">Flag</label>
                    <div class="col-sm-9">
                        <select name="flag" class="form-select" id="flag">
                            <option value="">-- Select Flag --</option>
                            <option @selected($tcrc->flag == 'rso') value="rso">RS0</option>
                            <option @selected($tcrc->flag == 'bp') value="bp">BP</option>
                            <option @selected($tcrc->flag == 'tmo') value="tmo">TMO</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Update TCRC</button>
                <a href="{{ route('tcrc.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
            </form>
        </div>
    </div>

</x-app-layout>
