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
//if it is searched hide the content of index page
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

    
                <!-- <div class="productsList">
                    <div class="product">
                        <img src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/e6da41fa-1be4-4ce5-b89c-22be4f1f02d4/air-force-1-07-mens-shoes-5QFp5Z.png" alt="product1"> <br>
                        <h2>Nike Air-Force</h2>
                        <span>Nike</span> 
                        <span>Price: $1300</span>
                        <span>Quantity: 30</span>    
                        <span>Description: Revolution 6 Next Nature Running Shoes  </span>
                    </div>
                    <div class="product">
                        <img src="https://media.wired.com/photos/63728604691ed08cc4b98976/master/pass/Nike-Swoosh-News-Gear.jpg" alt="product2">
                        <h2>Nike Shoes</h2>
                        <span>Nike</span> 
                        <span>Price: $1000</span>
                        <span>Quantity: 10</span>
                        <span>Description: Downshifter 11 Running Shoes </span>
                        
                        
                  </div>
                  <div class="product">
                        <img src="https://img1.theiconic.com.au/dQ0N216qG9oUjOgvUJwX3t8hle8=/fit-in/406x512/filters:fill(ffffff):quality(90)/http%3A%2F%2Fstatic.theiconic.com.au%2Fp%2Fpuma-3871-3533231-1.jpg" alt="product3">
                        <h2>   sneakers</h2>
                        <span> puma</span>
                        <span>Price: $1420</span>
                        <span>Quantity: 17</span>
                        <span>Description:Pacer Future Slip-Ons</span>
                  </div>
                    <div class="product">
                            <img src="https://assets.adidas.com/images/w_600,f_auto,q_auto/d44fa06fc83f4644b7e8acbc01160e1b_9366/NMD_R1_Primeblue_Shoes_Black_GZ9258_01_standard.jpg" alt="product4">
                            <h2>Adidas Shoes</h2>
                            <span>Adidas</span> 
                            <span>Price: $1200</span>
                            <span>Quantity: 34</span>
                            <span>Description: Duramo Sl 2.0 Running Shoe</span>
                    </div> 
                    <div class="product">
                            <img src="https://assets.adidas.com/images/w_600,f_auto,q_auto/21f515fe8e0440489925a97f00d5d19a_9366/Grand_Court_Shoes_White_F36392.jpg" alt="product5">
                            <h2> Grand_Court</h2>
                            <span>Adidas</span>
                            <span>Price: $1400</span>
                            <span>Quantity: 18</span>
                            <span>Description: Adizero Ubersonic 4</span>
                    </div>      
                    <div class="product">
                      <img src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/5f99a6ba-680e-4f53-83dd-e785bcfd21e5/zoom-mercurial-vapor-15-academy-tf-football-shoes-h1Fm9N.png" alt="product5">
                      <h2> Football Boots </h2>
                      <span>Nike</span>
                      <span>Price: $1342</span>
                      <span>Quantity: 43</span>
                      <span>Description:Predator Edge.3 Sport Shoe</span>
              </div>  
              <div class="product">
                <img src="https://www.sportsdirect.com/images/imgzoom/63/63836922_xxl.jpg" alt="product5">
                <h2> TrackSuit </h2>
                <span>Nike</span>
                <span>Price: $2342</span>
                <span>Quantity:33</span>
                <span>Description: NSW SPE Fleece GX HD Tracksuit </span>
        </div>  
                
                
                
                </div> -->
