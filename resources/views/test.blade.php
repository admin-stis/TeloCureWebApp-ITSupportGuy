@extends('doctor.layout')

@section('content')

<script src="{{ asset('backend/plugins/jquery/jquery.js') }}"></script>


                <form id="regForm" method="post" action="{{url('testform')}}" enctype="multipart/form-data">
                    
                    @csrf
    <div class="row"> blah blah

        <div class="col-md-12">
<input name="fileinput1" type="file" class="form-control" placeholder="" value=""/>
<input name="fileinput2" type="file" class="form-control" placeholder="" value=""/>
<input name="fileinput3" type="file" class="form-control" placeholder="" value=""/>
<input name="fileinput4" type="file" class="form-control" placeholder="" value=""/>

        </div>
        <div class="col-md-12">
            <br/>
            <button type="submit" class="btn btn-success">Upload Image</button>
        </div>
    </div>
</form>

@endsection
