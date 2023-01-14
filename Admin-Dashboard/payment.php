<?php
include_once('../Home-page/config.php');

if (isset($_POST['pay'])) {
  $payment = $_POST['text'];
  $sql = mysqli_query($conn, "INSERT INTO (admin_pay) VALUES ($payment)");
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
  <link rel="stylesheet" href="CSS/payment.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        <li class="active"><a href="payment.php" class="text-decoration-none px-3 py-3 d-block">PAYMENT</a></li>
        <li class=""><a href="work.php" class="text-decoration-none px-3 py-3 d-block">WORKS</a></li>
        <li class=""><a href="emplyoeelist.php" class="text-decoration-none px-3 py-3 d-block">EMPLOYEE LIST</a></li>
        <li class=""><a href="userlist.php" class="text-decoration-none px-3 py-3 d-block">USER LIST</a></li>
        <li class=""><a href="complaign.php" class="text-decoration-none px-3 py-3 d-block">COMPLAINS</a></li>


      </ul>


    </div>
    <div class="content">
      <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
        <img src="image.png" class="avatar">
        <input type="submit" class="btn btn-secondary default btn  " value="Logout" onclick="window.location.href='../Home-Page/index.html'" name="logout">
      </nav>

      <div class="payment ms-5 px-3 pt-4">
        <table class="table">
          <h6 class="mb-3">Employee Withdrawal Request</h6>
          <thead class="col-sm-4">
            <tr>
              <td class="text text-dark">EMPLOYEE ID</td>
              <td class="text text-dark">EMAIL</td>
              <td class="text text-dark">BANK ACC</td>
              <td class="text text-dark">AMOUNT</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT  emp_id,email,bank_acc,amount from registered_employee,emp_withdrawal_request where emp_id=1 and request_id=1 ");

            while ($row = mysqli_fetch_assoc($query)) {
              echo   "<tr>";
              echo "  <td>$row[emp_id]</td>";
              echo "  <td>$row[email]</td>";
              echo "  <td>$row[bank_acc]</td>";
              echo "  <td>$row[amount]</td>";


              echo "<td>";
              // <button type='submit' value='Pay' name='employeepay' class='btn btn-success ms-1'>PAY</button>";
            ?>
              <a href="https://dashboard.stripe.com/test/payments/new" class=""><input type="submit" value="Pay" class="btn btn-dark btn-sm col-sm-12" name=<?php echo "pay_$row[emp_id]"?>></a>
            <?php " </td>";
              echo "  </tr>";
            }
            ?>
          </tbody>
        </table>
        <table class="table">
          <h6 class="mb-3">Customer Refund Request</h6>
          <thead class="col-sm-4">
            <tr>
              <td class="text text-dark">CUSTOMER ID</td>
              <td class="text text-dark">EMAIL</td>
              <td class="text text-dark">Amount</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
           
            <?php
            $query1 = mysqli_query($conn, "SELECT refunds.cus_id,customer.email,refunds.amount FROM refunds JOIN customer ON refunds.cus_id = customer.cus_id where refunds.cus_id=1");

            while ($row1 = mysqli_fetch_assoc($query1)) {
              echo "  <td>$row1[cus_id]</td>";
              echo "  <td>$row1[email]</td>";
              echo "  <td>$row1[amount]</td>";
              echo "<td></td>";


              echo "<td>";
            ?>
              <a href="https://dashboard.stripe.com/test/payments?status[0]=successful "><input type="submit" value="Pay" class="btn btn-dark btn-sm col-sm-12" name="pay"></a>

            <?php echo " </td>
                </tr>";
            }
            ?>

            <!-- <td scope="col"><a href="#" class="btn btn-primary text-white btn-sm col-sm-6">EDIT</a></td> -->

          </tbody>
        </table>
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