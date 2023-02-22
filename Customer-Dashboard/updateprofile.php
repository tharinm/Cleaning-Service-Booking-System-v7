<?php
session_start();
include('../Home-page/config.php');
include('updateprofilevalidate.php');

if (isset($_GET['id'])) 
  $_SESSION['session_id']= $_GET['id']; 

if (isset($_GET['cusid']))
  $_SESSION['cus_id']= $_GET['cusid'];

if (isset($_GET['oid'])){
  $_SESSION['order_id']=$_GET['oid'];
}else{
  $cus_id = mysqli_real_escape_string($conn, $_SESSION['cus_id']);
    $result3=mysqli_query($conn,"SELECT job_order_id from job_order where cus_id ='$cus_id' order by job_order_id desc limit 1");
    $row3=mysqli_fetch_assoc($result3);

    if(!empty($row3['job_order_id']))
      $_SESSION['order_id'] = $row3['job_order_id'];
    else 
      $_SESSION['order_id']=0;
}
$cus_id = mysqli_real_escape_string($conn, $_SESSION['cus_id']);


if (isset($_SESSION['session_id'])) 
{
  $session_id = mysqli_real_escape_string($conn, $_SESSION['session_id']);
  if ($stmt = mysqli_prepare($conn, "SELECT sessions.session_id AS session_id, sessions.user_id AS user_id, sessions.username AS username, customer.cus_id AS cus_id
      FROM sessions 
      JOIN customer ON customer.user_name= sessions.username
      WHERE sessions.session_id = ? LIMIT 1")) {
      mysqli_stmt_bind_param($stmt, "i", $session_id);
      if (mysqli_stmt_execute($stmt)) {
          $result = mysqli_stmt_get_result($stmt);
          if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                  // echo "Session ID: " . $row['session_id'] . " User ID: " . $row['user_id'] . " User name: " . $row['username'] . " Cus ID: " . $row['cus_id'] . "<br>";
                  // $_SESSION['cus_id']=$row['cus_id'];
              }
          } else {
              echo "No data found";
          }
          mysqli_free_result($result);
      } else {
          echo "Error: " . mysqli_stmt_error($stmt);
      }
      mysqli_stmt_close($stmt);
  } else {
      echo "Error: " . mysqli_error($conn);
  }
}


if (isset($_POST['submit'])) 
{
  if ($firstnameErr == "" && $lastnameErr == "" && $addressErr == "" && $postalcodeErr == "" && $nicErr == "" && $mobileErr == "")
  {

      $firstname = mysqli_real_escape_string($conn, $_POST['first']);
      $lastname  = mysqli_real_escape_string($conn, $_POST['last']);
      $address = mysqli_real_escape_string($conn, $_POST['address']);
      $postalcode = mysqli_real_escape_string($conn, $_POST['postal_code']);
      $nic = mysqli_real_escape_string($conn, $_POST['nic']);
      $mobile = mysqli_real_escape_string($conn, $_POST['mobile_no']);
      // $cus_id = mysqli_real_escape_string($conn, $_SESSION['cus_id']);
      
      $sql1 = "UPDATE customer SET first_name='$firstname',last_name='$lastname',address='$address',nic='$nic',postal_code=$postalcode WHERE cus_id=$cus_id ";
      $results = mysqli_query($conn, $sql1);

      if (!$results) {
        die("Invalid query" . mysqli_error($conn));
      } else {
        echo "<script> alert('account updated sucessfully!');</script>";
        header("refresh: 0; http://localhost/Dcsmsv-5.1%20-%20Copy/Customer-Dashboard/postjob.php");
      }

  }else{
    echo "<h3 class='error' align='center'>Your Account isn't Updated!!! please fill the details correctly....!!!!</h3>";
  }  
}
print_r($_SESSION);
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

  .error {
            color: #FF0001;
        }


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
       <?php echo "<li class=''><a href='postjob.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>POST JOB</a></li>"; ?>
       <?php echo "<li class=''><a href='pendingorders.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>PENDING ORDERS</a></li>"; ?>
       <?php echo "<li class=''><a href='orderstatus.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>ORDER STATUS</a></li>"; ?>
        <!-- <li class=""><a href="payment.html" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li> -->
       <?php echo "<li class=''><a href='reshedule.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>RESHEDULE</a></li>" ; ?>
       <?php echo "<li class=''><a href='myorders.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>MY ORDERS</a></li>" ; ?> 
       <?php echo " <li class=''><a href='complaign.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>COMPLAIN</a></li> "; ?>
       <?php echo "<li class= 'active'><a href='updateprofile.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>UPDATE PROFILE</a></li> " ; ?>
       <?php echo "<li class=''><a href='store.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>REWARDS</a></li>" ; ?>
       <?php echo "<li class=''><a href='help.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>HELP</a></li>" ; ?>

      </ul>

    </div>
    <div class="content">
      <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
        <img src="image.png" class="avatar">
        <form method="POST" action="http://localhost/Dcsmsv-5.1%20-%20Copy/Home-Page/index.html">
                       <input type="submit" class="btn btn-secondary default btn" value="Logout" onclick="logOut()" name="logout" />
        </form>
      </nav>



      <div class="dashboard-content ms-5 px-3 pt-4 ">
        <div class="container ">
          <div class="row no-gutters">
            <form name="myform" class="form-group" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
              <div class="row jumbotron">
                <div class="col-sm-6 mb-4">
                  <label>First Name</label>
                  <input type="text" class="form-control " name="first">
                  <span class="error">* <?php echo $firstnameErr; ?> </span>
                  <br><br>
                </div>


                <div class="col-sm-6 mb-4">
                  <label>Last Name</label>
                  <input type="text" class="form-control " name="last">
                  <span class="error">* <?php echo $lastnameErr; ?> </span>
                  <br><br>
                </div>

                <div class="col-sm-6 mb-4">
                  <label>Address</label>
                  <input type="text" class="form-control " placeholder="Street-1" name="address">
                  <span class="error">* <?php echo $addressErr; ?> </span>
                  <br><br>
                </div>
                <div class="col-sm-6 mb-4">
                  <label></label>
                </div>
                <!-- <div class="col-sm-6 mb-4">    -->
                <!-- <label >         </label> -->
                <!-- <input type = "text" class="form-control " placeholder="Street-2"> -->

                <div class="col-sm-6 mb-4">
                  <input type="text" class="form-control" placeholder="postel-code" name="postal_code">
                  <span class="error">* <?php echo $postalcodeErr; ?> </span>
                  <br><br>
                </div>


                <div class="col-sm-6 mb-4">
                  <label></label>
                </div>

                <div class="col-sm-6 mb-4">
                  <label>NIC</label>
                  <input type="text" class="form-control" name="nic">
                  <span class="error">* <?php echo $nicErr; ?> </span>
                  <br><br>
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
                  <span class="error">* <?php echo $mobileErr; ?> </span>
                  <br><br>
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
  <script>

      function logOut() {
          // Send an HTTP POST request to the logout.php script
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'logout.php');
          xhr.send();

          console.log('Redirecting to index.html');
          window.location.href='../Home-Page/index.html';
      }

  </script>


</body>

</html>