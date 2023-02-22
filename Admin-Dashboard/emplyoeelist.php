<?php
session_start();
include_once('../Home-page/config.php');

if (isset($_GET['id'])) 
    $_SESSION['session_id'] = $_GET['id']; 

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
        <link rel="stylesheet" href="CSS/employeelist.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <style>

    </style>

    <body>

        <div class="main-container d-flex">
            <div class="sidebar " id="side_nav">
                <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                    <h1 class="fs-4 ms-2 name"><span class="text">DCSMS</span></h1>
                    <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
                </div>

                <ul class="list-unstyled px-2 ">
                    <?php echo "<li class=''><a href='registeremployee.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>REGISTER EMPLOYEE</a></li>" ?>
                    <?php echo "<li class=''><a href='payment.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>PAYMENT</a></li> " ?>
                    <?php echo "<li class=''><a href='work.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>WORKS</a></li> "?>
                    <?php echo "<li class='active'><a href='emplyoeelist.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>EMPLOYEE LIST</a></li> "?>
                    <?php echo "<li class=''><a href='userlist.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>USER LIST</a></li>" ?>
                    <?php echo "<li class=''><a href='complaign.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>COMPLAINS</a></li>" ?>
                </ul>

            </div>
            <script>
                    function updatePoints() {
                    // get the value of the point field and the current points value from the table cell
                    var point = document.querySelector('#point').value;
                    var currentPoint = document.querySelector('#empPoints').innerHTML;
                    // var emp_id = document.querySelector('#emp_id').value;
                    var empid = document.querySelector('#empid').innerHTML;

                    // send an AJAX request to the server
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'update.php');
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                        // if the update was successful, update the points on the page
                        document.querySelector('#empPoints').innerHTML = xhr.responseText;
                        } else {
                        // if the update failed, display an error message
                        alert('Failed to update points: ' + xhr.responseText);
                        }
                    };
                    xhr.send('point=' + point + '&currentPoint=' + currentPoint + '&empid=' + empid);
                    }
           
            </script>

            <div class="content">
                <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
                    <div class="search" align="left">
                        <form id="search-form">
                            <label for="search">Enter search term:</label>
                            <input type="text" id="search" name="search">
                            <input type="submit" value="Search">
                        </form>
                    </div>

                    <img src="image.png" class="avatar">
                    <form method="POST" action="http://localhost/Dcsmsv-5.1%20-%20Copy/Home-Page/index.html">
                        <input type="submit" class="btn btn-secondary default btn" value="Logout" onclick="logOut()" name="logout" />
                    </form>

                </nav>

                <script>
                $(document).ready(function() {
                    $('#search-form').submit(function(event) {
                    // Prevent form submission
                    event.preventDefault();

                    // Get search query
                    var search = $('#search').val();

                    // Send AJAX request to search.php
                    $.ajax({
                        url: 'empsearch.php',
                        type: 'POST',
                        data: { search: search },
                        success: function(response) {
                        // Display search results
                        $('#results').html(response);
                        }
                    });
                    });
                });

                </script>
               
                <div id="results">
                    
                </div>

                <div class="registeremp ms-5 px-3 pt-4">
                <form class="form-group">

                    <table class="table">
                        <thead>
                            <tr class="col-sm-2">
                                <td class="text text-dark" style="">EMPLOYEE ID</td>
                                <td class="text text-dark ">EMPLOYEE NAME</td>
                                <td class="text text-dark  ">IMAGE</td>
                                <td class="text text-dark  ">NIC</td>
                                <td class="text text-dark  ">Email</td>
                                <td class="text text-dark  ">POINTS</td>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * from registered_employee ";
                                $result = mysqli_query($conn, $sql);
                                if (!$result) {
                                    die("Invalid query" . mysqli_error($conn));
                                } else {
                                while ($row = mysqli_fetch_assoc($result)) {

                                    echo   "<tr>";
                                    echo "  <td id='empid'>$row[emp_id]</td>";
                                    echo "  <td>$row[emp_name]</td>"; ?>
                                <td><img src="../Employee-Dashboard/image/<?php echo $row['emp_filename']; ?>" width='150' height='130'>
                                    <?php
                                    echo "  <td>$row[nic]</td>";
                                    echo "  <td>$row[email]</td>";
                                    echo "  <td id='empPoints'>$row[emp_points]</td>";

                                    echo "  </tr>";

                                    echo "<td></td>
                                    <td>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td> 
                                    <p class='text-center lead'> <button type='button' name='edit_" . $row['emp_id'] . "' class='btn btn-primary btn-sm'  data-bs-toggle='modal' data-bs-target='#exampleModal'>EDIT</button></p>" ; 
                                    ?>

                                    <form method="POST">
                                        <button type='submit' value='Remove' name='remove' class='btn btn-danger ms-1'>Remove</button>
                                    </form>
                            <?php
                                    echo "</td>";
                                  echo " </td>";
                                    echo "  </tr>";
                                    ?>
                                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-fullscreen-sm-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change Employee Points</h5>

                                </div>

                                <div class="modal-body">
                                <form onsubmit="updatePoints(); return false;">
                                        <lable>Point :</lable> <input type="text" class="form-control modal-md" name="point" id="point" value=" ">
                                        <input type="hidden" name="emp_id" value="<?php echo $row['emp_id']; ?>" id="emp_id">

                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="edit">Edit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                
                      <?php }} ?>  
                        </tbody>
                    </table>

                    
                <?php
                if (isset($_POST['remove'])) {


                    $sql3 = "INSERT INTO bannded_employee(bandded_emp_name,bandded_emp_email,bandded_emp_nic) SELECT  emp_name,email,nic from registered_employee where emp_id=1 ";
                    $result3 = mysqli_query($conn, $sql3);
                }
                ?>




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
        <script>

            function logOut() {
                    // Send an HTTP POST request to the logout.php script
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'logout.php');
                    xhr.send();

                    console.log('Redirecting to index.html');
                    window.location.href='../Home-Page/index.html';
            }

        </script>


    </body>

    </html>