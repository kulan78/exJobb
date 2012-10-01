<!DOCTYPE html>
<html>
	<head>

		<title>Inform FilFlyttaren BETA</title>


		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" media="screen" href="/CSS/upload.css" />
			</style>  
  </head> 
     <body>


<form action="" method="post" enctype="multipart/form-data" name="uploadform" id="uploadform"> 
<p>Förnamn:<br /><input  type="text" name="surname" maxlength="30" value="<?php if (isset($username)) { echo $username; } ?>"><br /></p>
	<p>Efternamn:<br /><input  type="text" name="lastname" maxlength="40" value="<?php if (isset($surname)) { echo $surname; } ?>"><br /></p>
	<p>Företag:<br /><input  type="text" name="company" maxlength="40" value="<?php if (isset($company)) { echo $company; } ?>"><br /></p>
	<p>E-post:<br /><input  type="text" name="email" maxlength="40" value="<?php if (isset($email)) { echo $email; } ?>"><br /></p>
	<p>Telefon nummer:<br /><input  type="text" name="phone" maxlength="40" value="<?php if (isset($phone)) { echo $phone; } ?>"><br /></p>
	<p>Skicka med info om uppladdning:</p>
    <textarea  name="comment" rows="4" cols="50"  value="<?php if (isset($comment)) { echo $comment; } ?>"></textarea><br /></p>
    <p>Välj fil: <input  type="file" name="file" id="file" /><br /></p>
	<br /><input type="submit" value="Ladda Upp">


</form>


</body>
</html>
