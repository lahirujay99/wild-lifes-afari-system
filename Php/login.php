<?php session_start()?>

<?php require_once 'connection.php';?>
<?php 


//check for form submission
if(isset($_POST['submit'])){

 $error = array();
//check if username and password has been entered
  if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1){
    $error[] = "Userame empty";
  }

  if(!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1){
    $error[] = "password empty";
  }

//check if there are any errors in the form
    if(empty($error)){

        //save username and passowrd into variables
        $username = mysqli_real_escape_string($link,$_POST['email']);
        $password = mysqli_real_escape_string($link,$_POST['password']);
        $encPass = sha1($password);

        //prepare database query
        $query = "SELECT * FROM user 
        WHERE email = '{$username}' AND password = '{$encPass}'LIMIT 1";

          $result = mysqli_query($link,$query);

        //check if the user is valid
        if($result){

            //query succesful
          if(mysqli_num_rows($result) == 1){
            //user found

              $user = mysqli_fetch_assoc($result);
              $_SESSION['user_id'] = $user['id'];
              $_SESSION['first_name'] = $user['first_name'];
              
              //redirect to homepage.php
              header('Location: homepage.php');

          }else{
            $error[] = "User not found / invalid username or password";
       }
     }
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
  <link rel="stylesheet" href="../Css/main.css" </head>

<body>

  <?php 
if(!empty($array)){
  echo "error in code";
}


?>
  <div class="login">
    <form action="login.php" method="POST">
      <fieldset>
        <legend>
          <h2>Login</h2>
        </legend>

        <?php if(isset($errors) && !empty($errors))
                {
                    echo ' <p class = "error"> Invalid Username or Password</p>';

                }
                ?>

        <p>
          <label for="username">Username </label>
          <input type="text" name="email" id="username" placeholder="Enter email">
        </p>
        <p>
          <label for="password">Password </label>
          <input type="password" name="password" id="password" placeholder="password">
        </p>
        <p>
          <button type="submit" name="submit">Log in</button>
        </p>
      </fieldset>

    </form>
  </div>
</body>

</html>

<?php 
mysqli_close($link);
?>