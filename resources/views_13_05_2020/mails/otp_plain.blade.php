Hello {{ $otp->receiver }},
This is a demo email for testing purposes! Also, it's the HTML version.
 
Demo object values:
your otp is {{$otp->code}}
 
Values passed by With method:
 
testVarOne: {{ $testVarOne }}
testVarOne: {{ $testVarOne }}
 
Thank You,
{{ $otp->sender }}