<x-app-layout>

    <!-- Title -->
    <x-slot:title>Trash Users</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-0">Trash Users</h4>
                    <a href="{{ route('user.permanently.delete.all') }}" id="permanentlyDeleteAllUsers" class="text-secondary" style="font-weight: bold;">
                        <span style="margin: 0px 10px 0px 10px">|</span> Empty Trash Now ({{ $trashed->count() }})
                    </a>
                </div>

                <span>
                    <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">All Users</a>
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
                    @foreach( $trashed as $sl => $user )
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
                                <!-- Restore -->
                                <a href="{{ route('user.restore', $user->id) }}" class="btn btn-sm btn-primary">Restore</a>

                                <!-- Permanently Delete -->
                                <a href="{{ route('user.permanently.delete', $user->id) }}" id="permanentlyDeleteUser" class="btn btn-sm btn-danger">Delete Permanently</a>

{{--                                <form style="margin-left: 5px;" action="{{ route('user.permanently.delete', $user->id) }}" method="POST">--}}
{{--                                    @csrf @method('DELETE')--}}
{{--                                    <button onclick="return confirm('Are you sure you want to Permanently delete this user?');" type="submit" class="btn btn-sm btn-danger">Delete Permanently</button>--}}
{{--                                </form>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $trashed->links('pagination::bootstrap-5') }}
        </div>
    </div>

    @push('scripts')
        <script>
            new DataTable('#userTbl');

            $(document).ready(function(){

                // Permanently delete
                $(document).on('click','#permanentlyDeleteUser',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete This User Permanently?",
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

                // Permanently Delete All
                $(document).on('click','#permanentlyDeleteAllUsers',function(e){
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Permanently Delete All Users?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it !'
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
            });
        </script>
    @endpush

</x-app-layout>
