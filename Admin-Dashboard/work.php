<?php
session_start();
include_once('../Home-Page/config.php');

if (isset($_GET['id'])) 
    $_SESSION['session_id'] = $_GET['id']; 


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
    <link rel="stylesheet" href="CSS/registeremployee.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <div class="main-container d-flex">
        <div class="sidebar " id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4 ms-2 name"><span class="text">DCSMS</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>

            <ul class="list-unstyled px-2 ">
                <?php echo "<li class=''><a href='registeremployee.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>REGISTER EMPLOYEE</a></li>" ?>
                <?php echo "<li class=''><a href='payment.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>PAYMENT</a></li> " ?>
                <?php echo "<li class='active'><a href='work.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>WORKS</a></li> "?>
                <?php echo "<li class=''><a href='emplyoeelist.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>EMPLOYEE LIST</a></li> "?>
                <?php echo "<li class=''><a href='userlist.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>USER LIST</a></li>" ?>
                <?php echo "<li class=''><a href='complaign.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>COMPLAINS</a></li>" ?>

            </ul>


        </div>
        <div class="content">
            <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">

                <div class="search" align="left">
                    <form id="search-form">
                        <label for="search">Enter search term:</label>
                        <input type="text" id="search" name="search">
                        <input type="submit" value="Search">
                    </form>
                </div>

                <img src="image.png" class="avatar">
                    <form method="POST" action="http://localhost/Dcsmsv-5.1%20-%20Copy/Home-Page/index.html">
                        <input type="submit" class="btn btn-secondary default btn" value="Logout" onclick="logOut()" name="logout" />
                    </form>
            </nav>

            <script>
                $(document).ready(function() {
                    $('#search-form').submit(function(event) {
                    // Prevent form submission
                    event.preventDefault();

                    // Get search query
                    var search = $('#search').val();

                    // Send AJAX request to search.php
                    $.ajax({
                        url: 'worklistsearch.php',
                        type: 'POST',
                        data: { search: search },
                        success: function(response) {
                        // Display search results
                        $('#results').html(response);
                        }
                    });
                    });
                });
                </script>

                <div id="results">
                    
                </div>

            <div class="registeremp ms-5 px-3 pt-4">
                <table class="table">
                    <thead>
                        <tr class="col-sm-2">
                            <td class="text text-dark">ORDER ID</td>
                            <td class="text text-dark">EMPLOYEE ID</td>
                            <td class="text text-dark">CUSTOMER ID</td>
                            <td class="text text-dark">JOB DETAILS</td>
                            <td class="text text-dark">DATE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT  job_order_id,aemp_id,job_order_category,job_order_date,cus_id from job_order  ");

                        while ($row = mysqli_fetch_assoc($query)) {
                            echo   "<tr>";
                            echo "  <td>$row[job_order_id]</td>";
                            echo "  <td>$row[aemp_id]</td>";
                            echo "  <td>$row[cus_id]</td>";
                            echo "  <td>$row[job_order_category]</td>";
                            echo "  <td>$row[job_order_date]</td>";


                            echo "  </tr>";
                        }
                        ?>
                </table>
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