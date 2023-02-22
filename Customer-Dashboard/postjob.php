<?php

session_start();
include_once('../Home-Page/config.php');
include('postjobvalidate.php');

if (isset($_GET['id']))
    $_SESSION['session_id'] = $_GET['id'];
if (isset($_GET['cusid']))
    $_SESSION['cus_id'] = $_GET['cusid'];
if (isset($_GET['oid'])) {
    $_SESSION['order_id'] = $_GET['oid'];
}else{

    $cus_id = mysqli_real_escape_string($conn, $_SESSION['cus_id']);
    $result3=mysqli_query($conn,"SELECT job_order_id from job_order where cus_id ='$cus_id' order by job_order_id desc limit 1");
    $row3=mysqli_fetch_assoc($result3);
    if(!empty($row3['job_order_id']))
        $_SESSION['order_id'] = $row3['job_order_id'];
     
}
error_reporting(0);
$msg = "";
$cus_id    = mysqli_real_escape_string($conn, $_SESSION['cus_id']);

if (isset($_POST['submit'])) {
    if ($categoryErr == "" && $dateErr == "" && $noteErr == "" && $locationErr == "" && $addressErr == "") {
        //mysqli_real_escape_string () returns a legal string which can be used with SQL queries.
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "./workphoto/" . $filename;

        $category = mysqli_real_escape_string($conn, $_POST['category_name']);
        $date = $_POST['date'];
        $time = $_POST['time'];
        $tools = $_POST['tools'];
        $duration  = $_POST['duration'];
        $work  = mysqli_real_escape_string($conn, $_POST['workdetails']);
        $note  = mysqli_real_escape_string($conn, $_POST['note']);
        $location   = mysqli_real_escape_string($conn, $_POST['location']);
        $address     = mysqli_real_escape_string($conn, $_POST['address']);
        
     

        $query1  = "INSERT INTO job_order(cus_id,job_order_address, location, job_order_date, job_order_time, special_note, job_order_category, job_order_tools, work_detail, duration,filename) VALUES ($cus_id,'$address','$location','$date','$time','$note','$category','$tools','$work','$duration','$filename')";
        //$query1  = "INSERT INTO job_order(cus_id,job_order_address,location,job_order_date,special_note,job_order_category) VALUES ('$cus_id','$address','$location','$date','$note','$category')";
        $result1 = mysqli_query($conn, $query1);
        if (move_uploaded_file($tempname, $folder)) {
            // echo "<h3>  Image uploaded successfully!</h3>";
        } else {
            // echo "<h3>  Failed to upload image!</h3>";
        }
        if (!$result1)
            die("Inavlid query" . mysqli_error($conn));
        else
            $_SESSION['order_id']=mysqli_insert_id($conn);
            echo "<script>alert('job order posted successfully')</script>";
            header("refresh: 0; http://localhost/Dcsmsv-5.1%20-%20Copy/Customer-Dashboard/pendingorders.php");
    } else {
        echo "<h3 class='error' align='center'>your job order isn't posted !!! please fill the details correctly....!!!!</h3>";
          if (isset($_SESSION['session_id'])) {
              $cus_id = mysqli_real_escape_string($conn, $_SESSION['cus_id']);
             $result1=mysqli_query($conn,"SELECT job_order_id from job_order where cus_id ='$cus_id' order by job_order_id desc limit 1");
             $row2=mysqli_fetch_assoc($result1);
              if(!$result1){
                 die("invalid".mysqli_error($conn));
              }else{
                  $_SESSION['order_id'] = $row2['job_order_id'];
              }
          }
    }
    // mysqli_close($conn);
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
    <link rel="stylesheet" href="CSS/postjob.css">

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
<?php
// print_r($_SESSION);
?>
    <div class="main-container d-flex">
        <div class="sidebar " id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4 ms-2 name"><span class="text">DCSMS</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>


            <ul class="list-unstyled px-2 ">
                <?php echo "<li class='active'><a href='postjob.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>POST JOB</a></li>"; ?>
                <?php echo "<li class=''><a href='pendingorders.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>PENDING ORDERS</a></li>"; ?>
                <?php echo "<li class=''><a href='orderstatus.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>ORDER STATUS</a></li>"; ?>
                <!-- <li class=""><a href="payment.html" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li> -->
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

            <div class="dashboard-content ms-5 px-3 pt-4">
                <div class="jumbotron">
                <form class="form-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype='multipart/form-data'>
                        <table class="table table-borderless">
                            <thead></thead>

                            <tbody>

                                <tr>
                                    <td scope="col" class="text-sm">Work type</td>
                                    <td scope="col" class=" text text-sm">Work Details</td>
                                </tr>
                                    <tr>
                                    <td>
                                        <select class="form-select form-select-sm " aria-label=".form-select-lg example" placeholder="Select Work" name="category_name" required>
                                            <option selected value="select">Select Work</option>
                                            <option value="residential">Residential Cleaning</option>
                                            <option value="green">Green Cleaning</option>
                                            <option value="outdoor">Outdoor Cleaning</option>
                                            <option value="special">Special Event Cleaning</option>
                                        </select>
                                        <span class="error">* <?php echo $categoryErr; ?> </span>
                                       
                                    </td>
                                     
                                   <td> <textarea class="form-control " id="exampleFormControlTextarea2" rows="2" cols="20" placeholder="Work details" name="workdetails" required></textarea>
                                   </td>
                                </tr>

                                <tr>
                                    <td scope="col" class=" text text-sm align-left">Date</td>
                                    <td scope="col" class=" text text-sm align-left">Want Tools</td>
                   
                                </tr>
                                    <tr>
                                            <td>
                                                <input type="date" class="form-control" name="date" required>
                                                <span class="error">* <?php echo $dateErr; ?> </span>
                                             
                                            </td>
                                           
                                            <td><input type="radio" name="tools" value="yes"/>Yes    
                                            <input type="radio" name="tools" value="no"/>No</td>
                                    </tr>
                                   
                               
                                <tr>
                                    <td scope="col" class=" text text-sm align-left">Time</td>
                                    <td scope="col" class=" text text-sm align-left">Work Photo(please upload the a photo to get breif idea about work)</td>
                              </tr>
                                <tr>
                                    <td>
                                        <input type="time" class="form-control" name="time" required>
                                    </td>
                                    <td>
                                    <input class="form-control" type="file" name="uploadfile" value="" />
                                    </td>
                                       
                                   
                                <tr>
                                    <td scope="col" class=" text text-sm">Special Note</td>
                                    <td scope="col" class=" text text-sm">Duration</td>
                                </tr>
                                <tr>    
                                    <td scope="col">
                                        <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" cols="5 placeholder="Type your special requirments name="note" required></textarea>
                                        <span class="error">* <?php echo $noteErr; ?> </span>
                               
                                    </td>
                                    <td><input type="text" placeholder="in hour nearly" class="form-control" name="duration" >
                                </tr>


                                <tr>
                                    <td scope="col" class="text text-sm">City</td>
                                    <td scope="col" class=" text text-sm">Order Address</td>
                                </tr>
                                <tr>  
                                    <td><input type="text" placeholder="" class="form-control" name="location" required></td>
                                    <td>
                                        <textarea class="form-control " id="exampleFormControlTextarea2" rows="3" cols="5" placeholder="Type Address Here" name="address" required></textarea>
                                        <span class="error">* <?php echo $addressErr; ?> </span>
                                       
                                    </td>
                                       
                                 
                                </tr>
                               

                                <tr>

                                </tr>

                                <tr>
                                    <td>

                                    </td>
                                    <td class="text ">
                                        <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-3">
                                    </td>

                                </tr>
                            </tbody>

                        </table>

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