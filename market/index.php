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
                echo '</div>';
              }
              ?>
              
  </div>
