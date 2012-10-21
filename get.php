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

<?php include 'connect.inc.php'; ?>

<?php


// get the md5 value from url
$i=$_GET['q'];

//query db for link to file, to down download
 $query = "SELECT `folder`, `name` FROM `url` WHERE  `token`='$i'";
        $query_run = mysql_query($query);

        if (mysql_num_rows($query_run)>=1){
               
                while ($query_row = mysql_fetch_assoc($query_run)){
                        
                        $folder = $query_row['folder']; //folder on server stored in db
                        $file = $query_row['name']; //file on server stored in db

                }

        } else {

                echo 'Ogiltig länk';
        }
       
      




  ?>
  <?php 
    // creates the real path to folder and file on server for download script
     $secretfile = $folder . $file;
// some standard download form
if (file_exists($secretfile)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($secretfile));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($secretfile));
    ob_clean();
    flush();
    readfile($secretfile);
    exit;
}

?>
</body>
</html>
