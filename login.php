<?php

include_once('connections/connection.php');
$connection = connection();

if(!isset($_SESSION)){
  session_start();
}

if(isset($_POST['login'])){

  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);

  $sql = "SELECT * FROM student_users
            WHERE username = '$username' AND password = '$password' ";

  $user = $connection->query($sql) or die ($connection->error);
  $row = $user->fetch_assoc();
  $total = $user->num_rows;

  if( $total > 0){

  $_SESSION['UserLogin'] = $row['username'];
  $_SESSION['Access'] = $row['access'];

  echo header('Location: index.php');

  }else{
    echo '<script>alert("No user found!")</script>';
  }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Management System</title>

  <!-- * Bootstrap CDN  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <!-- * Custom CSS -->
  <link rel="stylesheet" href="./css/custom.css">
</head>
<body>
  <div class="container font-monospace">

    <div class="mt-5 w-25 mx-auto">
      <h4 class="text-center mb-3">Member Login</h4>
      <form action="" method="POST">
        <div class="mb-3">
          <input type="text" name="username" class="form-control" id="username" placeholder="Username" autocomplete="off">
        </div>
        <div class="mb-3">
          <input type="password" name="password" class="form-control" id="password" placeholder="Password" autocomplete="off">
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
      </form>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>