<?php
include "connect.php";
include "includes/templates/header.php";
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
if(isset($_POST['purchase'])){
  $sql = "UPDATE orders SET StatusID = 1 WHERE Username = '".$_SESSION['Username']."'";
  $result = $con->query($sql);
  $sql = "INSERT INTO balance (MarketUser, Balance, ProductID) VALUES ('".$_POST['MarketUser']."', '".$_POST['Price']."', '".$_POST['ProductID']."')";
  $result = $con->query($sql);
  $sql = "DELETE FROM cart WHERE ProductID = '".$_POST['ProductID']."'";
  $result = $con->query($sql);
  if($result){
    echo '<script>alert("Order has been placed")</script>';
  }else{
    echo '<script>alert("Order has not been placed")</script>';
  }
}
      
?>
<?php

?>

 <div class="productsList">
             <?php
              $sql = "SELECT * FROM products WHERE ProductID IN (SELECT ProductID FROM cart WHERE Username = '".$_SESSION['Username']."')";
              $result = $con->query($sql);
              $rows = $result->fetchAll();
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
                echo '<input type="hidden" name="Price" value="'.$row['Price'].'">';
                echo '<p><input type="submit" name="purchase" value="Purchase"></p>';
                echo '</form>';
                echo '</div>';
              }
              ?>
</div>