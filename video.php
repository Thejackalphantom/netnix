<?php
// Begin maken aan de sessie
session_start();
$Host = "127.0.0.1";
$User = "root";
$Password = "";
$DBName = "netnix";

if (!isset($_SESSION['loggedin'])) {
    // not logged in
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<!--
INF1C Informatica NHL STENDEN
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Netnix</title>
    </head>
    <body>
        <?php
        $Conn = mysqli_connect($Host, $User, $Password, $DBName)
                OR DIE("Connection to the database has failed");

        $result = $Conn->query("SELECT videoID, videoTitle, videoDescription, videoUploadPath FROM videos WHERE aprove = 1") or die($Conn->error);
        $random = $Conn->query("SELECT videoID, videoTitle, videoDescription, videoUploadPath FROM videos WHERE aprove = 1 ORDER BY RAND() LIMIT 3") or die($Conn->error);
        ?>
        <div id="Wrap">
            <div id="content">
                <?php include ("includes/header.php"); ?>
                <div id="MainContent">
                    <div class="video">
                        <h2 class="title"><?php echo $index[1] ?></h2>   
                        <?php
                        while ($data = $result->fetch_assoc()) {
                            //print_r($data);
                            echo "<a href=videoshow.php?videoid={$data['videoID']}><div class='videoBoxUser'>
                                    <h2>{$data['videoTitle']}</h2>
                                        <video width='300' height='300'>
                                        <source src='{$data['videoUploadPath']}' type=video/mp4>
                                        <source src='{$data['videoUploadPath']}' type=video/wav>
                                        </video>
                                </div></a>";
                        }
                        ?>  
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


