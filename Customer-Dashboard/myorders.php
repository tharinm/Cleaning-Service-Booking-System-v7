<?php
session_start();
include_once('../Home-Page/config.php');
ob_start(); // start output buffering

if (isset($_GET['id']))
  $_SESSION['session_id'] = $_GET['id'];
if (isset($_GET['cusid']))
  $_SESSION['cus_id'] = $_GET['cusid'];
if(isset($_GET['oid']))
    $_SESSION['order_id']=$_GET['oid'];

//  print_r($_SESSION);
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" http-equiv=”refresh” content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <!--bootstrap css-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="CSS/ordercancel.css">

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
                    <?php echo "<li class=''><a href='pendingorders.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>PENDING ORDERS</a></li>"; ?>
                    <?php echo "<li class=''><a href='orderstatus.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>ORDER STATUS</a></li>"; ?>
                    <!-- <li class=""><a href="payment.html" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li> -->
                    <?php echo "<li class=''><a href='reshedule.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>RESHEDULE</a></li>"; ?>
                    <?php echo "<li class='active'><a href='myorders.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>MY ORDERS</a></li>" ; ?>
                    <?php echo "<li class=''><a href='complaign.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>COMPLAIN</a></li> " ; ?>
                    <?php echo "<li class=''><a href='updateprofile.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>UPDATE PROFILE</a></li> " ; ?>
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
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
            <?php
                
            $cus_id    = mysqli_real_escape_string($conn, $_SESSION['cus_id']);
            $sql = "SELECT * from job_order where cus_id ='$cus_id' ";
            $result1 = mysqli_query($conn, $sql);

            $points_result=mysqli_query($conn,"SELECT cus_points from customer WHERE cus_id=$cus_id");
            $cuspoints=mysqli_fetch_array($points_result);

            if (!$result1) 
            {
                die("Invalid query" . mysqli_error($conn));
            } else {

                while ($row1 = mysqli_fetch_assoc($result1)) 
                {

                    $result3=mysqli_query($conn,"SELECT order_id,re_status,category,re_date from reshedule where order_id='$row1[job_order_id]' "); 
                    $row2=mysqli_fetch_assoc($result3);
                    // echo $row2['order_id'];
                    if($row1['status']=='Accept' )
                    {   
                    echo   "<tr>";
                    echo "  <td>$row1[job_order_id]</td>";
                    echo "  <td>$row1[job_order_category]</td>";
                    echo "  <td>$row1[job_order_date]</td>";

                    echo "<td>  
                        <form method='post'>
                        
                            <input type='submit' value='Complete' id='complete_button_" . $row1['job_order_id'] . "' name='complete_" . $row1['job_order_id'] . "' class='btn btn-primary btn-sm col-sm-9'>
                        </form>
                        </td>";
                    echo "  </tr>";


                    
                    if (isset($_POST['complete_' . $row1['job_order_id']])) 
                    {
                        $_SESSION['order_id']=$row1['job_order_id'];
                        $sql = mysqli_query($conn, "UPDATE customer SET cus_points= $cuspoints[cus_points]+100 WHERE cus_id='$cus_id'");
                        $sql2 =mysqli_query($conn,"UPDATE job_order SET status='CCompleted' where job_order_id=" . $row1['job_order_id'] . " ");
                        // $sql5=mysqli_query($conn,"UPDATE reshedule SET re_status='completed' where order_id=" . $row1['job_order_id'] . " ");

                        if (!$sql2) 
                        {
                            die("Inavlid query" . mysqli_error($conn));
                        }
                        $result = mysqli_query($conn, "INSERT INTO complete(order_id,c_complete)VALUES (" . $row1['job_order_id'] . ",1)");
                    
                        if ($result) 
                        {
                            
                            // Add this block of code to change the button value
                            echo "<script>
                                document.querySelector('#complete_button_" . $row1['job_order_id'] . "').value = 'Completed!!!';            
                            </script>";
                            echo "<script>alert('Job completed sucussfully')</script>";
                            header("refresh: 0; url=http://localhost/Dcsmsv-5.1%20-%20Copy/Customer-Dashboard/complaign.php");
                            exit; // stop further execution 
                            // ob_end_flush(); // flush output buffer
                        } else {
                            die("invalid qury" . mysqli_error($conn));
                        }                       
                     }    

                  }
                   if(!empty($row2) && $row1['status']=='Accept' && $row2['re_status']=='accept'  )
                   {
                    echo "<tr><td colspan=4 class=''>Reshedule Order-Round 1</td></tr>";
                    echo   "<tr>";
                    echo "  <td>$row2[order_id]</td>";
                    echo "  <td>$row2[category]</td>";
                    echo "  <td>$row2[re_date]</td>";

                    echo "<td>  
                        <form method='post'>
                        
                            <input type='submit' value='Complete' id='complete_button2_" . $row2['order_id'] . "' name='complete2_" . $row2['order_id'] . "' class='btn btn-primary btn-sm col-sm-9'>
                        </form>
                        </td>";
                    echo "  </tr>";
                    
                    if (isset($_POST['complete2_' . $row2['order_id']])) 
                    {
                        $_SESSION['order_id']=$row2['order_id'];
                        $sql = mysqli_query($conn, "UPDATE customer SET cus_points= $cuspoints[cus_points]+100 WHERE cus_id='$cus_id'");
                        $sql6 =mysqli_query($conn,"UPDATE job_order SET status='CCompleted' where job_order_id=" . $row2['order_id'] . " ");
                        $sql5=mysqli_query($conn,"UPDATE reshedule SET re_status='ccompleted' where order_id=" . $row2['order_id'] . " ");

                        if (!$sql5) 
                        {
                            die("Inavlid query" . mysqli_error($conn));
                        }
                        $result4 = mysqli_query($conn, "INSERT INTO complete(order_id,c_complete)VALUES (" . $row2['order_id'] . ",1)");
                    
                        if ($result4) 
                        {
                            
                            // Add this block of code to change the button value
                            echo "<script>
                                document.querySelector('#complete_button_" . $row2['order_id'] . "').value = 'Completed!!!';            
                            </script>";
                            echo "<script>alert('Job completed sucussfully')</script>";
                            header("refresh: 0; url=http://localhost/Dcsmsv-5.1%20-%20Copy/Customer-Dashboard/complaign.php");
                            exit; // stop further execution 
                            // ob_end_flush(); // flush output buffer
                        } else {
                            die("invalid qury" . mysqli_error($conn));
                        } 
                        
                        
                       }
                  }
                }
            }   

            $sql1 = "SELECT rejected_order_id,category,date,time,emp_reject_orders.status
            from emp_reject_orders 
            JOIN job_order ON emp_reject_orders.rejected_order_id=job_order.job_order_id
            where cus_id ='$cus_id'";
            $query2 = mysqli_query($conn, $sql1);
            
            if (!$query2) 
            {
                die("Invalid query" . mysqli_error($conn));
            } else {
                echo "<tr><td colspan=4 class=''>Reshedule Order-(Your Employee Replaced )</td></tr>";
                while ($reject_order = mysqli_fetch_assoc($query2)) 
                {

                    if($reject_order['status']=='Accept')
                    {
                    
                    echo   "<tr>";
                    echo "  <td>$reject_order[rejected_order_id]</td>";
                    echo "  <td>$reject_order[category]</td>";
                    echo "  <td>$reject_order[date]</td>";

                    echo "<td>  
                        <form method='post'>
                        
                            <input type='submit' value='Complete' id='complete1_button_" . $reject_order['rejected_order_id'] . "' name='complete1_" . $reject_order['rejected_order_id'] . "' class='btn btn-primary btn-sm col-sm-9'>
                        </form>
                        </td>";
                    echo "  </tr>";
                
                    if (isset($_POST['complete1_' . $reject_order['rejected_order_id']]))
                    {
                        $_SESSION['order_id']=$reject_order['rejected_order_id'];
                        $sql3 = mysqli_query($conn, "UPDATE customer SET cus_points= $cuspoints[cus_points]+100 WHERE cus_id='$cus_id'");
                        $sql7 =mysqli_query($conn,"UPDATE job_order SET status='CCompleted' where job_order_id=$reject_order[rejected_order_id] ");
                        $sql4 =mysqli_query($conn,"UPDATE emp_reject_orders SET status='CCompleted' where rejected_order_id=$reject_order[rejected_order_id]");
                        if (!$sql4) {
                            die("Inavlid query" . mysqli_error($conn));
                        }
                        $result2 = mysqli_query($conn, "INSERT INTO complete(order_id,c_complete)VALUES (" . $reject_order['rejected_order_id'] . ",1)");
                    
                        if ($result2) {
                            
                            // Add this block of code to change the button value
                            echo "<script>
                                document.querySelector('#complete_button_" . $reject_order['rejected_order_id'] . "').value = 'Completed!!!';            
                            </script>";
                            echo "<script>alert('Job completed sucussfully')</script>";
                            header("refresh: 0; url=http://localhost/Dcsmsv-5.1%20-%20Copy/Customer-Dashboard/complaign.php");
                            exit; // stop further execution 
                            ob_end_flush(); // flush output buffer
                        } else {
                            die("invalid qury" . mysqli_error($conn));
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