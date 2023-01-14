<?php

include_once('../Home-page/config.php');

// get the point and currentPoint values from the POST data
$point = $_POST['point'];
$currentPoint = $_POST['currentPoint'];

// calculate the sum of the points
$sum = $point + $currentPoint;

// update the points in the database
$sql = "UPDATE registered_employee SET emp_points = '$sum' WHERE emp_id = 1";
$result = mysqli_query($conn, $sql);
if (!$result) {
  // if the update failed, send an error message back to the client
  die('Failed to update points: ' . mysqli_error($conn));
} else {
  // if the update was successful, send the sum back to the client
  echo $sum;
}

?>
