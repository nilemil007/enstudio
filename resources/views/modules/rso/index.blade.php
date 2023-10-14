<x-app-layout>

    <!-- Title -->
    <x-slot:title>All Rso</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">All Rso</h4>
                <span>
                    <a href="{{ route('rso.create') }}" class="btn btn-sm btn-primary">Add New</a>
                    @if(count($rsos) > 1)
                        <a id="deleteAllRso" href="{{ route('rso.delete.all') }}" class="btn btn-sm btn-danger">Delete All</a>
                    @endif
                </span>
            </div>
            <div class="table-responsive">
                <table id="rsoTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>DD House</th>
                        <th>Supervisor</th>
                        <th>Routes</th>
                        <th>Rso Code</th>
                        <th>Rso Itop</th>
                        <th>Rso name</th>
                        <th>Pool Number</th>
                        <th>Joining Date</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $rsos as $sl => $rso )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $rso->ddHouse->code }}</td>
                            <td>{{ $rso->supervisor->user->name }}</td>
                            <td>
                                @foreach($rso->route as $route)
                                    <p>{{ $route->code .' - '. $route->name }}</p>
                                @endforeach
                            </td>
                            <td>{{ $rso->rso_code }}</td>
                            <td>{{ $rso->itop_number }}</td>
                            <td>{{ optional($rso->user)->name }}</td>
                            <td>{{ $rso->pool_number }}</td>
                            <td>{{ $rso->joining_date->toFormattedDateString() }}</td>
                            <td>
                                @switch( $rso->status )
                                    @case(1)
                                        <p class="text-success">Active</p>
                                    @break

                                    @case(0)
                                        <p class="text-danger">Inactive</p>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('rso.edit', $rso->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Delete -->
                                <a href="{{ route('rso.destroy', $rso->id) }}" id="deleteRso" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            new DataTable('#rsoTbl');

            $(document).ready(function(){
                // Single delete
                $(document).on('click','#deleteRso',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This Rso?",
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
                $(document).on('click','#deleteAllRso',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete All Rso?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it !'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: $(this).attr('href'),
                                type: 'POST',
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
