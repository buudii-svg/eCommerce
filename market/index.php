<?php
include "includes/templates/header.php";
include "connect.php";
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<style>
.product
{
    display: inline-block;
    width: 18%;
    margin-left:5%;
    margin-top: 5%;

}
.product img
{
    object-fit: cover;
    width: 15em;
    height: 15em;
}

.productsList
{
  width: 100%;
}
.product span
{
  display: block; 
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 30ch;

}
  input[type="submit"] {
    appearance: none;
    background-color: #008dde;
    border: none;
    border-radius: 3px;
    color: #f4f4f4;
    cursor: pointer;
    font-family: inherit;
    height: 20px;
    text-transform: uppercase;
}

</style> 

<?php
if(isset($_GET['search'])){
  echo '<style>
  .productsList{
    display:none;
  }
  </style>';
}else{
  echo '<style>
  .productsLists{
    display:none;
  }
  </style>';
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['cart'])){
  $stmt = $con->prepare("INSERT INTO cart (UserName, ProductID) VALUES (?, ?)");
  $stmt->execute(array($_SESSION['Username'], $_POST['ProductID']));
  $stmtt = $con->prepare("INSERT INTO orders (UserName, ProductID, StatusID) VALUES (?, ?, 0)");
  $stmtt->execute(array($_SESSION['Username'], $_POST['ProductID']));
  echo '<script>alert("Added to cart successfully")</script>';
  }else if(isset($_POST['like'])){
  $stmt = $con->prepare("INSERT INTO fav (UserName, ProductID) VALUES (?, ?)");
  $stmt->execute(array($_SESSION['Username'], $_POST['ProductID']));
 echo '<script>alert("Added to favourites successfully")</script>';
  }else if(isset($_POST['market'])){
  $stmt = $con->prepare("INSERT INTO market (UserName, MarketUser) VALUES (?, ?)");
  $stmt->execute(array($_SESSION['Username'], $_POST['MarketUser']));
  echo '<script>alert("Added to liked markets successfully")</script>';
  }
}

?>
<div class="productsList">
             <?php
              $stmt = $con->prepare("SELECT * FROM products");
              $stmt->execute();
              $rows = $stmt->fetchAll();
              foreach($rows as $row){ 
                echo '<div class="product">';
                echo '<img src="./layout/img/'.$row['Image'].'" alt="product"> <br>';
                echo '<h2>'.$row['Name'].'</h2>';
                echo '<span>'.$row['Brand'].'</span>';
                echo '<span>Price: '.$row['Price'].'</span>';
                echo '<span>Quantity: '.$row['Quantity'].'</span>';
                echo '<span>Description: '.$row['Fdesc'].'</span>';
                echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST">';
                echo '<input type="hidden" name="ProductID" value="'.$row['ProductID'].'">';
                echo '<input type="hidden" name="MarketUser" value="'.$row['MarketUser'].'">';
                echo '<p><input type="submit" name="cart" value="Add To Cart"></p>';
                echo '<p><input type="submit" name="like" value="Liked Product"></p>';
                echo '<p><input type="submit" name="market" value="Liked Market"></p>';
                echo '</form>';
                echo '</div>';
              }
              ?>
</div>
