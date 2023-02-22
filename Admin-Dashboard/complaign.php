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
        <link rel="stylesheet" href="CSS/complaign.css">

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    </head>

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
                    <?php echo "<li class=''><a href='emplyoeelist.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>EMPLOYEE LIST</a></li> "?>
                    <?php echo "<li class=''><a href='userlist.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>USER LIST</a></li>" ?>
                    <?php echo "<li class='active'><a href='complaign.php?id=".$_SESSION['session_id']."' class='text-decoration-none px-3 py-3 d-block'>COMPLAINS</a></li>" ?>

                </ul>


            </div>
            <div class="content">
            <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
                <img src="image.png" class="avatar">
                <form method="POST" action="http://localhost/Dcsmsv-5.1%20-%20Copy/Home-Page/index.html">
                    <input type="submit" class="btn btn-secondary default btn" value="Logout" onclick="logOut()" name="logout" />
                </form>
            </nav>

    <div class="dashboard-content ms-5 px-3 pt-4">
        <form class="form-group">
            
        <?php
        $sql = "SELECT * FROM complain 
                join job_order on job_order.job_order_id=complain.order_id GROUP BY order_id desc";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Invalid query" . mysqli_error($conn));
        } else {
            while ($row = mysqli_fetch_assoc($result)) 
            {                   
                if (!empty($row))
                {                                 
        ?>
    <table class="table table-borderless justify-content-center">
        <thead></thead>
        <tbody>
            <tr>
                <td>
                    <p><strong>Order ID:<?php echo $row['order_id']; ?></strong></p>
                    <textarea class="form-control z-depth-1" id="exampleFormControlTextarea1" rows="5" cols="50" readonly ><?php echo $row['complain_description']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="col-sm-12 mb-4" style=" text-align: right; margin-top: 20px;">
                        <label></label>
                        <div class="container">
                            <!-- Button trigger modal -->
                            <button type='button' name="accept" class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal<?php echo $row['order_id']; ?>'>TAKE AN ACCTION</button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $row['order_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-fullscreen-sm-down">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text text-danger" id="exampleModalLabel">Emlpoyee ID : <?php echo $row['aemp_id']; ?></h5>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary align-center col-sm-6" data-bs-dismiss="modal" id="ok-button-<?php echo $row['order_id']; ?>" href="http://localhost/Dcsmsv-5.1%20-%20Copy/Admin-Dashboard/emplyoeelist.php">OK</button>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
<?php
        }
    }  
}
?>
                    
        </form>
        </div>

    </div>
 </div>
 <script>
    // add a click event listener to all OK buttons
    var okButtons = document.querySelectorAll('[id^="ok-button-"]');
    for (var i = 0; i < okButtons.length; i++) {
        okButtons[i].addEventListener('click', function() {
            // get the URL of the page to load from the button's href attribute
            var pageUrl = this.getAttribute('href');

            // redirect to the page
            window.location.href = pageUrl;
        });
    }
</script>

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