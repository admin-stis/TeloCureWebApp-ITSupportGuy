Hello <i>{{ $otp->receiver }}</i>,
<p>This is a demo email for testing purposes! Also, it's the HTML version.</p>

<p><u>Click here to login :</u></p>

<div class="">
    <a href="{{url($otp->code)}}">Click here</a>
</div>

Thank You,
<br/>
<i>{{ $otp->sender }}</i>
