 <div class="app-sidebar-menu">
     <div class="h-100" data-simplebar>
         <div id="sidebarMenu">
             <div class="logo-box">
                 <a class='logo logo-light' href='{{ route('home') }}'>
                     <span class="d-none d-sm-block d-md-none">
                         <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                     </span>
                     <span class="d-sm-none d-md-block">
                         <img src="{{ asset('assets/img/logo-countryside-g.jpg') }}" alt="" height="80">
                     </span>
                 </a>
                 <a class='logo logo-dark' href='{{ route('home') }}'>
                     <span class="d-none d-sm-block d-md-none">
                         <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                     </span>
                     <span class="d-sm-none d-md-block">
                         <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="24">
                     </span>
                 </a>
             </div>

             <ul class="nav flex-column">
                 <li class="menu-title">Menu</li>

                 <li class="nav-item">
                     <a class="nav-link" href='{{ route('admin.dashboard') }}'>
                         <i data-feather="home"></i>
                         {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
                         <span>Dashboard</span>
                     </a>
                 </li>

                 <li class="menu-title">Pages</li>
                 @if (auth()->user()->hasRole('admin'))
                     <li class="{{ request()->routeIs(['users.*', 'roles.*', 'permission.*']) ? 'menuitem-active' : '' }} nav-item">
                         <a class="nav-link" href="#sidebarExpages" data-bs-toggle="collapse">
                             <i data-feather="file-text"></i>
                             <span>Admin</span>
                             <span class="menu-arrow"></span>
                         </a>
                         <div class="collapse {{ request()->routeIs(['users.*', 'roles.*', 'permission.*']) ? 'show' : '' }}" id="sidebarExpages">
                             <ul class="nav-second-level">
                                 {{-- <li class="{{ request()->routeIs('permission.*') ? 'menuitem-active' : '' }}">
                                         <a href='{{ route('permission.index') }}'>Permmision</a>
                                     </li>
                                     <li class="{{ request()->routeIs('roles.*') ? 'menuitem-active' : '' }}">
                                         <a href='{{ route('roles.index') }}'>Roles</a>
                                     </li> --}}
                                 <li class="{{ request()->routeIs('users.*') ? 'menuitem-active' : '' }}">
                                     <a href='{{ route('users.index') }}'>User Management</a>
                                 </li>
                             </ul>
                         </div>
                     </li>
                 @endif
                 <li class="{{ request()->routeIs('property.*') ? 'menuitem-active' : '' }} nav-item">
                     <a class="nav-link" href='{{ route('property.index') }}'>
                         <i data-feather="home"></i>
                         <span>Properties</span>
                     </a>
                 </li>
                 {{-- <li class="{{ request()->routeIs('developer_properties.*') ? 'menuitem-active' : '' }}">
                     <a href='{{ route('developer_properties.index') }}'>
                         <i data-feather="briefcase"></i>
                         <span> Dev's Properties </span>
                     </a>
                 </li>
                 <li class="{{ request()->routeIs('developers.*') ? 'menuitem-active' : '' }}">
                     <a href='{{ route('developers.index') }}'>
                         <i data-feather="briefcase"></i>
                         <span> Developers </span>
                     </a>
                 </li>
                 <li class="{{ request()->routeIs('agents.*') ? 'menuitem-active' : '' }}">
                     <a href='{{ route('agents.index') }}'>
                         <i data-feather="users"></i>
                         <span> Agents </span>
                     </a>
                 </li> --}}
                 {{-- <li class="{{ request()->routeIs('blogs.*') ? 'menuitem-active' : '' }}"> --}}
                 {{--     <a href='{{ route('blogs.index') }}'> --}}
                 {{--         <i data-feather="file-text"></i> --}}
                 {{--         <span>Blog</span> --}}
                 {{--     </a> --}}
                 {{-- </li> --}}
                 <li class="nav-item {{ request()->routeIs('Amenity.*') ? 'menuitem-active' : '' }}">
                     <a class="nav-link" href="{{ route('amenity.index') }}">
                         <i data-feather="star"></i>
                         <span>Amenity</span>
                     </a>
                 </li>
                 <li class="nav-item {{ request()->routeIs('master-plans.*') ? 'menuitem-active' : '' }}">
                     <a class="nav-link" href="{{ route('master-plans.index') }}">
                         <i data-feather="grid"></i>
                         <span>Master Plans</span>
                     </a>
                 </li>
                 <li class="nav-item {{ request()->routeIs('locations.*') ? 'menuitem-active' : '' }}">
                     <a class="nav-link" href='{{ route('locations.index') }}'>
                         <i data-feather="map-pin"></i>
                         <span>Locations</span>
                     </a>
                 </li>
                 <li class="nav-item {{ request()->routeIs('communities.*') ? 'menuitem-active' : '' }}">
                     <a class="nav-link" href='{{ route('communities.index') }}'>
                         <i data-feather="users"></i>
                         <span>Communities</span>
                     </a>
                 </li>
                 {{-- <li class="{{ request()->routeIs('team.*') ? 'menuitem-active' : '' }}"> --}}
                 {{--     <a href='{{ route('team.index') }}'> --}}
                 {{--         <i data-feather="users"></i> --}}
                 {{--         <span>Team</span> --}}
                 {{--     </a> --}}
                 {{-- </li> --}}
                {{-- <li class="{{ request()->routeIs('visitor-submissions.*') ? 'menuitem-active' : '' }}"> --}}
                {{--     <a href='{{ route('visitor-submissions.index') }}'> --}}
                {{--         <i data-feather="inbox"></i> --}}
                {{--         <span> Visitor Submissions </span> --}}
                {{--     </a> --}}
                {{-- </li> --}}
                {{-- <li class="{{ request()->routeIs('vendor-registrations.*') ? 'menuitem-active' : '' }}"> --}}
                {{--     <a href='{{ route('vendor-registrations.index') }}'> --}}
                {{--         <i data-feather="users"></i> --}}
                {{--         <span> Vendor Registrations </span> --}}
                {{--     </a> --}}
                {{-- </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href='{{ route('logout') }}' class="text-danger ">
                        <i data-feather="log-out"></i>
                        <span> Logout </span>
                     </a>
                 </li>
             </ul>

         </div>

         <div class="clearfix"></div>
     </div>
 </div>
 <!-- Left Sidebar End -->
