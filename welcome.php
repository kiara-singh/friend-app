<?php 
include("config.php");
session_start();

//Check if the user is logged in, if not then redirect them tp login page
if($_SESSION["loggedin"] !=true){
    header("location:login.php");
    exit;
$user_id=$_SESSION["id"];   

}

?>


<!DOCTYPE html>
 <html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{font: 14px sans-serif; text-align: center;}

        table {
        border-collapse: collapse;
        width: 80%;
        align-content: center;
        color: #000000;
        font-family: monospace;
        font-size: 25px;
        text-align: left;
        word-wrap: break-word;
        }
        th {
        background-color: #FDA89E;
        color: white;
        word-wrap: break-word;
        }
        tr:nth-child(even) {background-color: #f2f2f2}
        word-wrap: break-word;

        .padding-table-columns td
        {
    padding:0 5px 0 0; /* Only right padding*/
        }
     .button {
            color: black;
            text-align: center;
            font-size: 60px;
            padding-top: 10px;
         }
        
        .sidenav{
             color: black;
            text-align: center;
            font-size: 10px;
           
         
            
        }
        
        .my-5{
            
            text-align: center;
        }

    </style>

</head>
<body>
    
       
    <h1 class="my-5">hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
    <div id="mySidenav" class="sidenav">
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a> 
        <a href="logout.php" class="btn btn-danger ml-3">Sign out of your account</a>
        <a href="eventform.php" class="btn btn-danger ml-3">Create an Event</a>
        <a href="entertime.php" class="btn btn-danger ml-3">Enter Available Times for an Event</a>
       <a href="calculate.php" class="btn btn-danger ml-3">Calculate common time for an event!</a>
        <a href="poll.php" class="btn btn-danger ml-3">Participate in poll</a>
    </div>
    <div class="button">
     <?php if($_SESSION["role"] == "2") : ?>
          <a href="manage_users.php" class="btn btn-primary">Manage Users</a>
          <a href="manage_poll1.php" class="btn btn-primary">Manage Polls</a>
          <a href="manage_events.php" class="btn btn-primary">Manage Events</a>
          <a href="manage_times.php" class="btn btn-primary">Manage Available Times</a>
        <?php endif; ?>
    
    </div>


    
    <table style="border:1px solid black;margin-left:auto;margin-right:auto;">
    
        
        <th>User</th>
        <th>Event Name</th>
        <th>Number of People</th>
        <th>Event location</th>
        <th>Event details</th>
        <?php
        $sql="SELECT `user`,`event_name`,`number`,`event_location`,`event_detail` FROM `events`";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()){
        echo "<tr><td>".$row["user"]. "</td><td>".$row["event_name"]."</td><td>"
        .$row["number"]."</td><td>".$row["event_location"]."</td><td>".$row["event_detail"]."</td></tr>";
        }
        echo "</table>";
        } else { echo "0 results"; }
        $link->close();
        ?>
    </table>
    
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
 
</body>
</html>
    
