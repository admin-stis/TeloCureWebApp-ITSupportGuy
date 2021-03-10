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
            <h1 class="m-0 text-dark">District Discount</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">District Discount</li>
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
          <!-- <div class="card-header"><span style="margin-left:22px; display:block;">Change District Discount</span></div>  -->
          <span style="margin:10px 0 10px 22px;font-weight:bold;">Current district discounts and service charges</span>
            <ul class="list-group" style="margin-left:22px">
                   @foreach($activeDistrict as $item)
                        <li class="list-group-item"><b>{{$item['name']}}</b> : Discount = {{$item['discount']}}% , Service Charge = @if(isset($item['service_charges'])){{$item['service_charges']}}@else N/A @endif</li>
                    @endforeach
              
            </ul>
            <hr/>
          <span style="margin:10px 0 5px 22px; font-weight:bold;display:block;">Set district discounts</span>  
          <div class="card-body">
            <form class="" method="post" action="{{url('admin/districtDiscount')}}">
              @csrf
                <div class="form-group col-6">
                <div class="">
                    <select class="form-control" name="disId" id="disId">
                    <option value="default">Select district</option>
                    @foreach($activeDistrict as $item)
                        <option value="{{$item['id']}}">{{$item['name']}}</option>
                    @endforeach
                    </select>
                    <input type="hidden" name="discount_update" value="discount" />
                    @foreach($activeDistrict as $item)
                    <div style="margin:20px 0 20px 0; display:none;"><label for="discount{{$item['id']}}">Discount</label><input class="form-control" type="text" id="discount{{$item['id']}}" name="discount{{$item['id']}}" value="{{$item['discount']}}" style=""></div>
                    @endforeach
                </div></div>   
                
                {{-- @if($approvePermission) --}}
                    <div class="form-group col-6">
                      <button class="btn btn-sm btn-success" name="submit" value="submit">Update Discount</button>
                    </div>
              {{-- @endif --}}
              
            </form>
          </div>
        </div>
        <div class="card">          
          <!-- <span style="margin:10px 0 5px 22px; font-weight:bold;display:block; color:red;">it is under process don't use it </span> -->
          <span style="margin:10px 0 5px 22px; font-weight:bold;display:block;">Set district based service charge</span>  
          <div class="card-body">
            <form class="" method="post" action="{{url('admin/districtDiscount')}}">
              @csrf
                <div class="form-group col-6">
                <div class="">
                    <select class="form-control" name="disId" id="disId">
                    <option value="default">Select district</option>
                    @foreach($activeDistrict as $item)
                        <option value="{{$item['id']}}">{{$item['name']}}</option>
                    @endforeach
                    </select>
                    <input type="hidden" name="service_update" value="service" />
                    @foreach($activeDistrict as $item)
                    <div style="margin:20px 0 20px 0; display:none;"><label for="service{{$item['id']}}">Service charge</label><input class="form-control" type="text" id="service{{$item['id']}}" name="service{{$item['id']}}" value="@if(isset($item['service_charges'])){{$item['service_charges']}}@else N/A @endif" style=""></div>
                    @endforeach
                </div></div>             
              <div class="form-group col-6">

                @if($approvePermission)
                <button class="btn btn-sm btn-success" name="submit" value="submit">Update Service Charge</button>
                @endif 
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

<script>

</script>

@endsection
