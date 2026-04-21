<style>
.menu_mobile_inner { max-height: 100vh;overflow-y: auto;}
nav.menu_mobile_nav_area { padding-top: 60px !important;}
.tooltip { z-index: 99999 !important;}
.tooltip .arrow { z-index: 99998 !important;}
</style>
<div class="menu_mobile menu_mobile_narrow is_opened">
    <div class="menu_mobile_inner">
        <div class="menu_mobile_top_panel">
            <a class="menu_mobile_close theme_button_close" tabindex="0"><span class="theme_button_close_icon"></span></a>
            <a class="sc_layouts_logo" href="">
                <img class="lazyload_inited d-none" src="{{asset('sales_manager/uploads/2023/12/Salehiya-Launch-pad-v4-02.jpg')}}" alt="salehiya" width="418" height="224">
            </a>
        </div>

        @php
        $role = Auth::user()->role;
        @endphp
        <nav class="menu_mobile_nav_area" itemscope="itemscope" itemtype="">
            <ul id="mobile-menu_mobile" class="menu_mobile_nav">

                <!-- Home Menu Item -->
                <li id="mobile-menu-item-9071" class="icon-home-3 menu-item menu-item-type-custom menu-item-object-custom
                    @if(Request::routeIs('AdminDashboard') || Request::is('/')) current-menu-item @endif">
                    @if($role == "Admin")
                    <a title="Dashboard" data-toggle="tooltip" rel="noopener" href="{{ route('AdminDashboard') }}">
                        @else
                        <a href="" rel="noopener" aria-current="page">
                            @endif
                            <span>Home</span>
                        </a>
                </li>

                <!-- Manage Main Dashboard -->
                <li id="mobile-menu-item-9582" class="icon-menu-2 menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('SalemanagerDashboard')) current-menu-item @endif">
                    <a title="Manage Main Dashboard" data-toggle="tooltip" rel="noopener" href="{{ route('SalemanagerDashboard') }}">
                        <span>Manage Main Dashboard</span>
                    </a>
                </li>

                <!-- About Dubai Production Tool -->
                <li id="mobile-menu-item-9582" class="icon-analytics menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('AboutDubaiProductionTool')) current-menu-item @endif">
                    <a title="About Dubai Production Tool" data-toggle="tooltip" rel="noopener" href="{{ route('AboutDubaiProductionTool') }}">
                        <span>About Dubai Production Tool</span>
                    </a>
                </li>

                <!-- Pricing Tool -->
                <li id="mobile-menu-item-9582" class="icon-sale menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('PricingTool')) current-menu-item @endif">
                    <a title="Pricing Tool" data-toggle="tooltip" rel="noopener" href="{{ route('PricingTool') }}">
                        <span>Pricing Tool</span>
                    </a>
                </li>

                <!-- Reference Table -->
                <li id="mobile-menu-item-9582" class="icon-link menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('RefTable')) current-menu-item @endif">
                    <a title="Reference Table" data-toggle="tooltip" rel="noopener" href="{{ route('RefTable') }}">
                        <span>Reference Table</span>
                    </a>
                </li>

                <!-- Order Track -->
                <li id="mobile-menu-item-9582" class="icon-cart-2 menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('OrderTrack')) current-menu-item @endif">
                    <a title="Order Track" data-toggle="tooltip" rel="noopener" href="{{ route('OrderTrack')}}">
                        <span>Order Track</span>
                    </a>
                </li>

                <!-- Virtual Tour -->
                <li id="mobile-menu-item-9582" class="icon-video menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('VirtualTour')) current-menu-item @endif">
                    <a title="Virtual Tour" data-toggle="tooltip" rel="noopener" href="{{ route('VirtualTour')}}">
                        <span>Virtual Tour</span>
                    </a>
                </li>

                <!-- Test Facility -->
                <li id="mobile-menu-item-9582" class="icon-menu-1 menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('TestFacility')) current-menu-item @endif">
                    <a title="Test Facility" data-toggle="tooltip" rel="noopener" href="{{ route('TestFacility')}}">
                        <span>Test Facility</span>
                    </a>
                </li>

                <!-- Request Training Menu Item -->
                <li id="mobile-menu-item-9460" class="icon-calendar-2 menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('AdminRequestTraining')) current-menu-item @endif">
                    <a title="Request Training" data-toggle="tooltip" rel="noopener" href="{{ route('AdminRequestTraining') }}">
                        <span>Request Training</span>
                    </a>
                </li>

                <!-- Witness Test Menu Item -->
                <li id="mobile-menu-item-9080" class="icon-calendar-1 menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('AdminWitnessTest')) current-menu-item @endif">
                    <a title="Witness Test" data-toggle="tooltip" rel="noopener" href="{{ route('AdminWitnessTest') }}">
                        <span>Witness Test</span>
                    </a>
                </li>

                <!-- Feedback Menu Item -->
                <li id="mobile-menu-item-9080" class="icon-book-1 menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('AdminFeedback')) current-menu-item @endif">
                    <a title="Feedback" data-toggle="tooltip" rel="noopener" href="{{ route('AdminFeedback') }}">
                        <span>Feedback</span>
                    </a>
                </li>

                <!-- Countries Menu Item -->
                <li id="mobile-menu-item-9582" class="icon-globe menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('admin.countries.index')) current-menu-item @endif">
                    <a title="Countries" data-toggle="tooltip" rel="noopener" href="{{ route('admin.countries.index') }}">
                        <span>Countries</span>
                    </a>
                </li>

                <!-- Users Menu Item -->
                <li id="mobile-menu-item-9582" class="icon-user-1 menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('admin.users.index')) current-menu-item @endif">
                    <a title="Users" data-toggle="tooltip" rel="noopener" href="{{ route('admin.users.index') }}">
                        <span>Users</span>
                    </a>
                </li>

                <!-- Document Prortal -->
                <li id="mobile-menu-item-9582" class="icon-document-1 menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('DocumentPortal', 'GenralDocument', 'BoosterDoc', 'ControlDoc', 'NormDoc', 'SplitCaseDoc', 'HelixDoc', 'PumpMotorDoc', 'BoreholeDoc', 'FireDoc', 'ProductDocument')) current-menu-item @endif">
                    <a title="Document Portal" data-toggle="tooltip" rel="noopener" href="{{ route('DocumentPortal') }}">
                        <span>Document Portal</span>
                    </a>
                </li>

                <!-- Media Database -->
                <li id="mobile-menu-item-9582" class="icon-gallery menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('MediaDB', 'MediaImages', 'MediaVideos', 'MediaDocs')) current-menu-item @endif">
                    <a title="Media Database" data-toggle="tooltip" rel="noopener" href="{{ route('MediaDB') }}">
                        <span>Media Database</span>
                    </a>
                </li>

               

                <!-- Customer Service Menu Item -->
                <li id="mobile-menu-item-9581" class="icon-help menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('cutomer_service')) current-menu-item @endif">
                    <a title="Customer Service" data-toggle="tooltip" rel="noopener" href="{{ route('cutomer_service') }}">
                        <span>Customer Service</span>
                    </a>
                </li>

                <!-- Settings Menu Item -->
                <li id="mobile-menu-item-9581" class="icon-settings-1 menu-item menu-item-type-custom menu-item-object-custom @if(Request::routeIs('AdminSettings')) current-menu-item @endif">
                    <a title="Settings" data-toggle="tooltip" rel="noopener" href="{{ route('AdminSettings') }}">
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
