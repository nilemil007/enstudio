<x-app-layout>

    <!-- Title -->
    <x-slot:title>Activation Summary</x-slot:title>

    <div class="card mb-3">
        <div class="card-header">Data Filter</div>
        <div class="card-body">
            <form id="activationFilter" action="{{ route('report.activation.summary') }}" method="GET" class="row g-3">
                <!-- Start Date -->
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}" id="start_date" required>
                </div>
                <!-- End Date -->
                <div class="col-md-6">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" class="form-control" id="end_date" required>
                </div>
                <!-- DD House -->
                <div class="col-md-6">
                    <label for="houseId" class="form-label">DD House</label>
                    <select name="houseId" class="select-2 form-select form-select-sm" id="houseId">
                        <option selected value="">-- Select House --</option>
                        @foreach($ddHouses as $ddHouse)
                            <option @selected($ddHouse->id == request()->get('houseId')) value="{{ $ddHouse->id }}">{{ $ddHouse->code .' - '. $ddHouse->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Search Box -->
                <div class="col-md-6">
                    <label for="search" class="form-label">Search Box</label>
                    <input class="form-control" type="text" name="search" id="search" value="{{ request()->get('search') }}" placeholder="Type something...">
                </div>
                <!-- Button -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                </div>
            </form>
        </div>
    </div>

    @if(isset($retailerCode))
        <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Activation Summary</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>retailer code</th>
                        <th>total activation</th>
                        @for($i = $startDate; $i <= $endDate; $i++)
                            <th>{{ date('d M', strtotime($i)) }}</th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
{{--                    @forelse( $retailerCode as $sl => $retailer )--}}
{{--                        <tr>--}}
{{--                            <td><span class="text-muted">{{ ++$sl }}</span></td>--}}
{{--                            <td>{{ $retailer->code }}</td>--}}
{{--                            <td><strong>{{ \App\Models\Activation\CoreActivation::getRetailerTotalActivation($retailer->id) }}</strong></td>--}}
{{--                            @for ($a = $startDate; $a <= $endDate; $a++)--}}
{{--                            <td>{{ \App\Models\Activation\CoreActivation::getRetailerActivationByDate($retailer->id, $a) }}</td>--}}
{{--                            @endfor--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                        <tr>--}}
{{--                            <td>No data found.</td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $retailerCode->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif

    @push('scripts')
        <script>
            $(document).ready(function (){
                $(document).on('submit','#activationFilter',function (e){
                    e.preventDefault();

                    const startDate = $('#start_date').val();
                    const endDate = $('#end_date').val();
                    const houseId = $('#houseId').val();
                    const search = $('#search').val();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: {
                            startDate:startDate,
                            endDate:endDate,
                            houseId:houseId,
                            search:search,
                        },
                        success: function(response){
                            if(response.data.length > 0)
                            {
                                $('tbody').html(response.data);
                            }else{
                                alert('all result.');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
