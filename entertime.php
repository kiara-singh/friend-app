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
$date1 = $date2 = $date3 = $time1 = $time2 = $time3 = $event_name= "";
$date_err = $time_err = "";


//dropdown from event name in events table
$query = "SELECT * FROM `events`";
$result = mysqli_query($link, $query);
$options = "";
while($row2 = mysqli_fetch_array($result))
{
    $options = $options."<option>$row2[2]</option>";
}


if(isset($_POST['save_date'])){
    $username=$_SESSION["username"];
    $event_name=$_POST['event_name'];
    $date1 = date('Y-m-d', strtotime($_POST['date1']));
    $date2 = date('Y-m-d', strtotime($_POST['date2']));
    $date3 = date('Y-m-d', strtotime($_POST['date3']));
    $time1 = $_POST['time1'];
    $time2= $_POST['time2'];
    $time3= $_POST['time3'];

   $query = "INSERT INTO `options`(`username`, `event_name`, `date`, `time`) VALUES ('$username', '$event_name', '$date1','$time1')";
    $query_run = mysqli_query($link, $query);
    
    $query = "INSERT INTO `options`(`username`, `event_name`, `date`, `time`) VALUES ('$username', '$event_name', '$date2','$time2')";
    $query_run = mysqli_query($link, $query);
    
    $query = "INSERT INTO `options`(`username`, `event_name`, `date`, `time`) VALUES ('$username', '$event_name', '$date3','$time3')";
    $query_run = mysqli_query($link, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Date values Inserted";
        header("Location: welcome.php");
    }
    else
    {
        $_SESSION['status'] = "Date values Inserting Failed";
        echo "faliure to enter times";
        header("Location: welcome.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card mt-5">
                    
                    <div class="card-header">
                        <h4>Please enter 3 dates and 3 corresponding times. Along with which event these times are for</h4>
                    </div>
                    <div class="card-body">
                        
                        <form action="entertime.php" method="POST">
                            <div class="form-group mb-3">
                            <select name="event_name"><?php echo $options;?></select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Date 1</label>
                                <input type="date" name="date1" class="form-control" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Time 1</label>
                                <input type="time" name="time1" class="form-control" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Date 2</label>
                                <input type="date" name="date2" class="form-control" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Time 2</label>
                                <input type="time" name="time2" class="form-control" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Date 3</label>
                                <input type="date" name="date3" class="form-control" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Time 1</label>
                                <input type="time" name="time3" class="form-control" />
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="save_date" class="btn btn-primary">Save Data</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>