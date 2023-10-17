<x-app-layout>

    <!-- Title -->
    <x-slot:title>Trash Users</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title mb-0">Trash Users</h4>
                <span>
                    <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">All Users</a>
                    @if($trashedUser->count() > 1)
                        <a id="deleteAllUsers" href="{{ route('user.delete.all') }}" class="btn btn-sm btn-danger">Delete All Permanently</a>
                    @endif
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3">
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
                    @foreach( $trashedUser as $sl => $user )
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
                            <td class="d-flex align-items-center">
                                <!-- Restore -->
                                <a href="{{ route('user.restore', $user->id) }}" class="btn btn-sm btn-primary">Restore</a>

                                <!-- Permanently Delete -->
                                <form style="margin-left: 5px;" action="{{ route('user.permanently.delete', $user->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want to Permanently delete this user?');" type="submit" class="btn btn-sm btn-danger">Delete Permanently</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $trashedUser->links('pagination::bootstrap-5') }}
        </div>
    </div>

</x-app-layout>
