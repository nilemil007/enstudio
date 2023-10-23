<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Rso/Bp/Cm Number</th>
            <th>Flag</th>
            <th>Retailer Code</th>
            <th>Activation</th>
            <th>Price</th>
            <th>Date</th>
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $houseCodeAct as $sl => $hca )
        <tr>
            <td>{{ $hca->user->name }}</td>
            <td>
                {{ optional(\App\Models\Rso::firstWhere('user_id', $hca->user->id))->itop_number }}
                {{ optional(\App\Models\Bp::firstWhere('user_id', $hca->user->id))->pool_number }}
                {{ optional(\App\Models\Cm::firstWhere('user_id', $hca->user->id))->pool_number }}
            </td>
            <td>{{ Str::upper($hca->flag) }}</td>
            <td>{{ $hca->retailer_code }}</td>
            <td>{{ $hca->activation }}</td>
            <td>{{ $hca->price }}</td>
            <td>{{ $hca->activation_date->toFormattedDateString() }}</td>
            <td>{{ $hca->remarks }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
