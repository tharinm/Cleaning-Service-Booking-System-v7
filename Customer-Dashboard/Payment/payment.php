<?php
include_once('../../Home-page/config.php');
session_start();


if(isset($_POST['submit']))
{


  $bankname= mysqli_real_escape_string($conn,$_POST['bname']); 
  $bankaccount  = mysqli_real_escape_string($conn, $_POST['acc']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  


  $sql="INSERT INTO customer_bank_details(bank_name,bank_acc,cb_email) VALUES('$bankname','$bankaccount','$email')";
  $result1=mysqli_query($conn,$sql);

  $result2=mysqli_query($conn,"SELECT a_emp_id,a_order_id from job_accepted_emp where role='user' or mobile=$mobile");
  $row=mysqli_fetch_array($result2);
  

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="container">

        <form method="POST" action="">

            <div class="row">

                <div class="col">

                    <h3 class="title">billing address</h3>

                    <div class="inputBox">
                        <span>full name :</span>
                        <input type="text" placeholder="Tharindu Madhushan" >
                    </div>
                    <div class="inputBox">
                        <span>email :</span>
                        <input type="email" placeholder="example@example.com" name="email">
                    </div>
                    <div class="inputBox">
                        <span>Bank Name :</span>
                        <input type="text" placeholder="Type your bank name" name="bname">
                    </div>
                    <div class="inputBox">
                        <span>Bank Acc Number :</span>
                        <input type="text" placeholder=""  name="acc">
                    </div>
                    <div class="inputBox">
                        <span>Amout :</span>
                        <input type="text" placeholder="Rs 500" readonly>
                    </div>
                   </div>

                <div class="col">

                    <h3 class="title">payment</h3>

                    <div class="inputBox">
                        <span>cards accepted :</span>
                        <img src="images/card_img.png" alt="">
                    </div>
                    <div class="inputBox">
                        <span>name on card :</span>
                        <input type="text" placeholder="T .Madhushan">
                    </div>
                    <div class="inputBox">
                        <span>credit card number :</span>
                        <input type="text" placeholder="1111-2222-3333-4444">
                    </div>
                    <div class="inputBox">
                        <span>exp month :</span>
                        <input type="text" placeholder="january">
                    </div>

                    <div class="flex">
                        <div class="inputBox">
                            <span>exp year :</span>
                            <input type="number" placeholder="2022">
                        </div>
                        <div class="inputBox">
                            <span>CVV :</span>
                            <input type="text" placeholder="134">
                        </div>
                    </div>

                </div>

            </div>

            <input type="submit" value="proceed to checkout" class="submit-btn" name="submit">

        </form>

    </div>

</body>

</html>