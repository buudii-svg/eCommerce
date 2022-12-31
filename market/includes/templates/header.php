<!DOCKTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="layout/css/backend.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .nav {
  height: 50px;
  width: 100%;
  background-color: #131722;
  position: fixed;
  top: 0px;
}

.nav > .nav-header {
  display: inline;
}

.nav > .nav-header > .nav-title {
  display: inline-block;
  font-size: 22px;
  color: #fff;
  padding: 10px 10px 10px 10px;
}

.nav > .nav-btn {
  display: none;
}

.nav > .nav-links {
  display: inline;
  float: right;
  font-size: 18px;
}

.nav > .nav-links > a {
  display: inline-block;
  padding: 13px 10px 13px 10px;
  text-decoration: none;
  color: #efefef;
}

.nav > .nav-links > a:hover {
  background-color: rgba(0, 0, 0, 0.3);
}

.nav > #nav-check {
  display: none;
}

@media (max-width:600px) {
  .nav > .nav-btn {
    display: inline-block;
    position: absolute;
    right: 0px;
    top: 0px;
  }
  .nav > .nav-btn > label {
    display: inline-block;
    width: 50px;
    height: 50px;
    padding: 13px;
  }
  .nav > .nav-btn > label:hover,.nav  #nav-check:checked ~ .nav-btn > label {
    background-color: rgba(0, 0, 0, 0.3);
  }
  .nav > .nav-btn > label > span {
    display: block;
    width: 25px;
    height: 10px;
    border-top: 2px solid #eee;
  }
  .nav > .nav-links {
    position: absolute;
    display: block;
    width: 100%;
    background-color: #333;
    height: 0px;
    transition: all 0.3s ease-in;
    overflow-y: hidden;
    top: 50px;
    left: 0px;
  }
  .nav > .nav-links > a {
    display: block;
    width: 100%;
  }
  .nav > #nav-check:not(:checked) ~ .nav-links {
    height: 0px;
  }
  .nav > #nav-check:checked ~ .nav-links {
    height: calc(100vh - 50px);
    overflow-y: auto;
  }
  form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

/* Style the submit button */
form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

/* Clear floats */
form.example::after {
  content: "";
  clear: both;
  display: table;
}
}
    </style>
    <title>OOAA</title>

</head>   
<body> 
<div class="nav">
  <div class="nav-header">
    <div class="nav-title">
      <a href="index.php" target="" style="text-decoration:none; color:white;">OOAA</a>
      <?php
      if(!isset($_SESSION)) 
       { 
          session_start(); 
       }
      include "connect.php";
      if(isset($_SESSION['Username'])){
        $stmt = $con->prepare("SELECT Photo FROM users WHERE UserName = ?");
        $stmt->execute(array($_SESSION['Username']));
        $row = $stmt->fetch();
        echo '<img src="./layout/img/'.$row['Photo'].'" alt="#" width="30" height="30">';
      }
      else {
        echo '<img src="./layout/img/pp.jpg" alt="#" width="30" height="30">';
      }
      ?>
    </div>
  </div>
  <?php
  if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header('Location: index.php');
  }
  ?>
  <div class="nav-links">
    <a href="login.php" target="">Login</a>  
  </div>
  
  <div class="nav-links" style="display: inline-block; padding: 13px 10px 13px 10px;">
     <form class="formula" action="" method="GET" name="">
      <select name="options" id="options">
        <option value="products">Products</option>
        <option value="brands">Brands</option>
        <option value="markets">Markets</option>
      </select>
       <input type="text" name="search" placeholder="Search..">
       <button type="submit" style="cursor:pointer;" ><i class="fa fa-search"></i></button>
       <?php
        if(isset($_SESSION['Username'])){
          echo '<a href="index.php?logout=true" target="" style="text-decoration:none; color:white; padding:5px;">Logout</a>';
          echo '<a href="dashboard.php" target="" style="text-decoration:none; color:white; padding:5px;">Profile</a>';
        }
       ?>
     </form>
  </div> 
</div>


  <div class="productsLists" style="width:100%;">
  <?php
  if(isset($_GET['search'])){
    $search = $_GET['search'];
    @
    $option = $_GET['options'];
    if($option == 'products'){ 
      $stmt = $con->prepare("SELECT * FROM products WHERE Name LIKE '%$search%'");
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
    }
    else if($option == 'brands'){
      $stmt = $con->prepare("SELECT * FROM products WHERE Brand LIKE '%$search%'");
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
    }
    else if($option == 'markets'){
      $stmt = $con->prepare("SELECT * FROM products WHERE MarketUser LIKE '%$search%'");
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
    }
  }

  ?>
  </div>