<x-app-layout>

    <!-- Title -->
    <x-slot:title>All Route</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">All Route</h4>
                <span>
                    <a href="{{ route('route.create') }}" class="btn btn-sm btn-primary">Add New</a>
                    @if(count($routes) > 1)
                        <a id="deleteAllRoute" href="{{ route('route.delete.all') }}" class="btn btn-sm btn-danger">Delete All</a>
                    @endif
                </span>
            </div>
            <div class="table-responsive">
                <table id="routeTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>DD House</th>
                        <th>Route Code</th>
                        <th>Route Name</th>
                        <th>Weekday</th>
                        <th>Length</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $routes as $sl => $route )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $route->ddHouse->code }}</td>
                            <td>{{ $route->code }}</td>
                            <td>{{ $route->name }}</td>
                            <td>{{ $route->weekdays }}</td>
                            <td>{{ $route->length }}</td>
                            <td>
                                @switch( $route->status )
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
                                <a href="{{ route('route.edit', $route->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Delete -->
                                <a href="{{ route('route.destroy', $route->id) }}" id="deleteRoute" class="btn btn-sm btn-danger">Delete</a>
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
            new DataTable('#routeTbl');

            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Single delete
                $(document).on('click','#deleteRoute',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This Route?",
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
                $(document).on('click','#deleteAllRoute',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete All Route?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
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
