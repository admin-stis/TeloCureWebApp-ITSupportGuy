Hello <i>{{ $otp->receiver }}</i>,
<p>This is a demo email for testing purposes! Also, it's the HTML version.</p>
 
<p><u>Demo object values:</u></p>
 
<div>

</div>
 
<p><u>Values passed by With method:</u></p>
 <p>youe otp_code is </p>
 <h1>{{$otp->code}}</h1>
<div>
<p><b>testVarOne:</b>&nbsp;{{ $testVarOne }}</p>
<p><b>testVarTwo:</b>&nbsp;{{ $testVarTwo }}</p>
</div>
 
Thank You,
<br/>
<i>{{ $otp->sender }}</i>