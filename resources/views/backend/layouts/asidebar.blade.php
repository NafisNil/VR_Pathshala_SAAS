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

              <li class="nav-item {{ in_array($routeName, ['subscriptions.index']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['subscriptions.index']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Subscriptions
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('subscriptions.index') }}" class="nav-link {{ $routeName === 'subscriptions.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>All Subscriptions</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item {{ in_array($routeName, ['payments.index']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['payments.index']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Payments
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('payments.index') }}" class="nav-link {{ $routeName === 'payments.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>All Payments</p>
                    </a>
                  </li>

                </ul>
              </li>

              <hr>

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

              <li class="nav-item {{ in_array($routeName, ['sliders.index', 'sliders.create', 'sliders.edit']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['sliders.index', 'sliders.create', 'sliders.edit']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Sliders
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('sliders.index') }}" class="nav-link {{ $routeName === 'sliders.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>All Sliders</p>
                    </a>
                  </li>

                </ul>
              </li>

              
              <li class="nav-item {{ in_array($routeName, ['objectives.index', 'objectives.create', 'objectives.edit']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['objectives.index', 'objectives.create', 'objectives.edit']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Objectives
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('objectives.index') }}" class="nav-link {{ $routeName === 'objectives.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Objectives</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item {{ in_array($routeName, ['missions.index', 'missions.create', 'missions.edit']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['missions.index', 'missions.create', 'missions.edit']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Missions
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('missions.index') }}" class="nav-link {{ $routeName === 'missions.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p> Missions</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item {{ in_array($routeName, ['visions.index', 'visions.create', 'visions.edit']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['visions.index', 'visions.create', 'visions.edit']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Visions
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('visions.index') }}" class="nav-link {{ $routeName === 'visions.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p> Visions</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item {{ in_array($routeName, ['contentTypes.index', 'contentTypes.create', 'contentTypes.edit']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['contentTypes.index', 'contentTypes.create', 'contentTypes.edit']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Content Types
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('contentTypes.index') }}" class="nav-link {{ $routeName === 'contentTypes.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>All Content Types</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item {{ in_array($routeName, ['feature_topics.index', 'feature_topics.create', 'feature_topics.edit']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['feature_topics.index', 'feature_topics.create', 'feature_topics.edit']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Feature Topics
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('feature_topics.index') }}" class="nav-link {{ $routeName === 'feature_topics.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>All Feature Topics</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item {{ in_array($routeName, ['contacts.index', 'contacts.create', 'contacts.edit']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['contacts.index', 'contacts.create', 'contacts.edit']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Contact Info
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('contacts.index') }}" class="nav-link {{ $routeName === 'contacts.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p> Contact Info</p>
                    </a>
                  </li>

                </ul>
              </li>


              <li class="nav-item {{ in_array($routeName, ['quest_link.index', 'quest_links.create', 'quest_links.edit']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['quest_links.index', 'quest_links.create', 'quest_links.edit']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Meta Quest Link 
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('quest_links.index') }}" class="nav-link {{ $routeName === 'quest_links.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p> Meta Quest Link</p>
                    </a>
                  </li>

                </ul>
              </li>


              <li class="nav-item {{ in_array($routeName, ['messages.index']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['messages.index']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Messages from Users
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('messages.index') }}" class="nav-link {{ $routeName === 'messages.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p> Messages from Users</p>
                    </a>
                  </li>

                </ul>
              </li>


              
              <li class="nav-item {{ in_array($routeName, ['benefits.index', 'benefits.create', 'benefits.edit']) ? 'menu-open' : '' }}">
               
                <a href="#" class="nav-link {{ in_array($routeName, ['benefits.index', 'benefits.create', 'benefits.edit']) ? 'menu-open' : '' }}">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    Benefits
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('benefits.index') }}" class="nav-link {{ $routeName === 'benefits.index' ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>All Benefits</p>
                    </a>
                  </li>

                    
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