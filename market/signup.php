<?php 
session_start();
if(isset($_SESSION['Username'])){
    header('Location: index.php');
}
include "includes/templates/header.php"; 
include "connect.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $hashedPass = sha1($pass);
    $email= $_POST['email'];
    $location = $_POST['loc'];
    $phone = $_POST['phone'];
    $photo = $_POST['photo'];
    // $_SESSION['photo'] -> image = $photo;
    $address = $_POST['address'];
    @
    $market = $_POST['market'];
    if($market == 'market'){
        $groupID = 1;
    }else{
        $groupID = 0;
    }


    $stmt= $con->prepare("SELECT UserName, Email FROM users WHERE UserName = ? OR Email = ?");
    $stmt->execute(array($user, $email));
    $count = $stmt->rowcount();

    if($count > 0){
        echo 'This username or email is already exist';
    }else{
        $stmt= $con->prepare("INSERT INTO users (UserName, Password, Email, Address, Location, Phone, Photo, GroupID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute(array($user, $hashedPass, $email, $address, $location,$phone, $photo, $groupID ));
        header('Location: login.php');
        exit();
    }

}
 
?>

<div id="login">

  <h1><b>Welcome.</b> Please signup.</h1>

  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >

    <fieldset>
      <p><input type="text" required name="email" placeholder="Email" ></p>
      <p><input type="password" required name="pass" placeholder="Password"  ></p>
      <p><input type="text" required name="user" placeholder="Username" ></p>
      <p><input type="text" required name="address" placeholder="Address" ></p>
      <p><input type="text"  name="loc" placeholder="Location" ></p>
      <p><input type="text" required name="phone" placeholder="Phone" ></p>
      <p><input type="file" required name="photo" ></p>
      <p><input type="checkbox" name="market" value="market">Market User</p>
      <p><a href="login.php">Login?</a></p>
      <p><input type="submit" name="submit" value="Signup"></p>
    </fieldset>
  </form>
</div>


<?php include "includes/templates/footer.php"; ?>