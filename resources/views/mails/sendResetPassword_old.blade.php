<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>Reset password</h2>
    <?php
      //dd($data); 
    ?>

    <?php 
      //foreach($data as $item){
        echo 'E-mail : '.$data->receiver.'<br>' ;
        echo 'Temporary password : '.$data->code.'<br>' ;
      //}
    ?>
    <br>
    You can login with this credentials.
    
  </body>
</html>
