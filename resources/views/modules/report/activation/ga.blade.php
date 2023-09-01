<x-app-layout>

    <!-- Title -->
    <x-slot:title>GA Target vs Achievement</x-slot:title>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Gross Add [GA]</h4>
            <div>
                <select id="findByHouse" class="select-2 form-select form-select-sm">
                    <option selected value="">-- Select House --</option>
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
