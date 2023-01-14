<?php
extract($_POST);

// define variables and set to empty values
$categoryErr = $dateErr = $noteErr = $locationErr = $addressErr = "";


//Input fields validation 
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
    //category validation
    if(!empty($category_name) && ($category_name == 'select'  ))
    {
        $categoryErr = "Select a valid work type";
    }else{
        $category_name = test_input($category_name);

    }
     
             //date validation
    $d = DateTime::createFromFormat('m/d/Y', $date);

    if ($d && $d->format('m/d/Y') !== $date) 
    {
                $dateErr="date isn't valid";
    }else{
               $date = test_input($date);
    }
    
   /* if(!checkdate($_POST['date']))
    {
        $dateErr="Not a valid date";
    }else{
        $date = test_input($_POST['date']);
        //echo "valid date"
    }*/
  
             //special note Validation  
    if (empty($note)) 
    {  
        $noteErr = "Special note is required";  
    } else {  
        $note = test_input($note); 
           // check if special note only contains letters, whitespace  and numbers
           if (!preg_match("/^[a-z A-Z 0-9 ,#-\'\/ ]*$/",$note)) {  
               $noteErr= "Only alphabets,numbers and white space are allowed";  
           }  
   }  

   //postal code Validation  
    if (empty($location)) 
    {  
        $locationErr= "Postal code is required";  
    } else {  
        $location = test_input($location);
        // check if location is well-formed  
        if (!preg_match ("/^[a-z A-Z ]*$/", $location) ) {  
            $locationErr= "Only string value is allowed.";  
        }  
        //check postal code length should not be less and greator than 5
        // if (strlen($postal_code) != 5) {  
            //  $postalcodeErr = "postal code must contain 5 digits.";  
        // }  
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
 
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
