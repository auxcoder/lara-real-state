 <div class="app-sidebar-menu">
     <div class="h-100" data-simplebar>
         <div id="sidebarMenu">
             <div class="w-100 bg-primary">
                 <a class='d-block mx-auto ms-3' href='{{ route('home') }}'>
                    <img src="{{ asset('assets/img/logo-countryside-g.jpg') }}" alt="" height="70">
                 </a>
             </div>

             <ul class="nav flex-column ms-3 pt-3">
                 <li class="nav-item text-light">Menu</li>

                 <li class="nav-item">
                     <a class="nav-link text-white" href='{{ route('admin.dashboard') }}'>
                         <i class="bi bi-columns"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>

                 <li class="nav-item text-light">Pages</li>
                 @if (auth()->user()->hasRole('admin'))
                     <li class="{{ request()->routeIs(['users.*', 'roles.*', 'permission.*']) ? 'menuitem-active' : '' }} nav-item">
                         <a class="nav-link text-white d-flex gap-2" href="#sidebarExpages" data-bs-toggle="collapse">
                             <i class="bi bi-file-text"></i>
                             <span class="d-flex justify-content-between w-100">
                                <span>Admin</span>
                                <span class="bi bi-caret-down"></span>
                             </span>
                         </a>
                         <div class="collapse {{ request()->routeIs(['users.*', 'roles.*', 'permission.*']) ? 'show' : '' }}" id="sidebarExpages">
                             <ul class="nav-second-level">
                                 {{-- <li class="{{ request()->routeIs('permission.*') ? 'menuitem-active' : '' }}">
                                         <a href='{{ route('permission.index') }}'>Permmision</a>
                                     </li>
                                     <li class="{{ request()->routeIs('roles.*') ? 'menuitem-active' : '' }}">
                                         <a href='{{ route('roles.index') }}'>Roles</a>
                                     </li> --}}
                                 <li class=" {{ request()->routeIs('users.*') ? 'menuitem-active' : '' }}">
                                     <a class="text-white" href='{{ route('users.index') }}'>User Management</a>
                                 </li>
                             </ul>
                         </div>
                     </li>
                 @endif
                 <li class="{{ request()->routeIs('property.*') ? 'menuitem-active' : '' }} nav-item">
                     <a class="nav-link text-white" href='{{ route('property.index') }}'>
                         <i class="bi bi-house"></i>
                         <span>Properties</span>
                     </a>
                 </li>
                 {{-- <li class="{{ request()->routeIs('developer_properties.*') ? 'menuitem-active' : '' }}">
                     <a href='{{ route('developer_properties.index') }}'>
                         <i class="bi bi-briefcase"></i>
                         <span> Dev's Properties </span>
                     </a>
                 </li>
                 <li class="{{ request()->routeIs('developers.*') ? 'menuitem-active' : '' }}">
                     <a href='{{ route('developers.index') }}'>
                         <i class="bi bi-briefcase"></i>
                         <span> Developers </span>
                     </a>
                 </li>
                 <li class="{{ request()->routeIs('agents.*') ? 'menuitem-active' : '' }}">
                     <a href='{{ route('agents.index') }}'>
                         <i class="bi bi-users"></i>
                         <span> Agents </span>
                     </a>
                 </li> --}}
                 {{-- <li class="{{ request()->routeIs('blogs.*') ? 'menuitem-active' : '' }}"> --}}
                 {{--     <a href='{{ route('blogs.index') }}'> --}}
                 {{--         <i class="bi bi-file-text"></i> --}}
                 {{--         <span>Blog</span> --}}
                 {{--     </a> --}}
                 {{-- </li> --}}
                 <li class="nav-item {{ request()->routeIs('Amenity.*') ? 'menuitem-active' : '' }}">
                     <a class="nav-link text-white" href="{{ route('amenity.index') }}">
                         <i class="bi bi-star"></i>
                         <span>Amenity</span>
                     </a>
                 </li>
                 <li class="nav-item {{ request()->routeIs('master-plans.*') ? 'menuitem-active' : '' }}">
                     <a class="nav-link text-white" href="{{ route('master-plans.index') }}">
                         <i class="bi bi-grid"></i>
                         <span>Master Plans</span>
                     </a>
                 </li>
                 <li class="nav-item {{ request()->routeIs('locations.*') ? 'menuitem-active' : '' }}">
                     <a class="nav-link text-white" href='{{ route('locations.index') }}'>
                         <i class="bi bi-geo-alt"></i>
                         <span>Locations</span>
                     </a>
                 </li>
                 <li class="nav-item {{ request()->routeIs('communities.*') ? 'menuitem-active' : '' }}">
                     <a class="nav-link text-white" href='{{ route('communities.index') }}'>
                         <i class="bi bi-people"></i>
                         <span>Communities</span>
                     </a>
                 </li>
                 {{-- <li class="{{ request()->routeIs('team.*') ? 'menuitem-active' : '' }}"> --}}
                 {{--     <a href='{{ route('team.index') }}'> --}}
                 {{--         <i class="bi bi-microsoft-teams"></i> --}}
                 {{--         <span>Team</span> --}}
                 {{--     </a> --}}
                 {{-- </li> --}}
                {{-- <li class="{{ request()->routeIs('visitor-submissions.*') ? 'menuitem-active' : '' }}"> --}}
                {{--     <a href='{{ route('visitor-submissions.index') }}'> --}}
                {{--         <i class="bi bi-inbox"></i> --}}
                {{--         <span> Visitor Submissions </span> --}}
                {{--     </a> --}}
                {{-- </li> --}}
                {{-- <li class="{{ request()->routeIs('vendor-registrations.*') ? 'menuitem-active' : '' }}"> --}}
                {{--     <a href='{{ route('vendor-registrations.index') }}'> --}}
                {{--         <i class="bi bi-people"></i> --}}
                {{--         <span> Vendor Registrations </span> --}}
                {{--     </a> --}}
                {{-- </li> --}}
                <li class="nav-item">
                    <a class="nav-link text-white" href='{{ route('logout') }}' class="text-danger ">
                        <i class="bi bi-box-arrow-right"></i>
                        <span> Logout </span>
                     </a>
                 </li>
             </ul>
         </div>

         <div class="clearfix"></div>
     </div>
 </div>
