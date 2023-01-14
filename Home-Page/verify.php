<?php

    include "config.php";

    $email = $_GET['email'];
    $v_code = $_GET['v_code'];

    if(isset($email)&&isset($v_code))
    {
        $check = "SELECT * FROM users WHERE email= '$email' AND v_code= '$v_code'";

        $result = mysqli_query($conn, $check);

        if($result)
        {
            if(mysqli_num_rows($result)==1) // if any user found
            {
                $fetch = mysqli_fetch_assoc($result);

                if($fetch['v_user']==0)
                {
                    $update = "UPDATE users SET `v_user`='1' WHERE email = '$fetch[email]'";

                    if(mysqli_query($conn,$update))
                    {
                        echo "<script>alert('Email Verify Now You can login')</script>";
                        header("refresh:0; url=log.php");
                    }

                    else
                        {
                            echo "<script>alert('server down')</script>";
                        }


                }

                else
                {
                    echo "<script>alert('Email Already Verify')</script>";
                    header("refresh:0; url=log.php");
                }
            }
        }

        else
        {
            echo "<script>alert('server down')</script>";
        }
    }

?>