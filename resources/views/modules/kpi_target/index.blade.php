<x-app-layout>

    <!-- Title -->
    <x-slot:title>KPI Target</x-slot:title>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title">KPI Target</h4>
            <span>
                <a href="{{ route('kpi-target.create') }}" class="btn btn-sm btn-primary">Add New</a>
                @if(count($kpiTargets) > 1)
                    <a id="deleteAllKpiTarget" href="{{ route('kpi-target.delete.all') }}" class="btn btn-sm btn-danger">Delete all</a>
                @endif
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="kpiTargetTbl" class="table table-sm table-bordered table-hover table-vcenter text-nowrap mt-3 mb-3">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>dd code</th>
                        <th>manager</th>
                        <th>supervisor</th>
                        <th>rso number</th>
                        <th>ga</th>
                        <th>recharge</th>
                        <th>data</th>
                        <th>mixed</th>
                        <th>voice</th>
                        <th>total bundle</th>
                        <th>sso</th>
                        <th>lso</th>
                        <th>bso</th>
                        <th>dsso</th>
                        <th>ddso</th>
                        <th>dso</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $kpiTargets as $sl => $target )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $target->ddHouse->code }}</td>
                            <td>{{ $target->user->name }}</td>
                            <td>{{ $target->supervisor->user->name }}</td>
                            <td>{{ $target->rso->itop_number }}</td>
                            <td>{{ number_format((float)$target->ga) }}</td>
                            <td>{{ round((float)$target->recharge) }}</td>
                            <td>{{ round((float)$target->data) }}</td>
                            <td>{{ round((float)$target->mixed) }}</td>
                            <td>{{ round((float)$target->voice) }}</td>
                            <td>{{ round((float)$target->total_bundle) }}</td>
                            <td>{{ round((float)$target->sso) }}</td>
                            <td>{{ round((float)$target->lso) }}</td>
                            <td>{{ round((float)$target->bso) }}</td>
                            <td>{{ round((float)$target->dsso) }}</td>
                            <td>{{ round((float)$target->ddso) }}</td>
                            <td>{{ round((float)$target->dso) }}</td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('kpi-target.edit', $target->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Delete -->
                                <a href="{{ route('kpi-target.destroy', $target->id) }}" id="deleteKpiTarget" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $kpiTargets->links('pagination::bootstrap-5') }}
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function(){
                // Single delete
                $(document).on('click','#deleteKpiTarget',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This Record?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: $(this).attr('href'),
                                type: 'DELETE',
                                success: function (response){
                                    Swal.fire(
                                        'Deleted!',
                                        response.success,
                                        'success',
                                    ).then((result) => {
                                        location.reload();
                                    });
                                },
                            });
                        }
                    });
                });

                // Delete all
                $(document).on('click','#deleteAllKpiTarget',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete All Records?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: $(this).attr('href'),
                                type: 'POST',
                                beforeSend: () => {
                                    $('#loading').show();
                                },
                                complete: () => {
                                    $('#loading').hide();
                                },
                                success: function (response){
                                    Swal.fire(
                                        'Deleted!',
                                        response.success,
                                        'success',
                                    ).then((result) => {
                                        location.reload();
                                    });
                                },
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
