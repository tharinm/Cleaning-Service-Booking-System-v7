<?php
session_start();
include_once('../Home-Page/config.php');
ob_start(); // start output buffering


if (isset($_GET['id'])) 
  $_SESSION['session_id']= $_GET['id']; 

if (isset($_GET['cusid']))
  $_SESSION['cus_id']= $_GET['cusid'];

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
    <link rel="stylesheet" href="CSS/pending.css">
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
        	
        <?php echo "<li class=''><a href='findjob.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>FIND JOB</a></li>"; ?>
        <?php echo "<li class='active'><a href='mywork.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>MY WORK</a></li>"; ?>
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
                
                $empid    = mysqli_real_escape_string($conn, $_SESSION['cus_id']);
                $sql = "SELECT * from job_order where aemp_id=$empid ";
                $result1 = mysqli_query($conn, $sql);

                $points_result=mysqli_query($conn,"SELECT emp_points from registered_employee WHERE emp_id=$empid");
                $emppoints=mysqli_fetch_array($points_result);
                 
                if (!$result1) 
                {
                    die("Invalid query" . mysqli_error($conn));
                } else {
    
                    while ($row1 = mysqli_fetch_assoc($result1)) 
                    {
                                               
                      if($row1['status']=='Accept' or $row1['status']=='CCompleted' )
                      {   
                        echo " <table class='table table py-4'>
                        <thead class='text-center'>
                          <tr>
                            <th scope='col'>Order ID</th>
                            <th scope='col''>Job Details</th>
                            <th scope='col'>Date</th>
                            <th scope='col'>Time</th>
                            <th scope='col'>Address</th>
                            <th scope='col'></th>
                          </tr>
                        </thead>
                        <tbody class='text-center'> ";
                        echo   "<tr>";
                        echo "  <td>$row1[job_order_id]</td>";
                        echo "  <td>$row1[job_order_category]</td>";
                        echo "  <td>$row1[job_order_date]</td>";
                        echo "  <td>$row1[job_order_time]</td>";
                        echo "  <td>$row1[job_order_address]</td>";

                        echo "  </tr>";
                        echo " <tr><td class=' text-align-center '>
                      <input type='text' name='start1_" . $row1['job_order_id'] . "' id='time1_" . $row1['job_order_id'] . "'  placeholder='Starttime'  class='mt-3 ms-5' >
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    <input type='submit' class='btn btn-dark btn btn-sm col-sm-12' name='send1_" . $row1['job_order_id'] . "' value='Start' id='accept2'>
                    </td>
                    </tr>
                    <tr>
                    <td class='align-middle'>
                       <input type='text' placeholder='Endtime' name='end1_" . $row1['job_order_id'] . "' id ='time2_" . $row1['job_order_id'] . "'class='mt-3 ms-5  ' >
                    </td>
                    <td>
      
                       <select class='form-select form-select-sm ' aria-label='form-select-lg example' placeholder='Select Work' name='category_name1_" . $row1['job_order_id'] . "' required>
                                       <option selected value='select'>Select Work</option>
                                       <option value='residential'>Residential Cleaning</option>
                                       <option value='green'>Green Cleaning</option>
                                       <option value='outdoor'>Outdoor Cleaning</option>
                                       <option value='special'>Special Event Cleaning</option>
                        </select>
                    </td>
                    <td>
                    <select class='form-select form-select-sm ' aria-label='form-select-lg example' placeholder='About Tools' name='tools1_" . $row1['job_order_id'] . "' required>
                                       <option selected value='with_tools'>with tools</option>
                                       <option value='with_out_tools'>without tools</option>
                    </td>
                    <td>
                    <input type='submit' class='btn btn-dark btn btn-sm col-sm-12' name='send2_" . $row1['job_order_id'] . "' value='End' id='accept3'>
                    </td>
                      </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>  
                            <form method='post'>                            
                                <input type='submit' value='Complete' name='complete_" . $row1['job_order_id'] . "' id='complete_button_" . $row1['job_order_id'] . "' class='btn btn-success btn-sm col-sm-9'>
                            </form>
                      </td>
                    </tr>";
                      
                        if (isset($_POST['complete_' . $row1['job_order_id']])) 
                        {
                          $result2 = mysqli_query($conn, "UPDATE complete set e_complete=1 where order_id=$row1[job_order_id] ");
                          $result3 = mysqli_query($conn, "SELECT * from complete where order_id=$row1[job_order_id]  ");
                          $result4 = mysqli_query($conn,"UPDATE registered_employee SET emp_points=$emppoints[emp_points]+20 where emp_id=$empid ");
                          $result20= mysqli_query($conn,"UPDATE job_order set status='Completed' where job_order_id=$row1[job_order_id]");
                          $complete = mysqli_fetch_assoc($result3);
                          // print_r($row1);

                          if ($complete['c_complete'] == 1 && $complete['e_complete'] == 1) 
                          $result5 = mysqli_query($conn, "INSERT INTO emp_payment(order_id,emp_id) VALUES(" . $row1['job_order_id'] . " ,$empid)");
                          
                           if(!$result5){
                              die("invalid".mysqli_error($conn));
                          }
                    
                          if ($result2 || $result3 || $result4 || $result5) {
                          echo "<script>alert('Job completed sucussfully');</script>";
                          header("refresh: 0; url=http://localhost/Dcsmsv-5.1%20-%20Copy/Employee-Dashboard/mywork.php");
                          } else {
                              die("invalid qury" . mysqli_error($conn));
                          }                      
                        }
                                               
                        if (isset($_POST['send1_' . $row1['job_order_id']]))
                        {
                          $start = $_POST['start1_' . $row1['job_order_id'] . ''];     
                          $sql4 = "INSERT INTO time(order_id,start_time)VALUES ('$row1[job_order_id]','$start')";
                          $result4=mysqli_query($conn, $sql4);
                        }
             
                        if (isset($_POST['send2_' . $row1['job_order_id']]))
                        {
                          $end   = $_POST['end1_' . $row1['job_order_id'] . ''];
                          $type  = $_POST['category_name1_' . $row1['job_order_id'] . ''];
                          $tools = $_POST['tools1_' . $row1['job_order_id'] . ''];

                          $sql5 = "UPDATE  time set end_time = '$end' where order_id='$row1[job_order_id]' ";
                          $result8=mysqli_query($conn, $sql5);

                          $starttime = mysqli_query($conn, "SELECT start_time from time where order_id='$row1[job_order_id]'");
                          $result9 = mysqli_fetch_assoc($starttime);
                          // echo $result9['start_time'];
                          $start1 = $result9['start_time'];
                     
                          $a = new DateTime($end);
                          $b = new DateTime($start1);
                          $timediff = $b->diff($a);
                            //echo $timediff->format(' %h hour %i minute %s second')."<br/>";
                          $r = $timediff->format(' %h ') ;
                          $z = (int) $r;
                            //$z= strtotime($r);
                          // echo $r;
                          if($tools=="with_tools")
                          {
                            if($type=="residential")
                            {
                              $d=600 * $z -500 +500;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row1[job_order_id]','$d')";
                              $result10 = mysqli_query($conn, $sql1);
                            }

                            else if($type=="green")
                            {
                              $d=800* $z-500 +500;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row1[job_order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="outdoor")
                            {
                              $d=700 * $z-500 +500;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row1[job_order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="special")
                            {
                              $d=500 * $z-500 +500;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row1[job_order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                          }else{
                            if($type=="residential")
                            {                        
                              $d=600 * $z -500 ;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";                           
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row1[job_order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="green")
                            {
                              $d=800* $z-500 ;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row1[job_order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="outdoor")
                            {
                              $d=700 * $z-500 ;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row1[job_order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="special")
                            {
                              $d=500 * $z-500 ;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row1[job_order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                          }
                        }
                    }          
                }
            }
       
            $result6=mysqli_query($conn,"SELECT * from reshedule where aemp_id=$empid "); 
            if(!$result6)
            {
                die("invalid query".mysqli_error($conn));
            }else{
                while($row2=mysqli_fetch_assoc($result6))
                {
                  if(!empty($row2) &&  $row2['re_status']=='accept' or $row2['re_status']=='ccompleted' )
                  {
                    $result7=mysqli_query($conn,"SELECT * from job_order where job_order_id='$row2[order_id]' ");
                    $job_add= mysqli_fetch_assoc($result7);
           
                      echo " <table class='table table py-4'>";
                      echo "";
                      echo "  <thead class='text-center'>
                        <tr>
                          <th colspan='6'>Reshedule Order-Round 1</th>
                        </tr>
                          <tr>
                            <th scope='col'>Order ID</th>
                            <th scope='col''>Job Details</th>
                            <th scope='col'>Date</th>
                            <th scope='col'>Time</th>
                            <th scope='col'>Address</th>
                            <th scope='col'></th>
                          </tr>
                        </thead>
                        <tbody class='text-center'>  ";
                      echo   "<tr>";
                      echo "  <td>$row2[order_id]</td>";
                      echo "  <td>$row2[category]</td>";
                      echo "  <td>$row2[re_date]</td>";
                      echo "  <td>$row2[re_time]</td>";
                      echo "  <td>$job_add[job_order_address]</td>";
                     
                      echo " <tr>
                              <td class=' text-align-center '>
                                <input type='text' name='start2_" . $row2['order_id'] . "' id='time11_" . $row2['order_id'] . "' placeholder='Starttime' class='mt-3 ms-5' >
                              </td>
                              <td>
                              </td>
                              <td>
                              </td>
                              <td>
                              <input type='submit' class='btn btn-dark btn btn-sm col-sm-12' name='send11_" . $row2['order_id'] . "' value='Start' id='accept2'>
                              </td>
                              </tr>
                              <tr>
                              <td class='align-middle'>
                                <input type='text' name='end2_" . $row2['order_id'] . "' id='time22_" . $row2['order_id'] . "' placeholder='Endtime'  class='mt-3 ms-5  ' >
                              </td>
                      <td>
                        <select class='form-select form-select-sm ' aria-label='form-select-lg example' placeholder='Select Work' name='category_name2_" . $row2['order_id'] . "' required>
                                       <option selected value='select'>Select Work</option>
                                       <option value='residential'>Residential Cleaning</option>
                                       <option value='green'>Green Cleaning</option>
                                       <option value='outdoor'>Outdoor Cleaning</option>
                                       <option value='special'>Special Event Cleaning</option>
                        </select>
                      </td>
                      <td>
                        <select class='form-select form-select-sm ' aria-label='form-select-lg example' placeholder='About Tools' name='tools2_" . $row2['order_id'] . "' required>
                                       <option selected value='with_tools'>with tools</option>
                                       <option value='with_out_tools'>without tools</option>
                      </td>
                      <td>
                        <input type='submit' class='btn btn-dark btn btn-sm col-sm-12' name='send22_" . $row2['order_id'] . "' value='End' id='accept3'>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>  
                            <form method='post'>                            
                                <input type='submit' value='Complete'  name='complete2_" . $row2['order_id'] . "' id='complete_button_" . $row2['order_id'] . "' class='btn btn-success btn-sm col-sm-9'>
                            </form>
                      </td>
                    </tr>";
                      
                      if (isset($_POST['complete2_' . $row2['order_id']])) 
                      {
                        $result8 = mysqli_query($conn, "UPDATE complete set e_complete=1 where order_id=$row2[order_id] ");
                        $result9 = mysqli_query($conn, "SELECT * from complete where order_id=$row2[order_id]");
                        $result10 = mysqli_query($conn,"UPDATE registered_employee SET emp_points=$emppoints[emp_points]+20 where emp_id='$empid' ");
                        $result21= mysqli_query($conn,"UPDATE job_order set status='Completed' where job_order_id=$row2[order_id]");
                        $result22= mysqli_query($conn,"UPDATE reshedule set re_status='completed' where order_id=$row2[order_id]");

                        $complete1 = mysqli_fetch_assoc($result9);

                        if(empty($complete1))
                        echo "<script>alert('please wait little time for customer's complete...');</script>";

                         if (!empty($complete1) && $complete1['c_complete'] == 1 && $complete1['e_complete'] == 1) 
                          $result11 = mysqli_query($conn, "INSERT INTO emp_payment(order_id,emp_id) VALUES(" . $row2['order_id'] . " ,$empid)");
                        
                         if(!$result11){
                            die("invalid query".mysqli_error($conn));
                          }
                  
                          if ($result8 || $result9 || $result10 || $result11 || $result21 || $result22) {
                            echo "<script>alert('Job completed sucussfully');</script>";
                            header("refresh: 0; url=http://localhost/Dcsmsv-5.1%20-%20Copy/Employee-Dashboard/mywork.php");
                          } else {
                            die("invalid query" . mysqli_error($conn));
                          }
                      }

                      if (isset($_POST['send11_' . $row2['order_id']]))
                        {
                          $start = $_POST['start2_' . $row2['order_id'] . ''];     
                          $sql4 = "INSERT INTO time(order_id,start_time)VALUES ('$row2[order_id]','$start')";
                          $result4=mysqli_query($conn, $sql4);
                        }
             
                        if (isset($_POST['send22_' . $row2['order_id']]))
                        {
                          $end   = $_POST['end2_' . $row2['order_id'] . ''];
                          $type  = $_POST['category_name2_' . $row2['order_id'] . ''];
                          $tools = $_POST['tools2_' . $row2['order_id'] . ''];

                          $sql5 = "UPDATE  time set end_time = '$end' where order_id='$row2[order_id]' ";
                          $result8=mysqli_query($conn, $sql5);

                          $starttime = mysqli_query($conn, "SELECT start_time from time where order_id='$row2[order_id]'");
                          $result9 = mysqli_fetch_assoc($starttime);
                          // echo $result9['start_time'];
                          $start1 = $result9['start_time'];
                     
                          $a = new DateTime($end);
                          $b = new DateTime($start1);
                          $timediff = $b->diff($a);
                            //echo $timediff->format(' %h hour %i minute %s second')."<br/>";
                          $r = $timediff->format(' %h ') ;
                          $z = (int) $r;
                            //$z= strtotime($r);
                          // echo $r;
                          if($tools=="with_tools")
                          {
                            if($type=="residential")
                            {
                              $d=600 * $z -500 +500;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row2[order_id]','$d')";
                              $result10 = mysqli_query($conn, $sql1);
                            }

                            else if($type=="green")
                            {
                              $d=800* $z-500 +500;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row2[order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="outdoor")
                            {
                              $d=700 * $z-500 +500;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row2[order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="special")
                            {
                              $d=500 * $z-500 +500;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row2[order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                          }else{
                            if($type=="residential")
                            {                        
                              $d=600 * $z -500 ;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";                           
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row2[order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="green")
                            {
                              $d=800* $z-500 ;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row2[order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="outdoor")
                            {
                              $d=700 * $z-500 ;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row2[order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="special")
                            {
                              $d=500 * $z-500 ;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES ('$row2[order_id]','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                          }
                        }
                    }          
                }
            }
                                      
                $sql1 = "SELECT rejected_order_id,category,date,time,emp_reject_orders.status
                from emp_reject_orders 
                JOIN job_order ON emp_reject_orders.rejected_order_id=job_order.job_order_id
                where emp_reject_orders.aemp_id=$empid";
                $query1 = mysqli_query($conn, $sql1);
                
                if (!$query1) 
                {
                    die("Invalid query" . mysqli_error($conn));
                } else {
                     
                    while ($reject_order = mysqli_fetch_assoc($query1)) 
                    {
                        if(!empty($reject_order) && $reject_order['status']=='Accept' or $reject_order['status']=='CCompleted')
                        {
                          $query2=mysqli_query($conn,"SELECT * from job_order where job_order_id='$reject_order[rejected_order_id]' ");
                          $job_add2= mysqli_fetch_assoc($query2);
                          
                          echo " <table class='table table py-4'>";
                          echo "";
                          echo "  <thead class='text-center'>
                            <tr>
                              <th colspan='6'>Reshedule Order-New Order Recieved</th>
                            </tr>
                              <tr>
                                <th scope='col'>Order ID</th>
                                <th scope='col''>Job Details</th>
                                <th scope='col'>Date</th>
                                <th scope='col'>Time</th>
                                <th scope='col'>Address</th>
                                <th scope='col'></th>
                              </tr>
                            </thead>
                            <tbody class='text-center'>  ";
                          echo   "<tr>";
                          echo "  <td>$reject_order[rejected_order_id]</td>";
                          echo "  <td>$reject_order[category]</td>";
                          echo "  <td>$reject_order[date]</td>";
                          echo "  <td>$reject_order[time]</td>";
                          echo "  <td>$job_add2[job_order_address]</td>";
                         
                          echo " <tr>
                                  <td class=' text-align-center '>
                                    <input type='text' name='start3_" . $reject_order['rejected_order_id'] . "' id='time11_" . $reject_order['rejected_order_id'] . "' placeholder='Starttime' class='mt-3 ms-5' >
                                  </td>
                                  <td>
                                  </td>
                                  <td>
                                  </td>
                                  <td>
                                  <input type='submit' class='btn btn-dark btn btn-sm col-sm-12' name='send111_" . $reject_order['rejected_order_id'] . "' value='Start' id='accept2'>
                                  </td>
                                  </tr>
                                  <tr>
                                  <td class='align-middle'>
                                    <input type='text' name='end3_" . $reject_order['rejected_order_id'] . "' id='time22_" . $reject_order['rejected_order_id'] . "' placeholder='Endtime'  class='mt-3 ms-5  ' >
                                  </td>
                          <td>
                            <select class='form-select form-select-sm ' aria-label='form-select-lg example' placeholder='Select Work' name='category_name3_" . $reject_order['rejected_order_id'] . "' required>
                                           <option selected value='select'>Select Work</option>
                                           <option value='residential'>Residential Cleaning</option>
                                           <option value='green'>Green Cleaning</option>
                                           <option value='outdoor'>Outdoor Cleaning</option>
                                           <option value='special'>Special Event Cleaning</option>
                            </select>
                          </td>
                          <td>
                            <select class='form-select form-select-sm ' aria-label='form-select-lg example' placeholder='About Tools' name='tools3_" . $reject_order['rejected_order_id'] . "' required>
                                           <option selected value='with_tools'>with tools</option>
                                           <option value='with_out_tools'>without tools</option>
                          </td>
                          <td>
                            <input type='submit' class='btn btn-dark btn btn-sm col-sm-12' name='send222_" . $reject_order['rejected_order_id'] . "' value='End' id='accept3'>
                          </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>  
                                <form method='post'>                            
                                    <input type='submit' value='Complete'  name='complete1_" . $reject_order['rejected_order_id'] . "' id='complete_button_" . $reject_order['rejected_order_id'] . "' class='btn btn-success btn-sm col-sm-9'>
                                </form>
                          </td>
                        </tr>";
                    
                        if (isset($_POST['complete1_' . $reject_order['rejected_order_id']]))
                        {
                          $result12 = mysqli_query($conn, "UPDATE complete set e_complete=1 where order_id=$reject_order[rejected_order_id] ");
                          $result13 = mysqli_query($conn, "SELECT * from complete where order_id=$reject_order[rejected_order_id]");
                          $result14 = mysqli_query($conn,"UPDATE registered_employee SET emp_points=$emppoints[emp_points]+20 where emp_id='$empid' ");
                          $result15= mysqli_query($conn,"UPDATE job_order set status='Completed' where job_order_id=$reject_order[rejected_order_id]");
                          $result16= mysqli_query($conn,"UPDATE emp_reject_orders set status='Completed' where rejected_order_id=$reject_order[rejected_order_id]");
                          $result18= mysqli_query($conn,"UPDATE reshedule set re_status='completed' where order_id=$reject_order[rejected_order_id]");
  
                          $complete2 = mysqli_fetch_assoc($result13);
  
                          if(empty($complete2))
                          echo "<script>alert('please wait little time for customer's complete...');</script>";
  
                           if (!empty($complete2) && $complete2['c_complete'] == 1 && $complete2['e_complete'] == 1) 
                            $result17 = mysqli_query($conn, "INSERT INTO emp_payment(order_id,emp_id) VALUES(" . $reject_order['rejected_order_id'] . " ,$empid)");
                          
                           if(!$result17){
                              die("invalid query".mysqli_error($conn));
                            }
                    
                            if ($result12 || $result13 || $result14 || $result17 || $result15 || $result16) {
                              echo "<script>alert('Job completed sucussfully');</script>";
                              header("refresh: 0; url=http://localhost/Dcsmsv-5.1%20-%20Copy/Employee-Dashboard/mywork.php");
                              exit; // stop further execution 
                              ob_end_flush(); // flush output buffer
                            } else {
                              die("invalid query" . mysqli_error($conn));
                            }      
                        }                                                       
                        if (isset($_POST['send111_' . $reject_order['rejected_order_id']]))
                        {
                          $start = $_POST['start3_' . $reject_order['rejected_order_id'] . ''];     
                          $sql4 = "INSERT INTO time(order_id,start_time)VALUES (" . $reject_order['rejected_order_id'] . " ,'$start')";
                          $result4=mysqli_query($conn, $sql4);
                        }
             
                        if (isset($_POST['send222_' . $reject_order['rejected_order_id']]))
                        {
                          $end   = $_POST['end3_' . $reject_order['rejected_order_id'] . ''];
                          $type  = $_POST['category_name3_' . $reject_order['rejected_order_id'] . ''];
                          $tools = $_POST['tools3_' . $reject_order['rejected_order_id'] . ''];

                          $sql5 = "UPDATE  time set end_time = '$end' where order_id=" . $reject_order['rejected_order_id'] . " ";
                          $result8=mysqli_query($conn, $sql5);

                          $starttime = mysqli_query($conn, "SELECT start_time from time where order_id=" . $reject_order['rejected_order_id'] . " ");
                          $result9 = mysqli_fetch_assoc($starttime);
                          // echo $result9['start_time'];
                          $start1 = $result9['start_time'];
                     
                          $a = new DateTime($end);
                          $b = new DateTime($start1);
                          $timediff = $b->diff($a);
                            //echo $timediff->format(' %h hour %i minute %s second')."<br/>";
                          $r = $timediff->format(' %h ') ;
                          $z = (int) $r;
                            //$z= strtotime($r);
                          // echo $r;
                          if($tools=="with_tools")
                          {
                            if($type=="residential")
                            {
                              $d=600 * $z -500 +500;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES (" . $reject_order['rejected_order_id'] . ",'$d')";
                              $result10 = mysqli_query($conn, $sql1);
                            }

                            else if($type=="green")
                            {
                              $d=800* $z-500 +500;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES (" . $reject_order['rejected_order_id'] . ",'$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="outdoor")
                            {
                              $d=700 * $z-500 +500;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES (" . $reject_order['rejected_order_id'] . ",'$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="special")
                            {
                              $d=500 * $z-500 +500;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES (" . $reject_order['rejected_order_id'] . ",'$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                          }else{
                            if($type=="residential")
                            {                        
                              $d=600 * $z -500 ;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";                           
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES (" . $reject_order['rejected_order_id'] . ",'$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="green")
                            {
                              $d=800* $z-500 ;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES (" . $reject_order['rejected_order_id'] . "','$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="outdoor")
                            {
                              $d=700 * $z-500 ;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES (" . $reject_order['rejected_order_id'] . ",'$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                            else if($type=="special")
                            {
                              $d=500 * $z-500 ;
                              echo "<h2 class='error' align='center'>Your Balance is  $d</h2>";
                              $sql1 = "INSERT INTO price (order_id,amount)VALUES (" . $reject_order['rejected_order_id'] . ",'$d')";
                              $result10=mysqli_query($conn, $sql1);
                            }
                          }
                        }
                    }          
                }
            }     
         ?>
             
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