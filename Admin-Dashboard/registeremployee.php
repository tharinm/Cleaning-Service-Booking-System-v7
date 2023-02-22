<?php
session_start();
// print_r($_SESSION);
include_once('../Home-Page/config.php');
ob_start();

if (isset($_GET['id'])) 
    $_SESSION['session_id'] = $_GET['id']; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require('PHPmailer/Exception.php');
require('PHPmailer/SMTP.php');
require('PHPmailer/PHPMailer.php');

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
          
         <?php echo "<li class='active'><a href='registeremployee.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>REGISTER EMPLOYEE</a></li>" ?>
         <?php echo "<li class=''><a href='payment.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>PAYMENT</a></li> " ?>
         <?php echo "<li class=''><a href='work.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>WORKS</a></li> "?>
         <?php echo "<li class=''><a href='emplyoeelist.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>EMPLOYEE LIST</a></li> "?>
         <?php echo "<li class=''><a href='userlist.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>USER LIST</a></li>" ?>
         <?php echo "<li class=''><a href='complaign.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>COMPLAINS</a></li>" ?>
        </ul>


      </div>
      <div class="content">

      <div class="content">
            <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
                <img src="image.png" class="avatar">
                <form method="POST" action="http://localhost/Dcsmsv-5.1%20-%20Copy/Home-Page/index.html">
                    <input type="submit" class="btn btn-secondary default btn" value="Logout" onclick="logOut()" name="logout" />
                </form>
            </nav>

        <div class="registeremp ms-5 px-3 pt-4">

          <form name="myform" onclick="myClick()" id="form_1" enctype='multipart/form-data' method="POST" action=<?php $_SERVER['PHP_SELF'] ?>>
            <table class="table table py-4">
              <thead class="text-center col-sm-4">
                <tr>
                  <td scope="col" class="text text-dark">NAME</td>
                  <td scope="col" class="text text-dark">IMAGES</td>
                  <td scope="col" class="text text-dark">QUALIFICATION</td>
                  <td scope="col" class="text text-dark">Grama Certificate</td>
                  <td scope="col" class="text text-dark">Medi Certificate</td>
                  <td scope="col" class="text text-dark">DESICION</td>
                </tr>
              </thead>
              <tbody class="text-center col-sm-4">
          <?php

            $sql = "SELECT * from employee
            JOIN files ON files.e_id = employee.t_emp_id 
            JOIN medifiles ON medifiles.e_id = employee.t_emp_id group by t_emp_id desc";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) 
            {

                  echo  " <tr>";
                    echo  " <td>$row[emp_fname]</td> ";
                    echo  " <td><img src='../Employee-Dashboard/image/$row[emp_filename]' width='200' height='150'></td> ";
                    echo  " <td>$row[emp_qulification]</td>";      
                    // Modify the "Download" links in the table to include the employee ID
                    echo "<td><a href='registeremployee.php?file_id=$row[id]&emp_id=$row[t_emp_id]'>Download</a></td>";
                    echo "<td><a href='registeremployee.php?file1_id=$row[id]&emp_id=$row[t_emp_id]'>Download</a></td>";
            
                  echo "<td >
                        <form method='post'>
                          <button type='submit' value='accept' name='accept_" . $row['t_emp_id'] . "' class='btn btn-success ms-1'>Accept</button>
                          <button type='submit' value='reject' name='reject_" . $row['t_emp_id'] . "' class ='btn btn-danger ms-1 mt-4'>Reject</button>                       
                        </form>
                        </td>";
                      echo "  </tr>";

                      // Add a conditional to check if the emp_id is set and retrieve the file associated with that employee
              if (isset($_GET['emp_id'])) 
              {
                $emp_id = $_GET['emp_id'];

                if (isset($_GET['file_id'])) 
                {
                    // fetch file to download from database
                    $sql1 = "SELECT * FROM files WHERE e_id=$emp_id";
                    $result1 = mysqli_query($conn, $sql1);
                
                    $file = mysqli_fetch_assoc($result1);
                    $filepath = '../Employee-Dashboard/uploads/' . $file['name'];
                
                    if (file_exists($filepath)) 
                    {
                        // download the file
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename=' . basename($filepath));
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($filepath));
                        readfile($filepath);
                    }                     
                }

                if (isset($_GET['file1_id'])) 
                {
                    // fetch file to download from database
                    $sql2 = "SELECT * FROM medifiles WHERE e_id=$emp_id";
                    $result2 = mysqli_query($conn, $sql2);

                    $file1 = mysqli_fetch_assoc($result2);
                    $filepath1 = '../Employee-Dashboard/mediuploads/' . $file1['name'];

                    if (file_exists($filepath1)) 
                    {
                        // download the file
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename=' . basename($filepath1));
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($filepath1));
                        readfile($filepath1);
                    }
                }
              }
            
              if (isset($_POST['accept_' . $row['t_emp_id']])) 
              {

                  $email= $row['emp_email'];

                  function sendmail($email)
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
                      $mail->addAddress($email);     //Add a recipient
                  
                      //Content
                      $mail->isHTML(true);                                  //Set email format to HTML
                      $mail->Subject = 'Email Verification From My Cleaners Service';
                      $mail->Body    = "Congratulation.Your succesfully Register in mycleners....click this link to login my cleaners...http://localhost/Dcsmsv-5.1%20-%20Copy/Home-Page/log.php";
                  
                      $mail->send();
                      return true;
                    } catch (Exception $e) {
                      return false;
                    }
                  }
                                

                  $sql1 = "INSERT INTO registered_employee(emp_name,emp_status,emp_filename,email,nic) SELECT distinct emp_fname,emp_qulification,emp_filename,emp_email,emp_nic from employee where t_emp_id=$row[t_emp_id]";
                  $result1 = mysqli_query($conn, $sql1);
              
                  if($result1){
                      $last_id=mysqli_insert_id($conn);
                      $update=mysqli_query($conn,"UPDATE admin_employee_registration SET emp_id ='$last_id' where t_emp_id=$row[t_emp_id]");
                  }
                  
                  if (sendmail($row['emp_email'])) {
                    echo "<script> alert('email sent');</script>";
                  }
              }

              if (isset($_POST['reject_' . $row['t_emp_id'] . ''])) 
              {
                $email= $row['emp_email'];
                function sendmail1($email)
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
                    $mail->addAddress($email);     //Add a recipient
                
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Email Verification From My Cleaners Service';
                    $mail->Body    = "You are not registered.Try Again.";
                
                    $mail->send();
                    return true;
                  } catch (Exception $e) {
                    return false;
                  }
                }
                if (sendmail1($row['emp_email'])) {
                      echo "<script> alert('email sent');</script>";
                }
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