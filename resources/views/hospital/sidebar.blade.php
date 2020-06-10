
 @php
    $user = session::get('user');
    //dd($user[0]);
@endphp
<!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{url('hospital')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          {{--

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Doctor
              </p>
            </a>
          </li>
          --}}

          <li class="nav-item">
            <a href="{{url('admin/hospital/branch/'.$user[0]['hospitalUid'])}}" class="nav-link">
              <i class="nav-icon fas fa-hospital"></i>
              <p>
                Branch
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Revenue
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('hospital/bankinfo')}}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Bank Information
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('hospital/help')}}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Help
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{url('changepassword/hospital/'.$user[0]['hospitalUid'])}}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Change Password
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
