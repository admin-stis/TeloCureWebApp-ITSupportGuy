{{--
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
--}}

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>

    <?php
      //dd($data);
    ?>

    Hello {{ $otp->receiver }},

    <p>Your OTP is below:</p>

    <h3>{{$otp->code}}</h3>

    <br>

    <p>For any questions or query, please feel free to contact us at <strong>support@telocure.com</strong> or call us at <strong>09614501100</strong> </p>

    Best regards,
    <p>TeloCure Team</p>

  </body>
</html>

