<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>

    <?php
      //dd($otp);
    ?>

    Hello TeloCure,

    <p>You are requested update our bank information. New bank information is below:</p>

    <div>
        <p class="alert alert-info"><strong>Account Name :</strong>{{$data->code['accountName']}}</p>
        <p class="alert alert-info"><strong>Account Number :</strong>{{$data->code['accountNumber']}}</p>
        <p class="alert alert-info"><strong>Bank Name : </strong>{{$data->code['bankName']}}</p>
        <p class="alert alert-info"><strong>Swift Code / Routing Number : </strong>{{$data->code['swiftCode']}}</p>
    </div>

    Best regards,
    <p>{{$data->code['name']}}</p>

  </body>
</html>

