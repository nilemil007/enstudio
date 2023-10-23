<x-app-layout>

    <!-- Title -->
    <x-slot:title>House Code Activation</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-inline-flex align-items-center">
                    <h4 class="card-title m-0">House Code Activation</h4>
                </div>

                <span>
                    <a href="{{ route('hca.create') }}" class="btn btn-sm btn-primary">Add New</a>
                    @if( auth()->user()->role == 'superadmin' )
                        @if(count($houseCodeAct) > 1)
                            <a id="deleteAllHca" href="{{ route('hca.delete.all') }}" class="btn btn-sm btn-danger">Delete all</a>
                        @endif
                    @endif
                </span>
            </div>
            <div class="table-responsive">
                <table id="hcaTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Name</th>
                        <th>Retailer Code</th>
                        <th>Activation</th>
                        <th>Price</th>
                        <th>Flag</th>
                        <th>Remarks</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $houseCodeAct as $sl => $hca )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>
                                {{ $hca->user->name }}
                                <div class="text-muted">
                                    {{ optional(\App\Models\Rso::firstWhere('user_id', $hca->user->id))->itop_number }}
                                    {{ optional(\App\Models\Bp::firstWhere('user_id', $hca->user->id))->pool_number }}
                                    {{ optional(\App\Models\Cm::firstWhere('user_id', $hca->user->id))->pool_number }}
                                </div>
                            </td>
                            <td>{{ $hca->retailer_code }}</td>
                            <td>{{ $hca->activation }}</td>
                            <td>{{ $hca->price }}</td>
                            <td>{{ \Illuminate\Support\Str::upper($hca->flag) }}</td>
                            <td>{{ \Illuminate\Support\Str::title($hca->remarks) }}</td>
                            <td>{{ $hca->activation_date->toFormattedDateString() }}</td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('hca.edit', $hca->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Delete -->
                                @if( auth()->user()->role == 'superadmin' )
                                    <a href="{{ route('hca.destroy', $hca->id) }}" id="deleteHca" class="btn btn-sm btn-danger">Delete</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $houseCodeAct->links('pagination::bootstrap-5') }}
        </div>
    </div>

    @if(count($houseCodeAct) > 0)
        <div class="dropup mt-3" role="group">
            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Export Excel
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('hca.export') }}">Current Month</a></li>
                <li><a class="dropdown-item" href="{{ route('hca.export.last.month') }}">Last Month</a></li>
            </ul>
        </div>
    @endif


    @push('scripts')
        <script>
            // new DataTable('#hcaTbl');

            $(document).ready(function(){
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
