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
    $email= $_POST['email'];
    $location = $_POST['loc'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $photo = $_POST['photo'];
    $market = $_POST['market'];
    if($market == 'market'){
        $groupID = 1;
    }else{
        $groupID = 0;
    }

    //add image to database
    $image = $_FILES['photo']['name'];
    $image_tmp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($image_tmp, "layout/images/$image");
    



    $stmt= $con->prepare("SELECT UserName FROM users WHERE UserName = ?");
    $stmt->execute(array($user));
    $count = $stmt->rowcount();
  
    if($count > 0){
        echo 'This username is already exist';
    }else{
        $stmt= $con->prepare("INSERT INTO users (UserName, Password, Email, Address, Location, Phone, Photo, GroupID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute(array($user, $hashedPass, $email, $address, $location,$phone, $photo, $groupID ));
        header('Location: index.php');
        exit();
    }
}
 
?>

<div id="login">

  <h1><b>Welcome.</b> Please signup.</h1>

  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

    <fieldset>
      <p><input type="text" required name="email" placeholder="Email" ></p>
      <p><input type="password" required name="pass" placeholder="Password"  ></p>
      <p><input type="text" required name="user" placeholder="Username" ></p>
      <p><input type="text" required name="address" placeholder="Address" ></p>
      <p><input type="text"  name="loc" placeholder="Location" ></p>
      <p><input type="text" required name="phone" placeholder="Phone" ></p>
      <p><input type="file" required name="photo"  ></p>
      <p><input type="checkbox" name="market" value="market">Market User</p>
      <p><a href="index.php">Login?</a></p>
      <p><input type="submit" name="submit" value="Signup"></p>
    </fieldset>
  </form>
</div>


<?php include "includes/templates/footer.php"; ?>