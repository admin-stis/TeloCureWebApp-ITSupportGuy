@extends('admin.layout')

@section('content')


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
                <div class="col-md-3 row">
                  <input type="checkbox" id="disId" class="col-md-2" name="disId[{{$key}}]" value="{{$item['id']}}" style="height:20px;margin-right:10px;">
                  <label @if($item['active'] == 1) class="text-success" @else class="" @endif for="disId[{{$item['id']}}]" style="margin-right:10px;"> {{$item['name']}}</label>
              </div>
                  @endforeach
              </div>
              <div class="form-group">
                <button class="btn btn-sm btn-success" name="submit" value="active">Active</button>
                <button class="btn btn-sm btn-danger" name="submit" value="deactive">Deactive</button>
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
