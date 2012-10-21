<?php include 'connect.inc.php'; ?>
<?php
   $id = $_GET['id'];
?>
<?php echo $up_id?>
<?php
//user browser check
$pre = $_SERVER['HTTP_USER_AGENT'];
$usragent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($pre, "Firefox") !=0)
	$browser = "Firefox";
else if (strpos($pre, "Safari") !=0)
	$browser = "Safari";
else if (strpos($pre, "Chrome") !=0)
	$browser = "Chrome";
else if (strpos($pre, "Opera") !=0)
	$browser = "Opera";
else
	$browser = "Unknown";
// user ip check
 $http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
    $http_x_forwarded_for =$_SERVER	['HTTP_X_FORWARDED_FOR'];
    $remote_addr = $_SERVER['REMOTE_ADDR'];
  
    	$message2 = $_POST['comment'];
    	
    if (!empty($http_client_ip)) {
    	$ip_adress = $http_client_ip;

    }else if(!empty($http_x_forwarded_for)){
    	$ip_adress = $http_x_forwarded_for;	

    }else{
    	$ip_adress = $remote_addr;
    }
//some variabels for time, server url adress, and value for faking a token, and making a working link to file
$ts = date("Y-m-d h:i:s");  
$up_id = uniqid();
$today = date("ymd-H:i:s");
$host = $_SERVER['HTTP_HOST'];
$token = md5(uniqid(rand(),1));
$host = $_SERVER['HTTP_HOST'];
$host2 = '192.168.1.99';
$slash = '/get.php?q=';
$http = 'http://';
$link = $http.$host.$slash.$token;




?>
<?php
if ($_POST) { 
//get values from user when posting the form and upload the files 

$username = $_POST['username'];
$company = $_POST['company'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$comment = $_POST['comment'];
$dbcomment = $_POST['comment'];
//creating folder name for server file upload 
$folder = "upload/".$username."_".$company."-".$today."/";  $name = $_FILES['file']['name'];
// standard values from PHP when using php upload
$type =  $_FILES['file']['type'];
$size = $_FILES['file']['size'];
$tmp =  $_FILES['file']['tmp_name'];
$error =  $_FILES['file']['error'];
	
//redirect URL 
$redirect = "upload.php?success";
//echo $redirect;
//upload the file 
$filename = $_FILES['file']['name'];

#allowed file types
$whitelist = array('pdf', 'zip', 'jpg', 'png', 'jpeg', 'jpg', 'tif', 'gif', 'doc', 'docx','xls', 'xlsx', 'txt',  'bmp', 'raw', 'eps', 'ai', 'svg', 'svgz',  'ppt', 'pptx', 'indd', 'inx', 'psd', 'df'); 
// not allowed filetypes 
$backlist = array('php', 'php3', 'php4', 'phtml','exe'); 





// creating folder on server with this name, and giving full permisions to everyone on network
mkdir("upload/".$username."_".$company."-".$today."/", 0777);
//allowed file check
$filename = strtolower($_FILES['file']['name']);
if(!in_array(end(explode('.', $filename)), $whitelist))

{

        echo 'Ej Giltig Filtyp';
        echo '<form action="index.php" method="get">
<button type="submit">Tillbaka</button><br />
</form>';
        exit(0);
}

if(in_array(end(explode('.', $filename)), $backlist))
{

        echo 'Ej Giltig Filtyp';
       	echo '<form action="index.php" method="get">
<button type="submit">Tillbaka</button><br />
</form>';
        exit(0);
}
// insetfile will be stored in db for the download link
$insertfile = $folder.$filename;
// moving file with php
move_uploaded_file($_FILES["file"]["tmp_name"], "$folder" . $_FILES["file"]["name"]); 
// making text file for logging data  
    $myFile = "log/uploadlog.txt";
    $fh = fopen($myFile, 'a') or die("can't open file");
    $stringData = "\n$today, $username, $surname, $company, $email, $phone, $comment, $name, $type, $size, $tmp, $error, $folder, $ip_adress, $link, $browser, $usragent, $pre";
    fwrite($fh, $stringData);
    fclose($fh);
// making a csv text file with same values as above
    $myFile = "log/uploadlog.csv";
    $fh = fopen($myFile, 'a') or die("can't open file");
    $stringData = "\n$today, $username, $surname, $company, $email, $phone, $comment, $name, $type, $size, $tmp, $error, $folder, $ip_adress, $link, $browser, $usragent, $pre";
    fwrite($fh, $stringData);
    fclose($fh);

//send email to collector of file
// creating a lot of variabels for the HTML email
    $uploader = "Du har laddat upp filen: ";
    $table1 = '<table><tr><td style="border: 1px solid blue;">';
    $table2 = '</td></tr></table> ';
    $table3 = '<table border="0"><tr>';
    $tele = " Telefonnr: ";
    $foretag = "Företag: ";
    $infoomupp = "Uppladdare: ";
    $infoemail = "Email: ";
    $filflyttaren = '<td bgcolor=""><h2>&nbsp;&nbsp;&nbsp;Mail Från Filflyttaren&nbsp;&nbsp;&nbsp;</h2></td>'; 
    $filnamnet = "Filnamn: "; 
    $filtypen = "Filtyp: "; 
    $meddelande = "Meddelande från uppladdare: ";
    $filfinns = "Fil finns att hämta på följande URL_:";
    $space = "&nbsp;";
    $h2 = "<h3>";
    $h2b = "</h3>";
    $br = "<br />";
    $p = "<p>";
    $p2 = "</p>";
    $inform = "info.filflyttaren@inform-cmh.se";
    $to = $inform;
    $subject = "Filflyttaren Ny Uppladdning!";
// message for the user who gets the link 
$message = $table3.$filflyttaren.$table2.$br.$h2.$infoomupp.$username.$space.$surname.$h2b.$br.$foretag.$company.$br.$tele.$phone.$br.$infoemail.$email.$br.$filtypen.$type.$br.$filnamnet.$name.$br.$br.$meddelande.$br.$table1.$comment.$table2.$br.$br.$filfinns.$br.$h2.$link.$h2b;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";

// More headers
$headers .= 'From: <info.filflyttaren@inform-cmh.se>' . "\r\n";
$headers .= 'Cc: peterkullander@gmail.com' . "\r\n";
$headers .= 'Bcc: [email]peterkullander@hotmail.com[/email]' . "\r\n";
mail($to,$subject,$message,$headers);



//email notification to uploader
 $to = $email;
    $subject = "Filflyttaren Inform Din Uppladdning!";
// message to uploader
$message = $uploader.$name.$br.$infoomupp.$username.$space.$surname;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";

// More headers
$headers .= 'From: <filflyttaren@inform-cmh.se>' . "\r\n";
mail($to,$subject,$message,$headers);


//insert link for download to db
$query1 = "INSERT INTO `url` VALUES ('', '$link', '$insertfile', '$token', '$ts', '$folder', '$name', '$dbcomment')";
        if($query_run = mysql_query($query1)){
           
        }

}





$dir = $folder;

// read file with php
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            echo "filename: $file : filetype: " . filetype($dir . $file) . "\n";
        }
        closedir($dh);
    }
	
// sending user to redirct 
header('Location: '.$redirect); die; $name = $_FILES['file']['name'];$name = $_FILES['file']['name'];
	
} 


?> 





<!DOCTYPE html>
<html>
	<head>
		<title>Inform FilFlyttaren BETA</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script src="http://code.jquery.com/jquery-latest.js"></script>
    		<script type="text/javascript" src="js/check.js"></script>
            	<link rel="stylesheet" type="text/css" media="screen" href="/CSS/upload.css" />
	</head> 
     <body>

<table border="0" align="center" cellpadding="20"><tr bgcolor="#F9FAFB"><td>
<form action="" method="post" enctype="multipart/form-data" name="uploadform" id="uploadform" onsubmit="return validateForm()"> 
	<h6>*Alla fält är obligatoriska</h6>
	<p>Förnamn:<br /><input class="fyll" type="text" name="username" maxlength="30" value="<?php if (isset($username)) { echo $username; } ?>"><br /></p>
	<p>Efternamn:<br /><input class="fyll" type="text" name="surname" maxlength="40" value="<?php if (isset($surname)) { echo $surname; } ?>"><br /></p>
	<p>Företag:<br /><input class="fyll" type="text" name="company" maxlength="40" value="<?php if (isset($company)) { echo $company; } ?>"><br /></p>
	<p>Din e-postadress:<br /><input class="fyll" type="text" name="email" maxlength="40" value="<?php if (isset($email)) { echo $email; } ?>"><br /></p>
	<p>Telefon/Mobil:<br /><input class="fyll" type="text" name="phone" maxlength="40" value="<?php if (isset($phone)) { echo $phone; } ?>"><br /></p>
	<p>Skicka med info om uppladdningen:</p>
    <textarea  class="fyll" name="comment" rows="4" cols="50"  value="<?php if (isset($comment)) { echo $comment; } ?>"></textarea><br /></p>
    <p>Välj fil: <input class="file" type="file" name="file" id="file" /><br /></p>
	<br /><input class="fyll2" onclick="window.parent.startProgress(); return true;"
 type="submit" value="Ladda Upp">
<h6>*Max filstorlek 1.5 Gb <br /> Zippa större filer för att försöka hamna under den gränsen.</h6>

</form>
</td></tr></table>

</body>
</html>
