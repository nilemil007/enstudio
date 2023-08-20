<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            EN<span>Studio</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">reports</li>

            <!-- Daily Activation -->
            <li class="nav-item {{ request()->routeIs('hca.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#dailyActivation" role="button" aria-expanded="false" aria-controls="dailyActivation">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Daily Activation</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('hca.*') ? 'show' : '' }}" id="dailyActivation">
                    <ul class="nav sub-menu">
                        <!-- House Code Activation [HCA] -->
                        @if(auth()->user()->role != 'md')
                        <li class="nav-item">
                            <a href="{{ route('hca.index') }}" class="nav-link {{ request()->routeIs('hca.index') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="House Code Activation">HCA</a>
                        </li>
                        @endif
                        <!-- Summary -->
                       @if(auth()->user()->role == 'md' || auth()->user()->role == 'superadmin')
                        <li class="nav-item">
                            <a href="{{ route('hca.summary') }}" class="nav-link {{ request()->routeIs('hca.summary') ? 'active' : (request()->routeIs('hca.lmtd') ? 'active' : '') }}">Summary</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>


            @if( auth()->user()->role == 'superadmin' )
            <li class="nav-item nav-category">Services</li>

            <!-- Itop Replace -->
            <li class="nav-item {{ request()->routeIs('itop-replace.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#itopReplace" role="button" aria-expanded="false" aria-controls="itopReplace">
                    <i class="link-icon" data-feather="info"></i>
                    <span class="link-title">Itop Replace</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('itop-replace.*') ? 'show' : '' }}" id="itopReplace">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('itop-replace.create') }}" class="nav-link {{ request()->routeIs('itop-replace.create') ? 'active' : '' }}">Add New</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('itop-replace.index') }}" class="nav-link {{ request()->routeIs('itop-replace.index') ? 'active' : '' }}">All Replace</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif

            <li class="nav-item nav-category">import</li>
            <!-- DD House -->
            <li class="nav-item {{ request()->routeIs('core.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#core" role="button" aria-expanded="false" aria-controls="core">
                    <i class="link-icon" data-feather="info"></i>
                    <span class="link-title">Core Data Import</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('core.*') ? 'show' : '' }}" id="core">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('core.activation') }}" class="nav-link {{ request()->routeIs('core.activation') ? 'active' : '' }}">Activation</a>
                        </li>
                    </ul>
                </div>
            </li>

            @if( auth()->user()->role == 'superadmin' )

            <li class="nav-item nav-category">Define</li>

            <!-- DD House -->
            <li class="nav-item {{ request()->routeIs('dd-house.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#ddHouse" role="button" aria-expanded="false" aria-controls="ddHouse">
                    <i class="link-icon" data-feather="info"></i>
                    <span class="link-title">DD House</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('dd-house.*') ? 'show' : '' }}" id="ddHouse">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('dd-house.create') }}" class="nav-link {{ request()->routeIs('dd-house.create') ? 'active' : '' }}">Add New</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dd-house.index') }}" class="nav-link {{ request()->routeIs('dd-house.index') ? 'active' : '' }}">All Houses</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Supervisor -->
            <li class="nav-item {{ request()->routeIs('supervisor.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#supervisor" role="button" aria-expanded="false" aria-controls="supervisor">
                    <i class="link-icon" data-feather="info"></i>
                    <span class="link-title">Supervisor</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('supervisor.*') ? 'show' : '' }}" id="supervisor">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('supervisor.create') }}" class="nav-link {{ request()->routeIs('supervisor.create') ? 'active' : '' }}">Add New</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('supervisor.index') }}" class="nav-link {{ request()->routeIs('supervisor.index') ? 'active' : '' }}">All Supervisors</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- RS0 -->
            <li class="nav-item {{ request()->routeIs('rso.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#rso" role="button" aria-expanded="false" aria-controls="rso">
                    <i class="link-icon" data-feather="info"></i>
                    <span class="link-title">RS0</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('rso.*') ? 'show' : '' }}" id="rso">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('rso.create') }}" class="nav-link {{ request()->routeIs('rso.create') ? 'active' : '' }}">Add New</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rso.index') }}" class="nav-link {{ request()->routeIs('rso.index') ? 'active' : '' }}">All Rso</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- BP -->
            <li class="nav-item {{ request()->routeIs('bp.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#bp" role="button" aria-expanded="false" aria-controls="bp">
                    <i class="link-icon" data-feather="info"></i>
                    <span class="link-title">BP</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('bp.*') ? 'show' : '' }}" id="bp">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('bp.create') }}" class="nav-link {{ request()->routeIs('bp.create') ? 'active' : '' }}">Add New</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bp.index') }}" class="nav-link {{ request()->routeIs('bp.index') ? 'active' : '' }}">All Bp</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- TMO -->
            <li class="nav-item ">
                <a class="nav-link" data-bs-toggle="collapse" href="#tmo" role="button" aria-expanded="false" aria-controls="tmo">
                    <i class="link-icon" data-feather="info"></i>
                    <span class="link-title">TMO</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse " id="tmo">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link ">Add New</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">All TMO</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Retailer -->
            <li class="nav-item {{ request()->routeIs('retailer.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#retailer" role="button" aria-expanded="false" aria-controls="retailer">
                    <i class="link-icon" data-feather="info"></i>
                    <span class="link-title">Retailer</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('retailer.*') ? 'show' : '' }}" id="retailer">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('retailer.create') }}" class="nav-link {{ request()->routeIs('retailer.create') ? 'active' : '' }}">Add New</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('retailer.index') }}" class="nav-link {{ request()->routeIs('retailer.index') ? 'active' : '' }}">All Retailers</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Trade Campaign Retailer Code -->
            <li class="nav-item {{ request()->routeIs('tcrc.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#tcrc" role="button" aria-expanded="false" aria-controls="tcrc">
                    <i class="link-icon" data-feather="info"></i>
                    <span class="link-title" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Trade Campaign Retailer Code">TCRC</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('tcrc.*') ? 'show' : '' }}" id="tcrc">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('tcrc.create') }}" class="nav-link {{ request()->routeIs('tcrc.create') ? 'active' : '' }}">Add New</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tcrc.index') }}" class="nav-link {{ request()->routeIs('tcrc.index') ? 'active' : '' }}">All TCRC List</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- BTS -->
            <li class="nav-item {{ request()->routeIs('bts.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#bts" role="button" aria-expanded="false" aria-controls="bts">
                    <i class="link-icon" data-feather="info"></i>
                    <span class="link-title">BTS</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('bts.*') ? 'show' : '' }}" id="bts">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('bts.create') }}" class="nav-link {{ request()->routeIs('bts.create') ? 'active' : '' }}">Add New</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bts.index') }}" class="nav-link {{ request()->routeIs('bts.index') ? 'active' : '' }}">All BTS</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Route -->
            <li class="nav-item {{ request()->routeIs('route.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#route" role="button" aria-expanded="false" aria-controls="route">
                    <i class="link-icon" data-feather="info"></i>
                    <span class="link-title">Route</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('route.*') ? 'show' : '' }}" id="route">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('route.create') }}" class="nav-link {{ request()->routeIs('route.create') ? 'active' : '' }}">Add New</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('route.index') }}" class="nav-link {{ request()->routeIs('route.index') ? 'active' : '' }}">All Routes</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Scratch Card Serial -->
            <li class="nav-item {{ request()->routeIs('sc-serial.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#scSerial" role="button" aria-expanded="false" aria-controls="sc_serial">
                    <i class="link-icon" data-feather="info"></i>
                    <span class="link-title">SC Serial</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('sc-serial.*') ? 'show' : '' }}" id="scSerial">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('sc-serial.create') }}" class="nav-link {{ request()->routeIs('sc-serial.create') ? 'active' : '' }}">Add New</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sc-serial.index') }}" class="nav-link {{ request()->routeIs('sc-serial.index') ? 'active' : '' }}">All SC Serial</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">New Registration</li>

            <!-- New Registration -->
            <li class="nav-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">User</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('user.*') ? 'show' : '' }}" id="users">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('user.create') }}" class="nav-link {{ request()->routeIs('user.create') ? 'active' : '' }}">Add New</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">All Users</a>
                        </li>
                    </ul>
                </div>
            </li>

            @endif
        </ul>
    </div>
</nav>
