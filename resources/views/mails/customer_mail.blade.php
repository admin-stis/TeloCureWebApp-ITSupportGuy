<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>Your registation Status</h2>
    <?php if($data['flag']==true){ ?>
    	<p>Your registation is approve</p>
    	<p>username:mrdsx</p>
    	<p>password:$%#6765</p>

    <p>{{ $data['message'] }}</p>
<?php }
	else{
 ?>

<p>For any questions or query, please feel free to contact us at <strong>support@telocure.com</strong> or call us at <strong>09614501100</strong> </p>

<?php } ?>
  </body>
</html>
Sendin
