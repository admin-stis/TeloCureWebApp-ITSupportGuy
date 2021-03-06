@extends('hospital.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" style="float:left;">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('hospital')}}">Home</a></li>
              <li class="breadcrumb-item active">Bank Information</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


<section class="content">
    <div class="row col-md-12">
    	<div class="col-md-6 m-0 m-auto d-table" >
	    	<div class="card" style="min-height: 580px;">
	            <div class="card-header">Account Details</div>
	            <div class="card-body">
	            	<ul class="todo-list" data-widget="todo-list" style="">

                  <li>
                    <span class="text col-md-6 col-sm-12">Account Holder Name</span>
                    <span class="">:</span>
                    <span class="text col-md-5 col-sm-12">
                    @if(isset($info['accountName']))
                      {{$info['accountName']}}
                    @endif
                    </span>
                  </li>
                  <li>
                    <span class="text  col-md-6 col-sm-12">Bank Account Number</span>
                    <span class="">:</span>
                    {{-- <span class="text col-md-6 col-sm-12">{{$info['accountNo']}}</span> --}}
                    <span class="text col-md-5 col-sm-12">
                    @if(isset($info['accountNumber'])){{$info['accountNumber']}} @endif</span>
                  </li>
                  <li>
                    <span class="text col-md-6 col-sm-12">Bank</span>
                    <span class="">:</span>
                    <span class="text col-md-5 col-sm-12">@if(isset($info['bankName'])){{$info['bankName']}} @endif</span>
                  </li>

                  <li>
                    <span class="text col-md-6 col-sm-12">Swift Code / Routing number</span>
                    <span class="">:</span>
                    <span class="text col-md-5 col-sm-12">@if(isset($info['swiftCode'])){{$info['swiftCode']}} @endif</span>
                  </li>

                </ul>
	            </div>
	        </div>
	    </div>
        <div class="col-md-6 m-0 m-auto d-table" >
            <div class="card" style="min-height: 580px;">
                <div class="card-header">Add Bank Information</div>
                <div class="card-body">
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach
                            </ul>
                        @endif

                        @if(Session::has('add-bank-info'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('add-bank-info') }}</p></ul>
                        @endif

                        @if(Session::has('add-bank-info-warn'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('add-bank-info-warn') }}</p></ul>
                        @endif

                        <form method="POST" action="{{url('hospital/addBank_infoAction')}}" />
                        	@csrf
                        	<div class="row">

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <small class="text-bold"><i class="iconFa fa fa-asterisk color-red"></i> Please fill all field carefully. You can add one bank account.</small>
                                </div>

	                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
	                                <label class="">Name on the Account <i class="iconFa fa fa-asterisk color-red"></i></label>
                                    <input name="accountName" type="text" required="required" class="form-control" placeholder=""
                                    value="@if(isset($info['accountName'])) {{$info['accountName']}} @else {{old('accountName')}} @endif"/>
	                            </div>

	                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
	                                <label class="">Bank Name <i class="iconFa fa fa-asterisk color-red"></i></label>
                                    <input name="bankName" type="text" required="required" class="form-control" placeholder=""
                                    value="@if(isset($info['bankName'])) {{$info['bankName']}} @else {{old('bankName')}} @endif"/>
	                            </div>

	                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
	                                <label class="">Bank Account Number <i class="iconFa fa fa-asterisk color-red"></i></label>
                                    <input name="accountNumber" type="text" required="required" class="form-control" placeholder=""
                                    value="@if(isset($info['accountNumber'])) {{$info['accountNumber']}} @else {{old('accountNumber')}} @endif"/>
	                            </div>

	                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
	                                <label class="">Swift Code/Routing Number</label>
                                    <input name="swiftCode" type="text" class="form-control" placeholder=""
                                    value="@if(isset($info['swiftCode'])) {{$info['swiftCode']}} @else {{old('swiftCode')}} @endif"/>
	                            </div>

	                            {{-- <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <button class="btn btn-sm btn-primary"
                                    @if(isset($attr)) {{$attr}} @endif
                                    >Submit</button>
                                </div> --}}

                                @if(isset($info) == null)
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <button class="btn btn-sm btn-primary"
                                        >Submit</button>
                                    </div>
                                @else
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <button class="btn btn-sm btn-primary" name="edit" value="edit"
                                        >Edit</button>
                                    </div>
                                @endif

                            </form>

                </div>
            </div>
        </div>
    </div>
</div>

</section>

@endsection
