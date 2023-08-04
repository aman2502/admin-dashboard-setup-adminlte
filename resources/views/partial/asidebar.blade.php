  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link elevation-4">
          <img src="{{ URL::asset('/images/AdminLTELogo.png') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: 1.0">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="{{ route('admin.home') }}" class="{{ $nav == 'Dashboard' ? 'active' : '' }} nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p> Dashboard</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                      <a class="nav-link" href="{{ route('admin.logout') }}"
                          onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                          <i class="nav-icon fa fa-power-off"></i>
                          <p class="">Logout</p>
                      </a>
                  </li>
              </ul>
          </nav>





              <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
