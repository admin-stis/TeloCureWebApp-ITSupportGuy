<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>

    <?php
      //dd($data);
    ?>

    Hello {{$data->receiver}}

    <p>Your login credential is below:</p>

    <?php
      //foreach($data as $item){
        echo 'E-mail : '.$data->receiver.'<br>' ;
        echo 'Temporary password : '.$data->code.'<br>' ;
      //}
    ?>
    

    <p>For any questions or query, please feel free to contact us at <strong>support@telocure.com</strong> or call us at <strong>09614501100</strong> </p>

    Best regards,
    <p>TeloCure Team</p>

  </body>
</html>
