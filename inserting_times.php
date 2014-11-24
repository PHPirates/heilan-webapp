<!DOCTYPE html>
<html>
<head>
<title>
Heilan Aquapark
</title>
<link rel='stylesheet' type='text/css' href='indexstyle.css'/>
</head>
<body>
<?php


//connect to the database
$con=mysqli_connect("localhost","thomass_thomass","database","thomass_database");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}



//******************************************inserting new times for first stop below******************************** 




//change starting time and boattype
$time = "09:00"; //first departure time of the day
$boat = "Gondola";
$time_diff = 900; //difference in departure time in seconds
$time_day = 32400; //length of working day in seconds


//For how many times there go in a working day, add one time to the database
for($i = 0; $i < ($time_day/$time_diff) ; $i++){
    mysqli_query($con, "INSERT INTO `Schedule`(`Boat`, `stop`, `Time_D`) VALUES ('".$boat."', '1', '".$time."')");
//for the next time, calculate it via a timestamp (php...) 
$time = strtotime($time) + ($time_diff);
$time = date('H:i:s', ($time));
}




//*******************************************Process to make a new stop below***************************************
/*
$time_difference=120; //time difference in departure times between the two stops (seconds)
$stop_old = "4"; //stop from which to use the times to calculate the next times
$stop_new = "5"; //the new stop



//get times from stop in array
$result = mysqli_query($con,"SELECT `Boat`, `Time_D` from `Schedule` where `Stop` = '".$stop_old."' ");
//get database result
while ($row = mysqli_fetch_array($result) ) {                         
$rows[] = $row['Time_D']; //store all the times in one array
$boats[] = $row['Boat']; // store all the boats in one array
}
//print_r ($rows); //used for debugging
//Iterate over the array to change all the elements
for($i = 0; $i < sizeof($rows); $i++){
$rows[$i] = ( strtotime($rows[$i]) ) + ($time_difference); //with timestamps, because, well, php and times...
$rows[$i] = date('H:i:s', ($rows[$i]) ); // back from timestamp to time
}
//print_r($rows);
//print_r($boats);

for($i = 0; $i < sizeof($rows); $i++){
    mysqli_query($con, "INSERT INTO `Schedule`(`Boat`, `stop`, `Time_D`) VALUES ('$boats[$i]', '".$stop_new."', '$rows[$i]')");
}
*/

//Mysqli rule to insert items into the database
//mysqli_query($con, "INSERT INTO `Test`(`id`, `ItemName`) VALUES ('".$stop."', '11:00')");

//close connection 
mysqli_close($con);


?>

</body>
</html>