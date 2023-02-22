<?php

session_start();
include_once('../Home-page/config.php');

if (isset($_GET['id'])) 
    $_SESSION['session_id'] = $_GET['id']; 
if (isset($_GET['cusid']))
    $_SESSION['cus_id'] = $_GET['cusid']; 
if (isset($_GET['oid']))
    $_SESSION['order_id'] = $_GET['oid']; 

// print_r($_SESSION);

    $cus_id = mysqli_real_escape_string($conn, $_SESSION['cus_id']);
    $order_id = mysqli_real_escape_string($conn,$_SESSION['order_id']);
    $sql = mysqli_query($conn, "SELECT job_order_id,aemp_id,status from job_order where job_order_id='$order_id'");

    $orderid = mysqli_fetch_array($sql);
    if(!empty($orderid))
    {
        $oid = $orderid['job_order_id'];
        $eid = $orderid['aemp_id'];
    } 

if (isset($_POST['submit1']))
{

    //data insert to table
    if (!empty($_POST['complain']) && $orderid['status']=='Completed') 
    {
        
        $complaign = mysqli_real_escape_string($conn, $_POST['complain']);
        $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);

        $query  = "INSERT INTO complain(order_id,complain_description) VALUES ($oid,'$complaign')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script> alert('Your Complain Submitted sucessfully!');</script>";
        } else {
            echo "failed" . mysqli_error($conn);
        }
    }else{
        echo "<script> alert('Your Job Order is not Completed yet.if your job order already finised then go to my orders and update your work history....');</script>";
    }
}

if (isset($_POST['submit2'])) 
{
    $rate=$_POST['rating'];

    $sql=mysqli_query($conn,"SELECT emp_points from registered_employee where emp_id='$eid'");
    $oldrate=mysqli_fetch_array($sql);

    $rating=$oldrate[0] + $rate ;
    $result1 = mysqli_query($conn,"UPDATE registered_employee SET emp_points=$rating WHERE emp_id='$eid'");
    if ($result1) {

        echo "<script> alert('Your Review Submitted sucessfully!');</script>";
    } else {
        echo "failed" . mysqli_error($conn);
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
    <link rel="stylesheet" href="CSS/complaign.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <script>
           
                    // Declare the totalStars and rowSum variables outside the rate function
            var totalStars = 0;
            var rowSum = 0;

            function rate(item) {
            // Return if the stars in the row are not clickable
            if (item.onclick === null) {
                return;
            }

            // Find the parent row of the clicked element
            var row = item.parentNode.parentNode;
            // Find all the star elements within the row
            var stars = row.querySelectorAll('.fa-star');
            // Set the color of the stars based on their id values
            for (var i = 0; i < stars.length; i++) {
                if (stars[i].id <= item.id) {
                stars[i].style.color = "orange";
                } else {
                stars[i].style.color = "black";
                }
            }
            // Initialize the rowSum variable to 0
            rowSum = 0;
            // Loop through all the stars and get the sum of clicked stars for the current row
            for (var i = 0; i < stars.length; i++) {
                if (stars[i].style.color === "orange") {
                rowSum += 1;
                }
            }
            // Update the value of the totalStars variable with the sum of clicked stars for all rows
            totalStars += rowSum;

            // Update the value of the hidden input field with the totalStars value
            document.getElementById("rating").value = totalStars;

            // print the totalStars value to the console
            console.log(totalStars);

            // Disable the stars in the current row
            for (var i = 0; i < stars.length; i++) {
                stars[i].onclick = null;
            }
            }


             
    </script>

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
                <?php echo "<li class=''><a href='myorders.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>MY ORDERS</a></li>"; ?>
                <?php echo "<li class='active'><a href='complaign.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>COMPLAIN</a></li>"; ?>
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

            <div class=" dashboard-content ms-5 px-3 pt-4">
                <form name="myform" class="form-group" method="POST" action="">

                    <table class="table table-borderless justify-content-center">
                        <thead></thead>

                        <tbody>
                            <tr>
                                <td>
                                    <lable>ORDER ID:</lable>
                                    <input type="text" value='<?php if(!empty($oid)) echo $oid; ?>' name="order_id" size="11" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td scope="col">
                                    <textarea class="form-control z-depth-1" name="complain" id="exampleFormControlTextarea1" rows="10" cols="50" placeholder="Type your complain here" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>

                                    <input type="submit" class="btn btn-primary mt-3" name="submit1" value="Submit">
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </form>
            </div>
            <div class="dashboard-content ms-5 px-3 pt-4">
            <form onsubmit="return submitForm()" method="POST">
  
                <table class="table table-borderless justify-content-center   ">
                    <thead>
                        <th class="text text-primary">REVIEWS</th>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td class="text text-info">
                                Work On Time
                            </td>
                            <td class="text ">
                            <span onclick="rate(this)" class="fa fa-star" id="1"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="2"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="3"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="4"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="5"></span>
                            </td>

                        </tr>
                        <tr>
                        <tr>
                            <td class="text text-info">
                                Friendly Service
                            </td>
                            <td class="text ">
                            <span onclick="rate(this)" class="fa fa-star" id="1"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="2"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="3"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="4"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="5"></span>
                            </td>

                        </tr>
                        </tr>
                        <tr>
                            <td class="text text-info">
                                Charging
                            </td>
                            <td class="text ">
                            <span onclick="rate(this)" class="fa fa-star" id="1"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="2"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="3"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="4"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="5"></span>
                            </td>

                        </tr>
                        <tr>
                            <td class="text text-info">
                                About Work
                            </td>
                            <td class="text ">
                            <span onclick="rate(this)" class="fa fa-star" id="1"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="2"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="3"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="4"></span>
                            <span onclick="rate(this)" class="fa fa-star" id="5"></span>
                            </td>

                        </tr>

                        <tr>
                            
                            <td class="mt-5" colspan="3">
                                <input type="submit" name="submit2"onclick="result()"  style="margin-top:10px;margin-right:5px;" class="btn btn-sm btn-primary">
                                <input type="hidden" name="rating" id="rating" value="">                            
                            </td>
                        </tr>

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