<?php
session_start();
include_once('../Home-page/config.php');
ob_start(); // start output buffering

if (isset($_GET['id']))
    $_SESSION['session_id']= $_GET['id']; 
if (isset($_GET['cusid']))
    $_SESSION['cus_id']= $_GET['cusid'];
 if (isset($_GET['oid']))
    $_SESSION['order_id'] = $_GET['oid']; 
 
// print_r($_SESSION);

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
  <link rel="stylesheet" href="CSS/orderstatus.css">

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
        <?php echo "<li class=''><a href='postjob.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>POST JOB</a></li>"; ?>
        <?php echo "<li class='active'><a href='pendingorders.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>PENDING ORDERS</a></li>"; ?>
        <?php echo "<li class=''><a href='orderstatus.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>ORDER STATUS</a></li>"; ?>
        <!-- <li class=""><a href="payment.php" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li> -->
        <?php echo "<li class=''><a href='reshedule.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>RESHEDULE</a></li>"; ?>
        <?php echo "<li class=''><a href='myorders.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>MY ORDERS</a></li>"; ?>
        <?php echo "<li class=''><a href='complaign.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>COMPLAIN</a></li>"; ?>
        <?php echo "<li class=''><a href='updateprofile.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>UPDATE PROFILE</a></li>"; ?>
        <?php echo "<li class=''><a href='store.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>REWARDS</a></li>"; ?>
        <?php echo "<li class=''><a href='help.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>HELP</a></li>"; ?>

      </ul>


    </div>
    <div class="content">

      <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
        <img src="image.png" class="avatar">
        <form method="POST" action="http://localhost/Dcsmsv-5.1%20-%20Copy/Home-Page/index.html">
            <input type="submit" class="btn btn-secondary default btn" value="Logout" onclick="logOut()" name="logout" />
        </form>

      </nav>

      <div class="registeremp ms-5 px-3 pt-4">
            
                    <form method="POST" action="">
                        <table class="table table py-4 text-center">
                            <div class="col-md-4 mb-4">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Job Details</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
<?php      
        $cus_id = mysqli_real_escape_string($conn, $_SESSION['cus_id']);
        $order_id = mysqli_real_escape_string($conn, $_SESSION['order_id']);
        $result = mysqli_query($conn, "SELECT job_order_id, job_order_category, job_order_date, status from job_order where cus_id='$cus_id'");

        if (!$result)
        {
            die("Invalid query" . mysqli_error($conn));
        } else {
              echo "<h4>General Orders</h4>";
              while ($row1 = mysqli_fetch_assoc($result)) 
              {
                if ($row1['status'] == 'Accept' || $row1['status'] == 'Pending') 
                {
                    echo "<tr>";
                    echo "<td>$row1[job_order_id]</td>";
                    echo "<td>$row1[job_order_category]</td>";
                    echo "<td>$row1[job_order_date]</td>";
                    echo "<td>$row1[status]</td>";
                   
                    echo "<td>
                            <form method='post'>
                                <input type='submit' value='Check' id='check_button_" . $row1['job_order_id'] . "' name='check_" . $row1['job_order_id'] . "' class='btn btn-primary btn-sm col-sm-9'>
                            </form>
                        </td>";
                    echo "</tr>";

                    if (isset($_POST['check_' . $row1['job_order_id']])) {
                        $_SESSION['order_id'] = $row1['job_order_id'];
                        header("refresh: 0; http://localhost/Dcsmsv-5.1%20-%20Copy/Customer-Dashboard/orderstatus.php");
                        exit; // stop further execution    
                                       
                    }else{
                        $cus_id = mysqli_real_escape_string($conn, $_SESSION['cus_id']);
                        $result3=mysqli_query($conn,"SELECT job_order_id from job_order where cus_id ='$cus_id' order by job_order_id desc limit 1");
                        $row3=mysqli_fetch_assoc($result3);
                       
                        if(!$result3)
                            die("invalid".mysqli_error($conn));
                        else
                            $_SESSION['order_id'] = $row3['job_order_id'];
                    }
                }
             }
           } ?>
           </tbody>
           </table>
       </form>

    </div>

    <div class="registeremp ms-5 px-3 pt-4">
            
                    <form method="POST" action="">
                        <table class="table table py-4 text-center">
                            <div class="col-md-4 mb-4">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Job Details</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">1st Status</th>
                                        <th scope="col">2nd Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
           <?php
          $result1 = mysqli_query($conn,"SELECT reshedule.order_id,reshedule.category,reshedule.re_date,reshedule.re_time,reshedule.re_status 
                  from reshedule 
                  JOIN job_order ON reshedule.order_id=job_order_id
                  where cus_id='$cus_id' ");
          if(!$result1){
            die("invalid query".mysqli_error($conn));
          }else{
              echo "<tr><h4>Reshedule Orders</h4></tr>";
              while ($row2 = mysqli_fetch_assoc($result1)) 
              {
                if ($row2['re_status'] != 'completed' ) 
                {
                    echo "<tr>";
                    echo "<td>$row2[order_id]</td>";
                    echo "<td>$row2[category]</td>";
                    echo "<td>$row2[re_date]</td>";
                    echo "<td>$row2[re_status]</td>";
                    if( !empty($row2['re_status']) && $row2['re_status']=='rejected'){
                          $sql1=mysqli_query($conn,"SELECT status from emp_reject_orders where 	rejected_order_id=$row2[order_id]");
                          $re_status=mysqli_fetch_assoc($sql1);
                          if(!empty($re_status))
                          echo "<td>$re_status[status]</td>";
                    }else{
                            echo "<td></td>";
                    }
                    echo "<td>
                            <form method='post'>
                                <input type='submit' value='Check' id='check_button_" . $row2['order_id'] . "' name='check1_" . $row2['order_id'] . "' class='btn btn-primary btn-sm col-sm-9'>
                            </form>
                        </td>";
                    echo "</tr>";

                    if (isset($_POST['check1_' . $row2['order_id']])) {
                        $_SESSION['order_id'] = $row2['order_id'];

                        header("refresh: 0; http://localhost/Dcsmsv-5.1%20-%20Copy/Customer-Dashboard/reshedule.php");
                        exit; // stop further execution 
                    }}}
          }


        ob_end_flush(); // flush output buffer
        
  ?>

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