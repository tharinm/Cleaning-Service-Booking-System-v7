<?php
include_once('../Home-page/config.php');
$sql1 = "SELECT order_id,category,date from cancel_order where order_id =1 ";
$result = mysqli_query($conn, $sql1);

if (!$result) {
  die("invalid query" . mysqli_error($conn));
} else {

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
    <link rel="stylesheet" href="CSS/style.css">

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
          <li class=""><a href="findjob.php" class="text-decoration-none px-3 py-3 d-block">FIND JOB</a></li>
          <li class=""><a href="pending.php" class="text-decoration-none px-3 py-3 d-block">MY WORK</a></li>
          <!-- <li class=""><a href="works.php" class="text-decoration-none px-3 py-3 d-block">YOUR WORKS</a></li> -->
          <li class=""><a href="resheduled.php" class="text-decoration-none px-3 py-3 d-block">RESHEDULED</a></li>

          <li class=""><a href="map.html" class="text-decoration-none px-3 py-3 d-block">VIEW ON MAP</a></li>
          <li class="active"><a href="pending.php" class="text-decoration-none px-3 py-3 d-block">CANCEL JOB</a></li>
          <li class=""><a href="store.php" class="text-decoration-none px-3 py-3 d-block">REWARDS</a></li>
          <li class=""><a href="history.php" class="text-decoration-none px-3 py-3 d-block">HISTORY</a></li>

          <li class=""><a href="updated.php" class="text-decoration-none px-3 py-3 d-block">UPDATE PROFILE</a></li>

        </ul>


      </div>
      <div class="content">

        <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
          <img src="image.png" class="avatar">
          <input type="submit" class="btn btn-secondary default btn  " value="Logout" onclick="window.location.href='../Home-Page/index.html'" name="logout" />
        </nav>



        <div class="dashboard-content ms-5 px-3 pt-4">
          <br><br><br>





          <table class="table table py-4">
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

            while ($row = mysqli_fetch_assoc($result)) {

              echo   "<tr>";
              echo "  <td>$row[order_id]</td>";
              echo "  <td>$row[category]</td>";
              echo "  <td>$row[date]</td>";

              echo "<td>
                        <button type='submit' name='accept' class='btn btn-danger ms-1'>OK</button>

                        </td>";


              echo "  </tr>";
            }
          }

            ?>

            </tbody>
          </table>


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