<?php
session_start();
include('config.php');

$erorrs = [];

include('sessions.php');

if (isset($_SESSION['session_id'])) {
    if (isset($_POST['login'])) {
    
        $username = $_POST['username'];
        $password  = $_POST['password'];
        $role = $_POST['role'];
        
        $sql = "SELECT * FROM `users`  where (username = '$username' OR email = '$username') AND role = '$role'";

        $result = mysqli_query($conn, $sql);
        // $row=mysqli_fetch_assoc($result);
        // $_SERVER['email']=$row['email'];
        if ($result) {
            if (mysqli_num_rows($result) == 1) {

                $fetch = mysqli_fetch_assoc($result);

                if (password_verify($_POST['password'], $fetch['password'])) {
                    if ($fetch['v_user'] == 1 && $fetch['role'] == 'user') {
                        //   $_SESSION['login'] = true;
                        // $_SESSION['name'] = $fetch['name'];
                        echo "<script> alert('Login Successfully');</script>";
                        header("refresh: 0; http://localhost/Dcsmsv-5.1%20-%20Copy/Customer-Dashboard/updateprofile.php");
                    } elseif ($fetch['v_user'] == 1 && $fetch['role'] == 'employee') {
                        //  $_SESSION['login'] = true;
                        // $_SESSION['name'] = $fetch['name'];
                        echo "<script> alert('Login Successfully');</script>";
                        header("refresh: 0; http://localhost/Dcsmsv-5.1%20-%20Copy/Employee-Dashboard/updated.php?username=".$username);
                    } elseif ($fetch['v_user'] == 1 && $fetch['role'] == 'admin') {
                        //  $_SESSION['login'] = true;
                        // $_SESSION['name'] = $fetch['name'];
                        echo "<script> alert('Login Successfully');</script>";
                        header("refresh: 0; http://localhost/Dcsmsv-5.1%20-%20Copy/Admin-Dashboard/registeremployee.php");
                    } else {
                        echo "<script>alert('User Not Verified Please Check Your Mail')</script>";
                    }
                } else // if pass not match
                {
                    echo "<script> alert('invalid password');</script>";
                }
            } else // if a user not found
            {
                echo "<script> alert('user not found');</script>";
            }
        } else {
            echo "<script> alert('Query Faild....001');</script>";
        }
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
    <!-- <link rel="stylesheet" href="css/style1.css" /> -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <!--Load Bootsrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>


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
            <form action="log.php" method="POST">
                <div class="form-reg shadow p-3 mb-5 bg-white rounded">
                    <h5 class="welcome-text text-center text-primary">WELCOME BACK</h5>
                    <div class="welcome-form text-center">
                        <input type="text" placeholder="Username or Email Address" class="form-control" name="username" required><br />
                        <input type="password" placeholder="Password" class="form-control" name="password" required><br>
                        <select class="form-select mt-1" name="role">
                            <option value="user">User</option>
                            <option value="employee">Employee</option>
                            <option value="admin">Admin</option>
                        </select>
                        </select>
                        <input type="submit" name="login" class="click btn btn-primary mt-3" value="Login">
                        <p class="text-center text-muted mt-3 mb-0">Not Registered ?
                            <a href="reg.php"><u>Create an account</u></a><br>
                            <a id="btn" class="text-danger " href="forget-password.php" style="font-size: 15px;">Forget Password</a>
                        </p>


                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>