@extends('admin.layout')

@section('content')


<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Add role</a></li>
              <li class="breadcrumb-item active">Add role</li>
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
    
            @if(Session::has('rolenamemsg'))
                <ul><p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('rolenamemsg') }}</p></ul>
            @endif
          <div class="card-header"><span style="margin-left:22px">Add role</span></div>

          <div class="card-body">
            <form class="" method="post" action="{{url('admin/addroleaction')}}">
              @csrf
              <div class="row col-md-12"> 
                 <div style="" class="form-group col-12"><label for="">Role Name</label><input class="form-control" type="text" id="rolename" name="rolename" value="{{old('rolename')}}" style="">
                 </div>
                 
                 <div style="" class="form-group col-12"><label for="">Role Description</label><input class="form-control" type="text" id="roledesc" name="roledesc" value="{{old('roledesc')}}" style="">
                 </div>

                 <div class="form-group col-12">  
                 
                 <div class="row"><label for="">Permissions</label></div>
                  @foreach($custompermissionList as $key=>$item)
                   @if(($item['name'] == "Edit") || ($item['name'] == "Delete") || ($item['name'] == "Publish") )                    
                  <div class="container">
                  <div class="row" > 
                  <div style="background-color: beige" class="col-md-1">
                  <input type="checkbox" id="permId" class="" name="permId[{{$key}}]" value="{{$item['id']}}" style="height:20px;margin-right:10px;">
                  <input type="hidden" id="permName" name="permName[{{$key}}]" value="{{$item['name']}}" />
                  </div>
                  <div class="col-md-5">
                  <label class="text-success"  for="permId[{{$item['id']}}]" style="margin-right:10px;"> {{$item['name']}}</label>
                  </div> 
                  </div>
                  </div>  
                  @endif 
                  @endforeach 
                  </div>
                  

                  <div class="row"> <label for="" style="margin-right: 3%">View Permissions: </label></div>
                  @foreach($custompermissionList as $key=>$item)
                    @if(($item['name'] == "Edit") || ($item['name'] == "Delete") || ($item['name'] == "Publish") ) 
                    @else 
                      <div class="col-md-2" style="background-color: beige">
                        <input type="checkbox" id="permId" class="" name="permId[{{$key}}]" value="{{$item['id']}}" style="height:20px;margin-right:10px;">
                        <input type="hidden" id="permName" name="permName[{{$key}}]" value="{{$item['name']}}" />
                        <label class="text-success"  for="permId[{{$item['id']}}]" style="margin-right:10px;"> {{$item['name']}}</label>
                      </div>
                    @endif
                  @endforeach
              </div>

              <div class="form-group">
                <button class="btn btn-sm btn-success" name="submit" value="submit">Submit</button>
              </div> </div>
            </form>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </section>

<script>

</script>

@endsection
