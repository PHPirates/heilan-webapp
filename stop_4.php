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

$stop = "4";

//connect to the database
$con=mysqli_connect("localhost","thomass_thomass","database","thomass_database");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//query and subquery. Select the boat and departure time, where the stop is the variable above, and the time is later than now
$result = mysqli_query($con,"
SELECT `Boat`, `Time_D`
FROM `Schedule` 
WHERE `Stop`= '".$stop."' AND `Time_D` > CURTIME()
ORDER BY `Time_D` ASC
");


//get database result, via a while statement
while ($row = mysqli_fetch_assoc($result) ) {                         
$times[] = $row['Time_D']; //store all the times in one array
$boats[] = $row['Boat']; // store all the boats in one array
}

if (!empty($times)) { //if there is a time later than now, if not, don't try to calculate a difference! This goes of course also for everything below

$times = array_slice($times, 0, 3, true); //select elements 0 to 3 ( the first three) from the array, and assign them to different variables so they are usable
$time0 = $times[0];
$time1 = $times[1];
$time2 = $times[2];


$boats = array_slice($boats, 0, 3, true); //same for boats
$boat0 = $boats[0];
$boat1 = $boats[1];
$boat2 = $boats[2];

} else { echo "";}

//calculate the difference for each boat
$start_date = new DateTime(); // or DateTime('now')
$since_start = $start_date->diff(new DateTime($time0)); //the html5 way of calculating the difference
$diff0 = $since_start->format('%I:%S'); //and format it into a readable time

$start_date = new DateTime(); 
$since_start = $start_date->diff(new DateTime($time1));
$diff1 = $since_start->format('%I:%S');

$start_date = new DateTime(); 
$since_start = $start_date->diff(new DateTime($time2));
$diff2 = $since_start->format('%I:%S');


//close connection 
mysqli_close($con);


?>

<!-- 
The time is <?php echo date("H:i:s"); ?>
Boat is <?php echo $boat[x]; ?>
Departure time: <?php echo $time[x]; ?>
Waiting time: <?php echo $diff[x] ?>
-->

 <div class="center-wrapper">

<!-- make the table. the waiting room picture and waitin time are in one row. the boat images in another table -->
<table width="100%" >
    <tr>
        <td><?php 
if (!empty($time0)) {
?>
<img id="time_w" src="/Pictures/waiting_room.png" border="0" />
<h3><?php
} else { echo "There don't depart any boats anymore today, sorry.";} // if there is no first boat anymore, there don't depart boats anymore today at all (of course). 

if (!empty($time0)) {
echo $diff0;
} else { echo "";} // if there is no second boat, just leave that part empty. same for the pictures 
?>
</h3>
</td>

        <td><?php 
if (!empty($time1)) {
?>
<img id="time_w" src="/Pictures/waiting_room.png" border="0" /> <!-- echo the picture of the waiting person -->
<div class=tddiv>
<h3>
<?php
} else { echo "";}

if (!empty($time1)) {
echo $diff1;
} else { echo "";}
?>
</h3>
</div>
</td>

        <td><?php 
if (!empty($time2)) {
?>
<img id="time_w" src="/Pictures/waiting_room.png" border="0" />
<h3>
<?php
} else { echo "";}

if (!empty($time2)) {
echo $diff2;
} else { echo "";}
?>
</h3>
</td>
    </tr>
</table>

<table cellspacing="0" width="100%" margin="0" class="table"> <!-- have a look which boat it is, and then show the corresponding images -->
    <tr>
        <td><?php

if (!empty($boat0)) {

//Select pictures and echo them
if ($boat0 == "Gondola") {
$image = ($path . "/Pictures/Gondola.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";                                                    // use escape strings
} elseif ($boat0 == "Limousine Tender"){
$image = ($path . "/Pictures/Limousine Tender.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat0 == "Saloonboat Type A"){
$image = ($path . "/Pictures/Saloonboat Type A.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat0 == "Saloonboat Type C"){                                                    //problems with a random extra space
$image = ($path . "/Pictures/Saloonboat Type C.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat0 == "Saloonboat Type C "){                                                    
$image = ($path . "/Pictures/Saloonboat Type C.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat0 == "Touristboat Type A"){
$image = ($path . "/Pictures/Touristboat Type A.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat0 == "Touristboat Type C"){
$image = ($path . "/Pictures/Touristboat Type C.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} else {
echo "I don't know this boat.";
}

} else { echo "";}


?></td>

        <td><?php

if (!empty($boat1)) {

//Select pictures and echo them
if ($boat1 == "Gondola") {
$image = ($path . "/Pictures/Gondola.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat1 == "Limousine Tender"){
$image = ($path . "/Pictures/Limousine Tender.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat1 == "Saloonboat Type A"){
$image = ($path . "/Pictures/Saloonboat Type A.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat1 == "Saloonboat Type C"){                                                    
$image = ($path . "/Pictures/Saloonboat Type C.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat1 == "Saloonboat Type C "){                                                    
$image = ($path . "/Pictures/Saloonboat Type C.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat1 == "Touristboat Type A"){
$image = ($path . "/Pictures/Touristboat Type A.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat1 == "Touristboat Type C"){
$image = ($path . "/Pictures/Touristboat Type C.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} else {
echo "I don't know this boat.";
}

} else { echo "";}

?></td>
        <td><?php
if (!empty($boat2)) {

//Select pictures and echo them
if ($boat2 == "Gondola") {
$image = ($path . "/Pictures/Gondola.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat2 == "Limousine Tender"){
$image = ($path . "/Pictures/Limousine Tender.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat2 == "Saloonboat Type A"){
$image = ($path . "/Pictures/Saloonboat Type A.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat2  == "Saloonboat Type C"){                                                    
$image = ($path . "/Pictures/Saloonboat Type C.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat2 == "Saloonboat Type C "){                                                    
$image = ($path . "/Pictures/Saloonboat Type C.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat2  == "Touristboat Type A"){
$image = ($path . "/Pictures/Touristboat Type A.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} elseif ($boat2 == "Touristboat Type C"){
$image = ($path . "/Pictures/Touristboat Type C.jpg");
echo "<img id=\"Boat\" src=\"$image\" />";
} else {
echo "This boat has sunk...";
}

} else { echo "";}

?></td>
    </tr>
</table>        

</div>



</body>
</html>