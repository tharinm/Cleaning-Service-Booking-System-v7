<?php

// Connect to the database
include_once('../Home-page/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/userlist.css">
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <h2 align= "center">Search Results</h2>
        <?php
        if (isset($_POST['search'])) {
          $search = $_POST['search'];
          // Execute SELECT query to search for results using the search query
          $sql = "SELECT * FROM customer WHERE cus_id LIKE ? OR user_name LIKE  ? OR email LIKE ? OR mobile LIKE ? OR nic LIKE ?";
          $stmt = mysqli_prepare($conn, $sql);
          $like = "%$search%";
          mysqli_stmt_bind_param($stmt, "sssss", $like, $like,$like,$like,$like);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);

          // Check if any results were found
          if (mysqli_num_rows($result) > 0) {
            // Results found, create an HTML table to display the results
            echo "<div class='registeremp ms-5 px-3 pt-4'>";
            echo "<table class='table'>";
            echo "<thead class='col-sm-4'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>USER-Name</th>";
            echo "<th>Email</th>";
            echo "<th>Mobile-No</th>";
            echo "<th>NIC</th>";
            echo "<th>Total Orders</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) {

              $query1 = mysqli_query($conn,"SELECT COUNT(status) as count FROM job_order WHERE status='Completed' and cus_id=$row[cus_id]");
              $count = mysqli_fetch_array($query1);
              echo "<tr>";
              echo "<td>" . $row['cus_id'] . "</td>";
              echo "<td>" . $row['user_name'] . "</td>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td>" . $row['mobile'] . "</td>";
              echo "<td>" . $row['nic'] . "</td>";
              echo "<td>" . $count['count'] . "</td>";
              echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
          } else {
            // No results found
            echo "<p>No results found for search term: " . $search . "</p>";
          }
        }
        ?>
      </div>
    </body>

    </html>