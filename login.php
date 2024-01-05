<?php
//Initialize the session
session_start();
require_once('config.php');
require_once('core/controller.Class.php');

//check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location:welcome.php");
    exit;
}

//Include config file
require_once "config.php";

//Define varaibles and initalize with empty values
$username= $password= "";
$username_err= $password_err= $login_err= "";


//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    //check if username is empty 
    if(empty(trim($_POST["username"]))){
        $username_err= "Please enter username.";
    } else{
        $username= trim($_POST["username"]);
    }
    
    //check if password is empty 
    if(empty(trim($_POST["password"]))){
        $password_err= "Please enter your password.";
    } else{
        $password= trim($_POST["password"]);
    }
    
    // Validate credetials
    if(empty($username_err) && empty($password_err)){
        //Prepare a select statement
        $sql="SELECT `id`,`access`,`username`,`password` FROM `users` WHERE `username`=?";
        
        if($stmt= mysqli_prepare($link, $sql)){
            //Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt,"s",$param_username);
            
            //Set parameters
            $param_username= $username;
            
            //attempt to execute the prepared statement 
            if(mysqli_stmt_execute($stmt)){
                // Store result 
                mysqli_stmt_store_result($stmt);
                
                //Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                  
                    //bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $access, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password,$hashed_password)){
                            //Password is correct so start a new session 
                            session_start();
                            
                            //store data in session variables
                            $_SESSION["loggedin"]=true;
                            $_SESSION["id"]=$id;
                            $_SESSION['role']=$access;
                            $_SESSION["username"]=$username;

                                 
                            header("location:welcome.php");
                                        
                       
                                }
                        }else{
                            //password is not valid, display a generic error message
                            $login_err="Invalid username or password.";
                        }
                    }
                }else{
                    //Username doesn't exist, display a generic error message
                    $login_err="Invalid username or password.";
                }
            }else{
                echo"Oops! Something went wrong.  Please try again later.";
            }
            
            //Close statemtent
            mysqli_stmt_close($stmt);
        }
    
    
    //close connetion
    mysqli_close($link);
}

    
?>

<!DOCTYPE html>
<html leang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font:14px sans-serif}
        .wrapper{ width: 360px; padding:20px;}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        
        <?php
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>  
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err;?></span>
            </div>
            <div class="form group"  style="margin-bottom: 10px;">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err;?></span>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
<!--//echo part is connected to login url in config.php-->
            <button onclick="window.location='<?php echo $login_url;?>'" type="button" class="btn btn-danger">Login with Google</button>
            <p>Don't have an account?<a href="register.php">Sign up now</a>.</p>
        </form>
         
    </div>
</body>
</html>