@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Authorization settings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/doctor')}}">Doctor</a></li>
            @php
                //if(isset($doctorProfile['uid']))
                //$uid = trim($doctorProfile['uid']);
            @endphp
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">


    <div class="row col-md-12">
    
          @if(Session::has('msg'))
            <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('msg') }}</p></ul>
          @endif
          
        <div class="col-md-12" style="">
        
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="user-tab" data-toggle="tab" href="#users" role="tab" aria-controls="home" aria-selected="false">Users</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="role-tab" data-toggle="tab" href="#roles" role="tab" aria-controls="profile" aria-selected="true">Roles</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="permission-tab" data-toggle="tab" href="#permissions" role="tab" aria-controls="contact" aria-selected="false">Permissions</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade  active show" id="users" role="tabpanel" aria-labelledby="user-tab" style="background-color: white;padding:15px 10px 10px 10px;">
      <a class="btn btn-sm btn-success" href="{{url('admin/adduser')}}" name="adduser">Add User</a>
      
      <div> 
      
      <table class="table table-bordered table-hover"> 
    <thead>
        <tr>
        <td style="width: 14.2857%;" scope="col">SlNo</td>
        <td style="width: 14.2857%;" scope="col">User Name</td>
        <td style="width: 14.2857%;" scope="col">Email</td>
        <td style="width: 14.2857%;" scope="col">Roles</td>
        <td style="width: 14.2857%;" scope="col">Actions</td>
        </tr>
    </thead>

    <tbody>
         @foreach ($userList as $key=>$item)

         <tr>
                <td>{{++$key}}</td>
                <td>@if(isset($item['user_name'])) {{$item['user_name']}} @else N/A  @endif</td>
                <td>@if(isset($item['email'])) {{$item['email']}} @else N/A  @endif</td>
                <td><b>@if(isset($item['roles'])) {{$item['roles']}} @else N/A  @endif </b></td>
                <td><a class="btn  btn-sm btn-success" href="{{url('admin/edituser/'.$item['id'])}}">Edit</a>
                @if($item['user_name']=="super") @else <a class="btn  btn-sm btn-danger" onclick="return confirm('Do you really want to delete?');" href="{{url('admin/deleteuser/'.$item['id'])}}">Delete</a>@endif</td>
         </tr>
         @endforeach



    </tbody>


                                        </table>
      
      </div>
    </div>
    <div class="tab-pane fade" id="roles" role="tabpanel" aria-labelledby="role-tab" style="background-color: white;padding:15px 10px 10px 10px;">
      <a class="btn btn-sm btn-success" href="{{url('admin/addrole')}}" name="addrole">Add Role</a>
      
      <div> 
      
      <table class="table table-bordered table-hover">
    <thead>
        <tr>
        <td style="width: 14.2857%;" scope="col">SlNo</td>
        <td style="width: 14.2857%;" scope="col">Role Name</td>
        <td style="width: 14.2857%;" scope="col">Display name</td>
        <td style="width: 14.2857%;" scope="col">Description</td>
        <td style="width: 14.2857%;" scope="col">Permissions</td>
        <td style="width: 14.2857%;" scope="col">Actions</td>
        </tr>
    </thead>

    <tbody>
         @foreach ($roleList as $key=>$item)

         <tr>
                <td>{{++$key}}</td>
                <td>@if(isset($item['name'])) {{$item['name']}} @else N/A  @endif</td>
                <td>@if(isset($item['display_name'])) {{$item['display_name']}} @else N/A  @endif</td>
                <td>@if(isset($item['description'])) {{$item['description']}} @else N/A  @endif</td>
                <td><b>@if(isset($item['perms'])) {{$item['perms']}} @else N/A  @endif </b></td>
                <td><a class="btn  btn-sm btn-success" href="{{url('admin/editrole/'.$item['id'])}}">Edit</a>
                <a class="btn  btn-sm btn-danger" onclick="return confirm('Do you really want to delete?');" href="{{url('admin/deleterole/'.$item['id'])}}">Delete</a></td>
         </tr>
         @endforeach



    </tbody>


                                        </table>
      
      </div>
      
    </div>
    <div class="tab-pane fade" id="permissions" role="tabpanel" aria-labelledby="permission-tab" style="background-color: white;padding:15px 10px 10px 10px;">
    <label>All permissions</label>
    <div> 
      
      <table class="table table-bordered table-hover">
    <thead>
        <tr>
        <td style="width: 14.2857%;" scope="col">SlNo</td>
        <td style="width: 14.2857%;" scope="col">Permission name</td>
        <td style="width: 14.2857%;" scope="col">Display name</td>
        <td style="width: 14.2857%;" scope="col">Description</td>
        </tr>
    </thead>

    <tbody>
         @foreach ($permList as $key=>$item)

         <tr>
                <td>{{++$key}}</td>
                <td>@if(isset($item['name'])) {{$item['name']}} @else N/A  @endif</td>
                <td>@if(isset($item['display_name'])) {{$item['display_name']}} @else N/A  @endif</td>
                <td>@if(isset($item['description'])) {{$item['description']}} @else N/A  @endif</td>
         </tr>
         @endforeach



    </tbody>


                                        </table>
      
      </div>
      
    </div>

  </div>


		</div>        
    </div>
</section>
            </div>
    </div>
@endsection
