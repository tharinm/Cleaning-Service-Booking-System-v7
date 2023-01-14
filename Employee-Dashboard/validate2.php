<?php
extract($_POST);

$qualificationErr =  $nicErr = $emailErr ="";

//Input fields validation
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   
    //qualification validation
    if(!empty( $qualification) && ( $qualification == 'select'  ))
    {
        $qualificationErr = "Select a valid work type";
    }else{
        $qualification = test_input( $qualification);

    }

     //NIC code Validation  
     if (empty($nic))
     {  
         $nic= "NIC code is required";  
     } else {  
         $nic = test_input($nic);
         // check if NIC code is well-formed  
         if (!preg_match ("/^[A-Z 0-9]*$/", $nic) ) {  
             $nicErr = "Only numeric values and V are allowed.";  
         }  
         //check NIC code length should not be less and greator than 10
         if (strlen($nic) != 10) {  
             $nicErr = "NIC code must contain 10 digits.";  
         }  
     }

     if (empty($email))
     {  
         $nic= "Email code is required";  
     } else {  
         $email = test_input($email);
         // check if Email code is well-formed  
           
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
            $emailErr = "Invalid email format";
            }
         }  
     
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
 
  ?>