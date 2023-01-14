<?php
include_once('../Home-page/config.php');
$sql = "SELECT complain_id,order_id,complain_description FROM complain";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Invalid query" . mysqli_error($conn));
} else {

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
                    <li class=""><a href="registeremployee.php" class="text-decoration-none px-3 py-3 d-block">REGISTER EMPLOYEE</a></li>
                    <li class=""><a href="payment.php" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li>
                    <li class=""><a href="work.php" class="text-decoration-none px-3 py-3 d-block">WORKS</a></li>
                    <li class=""><a href="emplyoeelist.php" class="text-decoration-none px-3 py-3 d-block">EMPLOYEE LIST</a></li>
                    <li class=""><a href="userlist.php" class="text-decoration-none px-3 py-3 d-block">USER LIST</a></li>
                    <li class="active"><a href="complaign.php" class="text-decoration-none px-3 py-3 d-block">COMPLAINS</a></li>


                </ul>


            </div>
            <div class="content">
                <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
                    <img src="image.png" class="avatar">
                    <input type="submit" class="btn btn-secondary default btn  " value="Logout" onclick="window.location.href='../Home-Page/index.html'" name="logout">
                </nav>
                <div class="dashboard-content ms-5 px-3 pt-4">
                    <form class="form-group">
                        <table class="table table-borderless justify-content-center">
                            <thead></thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {

                                ?>
                                    <tr>
                                        <td>
                                            <p><strong>Order ID:<?php echo $row['order_id']; ?></strong></p>
                                            <textarea class="form-control z-depth-1" id="exampleFormControlTextarea1" rows="10" cols="50"><?php echo $row['complain_description']; ?></textarea>
                                        </td>
                                    </tr>


                                    <tr>

                                        <td>
                                            <div class="col-sm-12 mb-4" style=" text-align: right; margin-top: 20px;">
                                                <label> </label>
                                                <div class="container">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">TAKE AN ACCTION</button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm modal-fullscreen-sm-down">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text text-danger" id="exampleModalLabel">Emlpoyee ID 102458</h5>

                                                                </div>

                                                                <div class="modal-body">
                                                                    <p class="text justify-content-center"><?php echo $row['complain_description']; ?>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary  align-center col-sm-6" data-bs-dismiss="modal">OK</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                </div>
            </div>
            </td>

    <?php }
                            } ?>
    </tr>
    </tbody>
    </table>
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