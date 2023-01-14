<?php
include_once('../Home-Page/config.php');


  if (isset($_POST['submit']))
  {
  $fname = $conn->real_escape_string($_POST['fname']);
  $lname = $conn->real_escape_string($_POST['lname']);
  $address = $conn->real_escape_string($_POST['address']);
  $email = $conn->real_escape_string($_POST['email']);
  $postalcode = $conn->real_escape_string($_POST['postalcode']);
  $bankname= $conn->real_escape_string($_POST['bankname']);
  $bankaccno = $conn->real_escape_string($_POST['bankacc']);
  $nic = $conn->real_escape_string($_POST['nic']);
  $qualification = $_POST['qualification'];
 
  $chk="";
  $checkbox1=$_POST['techno'];  
  foreach($checkbox1 as $chk1  )  
     {  
        $chk.= $chk1.",";  
     }
      
  
     //$profile = $_FILES['image']['name']; 
        // File name
       $filename = $_FILES['image']['name'];
      
        // Location
        $target_file = './uploads/'.$filename;
      
        // file extension
        $file_extension = pathinfo(
            $target_file, PATHINFO_EXTENSION);
             
        $file_extension = strtolower($file_extension);
     
     //$quliphoto = $_FILES['image2']['name']; 
  
  
  $query1  = "INSERT INTO employee(emp_fname,emp_lname,emp_address,emp_email,emp_nic,emp_postalcode,emp_bankname,emp_bankacc,emp_categories,emp_photo,emp_qulification) VALUES ('$fname','$lname','$address','$email','$nic','$postalcode','$bankname','$bankaccno','$chk', '$filename','$qualification',)";
  $result = $conn->query($query1);
  

  if(!$result){
      die("not insert data".mysqli_connect_error());
  }
  else {
      echo "succfull";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!--bootstrap css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="CSS/update.css">

</head>

<body>

  <div class="main-container d-flex">
    <div class="sidebar " id="side_nav">
      <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
        <h1 class="fs-4 ms-2 name"><span class="text">DCSMS</span></h1>
        <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
      </div>


      <ul class="list-unstyled px-2 ">
        <li class=""><a href="findjob.php" class="text-decoration-none px-3 py-3 d-block">FIND JOB</a></li>
        <li class=""><a href="pending.php" class="text-decoration-none px-3 py-3 d-block">PENDING CONFIRM</a></li>
        <li class=""><a href="cancel.php" class="text-decoration-none px-3 py-3 d-block">CANCEL JOB</a></li>
        <li class=""><a href="works.php" class="text-decoration-none px-3 py-3 d-block">YOUR WORKS</a></li>
        <li class=""><a href="resheduled.php" class="text-decoration-none px-3 py-3 d-block">RESHEDULED</a></li>

        <li class=""><a href="history.php" class="text-decoration-none px-3 py-3 d-block">HISTORY</a></li>

        <li class="active"><a href="updated.php" class="text-decoration-none px-3 py-3 d-block">UPDATE PROFILE</a></li>

      </ul>


    </div>
    <div class="content">

      <nav class="navbar navbar-expand-md py-3 navbar-light bg-light">
        <div class="container-fluid">
          <div class="d-flex justify-content-between d-md-none d-block">
            <button class="btn px-1 py-0 open-btn me-2"><i class="fa-solid fa-bars-staggered"></i></button>
            <a class="navbar-brand fs-4" href="#"></a>
          </div>
          <button class="navbar-toggler