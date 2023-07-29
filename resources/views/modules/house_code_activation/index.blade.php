<x-app-layout>

    <!-- Title -->
    <x-slot:title>House Code Activation</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">House Code Activation</h4>
                <span>
                    <a href="{{ route('hca.create') }}" class="btn btn-sm btn-primary">Add New</a>
                    @if(count($houseCodeAct) > 1)
                        <a id="deleteAllHca" href="{{ route('hca.delete.all') }}" class="btn btn-sm btn-danger">Delete all</a>
                    @endif
                </span>
            </div>
            <div class="table-responsive">
                <table id="hcaTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>DD House</th>
                        <th>Name</th>
                        <th>Retailer Code</th>
                        <th>Activation</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $houseCodeAct as $sl => $hca )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $hca->dd_house }}</td>
                            <td>{{ $hca->user->name.' - '.\Illuminate\Support\Str::upper($hca->user->role) }}</td>
                            <td>{{ $hca->retailer_code }}</td>
                            <td>{{ $hca->activation }}</td>
                            <td>{{ $hca->price }}</td>
                            <td>{{ $hca->activation_date->toFormattedDateString() }}</td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('hca.edit', $hca->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Delete -->
                                <a href="{{ route('hca.destroy', $hca->id) }}" id="deleteHca" class="btn btn-sm btn-danger">Delete</a>
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
            new DataTable('#hcaTbl');

            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Single delete
                $(document).on('click','#deleteHca',function(e){
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
                $(document).on('click','#deleteAllHca',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete All Record?",
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
