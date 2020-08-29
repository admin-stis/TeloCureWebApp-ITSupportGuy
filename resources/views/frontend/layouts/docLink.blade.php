{{-- Hello <i>{{ $otp->receiver }}</i>,
<p>This is a demo email for testing purposes! Also, it's the HTML version.</p>

<p><u>Click here to login :</u></p>

<div class="">
    <a href="{{url($otp->code)}}">Click here</a>
</div>

Thank You,
<br/>
<i>{{ $otp->sender }}</i> --}}

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>

    <?php
      //dd($otp);
    ?>

    Hello {{$otp->code['name']}},

    <p>Thank you for your interest. Your login credential is below:</p>

    <div>
        <p class="alert alert-info"><strong>Phone :</strong>{{$otp->code['phone']}}</p>
        <p class="alert alert-info"><strong>Password : </strong>{{$otp->code['pass']}}</p>
    </div>

    <p>Please visit the following URL and login to the account.
    <a href="http://telocure.com/login/doctor" target="_blank">Login Doctor</a></p>

    <p>For any questions or query, please feel free to contact us at <strong>support@telocure.com</strong> or call us at <strong>09614501100</strong> </p>

    Best regards,
    <p>TeloCure Team</p>

  </body>
</html>

