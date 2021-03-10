<!-- Sidebar Menu -->
 @php 
    $admin = Session::get('user');
    if($admin[0]['user_name']=="super") {
      $view_doctorPermission = true; 
      $view_doctorPatientSmsPermission = true; 
      $view_patientPermission = true; 
      $view_hospitalPermission = true; 
      $view_service_financePermission = true; 
      $view_districtPermission = true; 
      $view_all_pagesPermission = true; 
      $view_district_discountPermission = true;  
      $view_manage_paymentsPermission = true; 
      $view_settingsPermission = true; 
    } else { 
    //for roles and security 
    $perm_role = Session::get('user_roles');
    $all_perms = $perm_role["perms"]; 
    //dd($all_perms); 
    $view_doctorPermission = false;     
    $view_patientPermission = false;
    $view_hospitalPermission = false; 
    $view_service_financePermission = false; 
    $view_districtPermission = false; 
    $view_authorizationPermission = false; 
    $view_all_pagesPermission = false; 
    $view_district_discountPermission = false; 
    $view_manage_paymentsPermission = false; 
    $view_settingsPermission = false; 
    
    for($i=0; $i<count($all_perms); $i++){      
      if($all_perms[$i]=="view_doctor") { $view_doctorPermission = true; } 
      if($all_perms[$i]=="view_patient") { $view_patientPermission = true; }
      if($all_perms[$i]=="view_hospital") { $view_hospitalPermission = true; }
      if($all_perms[$i]=="view_service_finance") { $view_service_financePermission = true; }
      if($all_perms[$i]=="view_district") { $view_districtPermission = true; }
      if($all_perms[$i]=="view_all_pages") { $view_all_pagesPermission = true; }
      if($all_perms[$i]=="view_authorization") { $view_authorizationPermission = true; }
      if($all_perms[$i]=="view_district_discount") { $view_district_discountPermission = true; } 
      if($all_perms[$i]=="view_manage_payments") { $view_manage_paymentsPermission = true; }
      if($all_perms[$i]=="view_settings") { $view_settingsPermission = true; }
    } }

      @endphp
      <nav class="mt-2">
        <ul class="active-list nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{url('admin')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>  
          
          @php if($view_doctorPermission== true || $view_all_pagesPermission==true) { @endphp
          <li class="nav-item">
            <a href="{{route('/admin/doctor')}}" class="nav-link">
              <i class="nav-icon fas fa-user-md"></i>
              <p>
                Doctor
              </p>
            </a>
          </li> @php } @endphp
          @php if($admin[0]['user_name']=="super") { @endphp
          <li class="nav-item">
            <a href="{{url('/admin/ourDoctor')}}" class="nav-link">
              <i class="nav-icon fas fa-user-md"></i>
              <p>
                Ours Doctor
              </p>
            </a>
          </li> @php } @endphp
          @php if($view_hospitalPermission== true || $view_all_pagesPermission==true) { @endphp
          <li class="nav-item">
            <a href="{{url('/admin/hospital')}}" class="nav-link">
              <i class="nav-icon fas fa-hospital"></i>
              <p>
                Hospital
              </p>
            </a>
          </li> @php } @endphp
          @php if($view_patientPermission== true || $view_all_pagesPermission==true) { @endphp
          <li class="nav-item">
            <a href="{{route('/admin/patient')}}" class="nav-link">
              <i class="nav-icon fas fa-bed"></i>
              <p>
                Patient
              </p>
            </a>
          </li>
          @php } @endphp
          
          {{-- <li class="nav-item">
            <a href="{{url('/admin/chart')}}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Graphical Chart 
              </p>
            </a>
          </li>  --}}
          @php if($view_service_financePermission== true || $view_all_pagesPermission==true) { @endphp
          <li class="nav-item">
            <a href="{{url('/admin/servicefinancial')}}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Service & Financial 
              </p>
            </a>
          </li> @php } @endphp

          @php if($view_districtPermission== true || $view_all_pagesPermission==true) { @endphp
          <li class="nav-item">
            <a href="{{url('/admin/district')}}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Manage District
              </p>
            </a>
          </li> @php } @endphp
          @php if($view_district_discountPermission== true || $view_all_pagesPermission==true) { @endphp
          <li class="nav-item">
            <a href="{{url('admin/districtDiscount')}}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                District Discounts and services
              </p>
            </a>
          </li>@php } @endphp
          
         
           @php if($view_manage_paymentsPermission== true || $view_all_pagesPermission==true) { @endphp
          <li class="nav-item">
            <a href="{{url('admin/processManagePay')}}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Manage Payments
              </p>
            </a>
          </li>
           @php } @endphp





          @php if($admin[0]['user_name']=="super") { @endphp
          <li class="nav-item">
            <a href="{{url('admin/rolesettings')}}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Authorization Settings
              </p>
            </a>
          </li>
          
           <li class="nav-item">
            <a href="{{url('admin/smsdocpat')}}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Doctor & Patient SMS 
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="{{url('changepassword/admin/'.$admin[0]['id'])}}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Change Password
              </p>
            </a>
          </li> @php } @endphp      
          
          

          @php if($view_settingsPermission== true || $view_all_pagesPermission==true) { @endphp
          <li class="nav-item">
            <a href="{{url('admin/settings')}}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
              </p>
            </a>
          </li>
          @php } @endphp

           
          <li class="nav-item">
            <div>
              <a class="dropdown-item" href="{{route('logout')}}" 
                    onclick="event.preventDefault();
                    var check = confirm('Do you really want to logout?');
                    if(check){
                    document.getElementById('logout-form').submit();}">



                 {{-- onclick=" return confirm('Are you sure to logout?'); 
                                event.preventDefault();
                               document.getElementById('logout-form').submit(); --}} 
                 <i class="nav-icon fas fa-sign-out-alt">&nbsp;&nbsp;Sign Out</i>
                 <p>
                   
                 </p>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
          </li>
        </ul>
      </nav>
