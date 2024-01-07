<table>
    <thead>
        <tr>
            <th>Cluster</th>
            <th>Region</th>
            <th>DD Code</th>
            <th>Retailer Code</th>
            <th>Retailer Name</th>
            <th>Enabled</th>
            <th>Sim Seller</th>
            <th>Itop Number</th>
            <th>Owner Name</th>
            <th>Contact Number</th>
            <th>District</th>
            <th>Thana</th>
            <th>Address</th>
            <th>NID</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $retailers as $sl => $retailer )
        <tr>
            <td>{{ $retailer->ddHouse->cluster_name }}</td>
            <td>{{ $retailer->ddHouse->region }}</td>
            <td>{{ $retailer->ddHouse->code }}</td>
            <td>{{ $retailer->code }}</td>
            <td>{{ $retailer->name }}</td>
            <td>{{ $retailer->enabled }}</td>
            <td>{{ $retailer->sim_seller }}</td>
            <td>{{ $retailer->itop_number }}</td>
            <td>{{ $retailer->owner_name }}</td>
            <td>{{ $retailer->contact_no }}</td>
            <td>{{ $retailer->district }}</td>
            <td>{{ $retailer->thana }}</td>
            <td>{{ $retailer->address }}</td>
            <td>{{ $retailer->nid }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
