<x-app-layout>

    <!-- Title -->
    <x-slot:title>Trash Rso</x-slot:title>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title mb-0">Trash Rso</h4>
                <span>
                    <a href="{{ route('rso.index') }}" class="btn btn-sm btn-primary">All Rso</a>
                    @if($trashedRso->count() > 1)
                        <a href="{{ route('rso.delete.all') }}" class="btn btn-sm btn-danger">Delete All Permanently</a>
                    @endif
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>DD House</th>
                        <th>Rso name</th>
                        <th>Supervisor</th>
                        <th>Routes</th>
                        <th>Rso Code</th>
                        <th>Rso Itop</th>
                        <th>Pool Number</th>
                        <th>Joining Date</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $trashedRso as $sl => $rso )
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
                            <td class="d-flex align-items-center">
                                <!-- Restore -->
                                <a href="{{ route('rso.restore', $rso->id) }}" class="btn btn-sm btn-primary">Restore</a>

                                <!-- Permanently Delete -->
                                <form style="margin-left: 5px;" action="{{ route('rso.permanently.delete', $rso->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want to Permanently delete this rso?');" type="submit" class="btn btn-sm btn-danger">Delete Permanently</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $trashedRso->links('pagination::bootstrap-5') }}
        </div>
    </div>

</x-app-layout>
