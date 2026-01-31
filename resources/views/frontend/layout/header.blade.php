 <header class="header">
     <nav class="z-5 bg-light navbar navbar-expand-lg navbar-light">
         <div class="container d-block">
             <div class="row align-items-center">
                 <div class="col-6 col-md-2">
                     <a class="navbar-brand" href="/">
                         <img src="{{ asset('assets/img/logo-countryside-g.jpg') }}" alt="logo" class="logo" title="Logo" />
                     </a>
                 </div>

                 <div class="col-lg-7 col-md-8 mob-1">
                     <ul class="mb-2 mb-lg-0 navbar-nav me-auto">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('aboutUs') }}">{{ __('About us') }}</a>
                         </li>

                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                 {{ __('Properties') }}
                             </a>
                             <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                 <li><a class="dropdown-item" href="{{ route('properties.byLocation', 'Residential') }}">{{ __('Residential') }}</a></li>
                                 <li><a class="dropdown-item" href="{{ route('properties.byLocation', 'Commercial') }}">{{ __('Commercial') }}</a></li>
                                 <li><a class="dropdown-item" href="{{ route('properties.byLocation', 'Villa') }}">{{ __('Villa') }}</a></li>
                             </ul>
                         </li>

                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                 {{ __('Contact us') }}
                             </a>
                             <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                 <li><a class="dropdown-item" href="{{ route('contactUs') }}">{{ __('Contact us') }}</a></li>
                                 <li><a class="dropdown-item" href="{{ route('complaint.form') }}">{{ __('Complaint Form') }}</a></li>
                                 <li><a class="dropdown-item" href="{{ route('visitor.form') }}">{{ __('Visitor Form') }}</a></li>
                                 <li><a class="dropdown-item" href="{{ route('registration.form') }}">{{ __('Register as vendor') }}</a></li>
                             </ul>
                         </li>
                     </ul>
                 </div>

                 <div class="col-md-3 mob-1 d-flex align-items-center justify-content-end gap-2">
                     <a class="text-uppercase small" href="{{ route('login') }}">{{ __('Login') }}</a>
                     <x-language-switcher />
                 </div>

                 <div class="col-6 col-md-10 d-lg-none d-md-block">
                     <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                         data-bs-target="#navbarOffcanvas" aria-controls="navbarOffcanvas" aria-expanded="false"
                         aria-label="Toggle navigation">
                         <span class="navbar-toggler-icon"></span>
                     </button>

                     <div class="bg-secondary offcanvas offcanvas-end secondary-1" id="navbarOffcanvas" tabindex="-1"
                         aria-labelledby="offcanvasNavbarLabel">
                         <div class="offcanvas-header">
                             <a class="navbar-brand" href="/">
                                 <img src="{{ asset('assets/img/logo-countryside-g.jpg') }}" alt="logo" class="logo" />
                             </a>
                             <button type="button" class="text-reset btn-close btn-close-white"
                                 data-bs-dismiss="offcanvas" aria-label="Close"></button>
                         </div>

                         <div class="offcanvas-body">
                             <ul class="mb-2 mb-lg-0 navbar-nav me-auto">
                                 <li class="nav-item">
                                     <a class="nav-link" href="{{ route('home') }}">Home</a>
                                 </li>
                                 <li class="nav-item dropdown">
                                     <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown"
                                         role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                         About
                                     </a>
                                     <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                         <li><a class="dropdown-item" href="{{ route('aboutUs') }}">About</a></li>
                                         <li><a class="dropdown-item" href="{{ route('leadership') }}">Leaders</a>
                                         </li>
                                     </ul>
                                 </li>
                                 <li class="nav-item dropdown">
                                     <a class="nav-link dropdown-toggle" href="#" id="propertiesDropdown"
                                         role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                         Properties
                                     </a>
                                     <ul class="dropdown-menu" aria-labelledby="propertiesDropdown">
                                         <li><a class="dropdown-item"
                                                 href="{{ route('properties.byLocation', 'Residential') }}">Residential</a>
                                         </li>
                                         <li><a class="dropdown-item"
                                                 href="{{ route('properties.byLocation', 'Commercial') }}">Commercial</a>
                                         </li>
                                         {{-- <li><a class="dropdown-item"
                                                 href="{{ route('properties.byLocation', 'Off-Plan') }}">Off-Plan</a>
                                         </li> --}}
                                         <li><a class="dropdown-item"
                                                 href="{{ route('properties.byLocation', 'Mall') }}">Mall</a></li>
                                         <li><a class="dropdown-item"
                                                 href="{{ route('properties.byLocation', 'Villa') }}">Villa</a></li>
                                     </ul>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="{{ route('service') }}">Services</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="{{ url('blog') }}">Blogs</a>
                                 </li>
                                 <li class="nav-item dropdown">
                                     <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown"
                                         role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                         Contact Us
                                     </a>
                                     <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                         <li><a class="dropdown-item" href="{{ route('contactUs') }}">Contact Us</a>
                                         </li>
                                         <li><a class="dropdown-item" href="{{ url('complain') }}">Complaint</a></li>
                                         <li><a class="dropdown-item" href="{{ url('visitor') }}">Visitor</a></li>
                                     </ul>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                     <div class="d-inline ms-2">
                                         <a href="{{ route('lang.switch', 'en') }}">EN</a> |
                                         <a href="{{ route('lang.switch', 'es') }}">ES</a>
                                     </div>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </nav>
 </header>
