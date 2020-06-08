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
<p>your registation is rejected for some reason plese contac us helodoc.example.com</p>
<?php } ?>
  </body>
</html>
Sendin