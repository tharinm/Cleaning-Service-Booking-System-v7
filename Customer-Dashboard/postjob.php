<?php
// session_start();
// print_r($_SESSION);
include_once('../Home-Page/config.php');
include('postjobvalidate.php');

// $customer=$_SESSION['username'];
// $email=$_SESSION['email'];
// $result1=mysqli_query($conn,"SELECT cus_id from customer where user_name like '$customer' or email like '$email' ");
// $row=mysqli_fetch_assoc($result1);
// $_SESSION['id'] = $row['cus_id'];


if (isset($_POST['submit'])) {
    if ($categoryErr == "" && $dateErr == "" && $noteErr == "" && $locationErr == "" && $addressErr == "") {
        //mysqli_real_escape_string () returns a legal string which can be used with SQL queries.

        $category = mysqli_real_escape_string($conn, $_POST['category_name']);
        $date = $_POST['date'];
        $note  = mysqli_real_escape_string($conn, $_POST['note']);
        $location   = mysqli_real_escape_string($conn, $_POST['location']);
        $address     = mysqli_real_escape_string($conn, $_POST['address']);


        $query1  = "INSERT INTO job_order(cus_id,job_order_address,location,job_order_date,special_note,job_order_category) VALUES (1,'$address','$location','$date','$note','$category')";
        $result1 = mysqli_query($conn, $query1);
        // print_r($_SESSION);

        // if (mysqli_query($conn, $query1)) {
        // $last_id = mysqli_insert_id($conn);
        // }

        //$query2= "SELECT customer.cus_id,,job_order.job_order_id from customer,job_order where cus_id=$i";
        // $result2 = mysqli_query($conn,$query2);



        if (!$result1)
            die("Inavlid query" . mysqli_error($conn));
        else
            echo "<script>alert('job order posted successfully')</script>";
    } else {
        // echo "<script>alert('your job order isn't posted !!! please fill the details correctly....!!!!')</script>";
        echo "<h3 class='error' align='center'>your job order isn't posted !!! please fill the details correctly....!!!!</h3>";
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

    <div class="main-container d-flex">
        <div class="sidebar " id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4 ms-2 name"><span class="text">DCSMS</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>


            <ul class="list-unstyled px-2 ">
                <li class="active"><a href="postjob.php" class="text-decoration-none px-3 py-3 d-block">POST JOB</a></li>
                <li class=""><a href="orderstatus.php" class="text-decoration-none px-3 py-3 d-block">ORDER STATUS</a></li>
                <!-- <li class=""><a href="payment.html" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li> -->
                <li class=""><a href="reshedule.php" class="text-decoration-none px-3 py-3 d-block">RESHEDULE</a></li>
                <li class=""><a href="myorders.php" class="text-decoration-none px-3 py-3 d-block">MY ORDERS</a></li>
                <li class=""><a href="complaign.php" class="text-decoration-none px-3 py-3 d-block">COMPLAIN</a></li>
                <li class=""><a href="updateprofile.php" class="text-decoration-none px-3 py-3 d-block">UPDATE PROFILE</a></li>
                <li class=""><a href="store.php" class="text-decoration-none px-3 py-3 d-block">REWARDS</a></li>
                <li class=""><a href="help.html" class="text-decoration-none px-3 py-3 d-block">HELP</a></li>

            </ul>


        </div>
        <div class="content">

            <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
                <img src="image.png" class="avatar">
                <input type="submit" class="btn btn-secondary default btn  " value="Logout" onclick="window.location.href='../Home-Page/index.html'" name="logout" />
            </nav>

            <div class="dashboard-content ms-5 px-3 pt-4">
                <div class="jumbotron">
                    <form class="form-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <table class="table table-borderless">
                            <thead></thead>

                            <tbody>

                                <tr>
                                    <td scope="col" class="text-sm">Work type</td>
                                    <td>
                                        <select class="form-select form-select-sm mb-3" aria-label=".form-select-lg example" placeholder="Select Work" name="category_name" required>
                                            <option selected value="select">Select Work</option>
                                            <option value="residential">Residential Cleaning</option>
                                            <option value="green">Green Cleaning</option>
                                            <option value="outdoor">Outdoor Cleaning</option>
                                            <option value="special">Special Event Cleaning</option>
                                        </select>
                                        <span class="error">* <?php echo $categoryErr; ?> </span>
                                        <br><br>
                                    </td>

                                </tr>

                                <tr>
                                    <td scope="col" class=" text text-sm align-left">Date</td>
                                    <td>
                                        <input type="date" class="form-control" name="date" required>
                                        <span class="error">* <?php echo $dateErr; ?> </span>
                                        <br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="col" class=" text text-sm">Special Note</td>
                                    <td scope="col">
                                        <textarea class="form-control " id="exampleFormControlTextarea1" rows="5" cols="50" placeholder="Type your special requirments" name="note" required></textarea>
                                        <span class="error">* <?php echo $noteErr; ?> </span>
                                        <br><br>
                                    </td>
                                </tr>


                                <tr>
                                    <td scope="col" class="text text-sm">Location</td>
                                    <td><input type="text" placeholder="" class="form-control" name="location" required>
                                        <span class="error">* <?php echo $locationErr; ?> </span>
                                        <br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="col" class=" text text-sm">Order Address</td>

                                    <td>
                                        <textarea class="form-control " id="exampleFormControlTextarea2" rows="5" cols="10" placeholder="Type Address Here" name="address" required></textarea>
                                        <span class="error">* <?php echo $addressErr; ?> </span>
                                        <br><br>
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

        function logOut() {
            // Use an XMLHttpRequest to send a request to logout.php
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // If the request is successful, redirect the user to the login page
                    window.location.replace("../Home-Page/index.html");
                }
            };
            xhttp.open("GET", "../Home-Page/logout.php", true);
            xhttp.send();
        }
    </script>


</body>

</html>