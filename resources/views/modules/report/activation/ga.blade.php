<x-app-layout>

    <!-- Title -->
    <x-slot:title>GA Target vs Achievement</x-slot:title>

    <div class="card mb-3">
        <div class="card-header">Data Filter</div>
        <div class="card-body">
            <form id="gaFilter" action="{{ route('daily.report.ga') }}" method="GET" class="row g-3">
                <!-- Start Date -->
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="" id="start_date">
                </div>
                <!-- End Date -->
                <div class="col-md-6">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" id="end_date">
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
                <!-- Rso -->
                <div class="col-md-6">
                    <label for="get_rso" class="form-label">Rso</label>
                    <select name="rso_id" class="select-2 form-select" id="get_rso">
                        <option value="">-- Select Rso --</option>
                    </select>
                </div>
                <!-- Button -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Gross Add [GA]</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>dd code</th>
                            <th>rso number</th>
                            <th>ga target</th>
                            <th>ach</th>
                            <th>ach %</th>
                            <th>remain</th>
                            <th>daily req</th>
                            <th>
                                <p>ga target</p>
                                <p class="text-muted">
                                    {{ $setting->shera_partner_day }} day, {{ $setting->shera_partner_percentage . '%' }}
                                </p>
                            </th>
                            <th>ach</th>
                            <th>ach %</th>
                            <th>remain</th>
                            <th>daily req</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="13">No house selected.</td>
                        </tr>
{{--                    @forelse($rsos as $sl => $rso)--}}
{{--                        <tr>--}}
{{--                            <td>{{ ++$sl }}</td>--}}
{{--                            <td>{{ $rso->ddHouse->code }}</td>--}}
{{--                            <td>{{ $rso->itop_number  }}</td>--}}
{{--                            <td>{{ round(($rso->kpiTarget->ga ?? 0)) }}</td>--}}
{{--                            <td>{{  }}</td>--}}
{{--                            <td>{{  }}</td>--}}
{{--                            <td>{{  }}</td>--}}
{{--                            <td>{{  }}</td>--}}
{{--                            <td>{{  }}</td>--}}
{{--                            <td>{{  }}</td>--}}
{{--                            <td>{{  }}</td>--}}
{{--                            <td>{{  }}</td>--}}
{{--                            <td>{{  }}</td>--}}
{{--                            <td>{{  }}</td>--}}
{{--                            <td>{{  }}</td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                        <tr>--}}
{{--                            <td colspan="13">No house selected.</td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}

                    <tr>
                        <td colspan="3">Grand Total</td>
                        <td>{{ ($totalTarget ?? 0) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function (){
                // Get house wise rso
               $(document).on('change','#houseId',function (){
                   const id = $(this).val();

                   if (id === '')
                   {
                       $('#get_rso').html('<option value="">-- Select Rso --</option>');
                   }

                   // Get rso by dd house
                   $.ajax({
                       url: "{{ route('daily.report.get.rso') }}/" + id,
                       type: 'POST',
                       dataType: 'JSON',
                       success: function (response){
                           $('#get_rso').find('option:not(:first)').remove();

                           $.each(response.rso, function (key, value){
                               $('#get_rso').append('<option value="'+ value.id +'">' + value.itop_number + ' - ' + value.user.name + '</option>')
                           });
                       }
                   });
               });

                $(document).on('submit','#gaFilter', function (e){
                    e.preventDefault();

                    const startDate = $('#start_date').val();
                    const endDate = $('#end_date').val();
                    const houseId = $('#houseId').val();
                    const get_rso = $('#get_rso').val();

                    // console.log($(this).attr('action'));

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: {
                            startDate:startDate,
                            endDate:endDate,
                            houseId:houseId,
                            get_rso:get_rso,
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
