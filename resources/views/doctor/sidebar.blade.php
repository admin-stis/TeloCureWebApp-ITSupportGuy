@php
$doctorInfo = Session::get('user');
// dd($doctorInfo);
@endphp


<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @if(isset($doctorInfo[0]['hospitalized']) && $doctorInfo[0]['hospitalized'] == false )
        <li class="nav-item">
            <a href="{{url('/doctor')}}" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                    Earnings
                </p>
            </a>
        </li>
        @endif

        <li class="nav-item">
            <a href="{{url('/doctor/fares/'.$doctorInfo[0]['uid'])}}" class="nav-link">
                <i class="nav-icon fas fa-address-book"></i>
                <p>
                    Visits
                </p>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Rewards
              </p>
            </a>
          </li> --}}

        {{--<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Invites
              </p>
            </a>
          </li>--}}


        <li class="nav-item">
            <a href="{{url('doctor/profile/'.$doctorInfo[0]['uid'])}}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Profile
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url('doctor/video')}}" class="nav-link">
                <i class="nav-icon fas fa-video"></i>
                <p>
                    Training Video
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url('doctor/help')}}" class="nav-link">
                <i class="nav-icon fas fa-question"></i>
                <p>
                    Help
                </p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{url('changepassword/doctor/'.$doctorInfo[0]['uid'])}}" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Change Password
                </p>
            </a>
        </li>

        <li class="nav-item">
            <div>
                <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                    var check = confirm('Do you really want to logout?');
                    if(check){
                    document.getElementById('logout-form').submit();}">
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