<?php

include('config.php');

// user check already exist in the session table
if (isset($_POST['login'])){

    $username = $_POST['username'];
    // user check already exist in the session table


$result = mysqli_query($conn, "SELECT * FROM sessions WHERE username like '$username' ");
$fetch = mysqli_fetch_assoc($result);

if (!$result) 
{
        die("invalid query".mysqli_error($conn));
            // $_SESSION['session_id']=$fetch['session_id'];
            // $_SESSION['user_id']=$fetch['user_id'];
            // $_SESSION['username']=$fetch['username'];
            // $_SESSION['email']=$fetch['email'];
       
    
}else {   //if any user not found
        
    $username = $_POST['username'];
    // $email    = $_POST['email'];
    $sql4  = "SELECT id from users where username in('$username')";
    $result=mysqli_query($conn,$sql4);
    $row=mysqli_fetch_array($result);


    $sql = "INSERT INTO sessions (user_id,username) VALUES ('$row[id]','$username')";
    $result1=mysqli_query($conn, $sql);

    if($result1){

        $last_id = mysqli_insert_id($conn);

        $_SESSION['session_id']=$last_id;
        $_SESSION['user_id']=$row['id'];
        $_SESSION['username']=$username;
        // $_SESSION['email']=$email;
    }else{
            die("invalied query".mysqli_error($conn));
    }
    }

}


    ?>
       