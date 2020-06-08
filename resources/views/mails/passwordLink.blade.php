Hello <i>{{ $otp->receiver }}</i>,
<p>This is a demo email for testing purposes! Also, it's the HTML version.</p>

<p><u>Demo object values:</u></p>

<div>
    <p class="alert alert-info"><strong>ID :</strong>{{$otp->code['id']}}</p>
    <p class="alert alert-info"><strong>Phone :</strong>{{$otp->code['phone']}}</p>
    <p class="alert alert-info"><strong>Password : </strong>{{$otp->code['pass']}}</p>
</div>

{{-- <div class="">
    <a href="{{url($otp->code)}}">Click here</a>
</div> --}}

Thank You,
<br/>
<i>{{ $otp->sender }}</i>
