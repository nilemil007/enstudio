<x-app-layout>

    <!-- Title -->
    <x-slot:title>All Users</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-0">All Users</h4>
                    @if(count($trashed) > 0)
                        <a href="{{ route('user.trash') }}" class="text-danger" style="font-weight: bold;"><span style="margin: 0px 10px 0px 10px">|</span> Trash ({{ $trashed->count() }})</a>
                    @endif
                </div>
                <span>
                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Add New</a>
                </span>
            </div>
            <div class="table-responsive">
                <table id="userTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>DD House</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $users as $sl => $user )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td class="py-1">
                                <img src="{{ $user->image }}" alt="user image">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->ddHouse as $house)
                                    <p>{{ $house->code }}</p>
                                @endforeach
                            </td>
                            <td>{{ $user->role }}</td>
                            <td>
                                @switch( $user->status )
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
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Move to trash -->
                                <a href="{{ route('user.destroy', $user->id) }}" id="deleteUser" class="btn btn-sm btn-danger">Delete</a>
{{--                                <form style="margin-left: 5px;" action="{{ route('user.destroy', $user->id) }}" method="POST">--}}
{{--                                    @csrf @method('DELETE')--}}
{{--                                    <button onclick="return confirm('Are you sure you want to delete this user?');" type="submit" class="btn btn-sm btn-danger">Delete</button>--}}
{{--                                </form>--}}
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
            new DataTable('#userTbl');

            $(document).ready(function(){

                // Single delete
                $(document).on('click','#deleteUser',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This User?",
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
                // $(document).on('click','#deleteAllUsers',function(e){
                //     e.preventDefault();
                //
                //     Swal.fire({
                //         title: 'Are you sure?',
                //         text: "Delete All Users?",
                //         icon: 'warning',
                //         showCancelButton: true,
                //         confirmButtonText: 'Yes, delete it!'
                //     }).then((result) => {
                //         if (result.isConfirmed) {
                //             $.ajax({
                //                 url: $(this).attr('href'),
                //                 type: 'POST',
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
