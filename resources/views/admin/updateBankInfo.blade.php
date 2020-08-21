@extends('admin.layout')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Hospital User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/hospital')}}">Hospital</a></li>
              <li class="breadcrumb-item active">Update Bank Information</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
                <div class="row">
            <!-- Left col -->
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-md-12">
                                    <span class="">Update Bank Information</span>
                                </div>
                            </div>
                            <!-- /.card-header -->
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

                                <form method="POST" action="{{url('admin/updateBankInfo/'.$id)}}" />
                                    @csrf
                                    <input type="hidden" name="id" value="{{$id}}" />
                                    <div class="row">

                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <small class="text-bold"><i class="iconFa fa fa-asterisk color-red"></i> Please fill all field carefully. You can add one bank account.</small>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label class="">Name on the Account <i class="iconFa fa fa-asterisk color-red"></i></label>
                                            <input name="accountName" type="text" required="required" class="form-control" placeholder=""
                                            value="{{old('accountName')}}"/>
                                        </div>


                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label class="">Bank Name <i class="iconFa fa fa-asterisk color-red"></i></label>
                                            <input name="bankName" type="text" required="required" class="form-control" placeholder=""
                                            value="{{old('bankName')}}"/>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label class="">Bank Account Number <i class="iconFa fa fa-asterisk color-red"></i></label>
                                            <input name="accountNumber" type="text" required="required" class="form-control" placeholder=""
                                            value="{{old('accountNumber')}}"/>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label class="">Swift Code/Routing Number</label>
                                            <input name="swiftCode" type="text" class="form-control" placeholder=""
                                            value="{{old('swiftCode')}}"/>
                                        </div>

                                        {{-- <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <button class="btn btn-sm btn-primary"
                                            @if(isset($attr)) {{$attr}} @endif
                                            >Submit</button>
                                        </div> --}}

                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                <button type="submit" name="update" value="update" class="btn btn-sm btn-primary"
                                                >Submit</button>
                                            </div>

                                    </form>

                        </div>
                        </div>
                    </section>
                </div>
        </div>
    </section>

@endsection
