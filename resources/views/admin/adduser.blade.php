@extends('admin.layout_table')

@section('content')


<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add user</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Add User</a></li>
              <li class="breadcrumb-item active">Add user</li>
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
    
            @if(Session::has('usernamemsg'))
                <ul><p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('usernamemsg') }}</p></ul>
            @endif
    
            @if(Session::has('emailmsg'))
                <ul><p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('emailmsg') }}</p></ul>
            @endif
          <div class="card-header"><span style="margin-left:22px">Add User</span></div>

          <div class="card-body">
            <form class="" method="post" action="{{url('admin/adduseraction')}}">
              @csrf
              <div class="row col-12"> 
                 <div style="" class="form-group col-12"><label for="">User Name</label><input class="form-control" type="text" id="username" name="username" value="{{old('username')}}" style="">
                 </div>
                 
                 <div style="" class="form-group col-12"><label for="">User Email</label><input class="form-control" type="text" id="useremail" name="useremail" value="{{old('useremail')}}" style="">
                 </div>
                 
                 <div style="" class="form-group col-12"><label for="">User Password</label><input class="form-control" type="text" id="userpass" name="userpass" value="{{old('userpass')}}" style="">
                 </div>
                 
                 <div class="form-group col-12">
                 <label for="">Roles</label>
                 </div>

                
                  @foreach($customroleList as $key=>$item)
                  <div class="container">
                  <div class="row" > 
                  <div style="background-color: beige" class="col-md-1">
                  <input type="checkbox" id="roleId" class="" name="roleId[{{$key}}]" value="{{$item['id']}}" style="height:20px;margin-right:10px;">
                  </div>
                  <div class="col-md-5">
                  <label class="text-success"  for="roleId[{{$item['id']}}]" style="margin-right:10px;"> {{$item['name']}}</label>
                  </div>
                  <div class="col-md-6">
                  <input type="hidden" id="roleName" name="roleName[{{$key}}]" value="{{$item['name']}}" />
                  </div>
          
                  </div>
                  </div> 
                  @endforeach
                 
              
                <div class="text-center p-3 mb-4">
                <button class="btn btn-primary" name="submit" value="submit">Submit</button>
              </div></div> 
            </form>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </section>

<script>

</script>

@endsection
