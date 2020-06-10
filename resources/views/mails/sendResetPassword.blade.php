<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>

    <?php
      //dd($data);
    ?>

    Hello {{$data->name}}

    <p>Thank you for your interest as a Doctor with our TeleCure App from the organization [Sristy].
    Your login credential is below:</p>

    <?php
      //foreach($data as $item){
        echo 'E-mail : '.$data->receiver.'<br>' ;
        echo 'Temporary password : '.$data->code.'<br>' ;
      //}
    ?>
    <br>
    <p>Please visit the following URL and login to the account to complete the registration process.
    <a href="http://telocure.com/login/doctor" target="_blank">Login Doctor</a></p>

    <p>For any questions or query, please feel free to contact us at <strong>support@telocure.com</strong> or call us at <strong>09614501100</strong> </p>

    Best regards,
    <p>TeloCure Team</p>

  </body>
</html>
