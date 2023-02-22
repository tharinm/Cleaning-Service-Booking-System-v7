<?php
session_start();
include_once('../Home-page/config.php');
ob_start(); // start output buffering


if (isset($_GET['id'])) 
  $_SESSION['session_id']= $_GET['id']; 

if (isset($_GET['cusid']))
  $_SESSION['cus_id']= $_GET['cusid'];

//checking the employee who registered by admin
if(!empty($_SESSION['session_id']))
{
  $t_eid = mysqli_real_escape_string($conn, $_SESSION['cus_id']);
  $check = mysqli_query($conn,"SELECT emp_id FROM admin_employee_registration where t_emp_id='$t_eid'");
  $eid=mysqli_fetch_array($check);
  if(!empty($eid['emp_id']) && $eid['emp_id']!=0 ){
    $_SESSION['cus_id']= $eid['emp_id'];
    // echo 4;
  }else{
    $_SESSION['cus_id']=$t_eid;
    // echo 6;
  }
}
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
  <link rel="stylesheet" href="CSS/style.css">

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
        
        <?php echo "<li class='active'><a href='findjob.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>FIND JOB</a></li>"; ?>
        <?php echo "<li class=''><a href='mywork.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>MY WORK</a></li>"; ?>
        <?php echo "<li class=''><a href='resheduled.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>RESHEDULED</a></li>"; ?>
        <?php echo "<li class=''><a href='map.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>VIEW ON MAP</a></li>"; ?>
        <?php echo "<li class=''><a href='cancel.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>CANCEL JOB</a></li>"; ?>
        <?php echo "<li class=''><a href='store.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>REWARDS</a></li>"; ?>
        <?php echo "<li class=''><a href='history.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>HISTORY</a></li>"; ?>
        <?php echo "<li class=''><a href='updated.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>UPDATE PROFILE</a></li>"; ?>

      </ul>


    </div>
    <div class="content">

    <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
      <img src="image.png" class="avatar">
        <form method="POST" action="http://localhost/Dcsmsv-5.1%20-%20Copy/Home-Page/index.html">
          <input type="submit" class="btn btn-secondary default btn" value="Logout" onclick="logOut()" name="logout" />
        </form>
    </nav>


      <div class="dashboard-content ms-5 px-3 pt-4">
        <br><br><br>
        <form method="POST" action="">
           
            <?php
          $empid = mysqli_real_escape_string($conn, $_SESSION['cus_id']);
          $sql1 = "SELECT * from job_order where status = 'Pending' ORDER BY job_order_id DESC ";
          $result = mysqli_query($conn, $sql1);

          if (!$result ) {
              die("Invalid query" . mysqli_error($conn));
          } else {
              while ($row = mysqli_fetch_array($result)) 
              {
                if(!empty($row))
                {
                      echo "<table class='table table py-4'>
                      <thead class='text-center'>
                          <tr>
                            <th scope='col'>Order ID</th>
                            <th scope='col'>Job Details</th>
                            <th scope='col'>Date</th>
                            <th scope='col'>Time</th>
                            <th scope='col'>Location</th>
                          </tr>
                        </thead>
                      <tbody class='text-center'>";
        
                          echo " <tr>";
                          echo " <td> $row[job_order_id] </td>";
                          echo "<td>$row[job_order_category]</td>";
                          echo "<td>$row[job_order_date]</td>";
                          echo "<td>$row[job_order_time]</td>";
                          echo "<td>$row[location]</td>";
                          echo "</tr>";

                    echo " <thead class='text-center'>
                            <tr>
                              <th scope='col'>Work detail</th>
                              <th scope='col'>Special note</th>
                              <th scope='col'>Duration</th>
                              <th scope='col'>Work Photo</th>
                              <th scope='col'></th>
                            </tr>
                          </thead>
        
                    <tbody class='text-center'>";
                          echo "<tr>";
                          echo "<td>$row[work_detail]</td>";
                          echo "<td>$row[special_note]</td>";
                          echo "<td>$row[duration]</td>";
                          echo "<td>
                                <img src='../Customer-Dashboard/workphoto/$row[filename]' width='200' height='150'>
                                </td> ";                     
                          echo "<td>
                              <form method='post'>
                                <input type='submit' class='btn btn-success' name='accept_" . $row['job_order_id'] . "' value='Accept' id='accept'>
                              </form>
                                </td>";
                          echo " </tr>";
                      echo "<tr></tr>";
                      echo "</table>";

                  if (isset($_POST['accept_' . $row['job_order_id']])) {
                      $accept = "UPDATE job_order set status='Accept', aemp_id='$empid' where job_order_id='" . $row['job_order_id'] . "'";
                      $result1 = mysqli_query($conn, $accept);

                      if ($result1) {
                          $result2 = mysqli_query($conn, "INSERT INTO job_accepted_emp(a_emp_id,a_order_id) VALUES('$empid'," . $row['job_order_id'] . ")");
                          if ($result2) {
                              echo "<script>alert('Job Accepted Successfully');</script>";
                              header("refresh: 0; http://localhost/Dcsmsv-5.1%20-%20Copy/Employee-Dashboard/mywork.php");
                          }
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

                  // print_r($column_array);
                
             for($i =0;$i<2;$i++)
             {
              if(!empty($column_array))
              {
                if($column_array[$i]==$empid)
                {

                $result3 = mysqli_query($conn,"SELECT r.rejected_order_id,r.category,r.date,r.time,j.location,
                j.work_detail,j.special_note,j.duration,j.filename
                FROM emp_reject_orders as r
                JOIN job_order as j ON j.job_order_id=r.rejected_order_id
                where r.status like 'pending' ");
                
                if (!$result3 ) 
                {
                  die("Invalid query" . mysqli_error($conn));
                } else {
                  while ($row2 = mysqli_fetch_array($result3)) 
                  {
                    if(!empty($row2))
                    {
                      echo "<table class='table table py-4'>
                      <thead class='text-center'>
                          <tr>
                            <th scope='col'>Order ID</th>
                            <th scope='col'>Job Details</th>
                            <th scope='col'>Date</th>
                            <th scope='col'>Time</th>
                            <th scope='col'>Location</th>
                          </tr>
                        </thead>
                      <tbody class='text-center'>";
        
                          echo " <tr>";
                          echo " <td> $row2[rejected_order_id] </td>";
                          echo "<td>$row2[category]</td>";
                          echo "<td>$row2[date]</td>";
                          echo "<td>$row2[time]</td>";
                          echo "<td>$row2[location]</td>";
                          echo "</tr>";

                    echo " <thead class='text-center'>
                            <tr>
                              <th scope='col'>Work detail</th>
                              <th scope='col'>Special note</th>
                              <th scope='col'>Duration</th>
                              <th scope='col'>Work Photo</th>
                              <th scope='col'></th>
                            </tr>
                          </thead>
        
                    <tbody class='text-center'>";
                          echo "<tr>";
                          echo "<td>$row2[work_detail]</td>";
                          echo "<td>$row2[special_note]</td>";
                          echo "<td>$row2[duration]</td>";
                          echo "<td>
                                <img src='../Customer-Dashboard/workphoto/$row2[filename]' width='200' height='150'>
                                </td> ";                     
                          echo "<td>
                              <form method='post'>
                                <input type='submit' class='btn btn-success' name='accept1_" . $row2['rejected_order_id'] . "' value='Accept' id='accept'>
                              </form>
                                </td>";
                          echo " </tr>";
                      echo "<tr></tr>";
                      echo "</table>";

                        
                      if (isset($_POST['accept1_' . $row2['rejected_order_id']])) 
                      {
                        $accept1 = "UPDATE emp_reject_orders set status='Accept', aemp_id='$empid' where rejected_order_id=$row2[rejected_order_id] ";
                        $accept2 = "UPDATE job_order set status='Accept', aemp_id='$empid' where job_order_id=$row2[rejected_order_id] ";
                        $result6 = mysqli_query($conn, $accept1);

                        if ($result6 ) 
                        {
                          echo "<script>alert('Job Accepted Successfully');</script>";
                          header("refresh: 0; http://localhost/Dcsmsv-5.1%20-%20Copy/Employee-Dashboard/mywork.php");
                          exit; // stop further execution 
                          ob_end_flush(); // flush output buffer
                        }
                        else{
                          die("Invalid query".mysqli_error($conn));
                        }
                      }
                    }
                  }
                }
           }}} ?>
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