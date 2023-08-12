<table>
    <thead>
        <tr>
            <th>DD House</th>
            <th>Name</th>
            <th>Retailer Code</th>
            <th>Activation</th>
            <th>Price</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $houseCodeAct as $sl => $hca )
        <tr>
            <td>{{ $hca->dd_house }}</td>
            <td>{{ $hca->user->name.' - '.\Illuminate\Support\Str::upper($hca->user->role) }}</td>
            <td>{{ $hca->retailer_code }}</td>
            <td>{{ $hca->activation }}</td>
            <td>{{ $hca->price }}</td>
            <td>{{ $hca->activation_date->toFormattedDateString() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
