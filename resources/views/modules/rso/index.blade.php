<x-app-layout>

    <!-- Title -->
    <x-slot:title>All Rso</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-0">All Rso</h4>
                    @if(count($trashed) > 0)
                        <a href="{{ route('rso.trash') }}" class="text-danger" style="margin-left: 5px;">Trash ({{ $trashed->count() }})</a>
                    @endif
                </div>
                <span>
                    <a href="{{ route('rso.create') }}" class="btn btn-sm btn-primary">Add New</a>
                </span>
            </div>
            <div class="table-responsive">
                <table id="rsoTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>DD House</th>
                        <th>Rso name</th>
                        <th>Supervisor</th>
                        <th>Rso Code</th>
                        <th>Rso Itop</th>
                        <th>Pool Number</th>
                        <th>Joining Date</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $rsos as $sl => $rso )
                        <tr class="{{ $rso->status == 0 ? 'text-bg-warning' : '' }}">
                            <td><span>{{ ++$sl }}</span></td>
                            <td>{{ $rso->ddHouse->code }}</td>
                            <td>{{ optional($rso->user)->name }}</td>
                            <td>{{ $rso->supervisor->user->name }}</td>
                            <td>{{ $rso->rso_code }}</td>
                            <td>{{ $rso->itop_number }}</td>
                            <td>{{ $rso->pool_number }}</td>
                            <td>{{ $rso->joining_date->toFormattedDateString() }}</td>
                            <td style="font-weight: bold">
                                @switch( $rso->status )
                                    @case(1)
                                        <p class="text-success">Active</p>
                                    @break

                                    @case(0)
                                        <p class="text-danger">Inactive</p>
                                        @break
                                @endswitch
                            </td>
                            <td class="d-flex align-items-center">
                                <!-- Edit -->
                                <a href="{{ route('rso.edit', $rso->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Move to trash -->
                                <form style="margin-left: 5px;" action="{{ route('rso.destroy', $rso->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want to delete this rso?');" type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
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
                // $(document).on('click','#deleteRso',function(e){
                //     e.preventDefault();
                //
                //     Swal.fire({
                //         title: 'Are you sure?',
                //         text: "Delete This Rso?",
                //         icon: 'warning',
                //         showCancelButton: true,
                //         confirmButtonText: 'Yes, delete it!'
                //     }).then((result) => {
                //         if (result.isConfirmed) {
                //             $.ajax({
                //                 url: $(this).attr('href'),
                //                 type: 'DELETE',
                                    // beforeSend: () => {
                                    //     $('#loading').show();
                                    // },
                                    // complete: () => {
                                    //     $('#loading').hide();
                                    // },
                //                 success: function (response){
                //                     Swal.fire(
                //                         'Deleted!',
                //                         response.success,
                //                         'success',
                //                     ).then((result) => {
                //                         location.reload();
                //                     });
                //                 },
                //             });
                //         }
                //     });
                // });

                // Delete all
                // $(document).on('click','#deleteAllRso',function(e){
                //     e.preventDefault();
                //
                //     Swal.fire({
                //         title: 'Are you sure?',
                //         text: "Delete All Rso?",
                //         icon: 'warning',
                //         showCancelButton: true,
                //         confirmButtonText: 'Yes, delete it !'
                //     }).then((result) => {
                //         if (result.isConfirmed) {
                //             $.ajax({
                //                 url: $(this).attr('href'),
                //                 type: 'POST',
                                    // beforeSend: () => {
                                    //     $('#loading').show();
                                    // },
                                    // complete: () => {
                                    //     $('#loading').hide();
                                    // },
                //                 success: function (response){
                //                     Swal.fire(
                //                         'Deleted!',
                //                         response.success,
                //                         'success',
                //                     ).then((result) => {
                //                         location.reload();
                //                     });
                //                 },
                //             });
                //         }
                //     });
                // });
            });
        </script>
    @endpush
</x-app-layout>
