<?php

include "config.php";

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require('PHPmailer/Exception.php');
require('PHPmailer/SMTP.php');
require('PHPmailer/PHPMailer.php');

function sendmail($email, $v_code)
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
        $mail->Body    = "Click the link to verify the email address <a href='http://localhost/Dcsmsv-5.1%20-%20Copy/Home-Page/verify.php?email=$email&v_code=$v_code'>Click Here</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

$errors = [];


if (isset($_POST['register'])) {
    /* if (empty($_POST['username'])) {
            $errors['username'] = 'Username required';
        }
        if (empty($_POST['email'])) {
            $errors['email'] = 'Email required';
        }
        if (empty($_POST['password'])) {
            $errors['password'] = 'Password required';
        }
        if (isset($_POST['password']) && $_POST['password'] == $_POST['cpassword']) {
            $errors['cpassword'] = 'The two passwords do not match';
        } */



    // user check already exist in the database
    $check = "SELECT * FROM `users` WHERE username = '$_POST[username]' OR email = '$_POST[email]'";

    $result = mysqli_query($conn, $check);

    if ($result) {
        if (mysqli_num_rows($result) > 0)   //if any user find
        {
            $fetch = mysqli_fetch_assoc($result);

            if ($fetch['username'] == $_POST['username']) {
                // echo "<script>
                //   alert('$_POST[username] - username is already taken');
                // </script>
                //   ";
                $errors[] = ' Sorry Username Already Taken';
            } else {
                echo "<script> alert('$_POST[email] -  email is already register');</script>";
            }
        } else  //if any user not found
        {
            $username = $_POST['username'];
            $email    = $_POST['email'];
            $mobile   = $_POST['mobile'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $role     = $_POST['role'];
            $v_code = bin2hex(random_bytes(16));

            $sql = "INSERT INTO users (username,email,mobile,password,role,v_code,v_user) VALUES ('$username','$email','$mobile','$password','$role', '$v_code', '0')";


            if(mysqli_query($conn, $sql)&& sendmail($email, $v_code))
            {
                    echo "<script> alert('Account created - Please Check Verify Your email');</script>";
                   
            
                     if($role=='user')
                    {
                     $sql1= "INSERT INTO customer(user_name,email) VALUES('$username','$email')";
                     mysqli_query($conn,$sql1);
                    }

                    else if($role=='employee')
                    {
                     $sql2= "INSERT INTO employee(user_name,emp_email)VALUES('$username','$email')";
                     mysqli_query($conn,$sql2);
                    }
             }
            else 
            {
                echo "<script> alert('query faild.!!!! 002');</script>";
            }
        }
    }

    else{
        echo "<script> alert('Query Faild....! 0001');</script>";
    }
}



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
            background-color: hsla(225, 100%, 53%, 1);
            background-image:
                radial-gradient(at 40% 20%, hsla(28, 0%, 0%, 1) 0px, transparent 50%),
                radial-gradient(at 80% 0%, hsla(189, 0%, 0%, 1) 0px, transparent 50%),
                radial-gradient(at 0% 50%, hsla(355, 0%, 0%, 1) 0px, transparent 50%),
                radial-gradient(at 80% 50%, hsla(340, 0%, 0%, 1) 0px, transparent 50%),
                radial-gradient(at 0% 100%, hsla(22, 0%, 0%, 1) 0px, transparent 50%),
                radial-gradient(at 80% 100%, hsla(242, 0%, 0%, 1) 0px, transparent 50%),
                radial-gradient(at 0% 0%, hsla(343, 0%, 0%, 1) 0px, transparent 50%);
        }
    </style>
</head>

<body>
    <div class="reg">

        <div class="container">
            <div class="form-reg form-reg shadow p-3 mb-5 bg-white rounded">
                <?php if (count($errors) > 0) : ?>
                    <div class="alert alert-danger text-center">
                        <?php foreach ($errors as $error) : ?>
                            <?php echo $error; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="POST">
                    <h5 class="welcome-text text-center ">CREATE AN ACCOUNT</h5>
                    <div class="welcome-form text-center">
                        <input type="text" placeholder="Username" name="username" class="form-control" required><br />
                        <input type="email" placeholder="Email" name="email" class="form-control" required><br />
                        <input type="text" placeholder="Mobile Number" name="mobile" class="form-control" required><br>
                        <input type="password" placeholder="Password" name="password" class="form-control"><br />
                        <input type="password" placeholder="Confirm Password" name="cpassword" class="form-control">
                        <select class="form-select" name="role">
                            <option value="user">User</option>
                            <option value="employee">Employee</option>
                            <option value="admin">Admin</option>
                        </select>
                        <label class="text text-center"><a href="term.html">Agree to Terms of Service</a></label>
                        <input type="checkbox" name="agree" required><br>
                        <input type="submit" name="register" value="Register" class="btn btn-primary mt-3">

                        <p class="text-center text-muted mt-3 mb-0">Have already an account? <a href="#!" class=" text-body " style="color:blue"><a href="log.php"><u>Login here</u></a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>