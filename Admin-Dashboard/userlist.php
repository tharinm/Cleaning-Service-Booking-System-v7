<?php
include_once('../Home-Page/config.php');

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
    <link rel="stylesheet" href="CSS/userlist.css">

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
                <li class=""><a href="registeremployee.php" class="text-decoration-none px-3 py-3 d-block">REGISTER EMPLOYEE</a></li>
                <li class=""><a href="payment.php" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li>
                <li class=""><a href="work.php" class="text-decoration-none px-3 py-3 d-block">WORKS</a></li>
                <li class=""><a href="emplyoeelist.php" class="text-decoration-none px-3 py-3 d-block">EMPLOYEE LIST</a></li>
                <li class="active"><a href="userlist.php" class="text-decoration-none px-3 py-3 d-block">USER LIST</a></li>
                <li class=""><a href="complaign.php" class="text-decoration-none px-3 py-3 d-block">COMPLAINS</a></li>


            </ul>


        </div>
        <div class="content" >

        <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">

        <div class="search" align="left">
        <form id="search-form">
            <label for="search">Enter search term:</label>
            <input type="text" id="search" name="search">
            <input type="submit" value="Search">
            </form>
        </div>
            
                <img src="image.png" class="avatar">
                <input type="submit" class="btn btn-secondary default btn  " value="Logout" onclick="window.location.href='../Home-Page/index.html'" name="logout">
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
                        url: 'usersearch.php',
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
                    <thead class="col-sm-4">
                        <tr>
                            <td class="text text-dark">CUSTOMER ID</td>
                            <td class="text text-dark">ADDRESS</td>
                            <td class="text text-dark">EMAIL</td>
                            <td class="text text-dark">NIC</td>
                            <td class="text text-dark">TOTAL ORDERS</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                            $query = mysqli_query($conn, "SELECT  cus_id,email,address,nic from customer ");

                            while ($row = mysqli_fetch_assoc($query)) {
                            $query1 = mysqli_query($conn,"SELECT COUNT(status) FROM job_order WHERE status='Accept' and cus_id=$row[cus_id]");
                            $count = mysqli_fetch_array($query1);
                            echo   "<tr>";
                            echo "  <td>$row[cus_id]</td>";
                            echo "  <td>$row[address]</td>";
                            echo "  <td>$row[email]</td>";
                            echo "  <td>$row[nic]</td>";
                            echo "  <td>$count[0]</td>";
                            echo "  </tr>";
                            }
                        ?>
                        <!-- <td scope="col"><a href="#" class="btn btn-primary text-white btn-sm col-sm-6">EDIT</a></td> -->
                        </tr>
                    </tbody>
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


</body>

</html>