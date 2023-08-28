<x-app-layout>

    <!-- Title -->
    <x-slot:title>GA Target vs Achievement</x-slot:title>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Gross Add [GA]</h4>
            <div>
                <select id="findByHouse" class="select-2 form-select form-select-sm">
                    <option selected value="all">All House</option>
                    @foreach($ddHouses as $ddHouse)
                        <option value="{{ $ddHouse->id }}">{{ $ddHouse->code .' - '. $ddHouse->name }}</option>
                    @endforeach
                </select>
            </div>
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
                        <th>ga target [30%]</th>
                        <th>ach</th>
                        <th>ach %</th>
                        <th>remain</th>
                        <th>daily req</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($rsos as $sl => $rso)
                        <tr>
                            <td>{{ ++$sl }}</td>
                            <td>{{ $rso->ddHouse->code }}</td>                                                                                  <!-- DD Code -->
                            <td>{{ $rso->itop_number }}</td>                                                                                    <!-- Rso Itop Number -->
                            <td>{{ round($rso->kpiTarget->ga ?? 0) }}</td>                                                                      <!-- GA Target -->
                            <td>{{ round($rso->coreActivation->count()) }}</td>                                                                 <!-- Achievement -->
                            <td>{{ round(($rso->coreActivation->count() ?? 0) / ($rso->kpiTarget->ga ?? 0) * 100) . '%' }}</td>                 <!-- Ach % -->
                            <td>{{ round($rso->kpiTarget->ga ?? 0) - $rso->coreActivation->count() }}</td>                                      <!-- Remaining -->
                            <td>{{ round((($rso->kpiTarget->ga ?? 0) - $rso->coreActivation->count()) / $restOfDay) }}</td>                     <!-- Daily Required -->
                            <td>{{ round(($rso->kpiTarget->ga ?? 0) * 30 / 100) }}</td>                                                         <!-- GA Target [Shera Partner] -->
                            <td>{{ round($rso->coreActivation->count() ?? 0) }}</td>                                                            <!-- Achievement [Shera Partner] -->
                            <td>{{ round($rso->coreActivation->count() ?? 0 / (($rso->kpiTarget->ga ?? 0) * 30 / 100 ?? 0) * 100) . '%' }}</td> <!-- Ach % [Shera Partner] -->
                            <td>{{ round((($rso->kpiTarget->ga ?? 0) * 30 / 100 ?? 0) - $rso->coreActivation->count()) }}</td>                  <!-- Remaining [Shera Partner] -->
                            <td>{{ round(((($rso->kpiTarget->ga ?? 0) * 30 / 100 ?? 0) - $rso->coreActivation->count()) / $restOfDay) }}</td>   <!-- Daily Required [Shera Partner] -->
                        </tr>
                        @endforeach
                        <tr style="font-weight: bold">
                            <td colspan="3">Grand Total</td>
                            <td>{{ $sumOfTotalTarget }}</td>        <!-- GA Target -->
                            <td>{{ $sumOfTotalActivation }}</td>    <!-- Achievement -->
                            <td>{{ $achPercent }}</td>              <!-- Ach % -->
                            <td>{{ $remaining }}</td>               <!-- Remaining -->
                            <td>{{ $dailyRequired }}</td>           <!-- Daily Required -->
                            <td>{{ $spGaTarget }}</td>              <!-- GA Target [Shera Partner] -->
                            <td>{{ $sumOfTotalActivation }}</td>    <!-- Achievement [Shera Partner] -->
                            <td>{{ $spAchPercent }}</td>            <!-- Ach % [Shera Partner] -->
                            <td>{{ $spRemaining }}</td>             <!-- Remaining [Shera Partner] -->
                            <td>{{ $spDailyRequired }}</td>         <!-- Daily Required [Shera Partner] -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function (){
                $('#findByHouse').on('change', function (){
                    const id = $(this).val();

                    $.ajax({
                        url: "{{ route('daily.report.ga') }}",
                        type: "GET",
                        data: {'id':id},
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
