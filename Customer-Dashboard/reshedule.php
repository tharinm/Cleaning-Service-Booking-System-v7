<?php

include_once('../Home-page/config.php');
if (isset($_POST['cancel'])) {
    $sql2 = "INSERT INTO cancel_order(order_id,category,date) SELECT  job_order_id,job_order_category,job_order_date from job_order where job_order_id=1";
    $result2 = mysqli_query($conn, $sql2);

    $sql4 = "INSERT INTO refunds(cus_id) SELECT cus_id from customer where cus_id=1";
    $result4 = mysqli_query($conn, $sql4);

    $result3 = mysqli_query($conn, "DELETE from job_order where job_order_id =1 ");

    if (!$result2 && !$result3) {
        die("invalid query" . mysqli_error($conn));
    } else {
        echo "<script>alert('job order cancelled succeesfully')</script>";
    }
}

if (isset($_POST['submit2'])) {

    $date = $_POST['date'];
    $time = $_POST['time'];
    $category = $_POST['category_name'];
    $result4 = mysqli_query($conn, "INSERT INTO reshedule(re_date,re_time,category)VALUES('$date','$time','$category')");

    if (!$result4) {
        die("invalid" . mysqli_error($conn));
    } else {
        echo "<script>alert('job order rescheduled succeesfully')</script>";
    }
}


?>
<?php
$status = "";
$msg = "";
//$city="";
//if(isset($_POST['submit'])){
//$city=$_POST['city'];
$url = "http://api.openweathermap.org/data/2.5/weather?q=Galle&appid=924c7e6c0f3ebd4974af86a9305376ba";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result, true);
if ($result['cod'] == 200) {
    $status = "yes";
} else {
    $msg = $result['message'];
}
//}
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
    <link rel="stylesheet" href="CSS/ordercancel.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .widget {

            position: absolute;
            top: 13%;
            left: 65%;
            display: flex;
            height: 200px;
            width: 450px;
            margin-top: 25px;
            flex-wrap: wrap;
            cursor: pointer;
            border-radius: 20px;
            box-shadow: 0px 0px 36px 15px rgba(184, 179, 179, 0.28);
            position: absolute;
            margin-bottom: 50%;
            margin-left: 50%;


        }

        .widget .weatherIcon {
            flex: 1 100%;
            height: 60%;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            background: #FAFAFA;
            font-family: weathericons;
            display: flex;
            align-items: center;
            justify-content: space-around;
            font-size: 100px;
        }

        .widget .weatherIcon i {
            padding-top: 30px;
        }

        .widget .weatherInfo {
            flex: 0 0 70%;
            height: 40%;
            background: #2f324f;
            border-bottom-left-radius: 20px;
            display: flex;
            align-items: center;
            color: white;

        }

        .widget .weatherInfo .temperature {
            flex: 0 0 40%;
            width: 100%;
            font-size: 50px;
            display: flex;
            justify-content: space-around;
        }

        .widget .weatherInfo .description {
            flex: 0 60%;
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
            justify-content: center;
            margin-left: -5px;
            z-index: 5;
        }

        .widget .weatherInfo .description .weatherCondition {
            text-transform: uppercase;
            font-size: 15px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
        }

        .widget .weatherInfo .description .place {
            font-size: 15px;
        }

        .widget .date {
            flex: 0 0 30%;
            height: 40%;
            background: #008AFF;
            border-bottom-right-radius: 20px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            color: white;
            font-size: 30px;
            font-weight: 800;
            z-index: -1;
        }


        .text {
            width: 80%;
            padding: 10px
        }

        .submit {
            height: 39px;
            width: 100px;
            border: 0px;
        }

        .mr45 {
            margin-right: 45px;
        }


        .table {
            background-color: #ffffff;
            width: 120%;
            border-radius: 5px;
            border-collapse: separate;
            border-spacing: 0;
            box-shadow: 0px 0px 36px 15px rgba(184, 179, 179, 0.28);
        }

        .btn {
            width: max-content;
        }

        .show-btn {
            background: #fff;
            padding: 10px 20px;
            font-size: 20px;
            font-weight: 500;
            color: #3498db;
            cursor: pointer;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            position: absolute;
            margin-bottom: 120%;
            margin-right: 30%;
        }

        .show-btn,
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        input[type="checkbox"] {
            display: none;
        }

        .container {
            display: none;
            background: #fff;
            width: 410px;
            padding: 30px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        #show:checked~.container {
            display: block;
        }

        .container .close-btn {
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 18px;
            cursor: pointer;
        }

        .container .close-btn:hover {
            color: #3498db;
        }

        .container .text {
            font-size: 30px;
            font-weight: 600;
            text-align: center;
        }

        .container form {
            margin-top: -20px;
        }

        .container form .data {
            height: 45px;
            width: 100%;
            margin: 40px 0;
        }

        form .data label {
            font-size: 18px;
        }

        form .data input {
            height: 100%;
            width: 100%;
            padding-left: 10px;
            font-size: 17px;
            border: 1px solid silver;
        }

        form .data input:focus {
            border-color: #3498db;
            border-bottom-width: 2px;
        }

        form .forgot-pass {
            margin-top: -8px;
        }

        form .forgot-pass a {
            color: #3498db;
            text-decoration: none;
        }

        form .forgot-pass a:hover {
            text-decoration: underline;
        }

        form .btn {
            margin: 30px 0;
            height: 30px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        form .btn .inner {
            height: 100%;
            width: 300%;
            position: absolute;
            left: -100%;
            z-index: -1;
            background: rgb(47, 130, 253);
            background: linear-gradient(58deg, rgba(47, 130, 253, 1) 21%, rgba(0, 138, 255, 1) 49%, rgba(229, 227, 250, 1) 100%);
            transition: all 0.4s;
        }

        form .btn:hover .inner {
            left: 0;
        }

        form .btn button {
            height: 100%;
            width: 100%;
            background: none;
            border: none;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
        }

        form .signup-link {
            text-align: center;
        }

        form .signup-link a {
            color: #3498db;
            text-decoration: none;
        }

        form .signup-link a:hover {
            text-decoration: underline;
        }

        .center {
            /* display:flex; */
            position: absolute;
            top: 60%;
            left: 40%;
            z-index: 1;
        }

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
                <li class=""><a href="postjob.php" class="text-decoration-none px-3 py-3 d-block">POST JOB</a></li>
                <li class=""><a href="orderstatus.php" class="text-decoration-none px-3 py-3 d-block">ORDER STATUS</a></li>
                <!-- <li class=""><a href="payment.html" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li> -->
                <li class="active"><a href="reshedule.php" class="text-decoration-none px-3 py-3 d-block">RESHEDULE</a></li>
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
                <input type="submit" class="btn btn-secondary default btn  " value="Logout" onclick="window.location.href='../Home-Page/index.html'" name="logout">
            </nav>
            <div class="dashboard-content ms-5 px-3 pt-4 d-flex  flex-wrap">
                <div class="details w-50">
                    <form name="myform" class="form-group" method="POST" action="">
                        <table class="table table py-4 text-center">
                            <div class="col-md-4 mb-4">
                                <tr>
                                    <td scope="col">ORDER ID</td>
                                    <td scope="col">Employee</td>
                                    <td scope="col">Details</td>
                                    <td scope="col">Action</td>
                                </tr>
                            </div>
                            <?php

                            $query = mysqli_query($conn, "SELECT  job_order_id,job_order_category,job_order_date,emp_name,emp_filename,emp_status from job_order,registered_employee where job_order_id=1 and emp_id=1");
                            /* $query3=mysqli_query($conn,"SELECT o1.job_order_id,o1.job_order_category,o1.job_order_date,jae1.a_emp_id,re1.emp_name,re1.emp_filename,re1.emp_status
                         FROM Job_accepted_emp AS jae1
                         INNER JOIN job_order AS o1 ON jae1.a_order_id=o1.job_order_id
                         INNER JOIN registered_employee AS re1 ON o1.emp_id =re1.emp_id");;*/
                            //  $numrow = mysqli_num_rows($query);	 = 

                            // if($numrow!=0){
                            while ($row = mysqli_fetch_assoc($query)) {

                            ?>
                                <div class="col-md-4 mb-4">
                                    <tr>
                                    </tr>
                                </div>
                                </thead>
                </div>
                <tbody class="text-center">
                    <div class="col-md-4 mb-4">
                        <tr>
                            <?php
                            ?>
                            <td scope="row"><?php echo $row['job_order_id']; ?></td>
                            <td><?php echo $row['emp_name']; ?></td>
                            <td><?php echo $row['job_order_category']; ?></td>
                            <td><input type="submit" class="btn btn-danger text-white btn-sm col-sm-6" name="cancel" value="Cancel"></td>
                        </tr>

                        <tr>
                            <th scope="col" colspan="3">Resheduled Details</th>
                        </tr>
                        <?php

                                $result5 = mysqli_query($conn, "SELECT re_id,re_date,re_time,category,re_status,emp_name,emp_filename,emp_status,filename FROM reshedule,registered_employee,image WHERE re_id=1 and emp_id=1 and id=1");
                                
                                
                                if ($result5) {

                                    // if($numrow!=0){
                                    while ($row5 = mysqli_fetch_assoc($result5)) {

                        ?>
                                <div class="col-md-4 mb-4">
                                    <tr>
                                        <td colspan="3"></td>
                                        <td scope="col " class="text-success align-right" ><?php echo $row5['re_status'];  ?></td>
                                    </tr>
                                </div>
                <tbody class="text-center">

                    <div class="col-md-4 mb-4">
                        <tr>
                            <td scope="row"><?php echo $row5['re_id']; ?></td>
                            <td><?php echo $row5['category']; ?></td>
                        </tr>
                    </div>
                    <div class="col-md-4 mb-4">
                        <tr>
                            <td scope="col"></td>
                            <td scope="col"></td>
                        </tr>
                    </div>
                    <?php       
                                

                                 if($row5['re_status'] == 'accept') { ?>
                        <div class="col-md-4 mb-4">
                            <tr>
                                <td scope="col" colspan="3">Employee Details</td>
                                
                            </tr>
                        </div>

                        <div class="col-md-4 mb-4">
                            <tr>
                                <td scope="row"><?php echo $row5['emp_name']; ?></td>
                                <td colspan="2"><?php echo $row5['emp_status']; ?></td>

                            </tr>
                            <tr>
                                <td><img src="../Employee-Dashboard/image/<?php echo $row5['filename']; ?>" width='150' height='100'></td>
                                <td><?php echo $row5['re_date']; ?></td>
                                <td><input type="submit" value="Accept" name="accept" class="btn btn-success  btn-sm col-sm-9"></td>

                            </tr>
                        </div>
                        
                <?php }else if($row5['re_status'] == 'rejected'){
                                $result6 = mysqli_query($conn, "SELECT rejected_order_id,date,time,category,status,emp_name,emp_filename,emp_status,filename FROM emp_reject_orders,registered_employee,image WHERE rejected_order_id=1 and emp_id=1 and id=1");
                            
                                $row6=mysqli_fetch_assoc($result6);

                                if($row6['status']=='Accept'){ ?>
                                        

                                        <div class="col-md-4 mb-4">
                            <tr>
                                <td scope="col" colspan="3">Employee Details</td>
                                <td scope="col " class="text-success align-right" ><?php echo $row6['status'];  ?></td>
                            </tr>
                        </div>

                        <div class="col-md-4 mb-4">
                            <tr>
                                <td scope="row"><?php echo $row6['emp_name']; ?></td>
                                <td colspan="2"><?php echo $row6['emp_status']; ?></td>

                            </tr>
                            <tr>
                                <td><img src="../Employee-Dashboard/image/<?php echo $row6['filename']; ?>" width='150' height='100'></td>
                                <td><?php echo $row6['date'];  echo"<br> ".$row6['time'];?></td>
                                <td><input type="submit" value="Accept" name="accept1" class="btn btn-success  btn-sm col-sm-9"></td>

                            </tr>
                        </div>


                                        
                            <?php
                                }                                
                        

                                 }
                     
                 }
             } ?>
            </table>
            </form>

            <form method="POST" action="">
                <table>
                    <td scope="col">

                        <div class="center">
                            <input type="checkbox" id="show">
                            <label for="show" class="show-btn">Reshedule</label>
                            <div class="container">
                                <label for="show" class="close-btn fas fa-times" title="close"></label>

                                <div class="data">
                                    <label>Date</label>
                                    <input type="Date" name="date" required>
                                </div>
                                <div class="data">
                                    <label>Time</label>
                                    <input type="Time" name="time" required>
                                </div>
                                <div class="data">
                                    <lable>Work type</lable>
                                    <select class="form-select form-select-sm mb-3" aria-label=".form-select-lg example" placeholder="Select Work" name="category_name" required>
                                        <option selected value="select">Select Work</option>
                                        <option value="residential">Residential Cleaning</option>
                                        <option value="green">Green Cleaning</option>
                                        <option value="outdoor">Outdoor Cleaning</option>
                                        <option value="special">Special Event Cleaning</option>
                                    </select>
                                </div>

                                <div class="btn">
                                    <div class="inner"></div>
                                    <input type="submit" name="submit2" value="Submit" />
                                </div>
                </table>
            </form>
            </div>
        </div>
    </div>


<?php  }  ?>
</div>
<?php if ($status == "yes") { ?>
    <article class="widget ms-5">
        <div class="weatherIcon">
            <img src="http://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon'] ?>@4x.png" />
        </div>
        <div class="weatherInfo">
            <div class="temperature">
                <span><?php echo round($result['main']['temp'] - 273.15) ?>°</span>
            </div>
            <div class="description mr45">
                <div class="weatherCondition"><?php echo $result['weather'][0]['main'] ?></div>
                <div class="place"><?php echo $result['name'] ?></div>
            </div>
            <div class="description wind">
                <div class="weatherCondition">Wind</div>
                <div class="place"><?php echo $result['wind']['speed'] ?> M/H</div>
            </div>
        </div>
        <div class="date">
            <?php echo date('d M', $result['dt']) ?>

        </div>
    </article>
<?php } ?>
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