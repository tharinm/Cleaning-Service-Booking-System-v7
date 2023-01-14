 <?php
  include_once('../Home-page/config.php');

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
   <link rel="stylesheet" href="CSS/history.css">

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
         <li class=""><a href="cancel.php" class="text-decoration-none px-3 py-3 d-block">CANCEL JOB</a></li>
         <li class=""><a href="store.php" class="text-decoration-none px-3 py-3 d-block">REWARD</a></li>
         <li class="active"><a href="history.php" class="text-decoration-none px-3 py-3 d-block">HISTORY</a></li>

         <li class=""><a href="updated.php" class="text-decoration-none px-3 py-3 d-block">UPDATE PROFILE</a></li>

       </ul>


     </div>
     <div class="content">
       <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
         <img src="image.png" class="avatar">
         <input type="submit" class="btn btn-secondary default btn  " value="Logout" onclick="window.location.href='../Home-Page/index.html'" name="logout" />
       </nav>



       <div class="dashboard-content ms-5 px-3 pt-4">

         <table class="table table py-4">
           <thead class="text-center">
             <tr>
               <th scope="col">Order ID</th>
               <th scope="col">Job Details</th>
               <th scope="col">Date</th>
               <th scope="col">Balance</th>
             </tr>
           </thead>
           <tbody class="text-center">
             <?php
              $result2 = mysqli_query($conn, "SELECT * from emp_payment,job_order ");
              $row1 = mysqli_fetch_assoc($result2);

              if (empty($row1['balance'])) {
                echo "<script>alert('please go to mywork and click on the complete button');</script>";
              } else {

                echo " <tr>";
                echo " <td> $row1[order_id] </td>";
                echo "<td>$row1[job_order_category]</td>";
                echo "<td>$row1[job_order_date]</td>";
                echo "<td>$row1[balance]</td>";
                echo "<td>";
              }
              ?>
           </tbody>
         </table>


         <div class="row">
           <div class="col-12">

             <p class="text-center lead">Total Balance Rs <?php if (empty($row1['balance'])) {
                                                            echo 0;
                                                          } else {
                                                            echo $row1['balance'];
                                                          } ?></p>
           </div>
         </div>

         <div class="row">
           <div class="col-12">

             <p class="text-center lead"> <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Withdraw</button></p>
           </div>
         </div>

         <?php

          if (isset($_POST['withdraw'])) {
            $payment = $_POST['bankacc'];
            $amount = $_POST['amount'];
            $sql = mysqli_query($conn, "INSERT INTO emp_withdrawal_request(bank_acc,amount) VALUES ($payment,$amount)");
          }
          ?>

         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-sm modal-fullscreen-sm-down">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Emlpoyee Bank Account Number</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>

               <div class="modal-body">
                 <form method="POST">
                   <input type="text" class="form-control modal-md" name="bankacc">
                   <lable>Amount :</lable> <input type="text" class="form-control modal-md" name="amount" value="<?php echo $row1['balance']; ?> ">
               </div>

               <div class="modal-footer">
                 <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="withdraw" value="Withdraw">
                 </form>
               </div>
             </div>
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
     </script>


 </body>

 </html>