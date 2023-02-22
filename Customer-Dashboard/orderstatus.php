<?php
session_start();
include_once('../Home-page/config.php');
if (isset($_GET['id'])) 
  $_SESSION['session_id']=$_GET['id']; 
if (isset($_GET['cusid']))
  $_SESSION['cus_id'] = $_GET['cusid'];
 if (isset($_GET['oid']))
  $_SESSION['order_id'] = $_GET['oid']; 
// print_r($_SESSION);
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
        <?php echo "<li class=''><a href='postjob.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>POST JOB</a></li>"; ?>
        <?php echo "<li class=''><a href='pendingorders.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>PENDING ORDERS</a></li>"; ?>
        <?php echo "<li class='active'><a href='orderstatus.php?id=".$_SESSION['session_id']."&&cusid=".$_SESSION['cus_id']."&&oid=".$_SESSION['order_id']."' class='text-decoration-none px-3 py-3 d-block'>ORDER STATUS</a></li>"; ?>
        <!-- <li class=""><a href="payment.php" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li> -->
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

      <div class="registeremp ms-5 px-3 pt-4">
        <!-- <form name="myform" class="form-group" method="POST" action=""> -->
        <table class="table table py-4 text-center">
          <div class="col-md-4 mb-4">
            <tr>
              <td scope="col">ORDER ID</td>
              <td scope="col">Details</td>
              <td scope="col">STATUS</td>
            </tr>
          </div>
      <?php

          $cus_id  = mysqli_real_escape_string($conn, $_SESSION['cus_id']);
          $order_id  = mysqli_real_escape_string($conn, $_SESSION['order_id']);
          $result=mysqli_query($conn,"SELECT job_order_id,job_order_category,status from job_order where job_order_id='$order_id' ");
          $row1=mysqli_fetch_array($result);
          if (!empty($row1)) {
 
              if ($row1['status'] == 'Pending'){
          ?>
              <div class="col-md-4 mb-4">
                <tr>
                  <td></td>
                  <td></td>
                  <td scope="col " class="text-success align-right" ><?php echo $row1['status']; ?></td>
                </tr>
              </div>
              </thead>
      </div>
      <tbody class="text-center">
        <div class="col-md-4 mb-4">
          <tr>
            <td scope="row"><?php echo $row1['job_order_id']; ?></td>
            <td><?php echo $row1['job_order_category']; ?></td>
            <td><button type="button"  name ="cancel" class="btn btn-danger text-white btn btn-sm col-sm-7">Cancel</button></td>
          </tr>
        </div>

   <?php 
        if(isset($_POST['cancel']))
        {
          $cancel_result=mysqli_query($conn,"DELETE FROM job_order WHERE job_order_id='$row1[job_order_id]' ");

          if(!$cancel_result)
              die("invalid".mysqli_error($conn));
        }
       }
        
        if ($row1['status'] == 'Accept') 
        { 
          
          $query1=mysqli_query($conn,"SELECT aemp_id from job_order where job_order_id='$order_id'");
          $aempid=mysqli_fetch_array($query1);
          $empid=$aempid['aemp_id'];
          $query = mysqli_query($conn, "SELECT * FROM job_order
          JOIN registered_employee ON job_order.aemp_id = registered_employee.emp_id
          WHERE job_order.job_order_id = '$order_id'
          AND registered_employee.emp_id = '$empid' ");

          if(isset($_POST['cancel']))
          {
            $cancel_result1=mysqli_query($conn,"DELETE FROM job_order WHERE job_order_id='$row1[job_order_id]' ");

            if(!$cancel_result1)
              die("invalid".mysqli_error($conn));
          }

          if(!$query)
          die("invalid".mysqli_error($conn));
          
           else
           { 
            while ($row = mysqli_fetch_assoc($query)) 
            {
          ?>
            <div class="col-md-4 mb-4">
                <tr>
                  <td></td>
                  <td></td>
                  <td scope="col " class="text-success align-right" ><?php echo $row1['status']; ?></td>
                </tr>
              </div>

            <tbody class="text-center">
              <div class="col-md-4 mb-4">
                <tr>
                  <td scope="row"><?php echo $row1['job_order_id']; ?></td>
                  <td><?php echo $row1['job_order_category']; ?></td>
                  <td><button type="button" name="cancel1" class="btn btn-danger text-white btn btn-sm col-sm-7">Cancel</button></td>
                </tr>
              </div>
              <div class="col-md-4 mb-4">
                <tr>
                  <td scope="col"></td>
                  <td scope="col"></td>
                  <td scope="col"></td>
                </tr>
              </div>

          <div class="col-md-4 mb-4">
            <tr>
              <td scope="col" colspan="3"><b>Employee Details</b></td>
            </tr>
          </div>

          <div class="col-md-4 mb-4">
            <tr>
            <td></td>
            <td></td>
            <td><input type="submit" value="Change" class="btn btn-success btn-sm col-sm-7" name="change"></td>
            </tr>
          </div>
          <div class="col-md-4 mb-4">
            <tr>

            </tr>
          </div>
          <div class="col-md-4 mb-4">
            <tr>
              <td scope="row"><?php echo $row['emp_name']; ?></td>
              <td><?php echo $row['emp_status']; ?></td>
              <td>
                <a href="https://book.stripe.com/test_cN2dUQ8cwdqq46c144" ><input type="submit" value="Accept" class="btn btn-primary btn-sm col-sm-7" name="pay"></a>
              </td>
            </tr>
            <tr>
              <td><img src="../Employee-Dashboard/image/<?php echo $row['emp_filename']; ?>" width='150' height='100'></td>
              <td class="w-25" >Date : <?php echo $row['job_order_date'] ; ?> 
              Mobile : <?php echo $row['job_order_date']; ?>
              <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark text-white btn btn-sm col-sm-12 " data-bs-toggle="modal" data-bs-target="#exampleModal">View Employee Profile</button>
              
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Emlpoyee Details</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                          <div class="row">
                            <div class="col-6 col-sm-6">
                              <img src="employee.jpg" class="img-fluid img-thumbnail" alt="emp">
                            </div>

                            <div class="col-6 col-sm-6">
                              Name : <p class="text-black-50">Alan sadtah</p>
                              Address : <p class="text-black-50">No.678,Weligama,Matara</p>
                              Mobile : <p class="text-black-50">+9475986458</p>
                              Currently Experienced : <p class="text-black-50">currently working in ABNMS</p>

                            </div>

                            <div class="col-5 col-sm-5">
                              <p class="strong"></p>
                              <p class="strong">RAITINGS & REVIEWS </p>
                            </div>

                            <div class="col-7 col-sm-5">

                              <div class="d-flex justify-content-center align-items-center">
                                <img src="Ellipse 7.svg" class="img-fluid img-thumbnail " alt="emp">
                                <label class="fine position-absolute ml-2">+4.5</label>
                              </div>

                            </div>

                            <div class="row">
                            <div class="col-2 col-sm-2">
                            <img src="image.png" class="rounded-circle mt-5" style="width: 30px;" alt="Avatar" />
                            </div>

                            <div class="col-4 col-sm-5">
                            <h6 class="mt-5">Thanuka Kumara</h6>

                            </div>

                            <div class="col-4 col-sm-4">
                            <fieldset class="rating">
                                <input type="radio" id="star" name="rating"  value="5">
                                <input type="radio" id="star" name="rating"  value="4">
                                <input type="radio" id="star" name="rating"  value="3">
                                <input type="radio" id="star" name="rating"  value="2">
                                <input type="radio" id="star" name="rating"  value="1">
                                                
                            </fieldset>
                            </div>

                            <div class="col-12 col-sm-12">

                              <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit.Id quod soluta quibusdam mollitia repudiandae, nobis inventore adipisci praesentium laboriosam ratione voluptas enim et totam, sapiente dolor autem rerum, illum culpa.</p>
                                
                              </div>

                            </div>

                            <div class="row">
                            <div class="col-2 col-sm-2">
                            <img src="image.png" class="rounded-circle mt-5" style="width: 30px;" alt="Avatar" />
                            </div>

                            <div class="col-4 col-sm-4">
                            <h6 class="mt-5">Channa Vidana</h6>

                            </div>

                            <div class="col-6 col-sm-6">
                            <fieldset class="rating">
                                <input type="radio" id="star" name="rating"  value="5">
                                <input type="radio" id="star" name="rating"  value="4">
                                <input type="radio" id="star" name="rating"  value="3">
                                <input type="radio" id="star" name="rating"  value="2">
                                <input type="radio" id="star" name="rating"  value="1">
                                
                            </fieldset>
                            </div>

                            <div class="col-12 col-sm-12">

                              <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit.Id quod soluta quibusdam mollitia repudiandae, nobis inventore adipisci praesentium laboriosam ratione voluptas enim et totam, sapiente dolor autem rerum, illum culpa.</p>                           
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </div>

    <?php
              }
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