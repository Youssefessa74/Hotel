<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        Vaction<span>Rental</span>
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
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>

        <li class="nav-item nav-category">Project</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#hotel" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Hotel</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="hotel">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{ route('all_hotels') }}" class="nav-link">all hotels</a>
              </li>

            </ul>
          </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#settings" role="button" aria-expanded="false" aria-controls="emails">
              <i class="link-icon" data-feather="mail"></i>
              <span class="link-title">Settings</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="settings">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('settings') }}" class="nav-link">Settings</a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#bookings" role="button" aria-expanded="false" aria-controls="emails">
              <i class="link-icon" data-feather="mail"></i>
              <span class="link-title">Bookings</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="bookings">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('bookings') }}" class="nav-link">All Bookings</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pending_bookings') }}" class="nav-link">Pending Bookings</a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('confirmed_bookings') }}" class="nav-link">Confirmed Bookings</a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('completed_bookings') }}" class="nav-link">Completed Bookings</a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('canceled_bookings') }}" class="nav-link">Canceled Bookings</a>
                  </li>
              </ul>
            </div>
          </li>

         @if (auth()->user()->role_level > 2)
         <li class="nav-item">
           <a class="nav-link" data-bs-toggle="collapse" href="#admins" role="button" aria-expanded="false" aria-controls="emails">
             <i class="link-icon" data-feather="mail"></i>
             <span class="link-title">Admins</span>
             <i class="link-arrow" data-feather="chevron-down"></i>
           </a>
           <div class="collapse" id="admins">
             <ul class="nav sub-menu">
               <li class="nav-item">
                 <a href="{{ route('all.admins') }}" class="nav-link">All Admins</a>
               </li>
             </ul>
           </div>
         </li>
         @endif


        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#pages" role="button" aria-expanded="false" aria-controls="emails">
              <i class="link-icon" data-feather="mail"></i>
              <span class="link-title">Pages & Components</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="pages">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('service_index') }}" class="nav-link">Services</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('offer_index') }}" class="nav-link">What We Offer</a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('all_amenities') }}" class="nav-link">Amenities</a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('contacts') }}" class="nav-link">Contact</a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('news_letters') }}" class="nav-link">News Letters</a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('testimonials') }}" class="nav-link">Testimonials</a>
                  </li>
              </ul>
            </div>
          </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#apartment" role="button" aria-expanded="false" aria-controls="emails">
              <i class="link-icon" data-feather="mail"></i>
              <span class="link-title">Apartment</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="apartment">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('apartments.index') }}" class="nav-link">All Aparmtents</a>
                </li>

              </ul>
            </div>
          </li>


        <li class="nav-item nav-category">Components</li>


        </li>
        <li class="nav-item nav-category">Docs</li>
        <li class="nav-item">
          <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
            <i class="link-icon" data-feather="hash"></i>
            <span class="link-title">Documentation</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <nav class="settings-sidebar">
    <div class="sidebar-body">
      <a href="#" class="settings-sidebar-toggler">
        <i data-feather="settings"></i>
      </a>
      <div class="theme-wrapper">
        <h6 class="text-muted mb-2">Light Theme:</h6>
        <a class="theme-item" href="../demo1/dashboard.html">
          <img src="../assets/images/screenshots/light.jpg" alt="light theme">
        </a>
        <h6 class="text-muted mb-2">Dark Theme:</h6>
        <a class="theme-item active" href="../demo2/dashboard.html">
          <img src="../assets/images/screenshots/dark.jpg" alt="light theme">
        </a>
      </div>
    </div>
  </nav>
