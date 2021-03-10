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
            <h1 class="m-0 text-dark">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
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
          <div class="card-header"><span style="margin-left:0px; display:block;">Settings</span></div>

          <span style="margin:10px 0 5px 22px; font-weight:bold;display:block;">Current SMS API</span>  
          <div class="card-body">
            <form class="" method="post" action="{{url('admin/settings')}}">
              @csrf
                <div class="form-group col-6">
                <div class="">
                @php foreach($settingList as $item){ $curApi = $item["SmsApi"]; } @endphp
                    <select class="form-control" name="smsApi" id="smsApi">
                    <option value="default">Select Sms Gateway</option> 
                        <option @if($curApi == "sslcommerz") selected @endif value="ssl">SslCommerz</option>
                        <option @if($curApi == "twilio") selected @endif value="twilio">Twilio</option>
                    </select>
                </div></div>           
                
                
                @if($approvePermission) 
              <div class="form-group col-6">
                <button class="btn btn-sm btn-success" name="submit" value="submit">Update Settings</button>
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
