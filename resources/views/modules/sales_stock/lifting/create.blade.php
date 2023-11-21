<x-app-layout>

    <!-- Title -->
    <x-slot:title>Create New Lifting</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <form x-data="lifting" id="cmForm" action="{{ route('lifting.store') }}" method="POST">
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
                            <div class="card-footer">
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" role="switch" value="openSimWindow" id="openSimWindow">
                                        <label class="form-check-label text-white" for="openSimWindow">SIM</label>
                                    </div>

                                    <div class="form-check" style="margin-left: 20px">
                                        <input class="form-check-input" type="checkbox" value="mmst" id="openMmstWindow">
                                        <label class="form-check-label text-white" for="openMmstWindow">
                                            MMST
                                        </label>
                                    </div>

                                    <div class="form-check" style="margin-left: 20px">
                                        <input class="form-check-input" type="checkbox" value="mmsts" id="openMmstsWindow">
                                        <label class="form-check-label text-white" for="openMmstsWindow">
                                            MMSTS
                                        </label>
                                    </div>

                                    <div class="form-check" style="margin-left: 20px">
                                        <input class="form-check-input" type="checkbox" value="simSwap" id="openSimSwapWindow">
                                        <label class="form-check-label text-white" for="openSimSwapWindow">
                                            Sim Swap
                                        </label>
                                    </div>

                                    <div class="form-check" style="margin-left: 20px">
                                        <input class="form-check-input" type="checkbox" value="simSwapEv" id="openSimSwapEvWindow">
                                        <label class="form-check-label text-white" for="openSimSwapEvWindow">
                                            Sim Swap Ev
                                        </label>
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
                                                        <input x-model.number="productSim.mmst.qty" name="mmst" id="mmst" type="number" class="form-control" value="{{ old('mmst') }}" placeholder="Enter Quantity">
                                                        <input :value="productSim.mmst.liftingPrice" type="hidden" name="mmst_lifting_price" id="mmst_lifting_price" placeholder="mmst_lifting_price">
                                                        <input :value="productSim.mmst.liftingPrice * productSim.mmst.qty" type="hidden" name="mmst_amount" id="mmst_amount" placeholder="mmst_amount">
                                                        @error('mmst')<span class="text-danger">{{ $message }}</span>@enderror
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
                                            <div x-transition x-cloak x-show="productSim.mmst.qty" class="card-footer text-light">
                                                <p x-text="'Lifting Price: ' + productSim.mmst.liftingPrice"></p>
                                                <p x-text="'Total Amount: ' + productSim.mmst.liftingPrice * productSim.mmst.qty"></p>
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
                                                        <input x-model.number="productSim.mmsts.qty" name="mmsts" id="mmsts" type="number" class="form-control" value="{{ old('mmsts') }}" placeholder="Enter Quantity">
                                                        <input :value="productSim.mmsts.liftingPrice" type="hidden" name="mmsts_lifting_price" id="mmsts_lifting_price">
                                                        <input :value="productSim.mmsts.liftingPrice * productSim.mmsts.qty" type="hidden" name="mmsts_amount" id="mmsts_amount">
                                                        @error('mmsts')<span class="text-danger">{{ $message }}</span>@enderror
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
                                            <div x-transition x-cloak x-show="productSim.mmsts.qty" class="card-footer text-light">
                                                <p x-text="'Lifting Price: ' + productSim.mmsts.liftingPrice"></p>
                                                <p x-text="'Total Amount: ' + productSim.mmsts.liftingPrice * productSim.mmsts.qty"></p>
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
                                                        <input x-model.number="productSim.simSwap.qty" name="sim_swap" id="sim_swap" type="number" class="form-control" value="{{ old('sim_swap') }}" placeholder="Enter Quantity">
                                                        <input :value="productSim.simSwap.liftingPrice" type="hidden" name="sim_swap_lifting_price" id="sim_swap_lifting_price">
                                                        <input :value="productSim.simSwap.liftingPrice * productSim.simSwap.qty" type="hidden" name="sim_swap_amount" id="sim_swap_amount">
                                                        @error('sim_swap')<span class="text-danger">{{ $message }}</span>@enderror
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
                                            <div x-transition x-cloak x-show="productSim.simSwap.qty" class="card-footer text-light">
                                                <p x-text="'Lifting Price: ' + productSim.simSwap.liftingPrice"></p>
                                                <p x-text="'Total Amount: ' + productSim.simSwap.liftingPrice * productSim.simSwap.qty"></p>
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
                                                        <input x-model.number="productSim.simSwapEv.qty" name="sim_swap_ev" id="sim_swap_ev" type="number" class="form-control" value="{{ old('sim_swap_ev') }}" placeholder="Enter Quantity">
                                                        <input :value="productSim.simSwapEv.liftingPrice" type="hidden" name="sim_swap_ev_lifting_price" id="sim_swap_ev_lifting_price">
                                                        <input :value="productSim.simSwapEv.liftingPrice * productSim.simSwapEv.qty" type="hidden" name="sim_swap_ev_amount" id="sim_swap_ev_amount">
                                                        @error('sim_swap_ev')
                                                        <span class="text-danger">{{ $message }}</span>@enderror
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
                                            <div x-transition x-cloak x-show="productSim.simSwapEv.qty" class="card-footer text-light">
                                                <p x-text="'Lifting Price: ' + productSim.simSwapEv.liftingPrice"></p>
                                                <p x-text="'Total Amount: ' + productSim.simSwapEv.liftingPrice * productSim.simSwapEv.qty"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div x-transition x-cloak x-show="totalSimAmount" class="card-footer">
                                <h4 x-text="'Total SIM Amount: ' + totalSimAmount" class="text-white"></h4>
                                <input :value="totalSimAmount" type="hidden" name="total_sim_amount" placeholder="total_sim_amount">
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
                                                        <input x-model.number="productSc.sc10.qty" name="sc_10" id="sc_10" type="number" class="form-control" value="{{ old('sc_10') }}" placeholder="Enter Quantity">
                                                        <input :value="productSc.sc10.liftingPrice" type="hidden" name="sc_10_lifting_price" id="sc_10_lifting_price">
                                                        <input :value="productSc.sc10.price * productSc.sc10.qty" type="hidden" name="sc_10_amount" id="sc_10_amount">
                                                        <input :value="productSc.sc10.liftingPrice * productSc.sc10.qty" type="hidden" name="sc_10_lifting_amount" id="sc_10_lifting_amount">
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
                                            <div x-transition x-cloak x-show="productSc.sc10.qty" class="card-footer text-light">
                                                <p x-text="'Lifting Price: ' + productSc.sc10.liftingPrice"></p>
                                                <p x-text="'Amount: ' + productSc.sc10.price * productSc.sc10.qty"></p>
                                                <p x-text="'Lifting Amount: ' + Math.round(productSc.sc10.liftingPrice * productSc.sc10.qty)"></p>
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
                                                        <input x-model.number="productSc.sc14.qty" name="sc_14" id="sc_14" type="number" class="form-control" value="{{ old('sc_14') }}" placeholder="Enter Quantity">
                                                        <input :value="productSc.sc14.liftingPrice" type="hidden" name="sc_14_lifting_price" id="sc_14_lifting_price">
                                                        <input :value="productSc.sc14.price * productSc.sc14.qty" type="hidden" name="sc_14_amount" id="sc_14_amount">
                                                        <input :value="productSc.sc14.liftingPrice * productSc.sc14.qty" type="hidden" name="sc_14_lifting_amount" id="sc_14_lifting_amount">
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
                                            <div x-transition x-cloak x-show="productSc.sc14.qty" class="card-footer text-light">
                                                <p x-text="'Lifting Price: ' + productSc.sc14.liftingPrice"></p>
                                                <p x-text="'Amount: ' + productSc.sc14.price * productSc.sc14.qty"></p>
                                                <p x-text="'Lifting Amount: ' + Math.round(productSc.sc14.liftingPrice * productSc.sc14.qty)"></p>
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
                                                        <input x-model.number="productSc.scd14.qty" name="scd_14" id="scd_14" type="number" class="form-control" value="{{ old('scd_14') }}" placeholder="Enter Quantity">
                                                        <input :value="productSc.scd14.liftingPrice" type="hidden" name="scd_14_lifting_price" id="scd_14_lifting_price">
                                                        <input :value="productSc.scd14.price * productSc.scd14.qty" type="hidden" name="scd_14_amount" id="scd_14_amount">
                                                        <input :value="productSc.scd14.liftingPrice * productSc.scd14.qty" type="hidden" name="scd_14_lifting_amount" id="scd_14_lifting_amount">
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
                                            <div x-transition x-cloak x-show="productSc.scd14.qty" class="card-footer text-light">
                                                <p x-text="'Lifting Price: ' + productSc.scd14.liftingPrice"></p>
                                                <p x-text="'Amount: ' + productSc.scd14.price * productSc.scd14.qty"></p>
                                                <p x-text="'Lifting Amount: ' + Math.round(productSc.scd14.liftingPrice * productSc.scd14.qty)"></p>
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
                                                        <input x-model.number="productSc.sc19.qty" name="sc_19" id="sc_19" type="number" class="form-control" value="{{ old('sc_19') }}" placeholder="Enter Quantity">
                                                        <input :value="productSc.sc19.liftingPrice" type="hidden" name="sc_19_lifting_price" id="sc_19_lifting_price">
                                                        <input :value="productSc.sc19.price * productSc.sc19.qty" type="hidden" name="sc_19_amount" id="sc_19_amount">
                                                        <input :value="productSc.sc19.liftingPrice * productSc.sc19.qty" type="hidden" name="sc_19_lifting_amount" id="sc_19_lifting_amount">
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
                                            <div x-transition x-cloak x-show="productSc.sc19.qty" class="card-footer text-light">
                                                <p x-text="'Lifting Price: ' + productSc.sc19.liftingPrice"></p>
                                                <p x-text="'Amount: ' + productSc.sc19.price * productSc.sc19.qty"></p>
                                                <p x-text="'Lifting Amount: ' + Math.round(productSc.sc19.liftingPrice * productSc.sc19.qty)"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SCD-19 -->
                                    <div class="col-lg-6">
                                        <div class="card mb-3 bg-gradient bg-secondary">
                                            <div class="card-header">SDC-19</div>
                                            <div class="card-body">
                                                <!-- Quantity -->
                                                <div class="row mb-3">
                                                    <label for="scd_19" class="col-sm-3 col-form-label">Quantity</label>
                                                    <div class="col-sm-9">
                                                        <input x-model.number="productSc.scd19.qty" name="scd_19" id="scd_19" type="number" class="form-control" value="{{ old('scd_19') }}" placeholder="Enter Quantity">
                                                        <input :value="productSc.scd19.liftingPrice" type="hidden" name="scd_19_lifting_price" id="scd_19_lifting_price">
                                                        <input :value="productSc.scd19.price * productSc.scd19.qty" type="hidden" name="scd_19_amount" id="scd_19_amount">
                                                        <input :value="productSc.scd19.liftingPrice * productSc.scd19.qty" type="hidden" name="scd_19_lifting_amount" id="scd_19_lifting_amount">
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
                                            <div x-transition x-cloak x-show="productSc.scd19.qty" class="card-footer text-light">
                                                <p x-text="'Lifting Price: ' + productSc.scd19.liftingPrice"></p>
                                                <p x-text="'Amount: ' + productSc.scd19.price * productSc.scd19.qty"></p>
                                                <p x-text="'Lifting Amount: ' + Math.round(productSc.scd19.liftingPrice * productSc.scd19.qty)"></p>
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
                                                        <input x-model.number="productSc.sc20.qty" name="sc_20" id="sc_20" type="number" class="form-control" value="{{ old('sc_20') }}" placeholder="Enter Quantity">
                                                        <input :value="productSc.sc20.liftingPrice" type="hidden" name="sc_20_lifting_price" id="sc_20_lifting_price">
                                                        <input :value="productSc.sc20.price * productSc.sc20.qty" type="hidden" name="sc_20_amount" id="sc_20_amount">
                                                        <input :value="productSc.sc20.liftingPrice * productSc.sc20.qty" type="hidden" name="sc_20_lifting_amount" id="sc_20_lifting_amount">
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
                                            <div x-transition x-cloak x-show="productSc.sc20.qty" class="card-footer text-light">
                                                <p x-text="'Lifting Price: ' + productSc.sc20.liftingPrice"></p>
                                                <p x-text="'Amount: ' + productSc.sc20.price * productSc.sc20.qty"></p>
                                                <p x-text="'Lifting Amount: ' + Math.round(productSc.sc20.liftingPrice * productSc.sc20.qty)"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SCD-29 -->
                                    <div class="col-lg-6">
                                        <div class="card mb-3 bg-gradient bg-secondary">
                                            <div class="card-header">SDC-29</div>
                                            <div class="card-body">
                                                <!-- Quantity -->
                                                <div class="row mb-3">
                                                    <label for="scd_29" class="col-sm-3 col-form-label">Quantity</label>
                                                    <div class="col-sm-9">
                                                        <input x-model.number="productSc.scd29.qty" name="scd_29" id="scd_29" type="number" class="form-control" value="{{ old('scd_29') }}" placeholder="Enter Quantity">
                                                        <input :value="productSc.scd29.liftingPrice" type="hidden" name="scd_29_lifting_price" id="scd_29_lifting_price">
                                                        <input :value="productSc.scd29.price * productSc.scd29.qty" type="hidden" name="scd_29_amount" id="scd_29_amount">
                                                        <input :value="productSc.scd29.liftingPrice * productSc.scd29.qty" type="hidden" name="scd_29_lifting_amount" id="scd_29_lifting_amount">
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
                                            <div x-transition x-cloak x-show="productSc.scd29.qty" class="card-footer text-light">
                                                <p x-text="'Lifting Price: ' + productSc.scd29.liftingPrice"></p>
                                                <p x-text="'Amount: ' + productSc.scd29.price * productSc.scd29.qty"></p>
                                                <p x-text="'Lifting Amount: ' + Math.round(productSc.scd29.liftingPrice * productSc.scd29.qty)"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Grand Total SC Amount -->
                            <div x-transition x-cloak x-show="totalScAmount.amount" class="card-footer">
                                <h4 x-text="'Total SC Amount: ' + Math.round(totalScAmount.amount)" class="text-white"></h4>
                                <h4 x-text="'Total SC Lifting Amount: ' + Math.round(totalScAmount.liftingAmount)" class="text-white"></h4>
                                <input :value="Math.round(totalScAmount.amount)" type="hidden" name="total_sc_amount" placeholder="total_sc_amount">
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
                                                        <input x-model.number="device.router.qty" name="router" id="router" type="number" class="form-control" value="{{ old('router') }}" placeholder="Enter Quantity">
                                                        <input :value="device.router.price" type="hidden" name="router_price" id="router_price">
                                                        <input :value="device.router.liftingPrice" type="hidden" name="router_retailer_price" id="router_retailer_price">
                                                        <input :value="device.router.price * device.router.qty" type="hidden" name="router_amount" id="router_amount">
                                                        <input :value="device.router.liftingPrice * device.router.qty" type="hidden" name="router_lifting_amount" id="router_lifting_amount">
                                                        @error('router')<span class="text-danger">{{ $message }}</span>@enderror
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
                                            <div x-transition x-cloak x-show="device.router.qty" class="card-footer text-light">
                                                <p x-text="'Price: ' + device.router.price"></p>
                                                <p x-text="'Lifting Price: ' + device.router.liftingPrice"></p>
                                                <p x-text="'Amount: ' + device.router.qty * device.router.price"></p>
                                                <p x-text="'Lifting Amount: ' + parseFloat(device.router.qty * device.router.liftingPrice).toFixed(2)"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div x-transition x-cloak x-show="totalDeviceAmount.amount" class="card-footer">
                                <h4 x-text="'Total Device Amount: ' + totalDeviceAmount.amount" id="totalDeviceAmount" class="text-white"></h4>
                                <h4 x-text="'Total Device Lifting Amount: ' + parseFloat(totalDeviceAmount.liftingAmount).toFixed(2)" id="totalDeviceLiftingAmount" class="text-white"></h4>
                                <input :value="totalDeviceAmount.amount" type="hidden" name="total_device_amount" id="total_device_amount">
                                <input :value="parseFloat(totalDeviceAmount.liftingAmount).toFixed(2)" type="hidden" name="total_device_lifting_amount" id="total_device_lifting_amount">
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
                                        <input x-model.number="bankDeposit" name="bank_deposit" id="bank_deposit" type="number" class="form-control" value="{{ old('bank_deposit') }}" placeholder="Enter Deposit Amount">
                                        <input :value="parseFloat(itopAmount).toFixed(2)" type="hidden" name="itopup" id="itopup">
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
                            <div x-transition x-cloak x-show="bankDeposit" class="card-footer">
                                <h4 x-text="'I\'top-up Amount: ' + parseFloat(itopAmount).toFixed(2)" id="totalSimAmount" class="text-white"></h4>
                                <h4 x-text="'Deposit Amount: ' + bankDeposit" class="text-white"></h4>
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

            document.addEventListener('alpine:init', () => {
                Alpine.data('lifting', () => ({
                    productSim: {
                        mmst: {
                            liftingPrice: 241,
                            qty: '',
                        },
                        mmsts: {
                            liftingPrice: 241,
                            qty: '',
                        },
                        simSwap: {
                            liftingPrice: 223,
                            qty: '',
                        },
                        simSwapEv: {
                            liftingPrice: 100,
                            qty: '',
                        },
                    },

                    productSc: {
                        sc10: {
                            price: 10,
                            liftingPrice: 9.65,
                            qty: '',
                        },
                        sc14: {
                            price: 14,
                            liftingPrice: 13.5576,
                            qty: '',
                        },
                        scd14: {
                            price: 14,
                            liftingPrice: 13.5576,
                            qty: '',
                        },
                        sc19: {
                            price: 19,
                            liftingPrice: 18.31,
                            qty: '',
                        },
                        scd19: {
                            price: 19,
                            liftingPrice: 18.31,
                            qty: '',
                        },
                        sc20: {
                            price: 20,
                            liftingPrice: 19.30,
                            qty: '',
                        },
                        scd29: {
                            price: 29,
                            liftingPrice: 27.91,
                            qty: '',
                        },
                    },

                    device: {
                        router: {
                            price: '3400',
                            liftingPrice: '3357.47',
                            qty: '',
                        },
                    },

                    bankDeposit: '',

                    get totalSimAmount(){
                        return (this.productSim.mmst.liftingPrice * this.productSim.mmst.qty) + (this.productSim.mmsts.liftingPrice * this.productSim.mmsts.qty) + (this.productSim.simSwap.liftingPrice * this.productSim.simSwap.qty) + (this.productSim.simSwapEv.liftingPrice * this.productSim.simSwapEv.qty)
                    },
                    get totalScAmount(){
                        return {
                            amount: (this.productSc.sc10.price * this.productSc.sc10.qty) + (this.productSc.sc14.price * this.productSc.sc14.qty) + (this.productSc.scd14.price * this.productSc.scd14.qty) + (this.productSc.sc19.price * this.productSc.sc19.qty) + (this.productSc.scd19.price * this.productSc.scd19.qty) + (this.productSc.sc20.price * this.productSc.sc20.qty) + (this.productSc.scd29.price * this.productSc.scd29.qty),
                            liftingAmount: (this.productSc.sc10.liftingPrice * this.productSc.sc10.qty) + (this.productSc.sc14.liftingPrice * this.productSc.sc14.qty) + (this.productSc.scd14.liftingPrice * this.productSc.scd14.qty) + (this.productSc.sc19.liftingPrice * this.productSc.sc19.qty) + (this.productSc.scd19.liftingPrice * this.productSc.scd19.qty) + (this.productSc.sc20.liftingPrice * this.productSc.sc20.qty) + (this.productSc.scd29.liftingPrice * this.productSc.scd29.qty),
                        }
                    },
                    get totalDeviceAmount(){
                        return {
                            amount: this.device.router.qty * this.device.router.price,
                            liftingAmount: this.device.router.qty * this.device.router.liftingPrice,
                        }
                    },
                    get restAmount(){
                        return this.bankDeposit - this.totalSimAmount - this.totalScAmount.liftingAmount - this.totalDeviceAmount.liftingAmount
                    },
                    get itopAmount(){
                        return this.restAmount / 0.9625
                    },



                    // get totalSimAmount(){
                    //     return Object.values(this.mmst).reduce((acc, cur) => acc + cur.liftingPrice*cur.qty, 0)
                    //     return Object.values(this.productSim).reduce((acc, cur) => acc * cur)
                    //     return console.log( Object.values(this.productSim).reduce((acc, cur) => acc) )
                    // },
                }));
            });

        </script>
    @endpush

</x-app-layout>
