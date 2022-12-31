
    <?php
    session_start();
    include "connect.php";
    include "includes/templates/header.php";

    if(isset($_SESSION['Username'])){
        echo 'Welcome '.$_SESSION['Username'];
    }else{
        header('Location: index.php');
        exit();
    }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name= $_POST['name'];
    $brand= $_POST['brand'];
    $price= $_POST['price'];
    $bdesc= $_POST['bdesc'];
    $fdesc= $_POST['fdesc'];
    $photo= $_POST['photo'];
    $quantity = $_POST['quantity'];
    $marketUser = $_SESSION['Username'];
    $stmt= $con->prepare("INSERT INTO products (Name, Brand, Price, Bdesc, Fdesc, Image, Quantity , MarketUser) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute(array($name, $brand, $price, $bdesc, $fdesc, $photo, $quantity, $marketUser));
    $count = $stmt->rowcount();
    if($count > 0){
         echo '<script>alert("Product is added successfully")</script>';
    }
}

    ?>

    <div id="login">

  <h1><b>Welcome.</b> Please Add Product.</h1>

  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >

    <fieldset>
      <p><input type="text" required name="name" placeholder="Name" ></p>
      <p><input type="text" required name="brand" placeholder="Brand" ></p>
      <p><input type="text" required name="price" placeholder="Price" ></p>
      <p><input type="text"  name="bdesc" placeholder="Enter a brief description" ></p>
      <p><input type="text" required name="fdesc" placeholder="Enter a full description" ></p>
       <p><input type="text" required name="quantity" placeholder="Enter number of available items" ></p>
      <p><input type="file" required name="photo" ></p>
      <p><input type="submit" name="submit" value="Add Product"></p>
    </fieldset>
  </form>
</div>
