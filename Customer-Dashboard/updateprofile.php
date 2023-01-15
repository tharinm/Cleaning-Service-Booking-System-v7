<?php
session_start();
include('../Home-page/config.php');

if (isset($_GET['username']))
 {
  $username = $_GET['username'];
  $_SESSION['cusname'] = $username;

    $sql2=mysqli_query($conn,"SELECT cus_id from customer where user_name in('$username')");
    $cusid=mysqli_fetch_array($sql2);
    if(!$sql2){
        die("Invalid query" . mysqli_error($conn));
    }else{
        $_SESSION['cus_id']=$cusid['cus_id'];
        
    }
  }
  $cusid=$_SESSION['cus_id'];
  print_r($_SESSION);

  echo $cusid;
if (isset($_POST['submit'])) {



  $firstname = mysqli_real_escape_string($conn, $_POST['first']);
  $lastname  = mysqli_real_escape_string($conn, $_POST['last']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $postalcode = mysqli_real_escape_string($conn, $_POST['postal_code']);
  $nic = mysqli_real_escape_string($conn, $_POST['nic']);
  $mobile = mysqli_real_escape_string($conn, $_POST['mobile_no']);
  // $username = $_SESSION['username'];
  // $email = $_SESSION['email'];

  //$result=mysqli_query($conn,"SELECT id,mobile from users where role='user' or mobile=$mobile");
  //$row=mysqli_fetch_array($result);
  // $result1 = mysqli_query($conn, "SELECT cus_id from customer where user_name like '$username' or email like '$email' ");
  // $row = mysqli_fetch_assoc($result1);
  // $_SESSION['id'] = $row['cus_id'];
  // print_r($_SESSION);
  $sql1 = "UPDATE customer SET first_name='$firstname',last_name='$lastname',address='$address',nic='$nic',postal_code=$postalcode WHERE cus_id=$cusid ";
  $results = mysqli_query($conn, $sql1);

  if (!$results) {
    die("Invalid query" . mysqli_error($conn));
  } else {
    echo "<script> alert('account updated sucessfully!');</script>";
  }

  mysqli_close($conn);
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
  <link rel="stylesheet" href="CSS/updateprofile.css">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">


  <style>
    .navbar {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      align-items: center;
      padding: 5px;


    }

    .avatar {
      width: 40px;
    }
  </style>

</head>

<body>
    
  <div class="main-container d-flex">
    <div class="sidebar " id="side_nav">
      <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
        <h1 class="fs-4 ms-2 name"><span class="text">DCSMS</span></h1>
        <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
      </div>


      <ul class="list-unstyled px-2 ">
        <li class=""><a href="postjob.php" class="text-decoration-none px-3 py-3 d-block">POST JOB</a></li>
        <li class=""><a href="orderstatus.php" class="text-decoration-none px-3 py-3 d-block">ORDER STATUS</a></li>
        <!-- <li class=""><a href="payment.html" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li> -->
        <li class=""><a href="reshedule.php" class="text-decoration-none px-3 py-3 d-block">RESHEDULE</a></li>
        <li class=""><a href="myorders.php" class="text-decoration-none px-3 py-3 d-block">MY ORDERS</a></li>
        <li class=""><a href="complaign.php" class="text-decoration-none px-3 py-3 d-block">COMPLAIN</a></li>
        <li class="active"><a href="updateprofile.php" class="text-decoration-none px-3 py-3 d-block">UPDATE PROFILE</a></li>
        <li class=""><a href="store.php" class="text-decoration-none px-3 py-3 d-block">REWARDS</a></li>
        <li class=""><a href="help.html" class="text-decoration-none px-3 py-3 d-block">HELP</a></li>

      </ul>


    </div>
    <div class="content">
      <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
        <img src="image.png" class="avatar">
        <input type="submit" class="btn btn-secondary default btn  " value="Logout" onclick="window.location.href='../Home-Page/index.html'" name="logout" />
      </nav>



      <div class="dashboard-content ms-5 px-3 pt-4 ">
        <div class="container ">
          <div class="row no-gutters">
            <form name="myform" class="form-group" method="POST" action="">
              <div class="row jumbotron">
                <div class="col-sm-6 mb-4">
                  <label>First Name</label>
                  <input type="text" class="form-control " name="first">
                </div>


                <div class="col-sm-6 mb-4">
                  <label>Last Name</label>
                  <input type="text" class="form-control " name="last">
                </div>

                <div class="col-sm-6 mb-4">
                  <label>Address</label>
                  <input type="text" class="form-control " placeholder="Street-1" name="address">
                </div>
                <div class="col-sm-6 mb-4">
                  <label></label>
                </div>
                <!-- <div class="col-sm-6 mb-4">    -->
                <!-- <label >         </label> -->
                <!-- <input type = "text" class="form-control " placeholder="Street-2"> -->

                <div class="col-sm-6 mb-4">
                  <input type="text" class="form-control" placeholder="postel-code" name="postal_code">
                </div>


                <div class="col-sm-6 mb-4">
                  <label></label>
                </div>

                <div class="col-sm-6 mb-4">
                  <label>NIC</label>
                  <input type="text" class="form-control" name="nic">
                </div>


                <!-- <div class="col-sm-6 mb-4"> -->
                <!-- <label ></label> -->
                <!-- </div> -->


                <!-- <div class="col-sm-6 mb-4"> -->
                <!-- <label ></label> -->
                <!-- </div> -->

                <div class="col-sm-6 mb-4">
                  <label>Mobile No</label>
                  <input type="text" class="form-control" name="mobile_no" value="" placeholder="enter your registered mobile">
                </div>

                <div class="col-sm-12 mb-4" style=" text-align: right; margin-top: 20px;">
                  <label> </label>
                  <input type="submit" class="btn btn-primary mt-3" name="submit" value="Submit">
                </div>
              </div>
          </div>
          </form>
        </div>
      </div>



    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/c752b78af3.js" crossorigin="anonymous"></script>


  <script>
    $(".sidebar ul li").on('click', function() {
      $(".sidebar ul li.active").removeClass('active');
      $(this).addClass('active');

    })

    $('.open-btn').on('click', function() {
      $('.sidebar').addClass('active');
    })

    $('.close-btn').on('click', function() {
      $('.sidebar').removeClass('active');
    })
  </script>


</body>

</html>