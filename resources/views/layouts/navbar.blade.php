      <header class="app-header app-header-dark">
          <!-- .top-bar -->
          <div class="top-bar">
              <!-- .top-bar-brand -->
              <div class="top-bar">
                  <div class="top-bar-brand">
                      <button class="hamburger hamburger-squeeze mr-2" type="button" data-toggle="aside-menu"
                          aria-label="toggle aside menu">
                          <span class="hamburger-box">
                              <span class="hamburger-inner"></span>
                          </span>
                      </button>
                      <a href="{{ route('home') }}">
                          <img style="height: 100px; width: 100px" src="{{ asset('assets/images/logo.png') }}"
                              alt="Logo">
                      </a>
                  </div>
              </div>
              <!-- /.top-bar-brand -->
              <!-- .top-bar-list -->
              <div class="top-bar-list">
                  <!-- .top-bar-item -->
                  <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
                      <!-- toggle menu -->
                      <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside"
                          aria-label="toggle menu"><span class="hamburger-box"><span
                                  class="hamburger-inner"></span></span></button> <!-- /toggle menu -->
                  </div><!-- /.top-bar-item -->
                  <!-- .top-bar-item -->
                  <div class="top-bar-item top-bar-item-full">
                      <!-- .top-bar-search -->

                  </div><!-- /.top-bar-item -->
                  <!-- .top-bar-item -->
                  <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
                      <!-- .nav -->

                      <!-- .btn-account -->
                      <div class="dropdown d-none d-md-flex">
                          <button class="btn-account" type="button" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false"><span class="user-avatar user-avatar-md"><img
                                      src="{{ asset(Auth::user()->image) }}" alt=""></span> <span
                                  class="account-summary pr-lg-4 d-none d-lg-block"><span
                                      class="account-name">{{ Auth::user()->prenom }}
                                  </span> <span class="account-description">{{ ucfirst(Auth::user()->role) }}</span>
                              </span></button> <!-- .dropdown-menu -->
                          <div class="dropdown-menu">
                              <div class="dropdown-arrow d-lg-none" x-arrow=""></div>
                              <div class="dropdown-arrow ml-3 d-none d-lg-block"></div>
                              <h6 class="dropdown-header d-none d-md-block d-lg-none"> </h6><a class="dropdown-item"
                                  href="{{ route('profile.edit', Auth::user()->id) }}"><span
                                      class="dropdown-icon oi oi-person"></span> Mon profil</a>
                              <div class="dropdown-divider"></div>
                              <a onclick="return confirm('Voulez vous vraiment vous déconnecter ?')"
                                  class="dropdown-item" href="/logout"><span
                                      class="dropdown-icon oi oi-account-logout"></span>
                                  Déconnexion</a>

                          </div><!-- /.dropdown-menu -->
                      </div><!-- /.btn-account -->
                  </div><!-- /.top-bar-item -->
              </div><!-- /.top-bar-list -->
          </div><!-- /.top-bar -->
      </header><!-- /.app-header -->
