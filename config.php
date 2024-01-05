<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'app');
 
//Attempt to connect to MySQL database 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

require_once "google-api/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId("942701728494-bmuaqnh4m6luo3kfh84rhub3pq4bn8co.apps.googleusercontent.com");
$gClient->setClientSecret("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");
$gClient->setApplicationName("Friend-App");
$gClient->setRedirectUri("http://localhost/friendapp/controller.php");
//what you want to get from the user eg email, login data, etc
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

$_SESSION['user_id']=1;

// login URL
$login_url = $gClient->createAuthUrl();

?>

