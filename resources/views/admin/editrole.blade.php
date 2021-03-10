@extends('admin.layout')

@section('content')


<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/rolesettings')}}">Roles</a></li>
              <li class="breadcrumb-item active">Edit role</li>
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
          <div class="card-header"><span style="margin-left:22px">Edit role</span></div>

          <div class="card-body">
            <form class="" method="post" action="{{url('admin/editroleaction')}}">
              @csrf
              <input type="hidden" id="role_id" name="role_id" value="{{ $customrole[0]['id'] }}" />
              <div class="row col-md-12"> 
                 <div style="" class="form-group col-12"><label for="">Role Name</label><input class="form-control" type="text" id="rolename" name="rolename" value="{{ $customrole[0]['name']}}" style="">
                 </div>
                 
                 <div style="" class="form-group col-12"><label for="">Role Description</label><input class="form-control" type="text" id="roledesc" name="roledesc" value="{{ $customrole[0]['description']}}" style="">
                 </div>
                 
                 <label for="">Permissions</label>
                  @foreach($custompermissionList as $key=>$item)
                <div class="form-group col-md-12">
                  
                  <input type="checkbox" id="permId" @php if($item['active']=="true") echo "checked" @endphp name="permId[{{$key}}]" value="{{$item['id']}}" style="height:20px;margin-right:10px;">
                  <input type="hidden" id="permName" name="permName[{{$key}}]" value="{{$item['name']}}" />
                  <input type="hidden" id="isActive" name="isActive[{{$key}}]" value="{{$item['active']}}" />
                  <label class="text-success"  for="permId[{{$item['id']}}]" style="margin-right:10px;"> {{$item['name']}}</label>
                 
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
