<?php
extract($_POST);
// define variables and set to empty values
$firstnameErr = $lastnameErr = $addressErr = $postalcodeErr = $nicErr = $mobileErr = "";

//Input fields validation 
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{    
    //firstname validation
    if (empty($first)) {  
        $firstnameErr = "First name is required";  
    } else {  
        $first = test_input($first); 
        if (!preg_match("/^[a-zA-Z]+$/", $first)) {  
            $firstnameErr = "Invalid first name format. Only letters are allowed.";  
        }  
    }
    


   //lastname validation
   if (empty($last)) 
   {  
       $lastnameErr = "lastname is required";  

   } else {  
           $last = test_input($last); 

          // check if lastname only contains only letters
          if (!preg_match("/^[a-z A-Z ]*$/",$last)) {  
           $lastnameErr = "Only alphabets are allowed";  
          }  
  }  
     

        //address Validation  
   if (empty($address)) {  
        $addressErr = "Address is required";  
    } else {  

        $address = test_input($address);  
       // check if address only contains letters and whitespace  
        if (!preg_match("/^[a-z A-Z 0-9 ,#-.\'\/ ]*$/",$address)) {  
           $addressErr= "Only alphabets,numbers and white space are allowed";  
        }  
    }  
     
   
    //postal code Validation  
    if (empty($postal_code)) 
    {  
        $postalcodeErr= "Postal code is required";  

    } else {  
        $postal_code = test_input($postal_code);
        // check if location is well-formed  
        if (!preg_match ("/^[0-9 ]*$/", $postal_code) ) {  
            $postal_code= "Only numbers are allowed.";  
        }  
        //check postal code length should not be less and greator than 5
        if (strlen($postal_code) != 5) {  
             $postalcodeErr = "postal code must contain 5 digits.";  
        }  
    } 

    if (empty($nic)) {  
        $nicErr = "NIC is required";  
    } else {  
        $nic = test_input($nic); 
        if (strlen($nic) == 10) {  
            if (!preg_match("/^[0-9]{9}[vV]{1}$/", $nic)) {  
                $nicErr = "Invalid 10-digit NIC format. Only numbers followed by 'v' or 'V' are allowed.";  
            }  
        } else if (strlen($nic) == 12) {  
            if (!preg_match("/^[0-9]{12}$/", $nic)) {  
                $nicErr = "Invalid 12-digit NIC format. Only numbers are allowed.";  
            }  
        } else {  
            $nicErr = "NIC must contain 10 or 12 digits.";  
        }  
    }
    
    if (empty($mobile_no)) {  
        $mobileErr = "Mobile number is required";  
    } else {  
        $mobile_no = test_input($mobile_no); 
        if (!preg_match("/^[0-9]+$/", $mobile_no)) {  
            $mobileErr = "Invalid mobile number format. Only numbers are allowed.";  
        } else if (strlen($mobile_no) != 10) {  
            $mobileErr = "Mobile number must contain 10  digits.";  
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
