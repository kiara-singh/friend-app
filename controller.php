<?php
require_once('core/controller.Class.php');
require_once("config.php");
session_start();
//check for authentication code. this can be seen in URL
if(isset($_GET["code"])){
    $token=$gClient->fetchAccessTokenWithAuthCode($_GET["code"]);
}else{
    header('Location: login.php');
    exit();
}

//check if user is accessing page for the second time. This should not be possible and so we are checking if the error is invalid_grant 
//if(!isset($token["error"])){

    // get data from google
    $oAuth = new Google_Service_Oauth2($gClient);
    $userData = $oAuth->userinfo_v2_me->get();
    
    //insert data
    $Controller = new Controller;
    echo $Controller -> insertData(
        array(
            'email' => $userData['email'],
            'familyName' => $userData['familyName'],
            'givenName' => $userData['givenName'],
        )
    );
    $_SESSION["username"]=$userData['givenName'];
    $_SESSION["role"] = "1";
    $_SESSION["loggedin"]=true;
    header('location: welcome.php');
//    exit();

?>