<?php
include_once('../Home-page/config.php');
session_start();
print_r($_SESSION);
// $sql1="SELECT job_order_id,job_order_category,job_order_date,location from job_order ";
// $result=mysqli_query($conn,$sql1);

// if(!$result){

// }else
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
  <link rel="stylesheet" href="CSS/style.css">


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
        <li class="active"><a href="findjob.php" class="text-decoration-none px-3 py-3 d-block">FIND JOB</a></li>
        <li class=""><a href="pending.php" class="text-decoration-none px-3 py-3 d-block">MY WORK</a></li>
        <!-- <li class=""><a href="works.php" class="text-decoration-none px-3 py-3 d-block">YOUR WORKS</a></li> -->
        <li class=""><a href="resheduled.php" class="text-decoration-none px-3 py-3 d-block">RESHEDULED</a></li>
        <li class=""><a href="map.html" class="text-decoration-none px-3 py-3 d-block">VIEW ON MAP</a></li>
        <li class=""><a href="cancel.php" class="text-decoration-none px-3 py-3 d-block">CANCEL JOB</a></li>
        <li class=""><a href="store.php" class="text-decoration-none px-3 py-3 d-block">REWARDS</a></li>
        <li class=""><a href="history.php" class="text-decoration-none px-3 py-3 d-block">HISTORY</a></li>

        <li class=""><a href="updated.php" class="text-decoration-none px-3 py-3 d-block">UPDATE PROFILE</a></li>



      </ul>


    </div>
    <div class="content">

      <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
        <img src="image.png" class="avatar">
        <input type="submit" class="btn btn-secondary default btn  " value="Logout" onclick="window.location.href='../Home-Page/index.html'" name="logout" />
      </nav>


      <div class="dashboard-content ms-5 px-3 pt-4">
        <br><br><br>
        <form method="POST" action="">
          <table class="table table py-4">
            <thead class="text-center">
              <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Job Details</th>
                <th scope="col">Date</th>
                <th scope="col">Location</th>
                <th scope="col"></th>
              </tr>
            </thead>

            <tbody class="text-center">

            <?php

          $empname =$_SESSION['empname'];
        
          $sql2=mysqli_query($conn,"SELECT emp_id from registered_employee where emp_name in('$empname') ");
          $emp_id=mysqli_fetch_array($sql2);
          $empid=$emp_id['emp_id'];
          $_SESSION['emp_id']=$empid;


          $sql1 = "SELECT job_order_id,job_order_category,job_order_date,location from job_order where status like 'Pending'";
          $result = mysqli_query($conn, $sql1);

          if (!$result ) {
              die("Invalid query" . mysqli_error($conn));
          } else {
              while ($row = mysqli_fetch_array($result)) {
                  echo " <tr>";
                  echo " <td> $row[job_order_id] </td>";
                  echo "<td>$row[job_order_category]</td>";
                  echo "<td>$row[job_order_date]</td>";
                  echo "<td>$row[location]</td>";
                  echo "<td>  
                       <form method='post'>
                         <input type='submit' class='btn btn-success' name='accept_" . $row['job_order_id'] . "' value='Accept' id='accept'>
                       </form>
                        </td>";
                  echo " </tr>";

                  if (isset($_POST['accept_' . $row['job_order_id']])) {
                      $accept = "UPDATE job_order set status='Accept', aemp_id='$empid' where job_order_id='" . $row['job_order_id'] . "'";
                      $result1 = mysqli_query($conn, $accept);

                      if ($result1) {
                          $result2 = mysqli_query($conn, "INSERT INTO job_accepted_emp(a_emp_id,a_order_id) VALUES('$empid'," . $row['job_order_id'] . ")");
                          if ($result2) {
                              echo "<script>alert('Job Accepted Successfully');</script>";
                              // header("refresh: 0; http://localhost/Dcsmsv-5.1%20-%20Copy/Employee-Dashboard/findjob.php");
                          }
                      }
       

                    }
              }
            }

              $result8=mysqli_query($conn,"SELECT emp_id from registered_employee where emp_points > 100 order by emp_id limit 10");
              
              $array = array();

                  while ($topempid=mysqli_fetch_assoc($result8)) {
                      $array[] = $topempid;
                  }

                  $column_array = array_column($array, 'emp_id');

                  // print_r($column_array[1]);
                
             for($i =0;$i<2;$i++){
                if($column_array[$i]==$empid){

            
                $result3 = mysqli_query($conn,"SELECT rejected_order_id,category,date,time FROM emp_reject_orders where status like 'pending' ");
                
                if (!$result3 ) {
                  die("Invalid query" . mysqli_error($conn));
                } else {
                  while ($row2 = mysqli_fetch_array($result3)) {
  
                    echo " <tr>";
                    echo " <td> $row2[rejected_order_id] </td>";
                    echo "<td>$row2[category]</td>";
                    echo "<td>$row2[date]</td>";
                    echo "<td>$row2[time]</td>";
                    echo "<td>  
                       <form method='post'>
                    <input type='submit' class='btn btn-success' name='accept1_" . $row2['rejected_order_id'] . "' value='Accept' id='accept1'>
                    </form>
                        </td>";
                    echo " </tr>";
                  
                  
              
                if (isset($_POST['accept1_' . $row2['rejected_order_id'] . ''])) {
                  $accept1 = "UPDATE emp_reject_orders set status='Accept', aemp_id='$empid' where rejected_order_id='" . $row2['rejected_order_id'] . "' ";
                  $result6 = mysqli_query($conn, $accept1);
                  
                  if ($result6){
                    

                  $result7 = mysqli_query($conn, "INSERT INTO job_accepted_emp(a_emp_id,a_order_id)VALUES('$empid'," . $row2['rejected_order_id'] . ")");

                  }
                  if ($result6 && $result7) {
                    echo "<script>alert('Job Accepted Successfully');</script>";
                    header("refresh: 0; http://localhost/Dcsmsv-5.1%20-%20Copy/Employee-Dashboard/findjob.php");
                  }
                }

              }
            }
           }} ?>
            </tbody>
          </table>
        </form>


       


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