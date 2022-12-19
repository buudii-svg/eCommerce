<?php
include "includes/templates/header.php";
include "connect.php";
 

// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//     $user1 = $_POST['user'];
//     $pass1 = $_POST['pass'];
//     $hashedPass1 = sha1($pass);
//     $email1= $_POST['email'];
//     $location1 = $_POST['loc'];
//     $phone1 = $_POST['phone'];
//     $address1 = $_POST['address'];
//     $stmt= $con->prepare("UPDATE users SET UserName = ?, Password = ?, Email = ?, Address = ?, Location = ?, Phone = ? WHERE UserName = ?");
//     $stmt->execute(array($user1, $hashedPass1, $email1, $address1, $location1, $phone1, $_SESSION['Username'] ));
//     header('Location: dashboard.php');
//     exit();
// }

// $stmtt= $con->prepare("SELECT Email, Password, UserName, Address, Location, Phone, Photo FROM users WHERE UserName = ?");
// $stmtt->execute(array($_SESSION['Username']));
// $row = $stmtt->fetch();
// $count = $stmtt->rowcount();  

// $email = $row['Email'];

// $pass = $row['Password'];

// $user = $row['UserName'];

// $address = $row['Address'];

// $loc = $row['Location'];

// $phone = $row['Phone'];
// $photo = $row['Photo'];


?>

<style>
   form fieldset input[type="button"] {
    appearance: none;
    background-color: #008dde;
    border: none;
    border-radius: 3px;
    color: #f4f4f4;
    cursor: pointer;
    font-family: inherit;
    height: 50px;
    text-transform: uppercase;
    width: 282px;
}
.btn{
    text-decoration: none;
    appearance: none;
    background-color: #008dde;
    border: none;
    border-radius: 3px;
    color: #f4f4f4;
    cursor: pointer;
    font-family: inherit;
    height: 50px;
    text-transform: uppercase;
    width: 282px;

}
</style>
<script>

function enable(){
document.getElementById("email").disabled = false; 
document.getElementById("pass").disabled = false;
document.getElementById("user").disabled = false;
document.getElementById("address").disabled = false;
document.getElementById("loc").disabled = false;
document.getElementById("phone").disabled = false;

}

</script>
<div class="container">
       <div class="profile_Side_Bar">
         <img src="./layout/img/<?php echo $photo?> " alt="Picture" width="140px" height="140px">
         </div>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <fieldset>
      <p><input type="text" required name="email" disabled placeholder="Email" id="email" value=" <?php echo $email?>" ></p>
      <p><input type="password" required name="pass" disabled placeholder="Password" id="pass" value="<?php echo $pass?>" ></p>
      <p><input type="text" required name="user" disabled placeholder="Username" id="user" value="<?php echo $user?>" ></p>
      <p><input type="text" required name="address" disabled placeholder="Address" id="address" value="<?php echo $address?>" ></p>
      <p><input type="text"  name="loc" placeholder="Location" disabled id="loc" value="<?php echo $loc?>" ></p>
      <p><input type="text" required name="phone" disabled  placeholder="Phone" id="phone" value="<?php echo $phone?>" ></p>
      <p><input type = "button" onclick = "enable()" value = "Edit The Above"></p>
      <p><input type="submit" name="submit" value="Submit"></p>
    </fieldset>
    </form>
    <a href="addProduct.php" class="btn">Add Product</a>
    <br>
    <a href="viewProducts.php" class="btn">View Products</a>
</div>
