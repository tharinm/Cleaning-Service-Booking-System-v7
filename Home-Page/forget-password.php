<?php

include 'config.php';

session_start();
$errors = [];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require('PHPmailer/Exception.php');
require('PHPmailer/SMTP.php');
require('PHPmailer/PHPMailer.php');


function sendemail($email, $reset_token)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'lkmoviesbazaar@gmail.com';                     //SMTP username
        $mail->Password   = 'owabqytypgocglyz';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('lkmoviesbazaar@gmail.com', 'Reset Password');
        $mail->addAddress($email);     //Add a recipient
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reset Password Link from MyCleaners';
        $mail->Body    = "Clik the link to reset your password <a href='http://localhost/Dcsmsv-5.1/Home-Page/reset-password.php?email=$email&token=$reset_token'>reset password</a>";
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

/*if (isset($_SESSION['login'])) {
    header("location: index.php");
} else {*/

if (isset($_POST['reset'])) {
    $email = $_POST['email'];

    $check = "SELECT * FROM `users` WHERE email = '$email'";

    $result = mysqli_query($conn, $check);

    if ($result) {
        $reset_token = bin2hex(random_bytes(10));

        if (mysqli_num_rows($result) == 1) {
            $update = "UPDATE users SET `reset_token`='$reset_token' WHERE email = '$email'";

            if (mysqli_query($conn, $update) && sendemail($email, $reset_token)) {
                echo "<script>alert('Reset Password Link sent to your email')</script>";
            } else {
                echo "<script>alert('server down 002')</script>";
            }
        } else {
            echo "<script>alert('User not register')</script>";
        }
    } else {
        echo "<script>alert('Sever down')</script>";
    }
}
//}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cssform/style.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color:hsla(225,100%,53%,1);
            background-image:
            radial-gradient(at 40% 20%, hsla(28,0%,0%,1) 0px, transparent 50%),
            radial-gradient(at 80% 0%, hsla(189,0%,0%,1) 0px, transparent 50%),
            radial-gradient(at 0% 50%, hsla(355,0%,0%,1) 0px, transparent 50%),
            radial-gradient(at 80% 50%, hsla(340,0%,0%,1) 0px, transparent 50%),
            radial-gradient(at 0% 100%, hsla(22,0%,0%,1) 0px, transparent 50%),
            radial-gradient(at 80% 100%, hsla(242,0%,0%,1) 0px, transparent 50%),
            radial-gradient(at 0% 0%, hsla(343,0%,0%,1) 0px, transparent 50%);
        }
    </style>
</head>

<body>
    <div class="reg ">

        <div class="container">
            <?php if (isset($errorMsg)) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $errors; ?>
                </div>
            <?php } ?>
            <form action="" method="POST">
                <div class="form-reg shadow p-3 mb-5 bg-white rounded">
                    <h5 class="welcome-text text-center text-danger">Forget Password ? </h5>
                    <div class="welcome-form text-center">
                        <input type="email" placeholder="Enter Your Email" class="form-control text-center" name="email" required><br />
                        <input type="submit" name="reset" class="btn btn-danger btn-sm" value="Reset">
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>