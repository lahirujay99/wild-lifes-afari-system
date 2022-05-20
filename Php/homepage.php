<?php session_start();?>
<?php require_once 'connection.php'?>
<?php 

//checking if a user is logged in;
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link rel="stylesheet" href="../Css/main.css" />
</head>

<body>
  <header>
    <div class="appname">Ceylon Wild Safari</div>
    <div class="logged_in">Welcome <?php echo $_SESSION['first_name']?> <a href="logout.php">Log Out</a>
    </div>
  </header>
</body>

</html>