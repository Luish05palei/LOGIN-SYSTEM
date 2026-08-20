<?php

$showAlert = false;
$showError = false;
if($_SERVER['REQUEST_METHOD'] == "POST") {

    
    include 'partials/db_connect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // $exists = false;

    // check wheather this username exists
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
      // $exists = true;
      $showError = "Username Already Exists";
    }
    else{
      // $exists = false;
    

    if (($password == $cpassword)){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `Users` (`username`, `password`, `date`) 
        VALUES ('$username', '$hash', current_timestamp())";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
        }
    }
    else{
        $showError = "Password do not Match";
    }
}
}
?>





<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIGNUP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require 'partials/nav.php';
    ?>

    <?php

    if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your Acoount is Now Created You Can Now Login .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> '. $showError.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
    ?>

    <div class="container my-4">
        <h1 class="text-center">SIGNUP TO OUR WEBSITE</h1>
        <form action="/LOGIN SYSTEM/signup.php" method = "post" >
  <div class="mb-3 form-group col-md-6">
    <label for="username" class="form-label">User Name</label>
    <input type="text" maxlength = "11" class="form-control" id="username" name="username" ">
  </div>
  <div class="mb-3 form-group col-md-6">
    <label for="password" class="form-label">Password</label>
    <input type="password" maxlength = "11" class="form-control" id="password" name="password">
    <div id="emailHelp" class="form-text">We'll never share your password with anyone else.</div>
  </div>

  <div class="mb-3 form-group col-md-6">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="cpassword" class="form-control" id="cpassword" name="cpassword">
    <div id="emailHelp" class="form-text">Make sure to type the same password</div>
  </div>

  <button type="submit" class="btn btn-primary">SignUp</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
