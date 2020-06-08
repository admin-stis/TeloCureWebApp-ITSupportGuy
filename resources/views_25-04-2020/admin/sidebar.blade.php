 <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          {{-- <li class="nav-item">
            <a href="{{route('area')}}" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a href="{{url('admin')}}" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('/admin/doctor')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Doctor
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Hospital
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('/admin/patient')}}" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Patient
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Service & Revenue
              </p>
            </a>
          </li>

          <li class="nav-item">
            <div>
              <a class="nav-link" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                 <i class="nav-icon fas fa-sign-out-alt"></i>
                 <p>
                   Sign Out
                 </p>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </div>
          </li>

        </ul>
      </nav>
