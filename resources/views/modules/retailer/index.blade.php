<x-app-layout>

    <!-- Title -->
    <x-slot:title>All Retailer</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">All Retailer</h4>
                <span>
                    <a href="{{ route('retailer.create') }}" class="btn btn-sm btn-primary">Add New</a>
                    @if(count($retailers) > 1)
                        <a id="deleteAllRetailer" href="{{ route('retailer.delete.all') }}" class="btn btn-sm btn-danger">Delete All</a>
                    @endif
                </span>
            </div>
            <div class="table-responsive">
                <table id="retailerTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Image</th>
                        <th>DD House</th>
                        <th>Code</th>
                        <th>Itop Number</th>
                        <th>Name</th>
                        <th>Thana</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $retailers as $sl => $retailer )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td class="py-1">
                                <img src="{{ asset($retailer->image) }}" alt="retailer image">
                            </td>
                            <td>{{ $retailer->dd_house }}</td>
                            <td>{{ $retailer->code }}</td>
                            <td>{{ $retailer->itop_number }}</td>
                            <td>{{ $retailer->name }}</td>
                            <td>{{ $retailer->thana }}</td>
                            <td>{{ $retailer->address }}</td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('retailer.edit', $retailer->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Delete -->
                                <a href="{{ route('retailer.destroy', $retailer->id) }}" id="deleteRetailer" class="btn btn-sm btn-danger">Delete</a>
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
            new DataTable('#retailerTbl');

            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Single delete
                $(document).on('click','#deleteRetailer',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This Retailer?",
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
                $(document).on('click','#deleteAllRetailer',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete All Retailer?",
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
