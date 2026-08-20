<?php

$login = false;
$showError = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {

  include 'partials/db_connect.php';
  $username = $_POST["username"];
  $password = $_POST["password"];

  // $sql = "select * from Users where username = '$username' AND password = '$password'";
  $sql = "select * from Users where username = '$username'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['password'])) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: welcome.php");
      } else {
        $showError = "Invalid credentials ";
      }
    }
  } else {
    $showError = "Invalid credentials ";
  }
}

?>





<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <?php
  require 'partials/nav.php';
  ?>

  <?php

  if ($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You are Logged In .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }

  if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> ' . $showError . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>

  <div class="container my-4">
    <h1 class="text-center">LOGIN TO OUR WEBSITE</h1>
    <form action="/LOGIN SYSTEM/login.php" method="post">
      <div class="mb-3 form-group col-md-6">
        <label for="username" class="form-label">User Name</label>
        <input type="text" class="form-control" id="username" name="username" ">
  </div>
  <div class=" mb-3 form-group col-md-6">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        <div id="emailHelp" class="form-text">We'll never share your password with anyone else.</div>
      </div>


      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>