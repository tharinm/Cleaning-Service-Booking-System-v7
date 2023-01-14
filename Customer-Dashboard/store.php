<?php
include_once('../Home-page/config.php');

$vacum = 400;
$broom = 1000;
$axe = 1200;

$sql = mysqli_query($conn, 'SELECT cus_points from customer where cus_id=1');
$result = mysqli_fetch_array($sql);

if (isset($_POST['buy'])) {
    if ($result['cus_points']> $vacum) {
        echo "<script>
            alert('Item added to your cart');
        </script>";
    } else {
        echo "<script>alert('You dont have enough point to buy this')
        </script>";
    }
}

if (isset($_POST['buy_1'])) {
    if ($result['cus_points'] > $vacum) {
        echo "<script>
            alert('Item added to your cart');
        </script>";
    } else {
        echo "<script>alert('You dont have enough point to buy this')
        </script>";
    }
}

if (isset($_POST['buy_2'])) {
    if ($result['cus_points']> $vacum) {
        echo "<script>
            alert('Item added to your cart');
        </script>";
    } else {
        echo "<script>alert('You dont have enough point to buy this')
        </script>";
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
    <link rel="stylesheet" href="CSS/help.css">
    <link rel="stylesheet" type="" href="CSS/store.css">

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
            height: 40px;
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
                <li class=""><a href="myorders.php" class="text-decoration-none px-3 py-3 d-block">MY ORDERS</a></li>
                <li class=""><a href="complaign.php" class="text-decoration-none px-3 py-3 d-block">COMPLAIN</a></li>
                <li class=""><a href="updateprofile.php" class="text-decoration-none px-3 py-3 d-block">UPDATE PROFILE</a></li>
                <li class="active"><a href="store.php" class="text-decoration-none px-3 py-3 d-block">REWARDS</a></li>
                <li class=""><a href="help.html" class="text-decoration-none px-3 py-3 d-block">HELP</a></li>
            </ul>


        </div>
        <div class="content">
            <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
                <img src="image.png" class="avatar">
                <input type="submit" class="btn btn-secondary default btn  " value="Logout" onclick="window.location.href='../Home-Page/index.html'" name="logout" />
            </nav>

            <div class="registeremp ms-5 px-3 pt-4">
                <div class="card ">
                    <img src="gold.png" alt="">
                    <label for=""><?php
                                    
                                    echo $result['cus_points'];
                                    ?>
                    </label>
                </div>

                <form method="POST">
                    <div class="shop">
                        <div class="shopping-item">
                            <div class="item">
                                <img src="vacum.jpg" alt="" class="goods">
                                <input type="submit" class="btn buy" value="Buy" name="buy">
                                <div class="points text-center"><img class="c" src="gold.png"><label class="amount">200</label></div>
                            </div>
                        </div>

                        <div class="shopping-item">
                            <div class="item">
                                <img src="vacum.jpg" alt="" class="goods">
                                <input type="submit" class="btn buy" value="Buy" name="buy_1">
                                <div class="points text-center"><img class="c" src="gold.png"><label class="amount">200</label></div>
                            </div>
                        </div>

                        <div class="shopping-item">
                            <div class="item">
                                <img src="vacum.jpg" alt="" class="goods">
                                <input type="submit" class="btn buy" value="Buy" name="buy_2">
                                <div class="points text-center"><img class="c" src="gold.png"><label class="amount">200</label></div>
                            </div>
                        </div>
                    </div>
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