<?php
session_start();
include('../Home-page/config.php');

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $_SESSION['session_id'] = $id;
} 

if (isset($_GET['cusid']))
 {
  $cus_id = $_GET['cusid'];
  $_SESSION['cus_id'] = $cus_id;

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
    
    <!-- Start of LiveChat (www.livechat.com) code -->
<script>
    window.__lc = window.__lc || {};
    window.__lc.license = 15089727;
    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
</script>
<noscript>
<a href="https://www.livechat.com/chat-with/15089727/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a>
</noscript>
<!-- End of LiveChat code -->

<div class="main-container d-flex">
    <div class="sidebar " id="side_nav">
         <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
            <h1 class="fs-4 ms-2 name"><span class="text">DCSMS</span></h1>
            <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
        </div>

        <ul class="list-unstyled px-2 ">
            <?php echo "<li class=''><a href='postjob.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>POST JOB</a></li>"; ?>
            <?php echo "<li class=''><a href='pendingorders.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>PENDING ORDERS</a></li>"; ?>
            <?php echo "<li class=''><a href='orderstatus.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>ORDER STATUS</a></li>"; ?>
           
            <!-- <li class=""><a href="payment.html" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li> -->
            <?php echo "<li class=''><a href='reshedule.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>RESHEDULE</a></li>"; ?>
            <?php echo "<li class=''><a href='myorders.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>MY ORDERS</a></li>"; ?>
            <?php echo "<li class=''><a href='complaign.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>COMPLAIN</a></li>"; ?>
            <?php echo "<li class=''><a href='updateprofile.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>UPDATE PROFILE</a></li>"; ?>
            <?php echo "<li class=''><a href='store.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>REWARDS</a></li>"; ?>
            <?php echo "<li class='active'><a href='help.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."' class='text-decoration-none px-3 py-3 d-block'>HELP</a></li>"; ?>

        </ul>
        
    </div>
    <div class="content">
          <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
                <img src="image.png" class="avatar">
                <input type="submit" class="btn btn-secondary default btn  " value="Logout" onclick="window.location.href='../Home-Page/index.html'" name="logout" />
        </nav>
            <div class="dashboard-content ms-5 px-3 pt-4  ">
            <img src="help.jpg" alt="" class="goods width-700px height-500px">

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

        $('.open-btn').on('click',function(){
     $('.sidebar').addClass('active');
        })

        $('.close-btn').on('click',function(){
     $('.sidebar').removeClass('active');
        })


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