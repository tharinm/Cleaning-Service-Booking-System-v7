<?php
// session_start();
// print_r($_SESSION);
include_once('../Home-page/config.php');

?>
<?php

// $cus_id=$_SESSION['id'];


/*if (isset($_POST['pay'])) {
                          
  $sql = mysqli_query($conn, "UPDATE customer SET cus_points= 10 WHERE id=1");

  if(!$sql){
    die("Inavlid query".mysqli_error($conn));
  }
  }if (mysqli_query($conn, $sql)) {
  $last_id = mysqli_insert_id($conn);*/

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
  <link rel="stylesheet" href="CSS/orderstatus.css">

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
        <li class="active"><a href="orderstatus.php" class="text-decoration-none px-3 py-3 d-block">ORDER STATUS</a></li>
        <!-- <li class=""><a href="payment.php" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li> -->
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



      <div class="registeremp ms-5 px-3 pt-4">
        <!-- <form name="myform" class="form-group" method="POST" action=""> -->
        <table class="table table py-4 text-center">
          <div class="col-md-4 mb-4">
            <tr>
              <td scope="col">ORDER ID</td>
              <td scope="col">Details</td>

            </tr>
          </div>
          <?php
          // $cus_id=$_SESSION['id'];
          // $result=mysqli_query($conn,"SELECT job_order_id from job_order where cus_id=$cus_id");
          // $row1=mysqli_fetch_array($result);
          $query = mysqli_query($conn, "SELECT  job_order_id,job_order_category,job_order_date,status,emp_name,emp_filename,emp_status,filename from job_order,registered_employee,image where job_order_id=1 and emp_id=1 and id=1 ");

          //  $numrow = mysqli_num_rows($query);


          if ($query) {

            // if($numrow!=0){
            while ($row = mysqli_fetch_assoc($query)) {

          ?>
              <div class="col-md-4 mb-4">
                <tr>
                  <td scope="col " class="text-success align-right" colspan="3"><?php
                                                                                echo $row['status'];
                                                                                ?></td>
                </tr>
              </div>
              </thead>
      </div>
      <tbody class="text-center">
        <div class="col-md-4 mb-4">
          <tr>
            <td scope="row"><?php echo $row['job_order_id']; ?></td>
            <td><?php echo $row['job_order_category']; ?></td>
            <!-- <td><button type="button" class="btn btn-danger text-white btn btn-sm col-sm-7">Cancel</button></td> -->
          </tr>
        </div>
        <div class="col-md-4 mb-4">
          <tr>
            <td scope="col"></td>
            <td scope="col"></td>

          </tr>
        </div>
        <?php if ($row['status'] == 'Accept') { ?>
          <div class="col-md-4 mb-4">
            <tr>
              <td scope="col" colspan="3">Employee Details</td>

            </tr>
          </div>
          <div class="col-md-4 mb-4">
            <tr>
              <td scope="row"><?php echo $row['emp_name']; ?></td>
              <td><?php echo $row['emp_status']; ?></td>
              <td><input type="hidden" value="Change" class="btn btn-danger  btn-sm col-sm-9">
                <!-- <a href="../Customer-Dashboard/Payment/payment.php"></a> -->
                <a href="https://book.stripe.com/test_cN2dUQ8cwdqq46c144" class="btn btn-primary"><input type="submit" value="Accept" class="btn btn-primary btn-sm col-sm-12" name="pay"></a>
              </td>
            </tr>
            <tr>
              <td><img src="../Employee-Dashboard/image/<?php echo $row['filename']; ?>" width='150' height='100'></td>
              <td><?php echo $row['job_order_date']; ?></td>
              <td></td>

            </tr>
          </div>

    <?php
              }
            }
          } ?>


      </tbody>
      </table>
      <!-- </form> -->




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