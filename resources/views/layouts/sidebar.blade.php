      <!-- .app-aside -->
      <aside class="app-aside app-aside-expand-md app-aside-light">
          <!-- .aside-content -->
          <div class="aside-content">
              <!-- .aside-header -->
              <header class="aside-header d-block d-md-none">
                  <!-- .btn-account -->
                  <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside"><span
                          class="user-avatar user-avatar-lg"><img src="{{ asset(Auth::user()->image) }}"
                              alt=""></span> <span class="account-icon"><span
                              class="fa fa-caret-down fa-lg"></span></span> <span class="account-summary"><span
                              class="account-name">{{ Auth::user()->prenom }}</span> <span
                              class="account-description">{{ ucfirst(Auth::user()->role) }}</span></span></button>
                  <!-- /.btn-account -->
                  <!-- .dropdown-aside -->
                  <div id="dropdown-aside" class="dropdown-aside collapse">
                      <!-- dropdown-items -->
                      <div class="pb-3">
                          <a class="dropdown-item" href="{{ route('profile.edit', Auth::user()->id) }}">
                              <span class="dropdown-icon oi oi-person">
                              </span> Mon profil
                          </a>
                          <div class="dropdown-divider"></div>
                          <a onclick="return confirm('Voulez vous vraiment vous déconnecter ?')" class="dropdown-item"
                              href="/logout"><span class="dropdown-icon oi oi-account-logout"></span>
                              Déconnexion
                          </a><!-- /.dropdown-aside -->
              </header><!-- /.aside-header -->
              <!-- .aside-menu -->
              <div class="aside-menu overflow-hidden">
                  <!-- .stacked-menu -->
                  <nav id="stacked-menu" class="stacked-menu">
                      <!-- .menu -->
                      <ul class="menu">
                          <!-- .menu-item -->
                          <li class="menu-item">
                              <a href="{{ route('home') }}" class="menu-link"><span
                                      class="menu-icon fas fa-home"></span> <span class="menu-text">Dashboard</span></a>
                          </li><!-- /.menu-item -->
                          <!-- .menu-item -->
                          {{-- <li class="menu-item has-child">
                              <a href="#" class="menu-link"><span class="menu-icon far fa-file"></span> <span
                                      class="menu-text">App Pages</span> <span
                                      class="badge badge-warning">New</span></a> <!-- child menu -->
                              <ul class="menu">
                                  <li class="menu-item">
                                      <a href="page-clients.html" class="menu-link">Clients</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="page-teams.html" class="menu-link">Teams</a>
                                  </li>
                                  <li class="menu-item has-child">
                                      <a href="#" class="menu-link">Team</a> <!-- grand child menu -->
                                      <ul class="menu">
                                          <li class="menu-item">
                                              <a href="page-team.html" class="menu-link">Overview</a>
                                          </li>
                                          <li class="menu-item">
                                              <a href="page-team-feeds.html" class="menu-link">Feeds</a>
                                          </li>
                                          <li class="menu-item">
                                              <a href="page-team-projects.html" class="menu-link">Projects</a>
                                          </li>
                                          <li class="menu-item">
                                              <a href="page-team-members.html" class="menu-link">Members</a>
                                          </li>
                                      </ul><!-- /grand child menu -->
                                  </li>
                                  <li class="menu-item has-child">
                                      <a href="#" class="menu-link">Project</a> <!-- grand child menu -->
                                      <ul class="menu">
                                          <li class="menu-item">
                                              <a href="page-project.html" class="menu-link">Overview</a>
                                          </li>
                                          <li class="menu-item">
                                              <a href="page-project-board.html" class="menu-link">Board</a>
                                          </li>
                                          <li class="menu-item">
                                              <a href="page-project-gantt.html" class="menu-link">Gantt View</a>
                                          </li>
                                      </ul><!-- /grand child menu -->
                                  </li>
                                  <li class="menu-item">
                                      <a href="page-calendar.html" class="menu-link">Calendar</a>
                                  </li>
                                  <li class="menu-item has-child">
                                      <a href="#" class="menu-link">Invoices</a> <!-- grand child menu -->
                                      <ul class="menu">
                                          <li class="menu-item">
                                              <a href="page-invoices.html" class="menu-link">List</a>
                                          </li>
                                          <li class="menu-item">
                                              <a href="page-invoice.html" class="menu-link">Details</a>
                                          </li>
                                      </ul><!-- /grand child menu -->
                                  </li>
                                  <li class="menu-item">
                                      <a href="page-messages.html" class="menu-link">Messages</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="page-conversations.html" class="menu-link">Conversations</a>
                                  </li>
                              </ul><!-- /child menu -->
                          </li><!-- /.menu-item --> --}}
                          <!-- .menu-item -->
                          {{-- <li class="menu-item has-child">
                              <a href="#" class="menu-link"><span class="menu-icon oi oi-wrench"></span> <span
                                      class="menu-text">Auth</span></a> <!-- child menu -->
                              <ul class="menu">
                                  <li class="menu-item">
                                      <a href="auth-comingsoon-v1.html" class="menu-link">Coming Soon v1</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-comingsoon-v2.html" class="menu-link">Coming Soon v2</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-cookie-consent.html" class="menu-link">Cookie Consent</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-empty-state.html" class="menu-link">Empty State</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-error-v1.html" class="menu-link">Error Page v1</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-error-v2.html" class="menu-link">Error Page v2</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-error-v3.html" class="menu-link">Error Page v3</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-maintenance.html" class="menu-link">Maintenance</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-page-message.html" class="menu-link">Page Message</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-session-timeout.html" class="menu-link">Session Timeout</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-signin-v1.html" class="menu-link">Sign In v1</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-signin-v2.html" class="menu-link">Sign In v2</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-signup.html" class="menu-link">Sign Up</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-recovery-username.html" class="menu-link">Recovery Username</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-recovery-password.html" class="menu-link">Recovery Password</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="auth-lockscreen.html" class="menu-link">Screen Locked</a>
                                  </li>
                              </ul><!-- /child menu -->
                          </li><!-- /.menu-item -->
                          <!-- .menu-item --> --}}
                          @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superAdmin')
                              <li class="menu-item">
                                  <a href="{{ route('users.index') }}" class="menu-link"><span
                                          class="menu-icon oi oi-person"></span> <span
                                          class="menu-text">Utilisateurs</span></a>
                              </li>
                          @endif
                          <li class="menu-item">
                              <a href="{{ route('devises.index') }}" class="menu-link"><span
                                      class="menu-icon fa fa-dollar-sign"></span> <span class="menu-text">Devises</span>
                              </a>
                          </li>
                          <li class="menu-item">
                              <a href="{{ route('balances.index') }}" class="menu-link"><span
                                      class="menu-icon fa fa-wallet"></span> <span class="menu-text">Balances</span>
                              </a>
                          </li>
                          <li class="menu-item">
                              <a href="{{ route('transactions.index') }}" class="menu-link"><span
                                      class="menu-icon fa fa-comments-dollar"></span> <span
                                      class="menu-text">Transactions</span>

                              </a>
                          </li>
                          <li class="menu-item">
                              <a href="{{ route('compenses.index') }}" class="menu-link"><span
                                      class="menu-icon fa fa-money-check"></span>
                                  <span class="menu-text">Compenses</span>
                              </a>
                          </li>
                          <li class="menu-item">
                              <a href="{{ route('calculette') }}" class="menu-link"><span
                                      class="menu-icon fa fa-calculator"></span> <span class="menu-text">Ma
                                      calculette</span>

                              </a>
                          </li>
                          <!-- child menu -->
                          {{-- <ul class="menu">
                                 <li class="menu-item">
                                      <a href="user-profile.html" class="menu-link">Profile</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="user-activities.html" class="menu-link">Activities</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="user-teams.html" class="menu-link">Teams</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="user-projects.html" class="menu-link">Projects</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="user-tasks.html" class="menu-link">Tasks</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="user-profile-settings.html" class="menu-link">Profile Settings</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="user-account-settings.html" class="menu-link">Account Settings</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="user-billing-settings.html" class="menu-link">Billing Settings</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="user-notification-settings.html" class="menu-link">Notification
                                          Settings</a>
                                  </li>
                      </ul><!-- /child menu -->
                      </li><!-- /.menu-item -->
                      {{-- <!-- .menu-item -->
                          <li class="menu-item has-child">
                              <a href="#" class="menu-link"><span class="menu-icon oi oi-browser"></span> <span
                                      class="menu-text">Layouts</span> <span
                                      class="badge badge-subtle badge-success">+4</span></a> <!-- child menu -->
                              <ul class="menu">
                                  <li class="menu-item">
                                      <a href="layout-blank.html" class="menu-link">Blank Page</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="layout-nosearch.html" class="menu-link">Header no Search</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="layout-horizontal-menu.html" class="menu-link">Horizontal Menu</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="layout-fullwidth.html" class="menu-link">Full Width</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="layout-pagenavs.html" class="menu-link">Page Navs</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="layout-pagecover.html" class="menu-link">Page Cover</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="layout-pagecover-img.html" class="menu-link">Cover Image</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="layout-pagesidebar.html" class="menu-link">Page Sidebar</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="layout-pagesidebar-fluid.html" class="menu-link">Sidebar Fluid</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="layout-pagesidebar-hidden.html" class="menu-link">Sidebar Hidden</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="layout-custom.html" class="menu-link">Custom</a>
                                  </li>
                              </ul><!-- /child menu -->
                          </li><!-- /.menu-item -->
                          <!-- .menu-item -->
                          <li class="menu-item">
                              <a href="landing-page.html" class="menu-link"><span
                                      class="menu-icon fas fa-rocket"></span> <span class="menu-text">Landing
                                      Page</span></a>
                          </li><!-- /.menu-item -->
                          <!-- .menu-header -->
                          <li class="menu-header">Interfaces </li><!-- /.menu-header -->
                          <!-- .menu-item -->
                          <li class="menu-item has-child">
                              <a href="#" class="menu-link"><span class="menu-icon oi oi-puzzle-piece"></span>
                                  <span class="menu-text">Components</span></a> <!-- child menu -->
                              <ul class="menu">
                                  <li class="menu-item">
                                      <a href="component-general.html" class="menu-link">General</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="component-icons.html" class="menu-link">Icons</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="component-rich-media.html" class="menu-link">Rich Media</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="component-list-views.html" class="menu-link">List Views</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="component-sortable-nestable.html" class="menu-link">Sortable &
                                          Nestable</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="component-activity.html" class="menu-link">Activity</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="component-steps.html" class="menu-link">Steps</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="component-tasks.html" class="menu-link">Tasks</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="component-metrics.html" class="menu-link">Metrics</a>
                                  </li>
                              </ul><!-- /child menu -->
                          </li><!-- /.menu-item -->
                          <!-- .menu-item -->
                          <li class="menu-item has-child">
                              <a href="#" class="menu-link"><span class="menu-icon oi oi-pencil"></span> <span
                                      class="menu-text">Forms</span></a> <!-- child menu -->
                              <ul class="menu">
                                  <li class="menu-item">
                                      <a href="form-basic.html" class="menu-link">Basic Elements</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="form-autocompletes.html" class="menu-link">Autocompletes</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="form-pickers.html" class="menu-link">Pickers</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="form-editors.html" class="menu-link">Editors</a>
                                  </li>
                              </ul><!-- /child menu -->
                          </li><!-- /.menu-item -->
                          <!-- .menu-item -->
                          <li class="menu-item has-child">
                              <a href="#" class="menu-link"><span class="menu-icon fas fa-table"></span> <span
                                      class="menu-text">Tables</span></a> <!-- child menu -->
                              <ul class="menu">
                                  <li class="menu-item">
                                      <a href="table-basic.html" class="menu-link">Basic Table</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="table-datatables.html" class="menu-link">Datatables</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="table-responsive-datatables.html" class="menu-link">Responsive
                                          Datatables</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="table-filters-datatables.html" class="menu-link">Filter Columns</a>
                                  </li>
                              </ul><!-- /child menu -->
                          </li><!-- /.menu-item -->
                          <!-- .menu-item -->
                          <li class="menu-item has-child">
                              <a href="#" class="menu-link"><span class="menu-icon oi oi-bar-chart"></span>
                                  <span class="menu-text">Collections</span></a> <!-- child menu -->
                              <ul class="menu">
                                  <li class="menu-item has-child">
                                      <a href="#" class="menu-link">Chart.js</a> <!-- grand child menu -->
                                      <ul class="menu">
                                          <li class="menu-item">
                                              <a href="collection-chartjs-line.html" class="menu-link">Line</a>
                                          </li>
                                          <li class="menu-item">
                                              <a href="collection-chartjs-bar.html" class="menu-link">Bar</a>
                                          </li>
                                          <li class="menu-item">
                                              <a href="collection-chartjs-radar-scatter.html" class="menu-link">Radar
                                                  & Scatter</a>
                                          </li>
                                          <li class="menu-item">
                                              <a href="collection-chartjs-others.html" class="menu-link">Others</a>
                                          </li>
                                      </ul><!-- /grand child menu -->
                                  </li>
                                  <li class="menu-item">
                                      <a href="collection-flot-charts.html" class="menu-link">Flot</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="collection-inline-charts.html" class="menu-link">Inline Charts</a>
                                  </li>
                                  <li class="menu-item">
                                      <a href="collection-jqvmap.html" class="menu-link">Vector Map</a>
                                  </li>
                              </ul><!-- /child menu -->
                          </li><!-- /.menu-item -->
                          <!-- .menu-item -->
                          <li class="menu-item has-child">
                              <a href="#" class="menu-link"><span class="menu-icon oi oi-list-rich"></span>
                                  <span class="menu-text">Level Menu</span></a> <!-- child menu -->
                              <ul class="menu">
                                  <li class="menu-item">
                                      <a href="#" class="menu-link">Menu Item</a>
                                  </li>
                                  <li class="menu-item has-child">
                                      <a href="#" class="menu-link">Menu Item</a> <!-- grand child menu -->
                                      <ul class="menu">
                                          <li class="menu-item">
                                              <a href="#" class="menu-link">Child Item</a>
                                          </li>
                                          <li class="menu-item">
                                              <a href="#" class="menu-link">Child Item</a>
                                          </li>
                                          <li class="menu-item has-child">
                                              <a href="#" class="menu-link">Child Item</a>
                                              <!-- grand child menu -->
                                              <ul class="menu">
                                                  <li class="menu-item">
                                                      <a href="#" class="menu-link">Grand Child Item</a>
                                                  </li>
                                                  <li class="menu-item">
                                                      <a href="#" class="menu-link">Grand Child Item</a>
                                                  </li>
                                                  <li class="menu-item">
                                                      <a href="#" class="menu-link">Grand Child Item</a>
                                                  </li>
                                                  <li class="menu-item">
                                                      <a href="#" class="menu-link">Grand Child Item</a>
                                                  </li>
                                              </ul><!-- /grand child menu -->
                                          </li>
                                          <li class="menu-item">
                                              <a href="#" class="menu-link">Child Item</a>
                                          </li>
                                      </ul><!-- /grand child menu -->
                                  </li>
                                  <li class="menu-item">
                                      <a href="#" class="menu-link">Menu Item</a>
                                  </li>
                              </ul><!-- /child menu -->
                          </li><!-- /.menu-item --> --}}
                      </ul><!-- /.menu -->
                  </nav><!-- /.stacked-menu -->
              </div><!-- /.aside-menu -->
              <!-- Skin changer -->
              <footer class="aside-footer border-top p-2">
                  <button class="btn btn-light btn-block text-primary" data-toggle="skin"><span
                          class="d-compact-menu-none">Mode sombre</span> <i class="fas fa-moon ml-1"></i></button>
              </footer><!-- /Skin changer -->
          </div><!-- /.aside-content -->
      </aside><!-- /.app-aside -->
