<?php
include_once('../Home-Page/config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require('PHPmailer/Exception.php');
require('PHPmailer/SMTP.php');
require('PHPmailer/PHPMailer.php');

function sendmail($row)
{
  $mail = new PHPMailer(true);

  try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                          //Enable verbose debug output
    $mail->isSMTP();                                                //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                                 //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                       //Enable SMTP authentication
    $mail->Username = 'lkmoviesbazaar@gmail.com';                 //SMTP username
    $mail->Password = 'owabqytypgocglyz';                       //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port = 465;                                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('lkmoviesbazaar@gmail.com', 'Verifiy');
    $mail->addAddress($row);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification From My Cleaners Service';
    $mail->Body    = "Congratulation.Your succesfully Register in mycleners....click this link to login my cleaners...http://localhost/Dcsmsv-5/Home-Page/log.php";

    $mail->send();
    return true;
  } catch (Exception $e) {
    return false;
  }
}

function sendmail1($row1)
{
  $mail = new PHPMailer(true);

  try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                          //Enable verbose debug output
    $mail->isSMTP();                                                //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                                 //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                       //Enable SMTP authentication
    $mail->Username = 'lkmoviesbazaar@gmail.com';                 //SMTP username
    $mail->Password = 'owabqytypgocglyz';                       //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port = 465;                                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('lkmoviesbazaar@gmail.com', 'Verifiy');
    $mail->addAddress($row1);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification From My Cleaners Service';
    $mail->Body    = "Your not registered.Try Again.";

    $mail->send();
    return true;
  } catch (Exception $e) {
    return false;
  }
}

$sql = "SELECT emp_fname,emp_qulification,filename from employee,image where id=1 and t_emp_id=1";
$result = mysqli_query($conn, $sql);



if (!$result) {
  die("Invalid query" . mysqli_error($conn));
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>!-->
    <link rel="stylesheet" href="CSS/registeremployee.css">

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
          <li class="active"><a href="registeremployee.php" class="text-decoration-none px-3 py-3 d-block"></i>REGISTER EMPLOYEE</a></li>
          <li class=""><a href="payment.php" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li>
          <li class=""><a href="work.php" class="text-decoration-none px-3 py-3 d-block">WORKS</a></li>
          <li class=""><a href="emplyoeelist.php" class="text-decoration-none px-3 py-3 d-block">EMPLOYEE LIST</a></li>
          <li class=""><a href="userlist.php" class="text-decoration-none px-3 py-3 d-block">USER LIST</a></li>
          <li class=""><a href="complaign.php" class="text-decoration-none px-3 py-3 d-block">COMPLAINS</a></li>
        </ul>


      </div>
      <div class="content">

        <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
          <img src="image.png" class="avatar">
          <input type="submit" class="btn btn-secondary default btn  " value="Logout" onclick="window.location.href='../Home-Page/index.html'" name="logout">
        </nav>

        <div class="registeremp ms-5 px-3 pt-4">

          <form name="myform" onclick="myClick()" id="form_1" enctype='multipart/form-data' method="POST" action=<?php $_SERVER['PHP_SELF'] ?>>
            <table class="table table py-4">
              <thead class="text-center col-sm-4">
                <tr>
                  <td scope="col" class="text text-dark">NAME</td>
                  <td scope="col" class="text text-dark">IMAGES</td>
                  <td scope="col" class="text text-dark">QUALIFICATION</td>
                  <td scope="col" class="text text-dark">DESICION</td>
                </tr>
              </thead>
              <tbody class="text-center col-sm-4">
                <?php

                while ($row = mysqli_fetch_assoc($result)) {

                  echo   "<tr>";
                  echo "  <td>$row[emp_fname]</td>"; ?>
                  <td><img src="../Employee-Dashboard/image/<?php echo $row['filename']; ?>" width='200' height='150'></td>


              <?php echo "  <td>$row[emp_qulification]</td>";
                  echo "<td>
                  <button type='submit' value='accept' name='accept' class='btn btn-success ms-1'>Aceept</button>
                  <button type='submit' value='reject' name='reject'class ='btn btn-danger ms-1'>Reject</button>
                  </td>";


                  echo " </td>";
                  echo "  </tr>";
                }
              }

              ?>
              <?php
              if (isset($_POST['accept'])) {

                //$query = mysqli_query($conn, "SELECT  job_order_id,job_order_category,job_order_date,status,emp_name,emp_profile,emp_status from job_order,registered_employee
                // where job_order_id=1 and emp_id=1");
                $sql1 = "INSERT INTO registered_employee(emp_name,emp_status,emp_filename,email,nic) SELECT distinct emp_fname,emp_qulification,filename,emp_email,emp_nic from employee,image where t_emp_id=1 and id=1";
                $result1 = mysqli_query($conn, $sql1);

                $sql3 = mysqli_query($conn, "select emp_email from employee where t_emp_id=1");
                $row = mysqli_fetch_assoc($sql3);

                if (!$row) {
                  die("Invalid query" . mysqli_error($conn));
                }
                if (sendmail($row['emp_email'])) {
                  echo "<script> alert('email sent');</script>";
                }
              }
              if (isset($_POST['reject'])) {
                $sql3 = mysqli_query($conn, "select emp_email from employee where t_emp_id=1");
                $row1 = mysqli_fetch_assoc($sql3);

                if (!$row1) {
                  die("Invalid query" . mysqli_error($conn));
                }
                if (sendmail1($row1['emp_email'])) {
                  echo "<script> alert('email sent');</script>";
                }
              }



              ?>

              </tbody>
            </table>
            <!-- </form>
          <form onclick="myClick()" id="form_1" name="form_order_id" action="#" method="post" >              
   <input type="hidden" name="frub_id" value="<?= $order->get_id() ?>" />
   <input type="submit" name="<?= $order->get_id() ?>" value="<?= $order->get_id() . $edit_form1 ?>" />
  </form>!-->
            <script type="text/javascript">
              function myClick() {
                document.getElementById("form_1").style.display = "none";
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