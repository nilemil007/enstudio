<x-app-layout>

    <!-- Title -->
    <x-slot:title>GA Target vs Achievement</x-slot:title>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Gross Add [GA]</h4>
            <form>
                @csrf
                <input type="date" name="f_date" class="form-control form-control-sm">
                <input type="date" name="l_date" class="form-control form-control-sm">
                <select name="houseId" class="select-2 form-select form-select-sm">
                    <option selected value="">-- Select House --</option>
                    @foreach($ddHouses as $ddHouse)
                        <option @selected($ddHouse->id == request()->get('houseId')) value="{{ $ddHouse->id }}">{{ $ddHouse->code .' - '. $ddHouse->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-sm btn-primary" type="submit">Apply Filter</button>
            </form>
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
                    @forelse($rsos as $sl => $rso)
                        <tr>
                            <td>{{ ++$sl }}</td>
                            <td>{{ $rso->ddHouse->code }}</td>
                            <td>{{ $rso->itop_number  }}</td>
                            <td>{{ round(($rso->kpiTarget->ga ?? 0)) }}</td>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13">No house selected.</td>
                        </tr>
                    @endforelse

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
            {{--$(document).ready(function (){--}}
            {{--    $('#ga_filter').on('submit', function (e){--}}
            {{--        e.preventDefault();--}}

            {{--        $.ajax({--}}
            {{--            url: $(this).attr('action'),--}}
            {{--            type: $(this).attr('method'),--}}
            {{--            data: new FormData(this),--}}
            {{--            processData: false,--}}
            {{--            contentType: false,--}}
            {{--            beforeSend: function (){--}}
            {{--                --}}{{--$('#rsoErrMsg').addClass('d-none').find('li').remove();--}}
            {{--                --}}{{--$('.btn-submit').prop('disabled', true).text('Creating...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');--}}
            {{--            },--}}
            {{--            success: function(response){--}}
            {{--                if(response.data.length > 0)--}}
            {{--                {--}}
            {{--                    $('tbody').html(response.data);--}}
            {{--                }else{--}}
            {{--                    alert('all result.');--}}
            {{--                }--}}
            {{--            }--}}
            {{--        });--}}
            {{--    });--}}
            {{--});--}}
        </script>
    @endpush

</x-app-layout>
