<!DOCTYPE html>
<html>
	<head>

		<title>Inform FilFlyttaren BETA</title>


		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script src="http://code.jquery.com/jquery-latest.js"></script>
			<link rel="stylesheet" type="text/css" media="screen" href="/CSS/upload.css" />
		
	</head> 
     <body>

<p class="notice">Klicka nedan för att ladda upp fler filer</p>
<form action="index.php" method="get">
<button type="submit">Ny Uppladdning</button><br />
</form>
<?php
echo '<script type="text/javascript">';
echo "alert('Ett mail har skickats med info om uppladdningen till Informtrycket.')";
 echo ' </script>';
?>
</body>
</html>
