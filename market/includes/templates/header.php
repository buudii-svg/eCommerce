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
    <title>admin</title>

</head>   
<body> 
  <?php
  include 'connect.php';
  @
  session_start();
  $stmt = $con->prepare("SELECT GroupID FROM users WHERE Username = ?");
  @
  $stmt->execute(array($_SESSION['Username']));
  $row = $stmt->fetch();
  $count = $stmt->rowCount();
  @
  $groupId = $row['GroupID'];
  ?>

<div class="nav">
  <div class="nav-header">
    <div class="nav-title">
      <a href="index.php" target="_blank" style="text-decoration:none; color:white;">OOAA</a>
      <img src="./layout/img/pp.jpg" alt="#" width="30" height="30">
    </div>
  </div>
  <div class="nav-links">
    <input type="text" name="search" placeholder="Search..">
    <button type="submit" ><i class="fa fa-search"></i></button>
    <?php
    if(isset($_SESSION['Username']) && $groupId == 1){
      echo '<a href="marketUser.php" target="_blank">Profile</a>';
    }else{
      echo '<a href="dashboard.php" target="_blank">Profile</a>';
    }
    ?>
    <a href="" target="_blank">Products</a>
    <a href="" target="_blank">Brands</a>
    <a href="" target="_blank">Markets</a>
    <a href="login.php" target="_blank">Login</a>
  </div>
</div>


