<?php
extract($_POST);
include('config.php');

// user check already exist in the session table
if (isset($_POST['login']))
{
    $username = $_POST['username'];
    // user check already exist in the session table
    $check_query = "SELECT * FROM sessions WHERE username like '$username' ";
    $check_result = mysqli_query($conn, $check_query);
    if (!$check_result) 
            die("invalid query".mysqli_error($conn));

    $check_users=mysqli_query($conn,"SELECT role from users WHERE username like '$username' ");
    $fetch_role=mysqli_fetch_array($check_users);

    if(!empty($fetch_role) && $fetch_role['role']=='user' )
    {
        
        if(mysqli_num_rows($check_result)>0){
            $fetch = mysqli_fetch_assoc($check_result);
            $_SESSION['session_id']=$fetch['session_id'];
            $check_result1=mysqli_query($conn,"SELECT cus_id from customer WHERE user_name like '$username' ");
            $fetch1=mysqli_fetch_assoc($check_result1);
            $_SESSION['cus_id']=$fetch1['cus_id'];
            if (!$check_result1) {
                die("invalid query".mysqli_error($conn));
            }

        }else {
            
            $get_user_query = "SELECT id from users where username = '$username'";
            $get_user_result = mysqli_query($conn,$get_user_query);
            if (!$get_user_result) {
                die("invalid query".mysqli_error($conn));
            }
            if(mysqli_num_rows($get_user_result)>0){
                $row=mysqli_fetch_array($get_user_result);
                $sql = "INSERT INTO sessions (user_id,username) VALUES ('$row[id]','$username')";
                $result=mysqli_query($conn, $sql);
                if($result){
                    $last_id = mysqli_insert_id($conn);
                    $_SESSION['session_id']=$last_id;
                    $check_result2=mysqli_query($conn,"SELECT cus_id from customer WHERE user_name like '$username' ");
                    $fetch2=mysqli_fetch_array($check_result2);

                    if($check_result2)
                    $_SESSION['cus_id']=$fetch2['cus_id'];

                    // $_SESSION['job_order_id']=1;
                    // $_SESSION['username']=$username;
                }else{
                    die("invalied query".mysqli_error($conn));
                }
            }
        } 

    }else if(!empty($fetch_role) && $fetch_role['role']=='employee'){

        $check_emp=mysqli_query($conn,"SELECT emp_id from registered_employee WHERE emp_name like '$username' ");
        $empid=mysqli_fetch_array($check_emp);
        // if(empty($empid))
        // {
            if(mysqli_num_rows($check_result)>0)
            {
                $fetch_emp= mysqli_fetch_assoc($check_result);
                $_SESSION['session_id']=$fetch_emp['session_id'];
                $check_result3=mysqli_query($conn,"SELECT t_emp_id from employee WHERE user_name like '$username' ");
                $fetch3=mysqli_fetch_assoc($check_result3);
                $_SESSION['cus_id']=$fetch3['t_emp_id'];
                if (!$check_result3) 
                    die("invalid query".mysqli_error($conn));
                
            }else {

                $get_t_emp_query = "SELECT id from users where username = '$username'";
                $get_t_emp_result = mysqli_query($conn,$get_t_emp_query);
                if (!$get_t_emp_result) 
                    die("invalid query".mysqli_error($conn));
                
                if(mysqli_num_rows($get_t_emp_result)>0)
                {
                    $row1=mysqli_fetch_array($get_t_emp_result);
                    $sql1 = "INSERT INTO sessions (user_id,username) VALUES ('$row1[id]','$username')";
                    $result1=mysqli_query($conn, $sql1);
                    if($result1){
                        $last_id1 = mysqli_insert_id($conn);
                        $_SESSION['session_id']=$last_id1;
                        $check_result4=mysqli_query($conn,"SELECT t_emp_id from employee WHERE user_name like '$username' ");
                        $fetch4=mysqli_fetch_array($check_result4);

                        if($check_result4)
                        $_SESSION['cus_id']=$fetch4['t_emp_id'];

                    }else{
                        die("invalied query".mysqli_error($conn));
                    }
                }   
            }
         }else{

            if(mysqli_num_rows($check_result)>0){
                $fetch = mysqli_fetch_assoc($check_result);
                $_SESSION['session_id']=$fetch['session_id'];
                
         }
    }
}

?>
