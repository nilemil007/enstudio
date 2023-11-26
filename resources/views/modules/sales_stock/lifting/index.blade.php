<x-app-layout>

    <!-- Title -->
    <x-slot:title>Liftings</x-slot:title>

    <div class="card bg-gradient bg-secondary">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h4 class="card-title mb-0 text-white">lifting(s)</h4>
                @if(count($trashed) > 0)
                    <a href="{{ route('lifting.trash') }}" style="font-weight: bold;">
                        <span style="margin: 0 10px 0 10px">|</span>
                        <span class="text-danger">Trash ({{ $trashed->count() }})</span>
                    </a>
                @endif
            </div>

            <form>
                <div class="input-group">
                    <input name="lifting_date" id="lifting_date" value="{{ request()->get('lifting_date') }}" type="text" class="flatpickr form-control" placeholder="Select date">
                    <select name="dd_house" class="form-select">
                        <option value="">-- Select DD House --</option>
                        @foreach($ddHouses as $house)
                            <option @selected($house->code == request()->get('dd_house')) value="{{ $house->code }}">{{ $house->code.' - '.$house->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" type="submit">Search</button>
                    <a href="{{ route('lifting.index') }}" class="btn btn-warning">Reset</a>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end align-items-center">
                <span>
                    <a href="{{ route('lifting.create') }}" class="btn btn-sm btn-primary bg-gradient">Add New</a>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-vcenter text-nowrap mt-3 mb-3 align-middle text-center text-white">
                    <thead>
                        <tr>
                            <th class="text-white">sl</th>
                            <th class="text-white">dd house</th>
                            <th class="text-white">products</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $liftings as $sl => $lifting )
                        <tr>
                            <td>{{ ++$sl }}</td>
                            <td>
                                {{ $lifting->ddHouse->code.' - '.$lifting->ddHouse->name }}
                                <p class="text-light"><em>{{ 'Lifting At: ' . $lifting->lifting_date->toFormattedDateString() }}</em></p>
                                <p class="text-light"><em>{{ 'Last update: ' . $lifting->updated_at->diffForHumans().' . '. $lifting->updated_at->toDayDateTimeString() }}</em></p>
                            </td>
                            <td>
                                <table class="table table-sm table-bordered table-vcenter text-nowrap mt-3 mb-3 align-middle text-white">
                                    <thead>
                                        <tr>
                                            <th class="text-white">sim</th>
                                            <th class="text-white">scratch card</th>
                                            <th class="text-white">device</th>
                                            <th class="text-white">i'top-up</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- SIM -->
                                        <td x-data="{actionBtn: false}" @mouseover="actionBtn = true" @mouseleave="actionBtn = false" class="position-relative">
                                            <div x-data="{mmstVal: {{ $lifting->mmst ?? 0 }} }" x-cloak x-show="mmstVal">
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->mmst_lifting_price . ', Amount: ' . $lifting->mmst_amount . ', Remarks: ' . $lifting->mmst_remarks }}">
                                                    MMST: {{ $lifting->mmst }}
                                                </p>
                                            </div>
                                            <div x-data="{mmstsVal: {{ $lifting->mmsts ?? 0 }} }" x-cloak x-show="mmstsVal">
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->mmsts_lifting_price . ', Amount: ' . $lifting->mmsts_amount . ', Remarks: ' . $lifting->mmsts_remarks }}">
                                                    MMSTS: {{ $lifting->mmsts }}
                                                </p>
                                            </div>
                                            <div x-data="{simSwapVal: {{ $lifting->sim_swap ?? 0 }} }" x-cloak x-show="simSwapVal">
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->sim_swap_lifting_price . ', Amount: ' . $lifting->sim_swap_amount . ', Remarks: ' . $lifting->sim_swap_remarks }}">
                                                    SIM SWAP: {{ $lifting->sim_swap }}
                                                </p>
                                            </div>
                                            <div x-data="{simSwapEvVal: {{ $lifting->sim_swap_ev ?? 0 }} }" x-cloak x-show="simSwapEvVal">
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->sim_swap_ev_lifting_price . ', Amount: ' . $lifting->sim_swap_ev_amount . ', Remarks: ' . $lifting->sim_swap_ev_remarks }}">
                                                    SIM SWAP EV: {{ $lifting->sim_swap_ev }}
                                                </p>
                                            </div>

                                            <!-- Edit -->
                                            <a x-transition x-cloak x-show="actionBtn" href="{{ route('lifting.edit', $lifting->id) }}" class="nav-link position-absolute top-0 end-0 text-primary">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <!-- Move to trash -->
                                            <a x-transition x-cloak x-show="actionBtn" href="{{ route('lifting.destroy', $lifting->id) }}" class="deleteLiftingData nav-link position-absolute bottom-0 end-0 text-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                        <!-- SC -->
                                        <td x-data="{actionBtn: false}" @mouseover="actionBtn = true" @mouseleave="actionBtn = false" class="position-relative">
                                            <div x-data="{sc10Val: {{ $lifting->sc_10 ?? 0 }} }" x-cloak x-show="sc10Val">
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->sc_10_lifting_price . ', Amount: ' . $lifting->sc_10_amount . ', Lifting Amount: ' . $lifting->sc_10_lifting_amount . ', Remarks: ' . $lifting->sc_10_remarks }}">
                                                    SC-10: {{ $lifting->sc_10 }}
                                                </p>
                                            </div>
                                            <div x-data="{sc14Val: {{ $lifting->sc_14 ?? 0 }} }" x-cloak x-show="sc14Val">
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->sc_14_lifting_price . ', Amount: ' . $lifting->sc_14_amount . ', Lifting Amount: ' . $lifting->sc_14_lifting_amount . ', Remarks: ' . $lifting->sc_14_remarks }}">
                                                    SC-14: {{ $lifting->sc_14 }}
                                                </p>
                                            </div>
                                            <div x-data="{scd14Val: {{ $lifting->scd_14 ?? 0 }} }" x-cloak x-show="scd14Val">
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->scd_14_lifting_price . ', Amount: ' . $lifting->scd_14_amount . ', Lifting Amount: ' . $lifting->scd_14_lifting_amount . ', Remarks: ' . $lifting->scd_14_remarks }}">
                                                    SCD-14: {{ $lifting->scd_14 }}
                                                </p>
                                            </div>
                                            <div x-data="{sc19Val: {{ $lifting->sc_19 ?? 0 }} }" x-cloak x-show="sc19Val">
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->sc_19_lifting_price . ', Amount: ' . $lifting->sc_19_amount . ', Lifting Amount: ' . $lifting->sc_19_lifting_amount . ', Remarks: ' . $lifting->sc_19_remarks }}">
                                                    SC-19: {{ $lifting->sc_19 }}
                                                </p>
                                            </div>
                                            <div x-data="{scd19Val: {{ $lifting->scd_19 ?? 0 }} }" x-cloak x-show="scd19Val">
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->scd_19_lifting_price . ', Amount: ' . $lifting->scd_19_amount . ', Lifting Amount: ' . $lifting->scd_19_lifting_amount . ', Remarks: ' . $lifting->scd_19_remarks }}">
                                                    SCD-19: {{ $lifting->scd_19 }}
                                                </p>
                                            </div>
                                            <div x-data="{sc20Val: {{ $lifting->sc_20 ?? 0 }} }" x-cloak x-show="sc20Val">
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->sc_20_lifting_price . ', Amount: ' . $lifting->sc_20_amount . ', Lifting Amount: ' . $lifting->sc_20_lifting_amount . ', Remarks: ' . $lifting->sc_20_remarks }}">
                                                    SC-20: {{ $lifting->sc_20 }}
                                                </p>
                                            </div>
                                            <div x-data="{scd29Val: {{ $lifting->scd_29 ?? 0 }} }" x-cloak x-show="scd29Val">
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Lifting Price: '. $lifting->scd_29_lifting_price . ', Amount: ' . $lifting->scd_29_amount . ', Lifting Amount: ' . $lifting->scd_29_lifting_amount . ', Remarks: ' . $lifting->scd_29_remarks }}">
                                                    SCD-29: {{ $lifting->scd_29 }}
                                                </p>
                                            </div>

                                            <!-- Edit -->
                                            <a x-transition x-cloak x-show="actionBtn" href="{{ route('lifting.edit', $lifting->id) }}" class="nav-link position-absolute top-0 end-0 text-primary">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <!-- Move to trash -->
                                            <a x-transition x-cloak x-show="actionBtn" href="{{ route('lifting.destroy', $lifting->id) }}" class="deleteLiftingData nav-link position-absolute bottom-0 end-0 text-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                        <!-- Device -->
                                        <td x-data="{actionBtn: false}" @mouseover="actionBtn = true" @mouseleave="actionBtn = false" class="position-relative">
                                            <div x-data="{router: {{ $lifting->router ?? 0 }} }" x-cloak x-show="router">
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Price: ' . $lifting->router_price . ', Lifting Price: '. $lifting->router_lifting_price . ', Amount: ' . $lifting->router_amount . ', Router Lifting Amount: ' . $lifting->router_lifting_amount . ', Remarks: ' . $lifting->router_remarks }}">
                                                    Router: {{ $lifting->router }}
                                                </p>
                                            </div>

                                            <!-- Edit -->
                                            <a x-transition x-cloak x-show="actionBtn" href="{{ route('lifting.edit', $lifting->id) }}" class="nav-link position-absolute top-0 end-0 text-primary">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <!-- Move to trash -->
                                            <a x-transition x-cloak x-show="actionBtn" href="{{ route('lifting.destroy', $lifting->id) }}" class="deleteLiftingData nav-link position-absolute bottom-0 end-0 text-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                        <!-- I'top-up -->
                                        <td x-data="{actionBtn: false}" @mouseover="actionBtn = true" @mouseleave="actionBtn = false" class="position-relative">
                                            <div x-data="{ itopup: {{ $lifting->itopup ?? 0 }} }" x-cloak x-show="itopup">
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Remarks: ' . $lifting->itopup_remarks }}">
                                                    I'top-up: {{ $lifting->itopup }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="d-inline-block"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="{{ 'Remarks: ' . $lifting->itopup_remarks }}">
                                                    Bank Deposit: {{ $lifting->bank_deposit }}
                                                </p>
                                            </div>

                                            <!-- Edit -->
                                            <a x-transition x-cloak x-show="actionBtn" href="{{ route('lifting.edit', $lifting->id) }}" class="nav-link position-absolute top-0 end-0 text-primary">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <!-- Move to trash -->
                                            <a x-transition x-cloak x-show="actionBtn" href="{{ route('lifting.destroy', $lifting->id) }}" class="deleteLiftingData nav-link position-absolute bottom-0 end-0 text-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td colspan="3">No data found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-white">
            {{ $liftings->links('pagination::bootstrap-5') }}
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function(){

                // Single delete
                $(document).on('click','.deleteLiftingData',function(e){
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
                                beforeSend: () => {
                                    $('#loading').show();
                                },
                                complete: () => {
                                    $('#loading').hide();
                                },
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
