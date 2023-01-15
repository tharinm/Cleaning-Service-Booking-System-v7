<?php
session_start();
include_once('../Home-Page/config.php');
error_reporting(E_ALL);
 print_r($_SESSION);
 $cusid=$_SESSION['cus_id'];
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
                    <li class=""><a href="postjob.php" class="text-decoration-none px-3 py-3 d-block">POST JOB</a></li>
                    <li class=""><a href="orderstatus.php" class="text-decoration-none px-3 py-3 d-block">ORDER STATUS</a></li>
                    <!-- <li class=""><a href="payment.html" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li> -->
                    <li class=""><a href="reshedule.php" class="text-decoration-none px-3 py-3 d-block">RESHEDULE</a></li>
                    <li class="active"><a href="myorders.php" class="text-decoration-none px-3 py-3 d-block">MY ORDERS</a></li>
                    <li class=""><a href="complaign.php" class="text-decoration-none px-3 py-3 d-block">COMPLAIN</a></li>
                    <li class=""><a href="updateprofile.php" class="text-decoration-none px-3 py-3 d-block">UPDATE PROFILE</a></li>
                    <li class=""><a href="store.php" class="text-decoration-none px-3 py-3 d-block">REWARDS</a></li>
                    <li class=""><a href="help.html" class="text-decoration-none px-3 py-3 d-block">HELP</a></li>

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
                $sql = "SELECT job_order_id,job_order_category,job_order_date,status from job_order where cus_id ='$cusid'";
                $result1 = mysqli_query($conn, $sql);
                
                if (!$result1) {
                    die("Invalid query" . mysqli_error($conn));
                } else {

                while ($row1 = mysqli_fetch_assoc($result1)) {

                    if($row1['status']=='Accept'){
                        
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
                    
                    if (isset($_POST['complete_' . $row1['job_order_id']])) {
                        
                        $sql = mysqli_query($conn, "UPDATE customer SET cus_points= 100 WHERE cus_id='$cusid'");
                        $sql2 =mysqli_query($conn,"UPDATE job_order SET status='Completed' where job_order_id=" . $row1['job_order_id'] . " ");
                        if (!$sql2) {
                            die("Inavlid query" . mysqli_error($conn));
                        }
                        $result = mysqli_query($conn, "INSERT INTO complete(order_id,c_complete)VALUES (" . $row1['job_order_id'] . ",1)");
                    
                        if ($result) {
                            echo "<script>alert('Job completed sucussfully')</script>";
                            // Add this block of code to change the button value
                            echo "<script>
                                document.querySelector('#complete_button_" . $row1['job_order_id'] . "').value = 'Completed!!!';
                                header('refresh: 0; url=http://localhost/Dcsmsv-5.1%20-%20Copy/Customer-Dashboard/complaign.php');
                            </script>";
                             
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

                    <!-- <a href="http://localhost/DCSMS-v1/Customer-Dashboard/complaign.php"><input type="submit" value="Complete" class="btn btn-primary btn-sm col-sm-9"></a> -->
                    <!-- <a href="../Customer-Dashboard/Payment/payment.php"><input type="submit" value="Accept" class="btn btn-primary btn-sm col-sm-9"></a>       -->


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