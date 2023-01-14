<?php
// session_start();
include_once('../Home-Page/config.php');
include('validate2.php');

if (isset($_POST['submit'])) {
  if ($qualificationErr ==  "" && $nicErr == "" && $emailErr == "") {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname =  mysqli_real_escape_string($conn, $_POST['lname']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email =  mysqli_real_escape_string($conn, $_POST['email']);
    $postalcode = mysqli_real_escape_string($conn, $_POST['postalcode']);
    // $bankname=  mysqli_real_escape_string($conn,$_POST['bankname']);
    // $bankaccno =  mysqli_real_escape_string($conn,$_POST['bankacc']);
    $nic =  mysqli_real_escape_string($conn, $_POST['nic']);
    $qualification =  mysqli_real_escape_string($conn, $_POST['qualification']);

    $chk = "";
    $checkbox1 = $_POST['techno'];
    foreach ($checkbox1 as $chk1) {
      $chk .= $chk1 . ",";
    }
    $query = "UPDATE employee SET emp_fname='$fname',emp_lname='$lname',emp_address='$address',emp_nic='$nic',emp_postalcode='$postalcode',emp_categories='$chk',emp_qulification='$qualification' WHERE t_emp_id=1";
    $statement = mysqli_query($conn, $query);
    if (!$statement) {
      die("invalid query" . mysqli_error($conn));
    } else {
      echo "<script>alert('Profile updated succesfully');</script>";
      header("refresh: 0; url=http://localhost/Dcsmsv-5.1/Employee-Dashboard/findjob.php");
    }
  } else {

    echo "<h3 class='error' align='center'>your Update Profile isn't Uploaded!!! please fill the details correctly....!!!!</h3>";
  }
  mysqli_close($conn);
}
?>

<?php
error_reporting(0);

$msg = "";

// If upload button is clicked ...
if (isset($_POST['submit'])) {

  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];
  $folder = "./image/" . $filename;

  $db = mysqli_connect("localhost", "root", "", "dcsms5");

  // Get all the submitted data from the form
  $sql = "INSERT INTO image (filename) VALUES ('$filename')";

  // Execute query
  mysqli_query($db, $sql);

  // Now let's move the uploaded image into the folder: image
  if (move_uploaded_file($tempname, $folder)) {
    // echo "<h3>  Image uploaded successfully!</h3>";
  } else {
    // echo "<h3>  Failed to upload image!</h3>";
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

  <!--bootstrap css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="CSS/update.css">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    .error {
      color: #FF0001;
    }

    .navbar {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      align-items: center;
      padding: 5px;
    }

    .avatar {
      width: 40px;
    }
  </style>

</head>

<body>

  <div class="main-container d-flex">
    <div class="sidebar " id="side_nav">
      <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
        <h1 class="fs-4 ms-2 name"><span class="text">DCSMS</span></h1>
        <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
      </div>


      <ul class="list-unstyled px-2 ">
        <li class=""><a href="findjob.php" class="text-decoration-none px-3 py-3 d-block">FIND JOB</a></li>
        <li class=""><a href="pending.php" class="text-decoration-none px-3 py-3 d-block">MY WORK</a></li>


        <li class=""><a href="resheduled.php" class="text-decoration-none px-3 py-3 d-block">RESHEDULED</a></li>
        <li class=""><a href="map.html" class="text-decoration-none px-3 py-3 d-block">VIEW ON MAP</a></li>
        <li class=""><a href="cancel.php" class="text-decoration-none px-3 py-3 d-block">CANCEL JOB</a></li>
        <li class=""><a href="store.php" class="text-decoration-none px-3 py-3 d-block">REWARDS</a></li>
        <li class=""><a href="history.php" class="text-decoration-none px-3 py-3 d-block">HISTORY</a></li>

        <li class="active"><a href="updated.php" class="text-decoration-none px-3 py-3 d-block">UPDATE PROFILE</a></li>

      </ul>


    </div>
    <div class="content">
      <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
        <img src="image.png" class="avatar">
        <input type="submit" class="btn btn-secondary default btn  " value="Logout" onclick="window.location.href='../Home-Page/index.html'" name="logout" />
      </nav>
      <div class="dashboard-content ms-5 px-3 pt-4">
        <div class="container mt-3 ms-2">


          <div class="dashboard-content ms-5 px-3 pt-4">

            <div class="container">
              <form class="form-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype='multipart/form-data'>

                <div class="row jumbotron">
                  <div class="col-sm-6 mb-4">
                    <label>First Name</label>
                    <input type="text" class="form-control " name="fname">
                  </div>


                  <div class="col-sm-6 mb-4">
                    <label>Last Name</label>
                    <input type="text" class="form-control " name="lname">
                  </div>

                  <div class="col-sm-6 mb-4">
                    <label>Address</label>
                    <input type="text" class="form-control " placeholder="Street-1" name="address">

                  </div>

                  <div class="col-sm-6 mb-4">
                    <!-- <label> Bank Name & Account number </label> -->
                    <!-- <input type="text" class="form-control " placeholder="Name" name="bankname"> -->
                  </div>


                  <div class="col-sm-6 mb-4">

                    <input type="text" class="form-control" placeholder="postel-code" name="postalcode">
                  </div>


                  <div class="col-sm-6 mb-4">
                    <!-- <input type="text" class="form-control" placeholder="Acc num" name="bankacc"> -->

                  </div>


                  <div class="col-sm-6 mb-4">
                    <label>Work Type</label><br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="greenclean" name="techno[]">
                      <label class="form-check-label" for="inlineCheckbox1">Green Cleaning</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="indoorclean" name="techno[]">
                      <label class="form-check-label" for="inlineCheckbox2">Indoor Cleaning</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="outdoorclean" name="techno[]">
                      <label class="form-check-label" for="inlineCheckbox3">Outdoor Cleaning</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="specialclean" name="techno[]">
                      <label class="form-check-label" for="inlineCheckbox3">Special Type Cleaning</label>
                    </div>
                  </div>


                  <div class="col-sm-6 mb-4">



                    <label class="mt-2"></label>
                    <select class="form-select" aria-label="" name="qualification">
                      <option selected>Work Status</option>
                      <option value="Currently Working In cleaning service">Currently Working In cleaning service</option>
                      <option value="Worked in cleaning service">Worked in cleaning service</option>
                      <option value="Other">Other</option>
                    </select>
                    <span class="error">* <?php echo   $qualificationErr; ?> </span>
                    <br>

                  </div>



                  <div class="col-sm-6 mb-4">

                    <div class="upload">
                      <label>Please Upload proof documents</label>
                      <button type="button" class="btn1" name="button">
                        <i class="fa fa-upload"></i>Upload
                        <input type="file" name='image2'>
                      </button>
                    </div>
                  </div>


                  <div class="col-sm-6 mb-4">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Email address" name="email" required>
                    <span class="error">* <?php echo $emailErr; ?> </span>
                    <br>
                  </div>

                  <div class="col-sm-6 mb-4">
                    <label>NIC</label>
                    <input type="text" class="form-control" placeholder="NIC Number" name="nic" required>
                    <span class="error">* <?php echo $nicErr; ?> </span>
                  </div>


                  <div class="col-sm-6 mb-4">
                    <label>Profile photo</label>

                    <div class="form-group">
                      <input class="form-control" type="file" name="uploadfile" value="" />
                    </div>

                  </div>

                  <div class="col-sm-12 mb-4" style=" text-align: right; margin-top: 20px;">
                    <label> </label>

                    <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-md col-sm-1">
                  </div>




                </div>

              </form>
            </div>
          </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/c752b78af3.js" crossorigin="anonymous"></script>


        <script>
          $(".sidebar ul li").on('click', function() {
            $(".sidebar ul li.active").removeClass('active');
            $(this).addClass('active');

          })

          $('.open-btn').on('click', function() {
            $('.sidebar').addClass('active');
          })

          $('.close-btn').on('click', function() {
            $('.sidebar').removeClass('active');
          })
        </script>


</body>

</html>