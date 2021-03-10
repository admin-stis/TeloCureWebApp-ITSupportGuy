@extends('admin.layout')

@section('content')
@php 
    //for roles and security 
    $perm_role = Session::get('user_roles');
    $all_perms = $perm_role["perms"]; 
    $editPermission = false; 
    $deletePermission = false; 
    $approvePermission = false; 
    for($i=0; $i<count($all_perms); $i++)
    {
      if($all_perms[$i]=="Edit") { $editPermission = true; }
      if($all_perms[$i]=="Delete") { $deletePermission = true; }
      if($all_perms[$i]=="Approve") { $approvePermission = true; }    
    }
@endphp

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Doctor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">District</li>
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
          <div class="card-header"><span style="margin-left:22px">Change District Status</span></div>

          <div class="card-body">
            <form class="" method="post" action="{{url('admin/district')}}">
              @csrf
              {{--
                <div class="form-group">
                    <select class="form-control" name="disId">
                    <option>Select district</option>
                    @foreach($districtList as $item)
                        <option value="{{$item['id']}}">{{$item['name']}}</option>
                    @endforeach
                    </select>
                </div>
              --}}
              <div class="row col-md-12">
                  @foreach($districtList as $key=>$item)
                  {{-- <input type="checkbox" id="vehicle1" name="disId" value="{{$item['id']}}">{{$item['name']}} --}}
                <div class="col-md-6 row">
                  <input type="checkbox" id="disId" class="col-md-2" name="disId[{{$key}}]" value="{{$item['id']}}" style="height:20px;margin-right:10px;">
                  <label @if($item['active'] == 1) class="text-success" @else class="" @endif for="disId[{{$item['id']}}]" style="margin-right:10px;"> {{$item['name']}}</label>
                 
              </div>
                  @endforeach
              </div>
                      @if($approvePermission)
                          <div class="form-group">
                            <button class="btn btn-sm btn-success" name="submit" value="active">Active</button>
                            <button class="btn btn-sm btn-danger" name="submit" value="deactive">Deactive</button>
                          </div>
                      @endif 
            </form>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </section>

<script>

</script>

@endsection
