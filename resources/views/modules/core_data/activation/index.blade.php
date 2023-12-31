<x-app-layout>

    <!-- Title -->
    <x-slot:title>Activation</x-slot:title>

    <div id="coreActivationErrMsg" class="alert alert-danger err-msg d-none"></div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Activation Import</h4>
            <span>
                <form id="importCoreActivation" action="{{ route('core.activation.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input name="core_activation_import" type="file" class="form-control form-control-sm" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        <button class="btn btn-sm btn-primary btn-submit" type="submit">Import Activation</button>
                    </div>
                </form>
                {{-- @if(count($rsos) > 1)
                    <a id="deleteAllRso" href="{{ route('rso.delete.all') }}" class="btn btn-sm btn-danger">Delete All</a>
                @endif --}}
            </span>
        </div>
        <div class="card-body">
            <div class=" mb-3">
            </div>
            <div class="table-responsive">
                <table id="coreActivationTbl" class="table table-sm table-bordered table-hover card-table table-vcenter text-nowrap mt-3 mb-3 text-center">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>activation date</th>
                        <th>distributor code</th>
                        <th>distributor name</th>
                        <th>retailer code</th>
                        <th>retailer name</th>
                        <th>product code</th>
                        <th>product name</th>
                        <th>sim no</th>
                        <th>msisdn</th>
                        <th>selling price</th>
                        <th>bp flag</th>
                        <th>bp number</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse( $activations as $sl => $activation )
                        <tr>
                            <td><span class="text-muted">{{ ++$sl }}</span></td>
                            <td>{{ $activation->activation_date->toFormattedDateString() }}</td>
                            <td>{{ $activation->ddHouse->code }}</td>
                            <td>{{ $activation->ddHouse->name }}</td>
                            <td>{{ $activation->retailer->code }}</td>
                            <td>{{ $activation->retailer->name }}</td>
                            <td>{{ $activation->product_code }}</td>
                            <td>{{ $activation->product_name }}</td>
                            <td>{{ $activation->sim_serial }}</td>
                            <td>{{ $activation->msisdn }}</td>
                            <td>{{ $activation->selling_price }}</td>
                            <td>{{ $activation->bp_flag }}</td>
                            <td>{{ $activation->bp_number }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13">No data found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $activations->links('pagination::bootstrap-5') }}
        </div>
    </div>

    @push('scripts')
        <script>
            // new DataTable('#coreActivationTbl');

            $(document).ready(function(){
                // Import Activation
                $(document).on('submit','#importCoreActivation',function (e){
                    e.preventDefault();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: () => {
                            $('#loading').show();
                            $('#coreActivationErrMsg').addClass('d-none').find('li').remove();
                            $('.btn-submit').prop('disabled', true).text('Importing...').append('<img src="{{ url('public/assets/images/gif/DzUd.gif') }}" alt="" width="18px">');
                        },
                        complete: () => {
                            $('#loading').hide();
                        },
                        success: (response) => {
                            $('.btn-submit').prop('disabled', false).text('Import Activation');
                            Swal.fire(
                                'Success!',
                                response.success,
                                'success',
                            ).then((result) => {
                                location.reload();
                            });
                        },
                        error: (e) => {
                            const err = JSON.parse(e.responseText);

                            $.each(err.errors,function (key,value){
                                $('.err-msg').removeClass('d-none').append('<li>' + value + '</li>');
                            });

                            $('.btn-submit').prop('disabled', false).text('Import Activation');
                        },
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
