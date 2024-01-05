<?php
require_once "config.php";
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Define all variables
$event_name = $event_detail = $event_location = "";
$event_name_err = $event_detail_err = $event_location_err = "";
$number = 0;
$username=$_SESSION["username"];

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Confirm eventname is less than 100 characters and exists
    if(empty(trim($_POST["eventname"]))){
        $event_name_err = "Please enter an event name.";
    }  elseif(strlen(trim($_POST["eventname"])) > 200){
        $event_desc_err = "Event description must be less than 200 characters.";
    } else{
        $event_name = trim($_POST["eventname"]);
    }

    // Confirm that event description is less than 1000 characters
    if(empty(trim($_POST["eventdetail"]))){
        $event_detail_err = "Please enter an event description.";
    } elseif(strlen(trim($_POST["eventdetail"])) > 1000){
        $event_detail_err = "Event description must be less than 1000 characters.";
    } else{
        $event_detail = trim($_POST["eventdetail"]);
    }
// confrim location is less than 5000 characters
    if(empty(trim($_POST["eventlocation"]))){
        $event_location_err = "Please enter an proposed location.";
    } elseif(strlen(trim($_POST["eventlocation"])) > 5000){
        $event_location_err = "Location must be less than 5000 characters.";
    } else{
        $event_location = trim($_POST["eventlocation"]);
    }

    // Check input errors before inserting in database
    if(empty($event_name_err) && empty($event_detail_err) && empty($event_location_err)){
//        $number=$_POST["number"];
    $user =$_SESSION["username"];
    $event_name = mysqli_real_escape_string($link, $_POST['eventname']);
    $number = mysqli_real_escape_string($link, $_POST['number']);
    $location = mysqli_real_escape_string($link, $_POST['eventlocation']);
    $detail = mysqli_real_escape_string($link, $_POST['eventdetail']);

    $query = "INSERT INTO events (`id`,`user`, `event_name`, `number`, `event_location`, `event_detail`)  VALUES ('','$user','$event_name','$number','$location','$detail')";

    $query_run = mysqli_query($link, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Event Created Successfully";
        header("Location: welcome.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Event Not Created";
        header("Location: welcome.php");
        exit(0);
    }
}
//        // Prepare an insert statement
//        $sql=("INSERT INTO `events`(`user`, `event_name`, `number`, `event_location`, `event_detail`) VALUES (?,?,?,?,?)");
//        $stmt=$link->prepare($sql);
//        $stmt->bind_param("ssiss",$username,$event_name,$number,$event_location,$event_detail);
//        $stmt->execute();
//        $result = $stmt->get_result();
//        if($result){
//            // Redirect to home page
//              header("location: welcome.php");
//
//            } else{
//                echo "Something went wrong. Please try again later.";
//            }

            // Close statement
        
// }

    // Close connection
    mysqli_close($link);
}
?>


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Creation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        .wrapper{width: 850px; margin-left:auto; margin-right: auto;}
    </style>
</head>
<body>

    <div class="wrapper">
    <h2>Create an Event</h2>
    <p>Please fill this form to create an event.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($event_name_err)) ? 'has-error' : ''; ?>">
            <label>Event Name</label>
            <input type="text" name="eventname" class="form-control" value="<?php echo $event_name; ?>">
            <span class="help-block"><?php echo $event_name_err; ?></span> <!-- Echoes the php error in a box underneath the input -->
        </div>
        <div class="form-group">
            <label>Number of friends</label>
            <input type="number" name="number" class="form-control" placeholder="Insert number here" value="<?php echo $number; ?>">
        </div>
        <div class="form-group <?php echo (!empty($event_detail)) ? 'has-error' : ''; ?>">
            <label>Event Details</label>
            <textarea type="text" name="eventdetail" class="form-control" rows="3" value="<?php echo $event_detail; ?>"></textarea>
            <span class="help-block"><?php echo $event_detail_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($event_location)) ? 'has-error' : ''; ?>">
            <label>Location</label>
            <textarea type="text" name="eventlocation" class="form-control" rows="3" value="<?php echo $event_location; ?>"></textarea>
            <span class="help-block"><?php echo $event_location_err; ?></span>
        </div>
        <div class="form group">
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
            <a href="welcome.php" class="btn btn-info">Cancel Event Creation</a>
      </div>
        </div>
    </form>
    </div>
</body>
</html>