@extends('admin.layout')

@section('content')


<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit user</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/rolesettings')}}">Users</a></li>
              <li class="breadcrumb-item active">Edit user</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          @if(Session::has('msg'))
            <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('msg') }}</p></ul>
          @endif
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach
                    </ul>
            @endif
          <div class="card-header"><span style="margin-left:22px">Edit user</span></div>

          <div class="card-body">
            <form class="" method="post" action="{{url('admin/edituseraction')}}">
              @csrf
              <input type="hidden" id="user_id" name="user_id" value="{{ $customuser[0]['id'] }}" />
              <div class="row col-md-12"> 
                 <div style="" class="form-group col-12"><label for="">User Name</label><input class="form-control" type="text" id="username" @php if($customuser[0]['user_name']=="super") echo "disabled" @endphp name="username" value="{{ $customuser[0]['user_name']}}" style="">
                 <input type="hidden" name="isSuperUser" id="isSuperUser" value="@php if($customuser[0]['user_name']=='super') echo '1'; else echo '0'; @endphp"/>
                 </div>
                 
                 <div style="" class="form-group col-12"><label for="">User Email</label><input class="form-control" type="text" id="useremail" name="useremail" value="{{ $customuser[0]['email']}}" style="">
                 </div>
                 
                 <label for="">Roles</label>
                  @foreach($customroleList as $key=>$item)
                <div class="form-group col-md-12">
                  
                  <input type="checkbox" id="roleId" @php if($item['active']=="true") echo "checked" @endphp name="roleId[{{$key}}]" value="{{$item['id']}}" style="height:20px;margin-right:10px;">
                  <input type="hidden" id="roleName" name="roleName[{{$key}}]" value="{{$item['name']}}" />
                  <input type="hidden" id="isActive" name="isActive[{{$key}}]" value="{{$item['active']}}" />
                  <label class="text-success"  for="roleId[{{$item['id']}}]" style="margin-right:10px;"> {{$item['name']}}</label>
                 
                </div>
                  @endforeach
              </div>
              <div class="form-group">
                <button class="btn btn-sm btn-success" name="submit" value="submit">Submit</button>
              </div>
            </form>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </section>

<script>

</script>

@endsection
