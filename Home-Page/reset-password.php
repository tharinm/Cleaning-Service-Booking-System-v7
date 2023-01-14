<?php

include 'config.php';
session_start();

/*if(isset($_SESSION['login']))
{
    header("location: index.php");
}

else
{ */
$email = $_GET['email'];
$token = $_GET['token'];

if (isset($email) && isset($token)) {
    if (isset($_POST['reset'])) {
        $check = "SELECT * FROM `users` WHERE email ='$email' AND reset_token = '$token'";

        $result = mysqli_query($conn, $check);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $fetch = mysqli_fetch_assoc($result);

                if ($fetch['reset_token'] == $token) {
                    $update = "UPDATE `users` SET `password`='$pass',`reset_token`= NULL WHERE email = '$email'";

                    if (mysqli_query($conn, $update)) {
                        echo "<script>alert('Your Password Has Been Chnaged')</script>";
                        header("refresh:0; url=log.php");
                    } else {
                        echo "<script>alert('server down')</script>";
                    }
                }
            } else {
                echo "<script>alert('link Expire')</script>";
                header("refresh:0; url=log.php");
            }
        } else {
            echo "<script>alert('server down')</script>";
        }
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
                    <h5 class="welcome-text text-center text-primary">Reset Password</h5>
                    <div class="welcome-form text-center">
                        <input type="Password" placeholder="Enter New Password" class="form-control text-center" name="password" required><br />
                        <input type="submit" name="reset" class="btn btn-primary btn-sm" value="Reset">
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>