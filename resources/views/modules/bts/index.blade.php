<x-app-layout>

    <!-- Title -->
    <x-slot:title>All BTS</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">All BTS</h4>
                <span>
                    <a href="{{ route('bts.create') }}" class="btn btn-sm btn-primary">Add New</a>
                    @if(count($allBts) > 1)
                        <a id="deleteAllBts" href="{{ route('bts.delete.all') }}" class="btn btn-sm btn-danger">Delete All</a>
                    @endif
                </span>
            </div>
            <div class="table-responsive">
                <table id="btsTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>DD House</th>
                            <th>BTS Code</th>
                            <th>Address</th>
                            <th>District</th>
                            <th>Thana</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $allBts as $sl => $bts )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $bts->dd_house }}</td>
                            <td>{{ $bts->bts_code }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($bts->address, 50) }}</td>
                            <td>{{ $bts->district }}</td>
                            <td>{{ $bts->thana }}</td>
                            <td>{{ $bts->longitude }}</td>
                            <td>{{ $bts->latitude }}</td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('bts.edit', $bts->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Delete -->
                                <a href="{{ route('bts.destroy', $bts->id) }}" id="deleteBts" class="btn btn-sm btn-danger">Delete</a>
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
            new DataTable('#btsTbl');

            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Single delete
                $(document).on('click','#deleteBts',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This BTS?",
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
                $(document).on('click','#deleteAllBts',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete All BTS?",
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
