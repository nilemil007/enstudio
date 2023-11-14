<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Lifting</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <form id="cmForm" action="{{ route('lifting.store') }}" method="POST">
                @csrf
            <div class="card bg-light bg-gradient">
                <div class="card-header">
                    <h6 class="card-title m-0">Create New Lifting</h6>
                </div>
                <div class="card-body">
                    <!-- DD House and Lifting Date -->
                    <div class="card mb-3 bg-secondary bg-gradient">
                        <div class="card-header">
                            <h3 class="m-0 text-white">DD House & Date</h3>
                        </div>
                        <div class="card-body">
                            <!-- Lifting Date -->
                            <div class="row mb-3">
                                <label for="lifting_date" class="col-sm-3 col-form-label">Lifting Date</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input name="lifting_date" id="lifting_date" type="text" value="{{ now() }}" class="flatpickr form-control" placeholder="Select date">
                                        <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                    </div>
                                    @error('lifting_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Distribution House -->
                            <div class="row mb-3">
                                <label for="dd_house_id" class="col-sm-3 col-form-label">DD House</label>
                                <div class="col-sm-9">
                                    <select name="dd_house_id" class="form-select" id="dd_house_id" >
                                        <option value="">-- Select Distribution House --</option>
                                        @if(count($houses) > 0)
                                            @foreach($houses as $house)
                                                <option value="{{ $house->id }}">{{ $house->code .' - '. $house->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('dd_house_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SIM -->
                    <div class="card mb-3 bg-secondary bg-gradient">
                        <div class="card-header">
                            <h3 class="m-0 text-white">SIM</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- MMST -->
                                <div class="col-lg-6">
                                    <div class="card mb-3 bg-gradient bg-secondary">
                                        <div class="card-header">MMST</div>
                                        <div class="card-body">
                                            <!-- Quantity -->
                                            <div class="row mb-3">
                                                <label for="mmst" class="col-sm-3 col-form-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input name="mmst" id="mmst" type="number" class="form-control" value="{{ old('mmst') }}" placeholder="Enter Quantity">
                                                    <input type="hidden" name="mmst_lifting_price" id="mmst_lifting_price">
                                                    <input type="hidden" name="mmst_amount" id="mmst_amount">
                                                    @error('mmst')
                                                    <span class="text-danger">{{ $message }}</span>@else<small class="text-light" id="showPrice" style="font-weight: bold"></small>@enderror
                                                </div>
                                            </div>

                                            <!-- Cash/Credit -->
                                            <div class="row mb-3">
                                                <label for="mmst_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                                <div class="col-sm-9">
                                                    <select name="mmst_remarks" class="form-select" id="mmst_remarks">
                                                        <option value="">- Select Mode -</option>
                                                        <option selected value="Cash">Cash</option>
                                                        <option value="Credit" >Credit</option>
                                                    </select>
                                                    @error('mmst_remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-light">
                                            <p>Lifting Price: 241</p>
                                            <p>Amount: 241000</p>
                                            <p>Lifting Amount: 241000</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- MMSTS -->
                                <div class="col-lg-6">
                                    <div class="card mb-3 bg-gradient bg-secondary">
                                        <div class="card-header">MMSTS</div>
                                        <div class="card-body">
                                            <!-- Quantity -->
                                            <div class="row mb-3">
                                                <label for="mmsts" class="col-sm-3 col-form-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input name="mmsts" id="mmsts" type="number" class="form-control" value="{{ old('mmsts') }}" placeholder="Enter Quantity">
                                                    <input type="hidden" name="mmsts_lifting_price" id="mmsts_lifting_price">
                                                    <input type="hidden" name="mmsts_amount" id="mmsts_amount">
                                                    @error('mmsts')
                                                    <span class="text-danger">{{ $message }}</span>@else<small class="text-light" id="showPrice" style="font-weight: bold"></small>@enderror
                                                </div>
                                            </div>

                                            <!-- Cash/Credit -->
                                            <div class="row mb-3">
                                                <label for="mmsts_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                                <div class="col-sm-9">
                                                    <select name="mmsts_remarks" class="form-select" id="mmsts_remarks">
                                                        <option value="">- Select Mode -</option>
                                                        <option selected value="Cash">Cash</option>
                                                        <option value="Credit" >Credit</option>
                                                    </select>
                                                    @error('mmsts_remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sim Swap -->
                                <div class="col-lg-6">
                                    <div class="card mb-3 bg-gradient bg-secondary">
                                        <div class="card-header">Sim Swap</div>
                                        <div class="card-body">
                                            <!-- Quantity -->
                                            <div class="row mb-3">
                                                <label for="sim_swap" class="col-sm-3 col-form-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input name="sim_swap" id="sim_swap" type="number" class="form-control" value="{{ old('sim_swap') }}" placeholder="Enter Quantity">
                                                    <input type="hidden" name="sim_swap_lifting_price" id="sim_swap_lifting_price">
                                                    <input type="hidden" name="sim_swap_amount" id="sim_swap_amount">
                                                    @error('sim_swap')
                                                    <span class="text-danger">{{ $message }}</span>@else<small class="text-light" id="showPrice" style="font-weight: bold"></small>@enderror
                                                </div>
                                            </div>

                                            <!-- Cash/Credit -->
                                            <div class="row mb-3">
                                                <label for="sim_swap_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                                <div class="col-sm-9">
                                                    <select name="sim_swap_remarks" class="form-select" id="sim_swap_remarks">
                                                        <option value="">- Select Mode -</option>
                                                        <option selected value="Cash">Cash</option>
                                                        <option value="Credit" >Credit</option>
                                                    </select>
                                                    @error('sim_swap_remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sim Swap Ev -->
                                <div class="col-lg-6">
                                    <div class="card mb-3 bg-gradient bg-secondary">
                                        <div class="card-header">Sim Swap Ev</div>
                                        <div class="card-body">
                                            <!-- Quantity -->
                                            <div class="row mb-3">
                                                <label for="sim_swap_ev" class="col-sm-3 col-form-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input name="sim_swap_ev" id="sim_swap_ev" type="number" class="form-control" value="{{ old('sim_swap_ev') }}" placeholder="Enter Quantity">
                                                    <input type="hidden" name="sim_swap_ev_lifting_price" id="sim_swap_ev_lifting_price">
                                                    <input type="hidden" name="sim_swap_ev_amount" id="sim_swap_ev_amount">
                                                    @error('sim_swap_ev')
                                                    <span class="text-danger">{{ $message }}</span>@else<small class="text-light" id="showPrice" style="font-weight: bold"></small>@enderror
                                                </div>
                                            </div>

                                            <!-- Cash/Credit -->
                                            <div class="row mb-3">
                                                <label for="sim_swap_ev_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                                <div class="col-sm-9">
                                                    <select name="sim_swap_ev_remarks" class="form-select" id="sim_swap_ev_remarks">
                                                        <option value="">- Select Mode -</option>
                                                        <option selected value="Cash">Cash</option>
                                                        <option value="Credit" >Credit</option>
                                                    </select>
                                                    @error('sim_swap_ev_remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h4 id="totalSimAmount" class="text-white">Total Sim Amount: 1038961</h4>
                            <input type="hidden" name="total_sim_amount" id="total_sim_amount">
                        </div>
                    </div>

                    <!-- Scratch Card -->
                    <div class="card mb-3 bg-secondary bg-gradient">
                        <div class="card-header">
                            <h3 class="m-0 text-white">Scratch Card</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- SC-10 -->
                                <div class="col-lg-6">
                                    <div class="card mb-3 bg-gradient bg-secondary">
                                        <div class="card-header">SC-10</div>
                                        <div class="card-body">
                                            <!-- Quantity -->
                                            <div class="row mb-3">
                                                <label for="sc_10" class="col-sm-3 col-form-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input name="sc_10" id="sc_10" type="number" class="form-control" value="{{ old('sc_10') }}" placeholder="Enter Quantity">
                                                    <input type="hidden" name="sc_10_lifting_price" id="sc_10_lifting_price">
                                                    <input type="hidden" name="sc_10_amount" id="sc_10_amount">
                                                    <input type="hidden" name="sc_10_lifting_amount" id="sc_10_lifting_amount">
                                                    @error('sc_10')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <!-- Cash/Credit -->
                                            <div class="row mb-3">
                                                <label for="sc_10_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                                <div class="col-sm-9">
                                                    <select name="sc_10_remarks" class="form-select" id="sc_10_remarks">
                                                        <option value="">- Select Mode -</option>
                                                        <option selected value="Cash">Cash</option>
                                                        <option value="Credit" >Credit</option>
                                                    </select>
                                                    @error('sc_10_remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-light">
                                            <p>Lifting Price: 241</p>
                                            <p>Amount: 241000</p>
                                            <p>Lifting Amount: 241000</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- SC-14 -->
                                <div class="col-lg-6">
                                    <div class="card mb-3 bg-gradient bg-secondary">
                                        <div class="card-header">SC-14</div>
                                        <div class="card-body">
                                            <!-- Quantity -->
                                            <div class="row mb-3">
                                                <label for="sc_14" class="col-sm-3 col-form-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input name="sc_14" id="sc_14" type="number" class="form-control" value="{{ old('sc_14') }}" placeholder="Enter Quantity">
                                                    <input type="hidden" name="sc_14_lifting_price" id="sc_14_lifting_price">
                                                    <input type="hidden" name="sc_14_amount" id="sc_14_amount">
                                                    <input type="hidden" name="sc_14_lifting_amount" id="sc_14_lifting_amount">
                                                    @error('sc_14')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <!-- Cash/Credit -->
                                            <div class="row mb-3">
                                                <label for="sc_14_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                                <div class="col-sm-9">
                                                    <select name="sc_14_remarks" class="form-select" id="sc_14_remarks">
                                                        <option value="">- Select Mode -</option>
                                                        <option selected value="Cash">Cash</option>
                                                        <option value="Credit" >Credit</option>
                                                    </select>
                                                    @error('sc_14_remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-light">
                                            <p>Lifting Price: 241</p>
                                            <p>Amount: 241000</p>
                                            <p>Lifting Amount: 241000</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- SCD-14 -->
                                <div class="col-lg-6">
                                    <div class="card mb-3 bg-gradient bg-secondary">
                                        <div class="card-header">SCD-14</div>
                                        <div class="card-body">
                                            <!-- Quantity -->
                                            <div class="row mb-3">
                                                <label for="scd_14" class="col-sm-3 col-form-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input name="scd_14" id="scd_14" type="number" class="form-control" value="{{ old('scd_14') }}" placeholder="Enter Quantity">
                                                    <input type="hidden" name="scd_14_lifting_price" id="scd_14_lifting_price">
                                                    <input type="hidden" name="scd_14_amount" id="scd_14_amount">
                                                    <input type="hidden" name="scd_14_lifting_amount" id="scd_14_lifting_amount">
                                                    @error('scd_14')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <!-- Cash/Credit -->
                                            <div class="row mb-3">
                                                <label for="scd_14_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                                <div class="col-sm-9">
                                                    <select name="scd_14_remarks" class="form-select" id="scd_14_remarks">
                                                        <option value="">- Select Mode -</option>
                                                        <option selected value="Cash">Cash</option>
                                                        <option value="Credit" >Credit</option>
                                                    </select>
                                                    @error('scd_14_remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-light">
                                            <p>Lifting Price: 241</p>
                                            <p>Amount: 241000</p>
                                            <p>Lifting Amount: 241000</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- SC-19 -->
                                <div class="col-lg-6">
                                    <div class="card mb-3 bg-gradient bg-secondary">
                                        <div class="card-header">SC-19</div>
                                        <div class="card-body">
                                            <!-- Quantity -->
                                            <div class="row mb-3">
                                                <label for="sc_19" class="col-sm-3 col-form-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input name="sc_19" id="sc_19" type="number" class="form-control" value="{{ old('sc_19') }}" placeholder="Enter Quantity">
                                                    <input type="hidden" name="sc_19_lifting_price" id="sc_19_lifting_price">
                                                    <input type="hidden" name="sc_19_amount" id="sc_19_amount">
                                                    <input type="hidden" name="sc_19_lifting_amount" id="sc_19_lifting_amount">
                                                    @error('sc_19')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <!-- Cash/Credit -->
                                            <div class="row mb-3">
                                                <label for="sc_19_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                                <div class="col-sm-9">
                                                    <select name="sc_19_remarks" class="form-select" id="sc_19_remarks">
                                                        <option value="">- Select Mode -</option>
                                                        <option selected value="Cash">Cash</option>
                                                        <option value="Credit" >Credit</option>
                                                    </select>
                                                    @error('sc_19_remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-light">
                                            <p>Lifting Price: 241</p>
                                            <p>Amount: 241000</p>
                                            <p>Lifting Amount: 241000</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- SCD-19 -->
                                <div class="col-lg-6">
                                    <div class="card mb-3 bg-gradient bg-secondary">
                                        <div class="card-header">SCD-19</div>
                                        <div class="card-body">
                                            <!-- Quantity -->
                                            <div class="row mb-3">
                                                <label for="scd_19" class="col-sm-3 col-form-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input name="scd_19" id="scd_19" type="number" class="form-control" value="{{ old('scd_19') }}" placeholder="Enter Quantity">
                                                    <input type="hidden" name="scd_19_lifting_price" id="scd_19_lifting_price">
                                                    <input type="hidden" name="scd_19_amount" id="scd_19_amount">
                                                    <input type="hidden" name="scd_19_lifting_amount" id="scd_19_lifting_amount">
                                                    @error('scd_19')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <!-- Cash/Credit -->
                                            <div class="row mb-3">
                                                <label for="scd_19_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                                <div class="col-sm-9">
                                                    <select name="scd_19_remarks" class="form-select" id="scd_19_remarks">
                                                        <option value="">- Select Mode -</option>
                                                        <option selected value="Cash">Cash</option>
                                                        <option value="Credit" >Credit</option>
                                                    </select>
                                                    @error('scd_19_remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-light">
                                            <p>Lifting Price: 241</p>
                                            <p>Amount: 241000</p>
                                            <p>Lifting Amount: 241000</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- SC-20 -->
                                <div class="col-lg-6">
                                    <div class="card mb-3 bg-gradient bg-secondary">
                                        <div class="card-header">SC-20</div>
                                        <div class="card-body">
                                            <!-- Quantity -->
                                            <div class="row mb-3">
                                                <label for="sc_20" class="col-sm-3 col-form-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input name="sc_20" id="sc_20" type="number" class="form-control" value="{{ old('sc_20') }}" placeholder="Enter Quantity">
                                                    <input type="hidden" name="sc_20_lifting_price" id="sc_20_lifting_price">
                                                    <input type="hidden" name="sc_20_amount" id="sc_20_amount">
                                                    <input type="hidden" name="sc_20_lifting_amount" id="sc_20_lifting_amount">
                                                    @error('sc_20')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <!-- Cash/Credit -->
                                            <div class="row mb-3">
                                                <label for="sc_20_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                                <div class="col-sm-9">
                                                    <select name="sc_20_remarks" class="form-select" id="sc_20_remarks">
                                                        <option value="">- Select Mode -</option>
                                                        <option selected value="Cash">Cash</option>
                                                        <option value="Credit" >Credit</option>
                                                    </select>
                                                    @error('sc_20_remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-light">
                                            <p>Lifting Price: 241</p>
                                            <p>Amount: 241000</p>
                                            <p>Lifting Amount: 241000</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- SCD-29 -->
                                <div class="col-lg-6">
                                    <div class="card mb-3 bg-gradient bg-secondary">
                                        <div class="card-header">SCD-29</div>
                                        <div class="card-body">
                                            <!-- Quantity -->
                                            <div class="row mb-3">
                                                <label for="scd_29" class="col-sm-3 col-form-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input name="scd_29" id="scd_29" type="number" class="form-control" value="{{ old('scd_29') }}" placeholder="Enter Quantity">
                                                    <input type="hidden" name="scd_29_lifting_price" id="scd_29_lifting_price">
                                                    <input type="hidden" name="scd_29_amount" id="scd_29_amount">
                                                    <input type="hidden" name="scd_29_lifting_amount" id="scd_29_lifting_amount">
                                                    @error('scd_29')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <!-- Cash/Credit -->
                                            <div class="row mb-3">
                                                <label for="scd_29_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                                <div class="col-sm-9">
                                                    <select name="scd_29_remarks" class="form-select" id="scd_29_remarks">
                                                        <option value="">- Select Mode -</option>
                                                        <option selected value="Cash">Cash</option>
                                                        <option value="Credit" >Credit</option>
                                                    </select>
                                                    @error('scd_29_remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-light">
                                            <p>Lifting Price: 241</p>
                                            <p>Amount: 241000</p>
                                            <p>Lifting Amount: 241000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h4 id="totalSimAmount" class="text-white">Total SC Amount: 1038961</h4>
                            <input type="hidden" name="total_sc_amount" id="total_sc_amount">
                        </div>
                    </div>

                    <!-- Device -->
                    <div class="card mb-3 bg-secondary bg-gradient">
                        <div class="card-header">
                            <h3 class="m-0 text-white">Device</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Router -->
                                <div class="col-lg-6">
                                    <div class="card mb-3 bg-gradient bg-secondary">
                                        <div class="card-header">Router</div>
                                        <div class="card-body">
                                            <!-- Quantity -->
                                            <div class="row mb-3">
                                                <label for="router" class="col-sm-3 col-form-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input name="router" id="router" type="number" class="form-control" value="{{ old('router') }}" placeholder="Enter Quantity">
                                                    <input type="hidden" name="router_lifting_price" id="router_lifting_price">
                                                    <input type="hidden" name="router_amount" id="router_amount">
                                                    @error('router')
                                                    <span class="text-danger">{{ $message }}</span>@else<small class="text-light" id="showPrice" style="font-weight: bold"></small>@enderror
                                                </div>
                                            </div>

                                            <!-- Cash/Credit -->
                                            <div class="row mb-3">
                                                <label for="router_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                                <div class="col-sm-9">
                                                    <select name="router_remarks" class="form-select" id="router_remarks">
                                                        <option value="">- Select Mode -</option>
                                                        <option selected value="Cash">Cash</option>
                                                        <option value="Credit" >Credit</option>
                                                    </select>
                                                    @error('router_remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-light">
                                            <p>Lifting Price: 241</p>
                                            <p>Amount: 241000</p>
                                            <p>Lifting Amount: 241000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h4 id="totalSimAmount" class="text-white">Total Device Amount: 1038961</h4>
                            <input type="hidden" name="total_device_amount" id="total_device_amount">
                        </div>
                    </div>

                    <!-- Bank Deposit -->
                    <div class="card mb-3 bg-secondary bg-gradient">
                        <div class="card-header">
                            <h3 class="m-0 text-white">Bank Deposit</h3>
                        </div>
                        <div class="card-body">
                            <!-- Bank Deposit -->
                            <div class="row mb-3">
                                <label for="bank_deposit" class="col-sm-3 col-form-label">Bank Deposit</label>
                                <div class="col-sm-9">
                                    <input name="bank_deposit" id="bank_deposit" type="number" class="form-control" value="{{ old('bank_deposit') }}" placeholder="Enter Deposit Amount">
                                    @error('bank_deposit')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <!-- Cash/Credit -->
                            <div class="row mb-3">
                                <label for="itopup_remarks" class="col-sm-3 col-form-label">Cash/Credit</label>
                                <div class="col-sm-9">
                                    <select name="itopup_remarks" class="form-select" id="itopup_remarks">
                                        <option value="">- Select Mode -</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Credit" >Credit</option>
                                    </select>
                                    @error('itopup_remarks') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h4 id="totalSimAmount" class="text-white">I'top-up Amount: 1038961</h4>
                            <input type="hidden" name="itopup" id="itopup">
                        </div>
                    </div>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <button type="submit" class="btn btn-sm btn-primary me-2 btn-submit">Create New Lifting</button>
                    <a href="{{ route('lifting.index') }}" class="btn btn-sm btn-info me-2 text-white">Back</a>
                </div>
            </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {

                var productLiftingPrice = '';
                var price = '';

                // MMST
                $('#mmst').blur(function (){
                    const mmstQty = $(this).val();
                    $.ajax({
                        url: "{{ route('lifting.calculation') }}",
                        type: "GET",
                        data: {mmstQty:mmstQty,product:'mmst'},
                        beforeSend: () => {
                            $('#loading').show();
                        },
                        complete: () => {
                            $('#loading').hide();
                        },
                        success: () => {

                        },
                    });
                });

            });
        </script>
    @endpush

</x-app-layout>
