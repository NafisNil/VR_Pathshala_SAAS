<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ route('dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{ asset('backend/logo/logo_vr.jpg') }}"
              alt="VR Pathshala Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">{{ Auth::user()->name }}</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        @php
            $routeName = Route::currentRouteName();
        @endphp
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
          
              <li class="nav-item">
                <a href="./docs/layout.html" class="nav-link">
                  <i class="nav-icon bi bi-grip-horizontal"></i>
                  <p>Layout</p>
                </a>
              </li>

              <li class="nav-item {{ in_array($routeName, ['users.index']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['users.index']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Users
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ $routeName === 'users.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>All Users</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item {{ in_array($routeName, ['plans.index', 'plans.create', 'plans.edit']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['plans.index', 'plans.create', 'plans.edit']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Plans
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('plans.index') }}" class="nav-link {{ $routeName === 'plans.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>All Plans</p>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-filetype-js"></i>
                  <p>
                    Javascript
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./docs/javascript/treeview.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Treeview</p>
                    </a>
                  </li>
                </ul>
              </li>
     
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>