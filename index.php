<?php include 'connect.inc.php'; ?>


<?php
// user browser check
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
// check for user upload ip-adress
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
$ts = date("Y-m-d h:i:s");  
$up_id = uniqid();
$today = date("ymd-H:i:s");
$host = $_SERVER['HTTP_HOST'];
$token = md5(uniqid(rand(),1));
$host = $_SERVER['HTTP_HOST'];
//$host2 = '192.168.0.16';
$slash = '/get.php?q=';
$http = 'http://';
$link = $http.$host.$slash.$token;




?>
<?php
//process the forms and upload the files 
if ($_POST) { 
$username = $_POST['username'];
$company = $_POST['company'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$comment = $_POST['comment'];
$dbcomment = $_POST['comment'];
//specify folder for file upload 
$folder = "upload/".$username."_".$company."-".$today."/";  $name = $_FILES['file']['name'];

$type =  $_FILES['file']['type'];
$size = $_FILES['file']['size'];
$tmp =  $_FILES['file']['tmp_name'];
$error =  $_FILES['file']['error'];
	
	//echo $folder;


$filename = $_FILES['file']['name'];

// allowed file types for upload
$whitelist = array('pdf', 'zip', 'jpg', 'png', 'jpeg', 'jpg', 'tif', 'gif', 'doc', 'docx','xls', 'xlsx', 'txt',  'bmp', 'raw', 'eps', 'ai', 'svg', 'svgz',  'ppt', 'pptx', 'indd', 'inx', 'psd', 'df'); #example of white list
// not allowed files type
$backlist = array('php', 'php3', 'php4', 'phtml','exe'); #blacklisted file types






mkdir("upload/".$username."_".$company."-".$today."/", 0777);
//allowed files check
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
$insertfile = $folder.$filename;

move_uploaded_file($_FILES["file"]["tmp_name"], "$folder" . $_FILES["file"]["name"]); 
// upload log file
    $myFile = "log/uploadlog.txt";
    $fh = fopen($myFile, 'a') or die("can't open file");
    $stringData = "\n$today, $username, $surname, $company, $email, $phone, $comment, $name, $type, $size, $tmp, $error, $folder, $ip_adress, $link, $browser, $usragent, $pre";
    fwrite($fh, $stringData);
    fclose($fh);
// upload log file
    $myFile = "log/uploadlog.csv";
    $fh = fopen($myFile, 'a') or die("can't open file");
    $stringData = "\n$today, $username, $surname, $company, $email, $phone, $comment, $name, $type, $size, $tmp, $error, $folder, $ip_adress, $link, $browser, $usragent, $pre";
    
    fwrite($fh, $stringData);
    fclose($fh);

      //send email to collector of file
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

$message = $table3.$filflyttaren.$table2.$br.$h2.$infoomupp.$username.$space.$surname.$h2b.$br.$foretag.$company.$br.$tele.$phone.$br.$infoemail.$email.$br.$filtypen.$type.$br.$filnamnet.$name.$br.$br.$meddelande.$br.$table1.$comment.$table2.$br.$br.$filfinns.$br.$h2.$link.$h2b;

//  set content-type HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";

// More headers
$headers .= 'From: <info.filflyttaren@inform-cmh.se>' . "\r\n";
$headers .= 'Cc:  ' . "\r\n";
$headers .= 'Bcc: [email]peterkullander@hotmail.com[/email]' . "\r\n";
mail($to,$subject,$message,$headers);



//email notification to uploader
 $to = $email;
    $subject = "Filflyttaren Inform Din Uppladdning!";

$message = $uploader.$name.$br.$infoomupp.$username.$space.$surname;

// set content-type HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";

// More headers
$headers .= 'From: <filflyttaren@inform-cmh.se>' . "\r\n";
mail($to,$subject,$message,$headers);


//insert link for download
$query1 = "INSERT INTO `url` VALUES ('', '$link', '$insertfile', '$token', '$ts', '$folder', '$name', '$dbcomment')";
        if($query_run = mysql_query($query1)){
           
        }

}



//redirect user afterupload

$dir = $folder;

// Open a known directory, and proceed to read its contents
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            echo "filename: $file : filetype: " . filetype($dir . $file) . "\n";
        }
        closedir($dh);
    }
	

header('Location: '.$redirect); die; $name = $_FILES['file']['name'];$name = $_FILES['file']['name'];
	
} 
	
?> 





<!DOCTYPE html>
<html>
	<head>

		<title>Inform FilFlyttaren BETA</title>


		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="check.js"></script>

			<link rel="stylesheet" type="text/css" media="screen" href="upload.css" />
			</style>  
  </head> 
     <body>

<table border="0" align="center" cellpadding="20"><tr bgcolor="#F9FAFB"><td>
<form action="" method="post" enctype="multipart/form-data" name="uploadform" id="uploadform" onsubmit="return validateForm()"> 
	<h6>*Alla fält är obligatoriska</h6>
	<p>Förnamn:<br /><input class="fyll" type="text" name="username" maxlength="30" value="<?php if (isset($username)) { echo $username; } ?>"><br /></p>
	<p>Efternamn:<br /><input class="fyll" type="text" name="surname" maxlength="40" value="<?php if (isset($surname)) { echo $surname; } ?>"><br /></p>
	<p>Företag:<br /><input class="fyll" type="text" name="company" maxlength="40" value="<?php if (isset($company)) { echo $company; } ?>"><br /></p>
	<p>E-post:<br /><input class="fyll" type="text" name="email" maxlength="40" value="<?php if (isset($email)) { echo $email; } ?>"><br /></p>
	<p>Telefon nummer:<br /><input class="fyll" type="text" name="phone" maxlength="40" value="<?php if (isset($phone)) { echo $phone; } ?>"><br /></p>
	<p>Skicka med info om uppladdning:</p>
    <textarea  class="fyll" name="comment" rows="4" cols="50"  value="<?php if (isset($comment)) { echo $comment; } ?>"></textarea><br /></p>
    <p>Välj fil: <input class="file" type="file" name="file" id="file" /><br /></p>
	<br /><input class="fyll2" onclick="window.parent.startProgress(); return true;"
 type="submit" value="Ladda Upp">
<h6>*Max filstorlek 1.5 Gb <br /> Zippa st&ouml;rre filer f&ouml;r att f&ouml;rs&ouml;ka hamna under den gr&auml;nsen.</h6>

</form>
</td></tr></table>

</body>
</html>
