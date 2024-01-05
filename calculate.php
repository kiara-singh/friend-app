<?php
require_once "config.php"; 

$query = "SELECT * FROM `events`";
$result = mysqli_query($link, $query);
$options = "";
while($row2 = mysqli_fetch_array($result))
{
    $options = $options."<option>$row2[2]</option>";
}



if(isset($_POST['calculate'])){
    $event_name=$_POST['event_name'];
    //number of people for that specific event
    $search="SELECT `number` FROM `events` WHERE `event_name`=?";
    $stmt=$link->prepare($search);
    $stmt->bind_param("s",$event_name);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row=$result->fetch_assoc()){
        $number= $row['number'];
    }
        

//check for duplicate entries of date and time for that event
//    
    $search2 = ("SELECT `date`, `time` FROM `options` WHERE `event_name`=? GROUP BY `date`,`time` HAVING COUNT(*)=?;");
    $stmt=$link->prepare($search2);
    $stmt->bind_param("ss",$event_name,$number);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row=$result->fetch_assoc()){
        $notempty = true;    
        echo $row['date'];
        echo "<br>";
        echo $row['time'];
        echo"<br";
    }
    if (!isset($notempty)){
        echo 'no common time!';
    }
}

?>
<html>
<head>
</head>

<body>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
      <form action="" method="POST">

        <h2>Which event do you want to calculate the common time for?</h2>

        <div class="form-group mb-3">
        <select name="event_name" value="<?php echo $event_name;?>"><?php echo $options;?></select>
        </div>

        <div>
            <button type="submit" name="calculate" class="btn btn-primary">Calculate Common Time</button>
        </div>

        <div id="center_button">
            <a href="welcome.php" class="btn btn-danger ml-3">Return to home</a>
        </div>

    </form>

</body>
</html>
