<?php 
session_start();
if(isset($_SESSION['Username'])){
    header('Location: dashboard.php');
}
include "includes/templates/header.php"; 
include "connect.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $hashedPass = sha1($pass);

    $stmt= $con->prepare("SELECT UserName, Password FROM users WHERE UserName = ? AND Password = ? AND GroupID = 0");
    $stmt->execute(array($user, $hashedPass));
    $count = $stmt->rowcount();
  
    if($count > 0){
       $_SESSION['Username'] = $user;
        header('Location: dashboard.php');
        exit();
    }
}

?>

<div id="login">

  <h1><strong>Welcome.</strong> Please login.</h1>

  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

    <fieldset>
      <p><input type="text" required name="user" placeholder="Username" autocomplete="off"></p>
      <p><input type="password" required name="pass" placeholder="Password"  autocomplete="new-password"></p>
      <p><a href="signup.php">Signup?</a></p>
      <p><input type="submit" value="Login"></p>
    </fieldset>
  </form>
</div>


<?php include "includes/templates/footer.php"; ?>



