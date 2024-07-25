<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
<style>

body {
    font-family: 'Nunito', sans-serif;
}

h1 {
    text-align: center;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

li.dropdown {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}

.topnav .login-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
  width:120px;
}

.topnav input[type=password] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
  width:120px;
}

.topnav .login-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background-color: #555;
  color: white;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .login-container button:hover {
  background-color: green;
}

@media screen and (max-width: 600px) {
  .topnav .login-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .login-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
}

</style>
</head>

<body>
<ul>
    <li><a href="./index.php">Home</a></li>
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">Customer</a>
        <div class="dropdown-content">
            <a href="./cust_gridView.php">Customer List</a>
            <a href="./cust_insertView.php">Add Customer</a>
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">Product</a>
        <div class="dropdown-content">
            <a href="./prod_gridView.php">Product List</a>
            <a href="./prod_insertView.php">Add Product</a>
	<li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">Vendor</a>
        <div class="dropdown-content">
            <a href="./vend_gridView.php">Vendor List</a>
            <a href="./vend_insertView.php">Add Vendor</a>
	<li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">Purchase Order</a>
        <div class="dropdown-content">
            <a href="./purc_gridView.php">Purchase Order List</a>
            <a href="./purc_insertView.php">Add Purchase</a>
	<li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">Sales Order</a>
        <div class="dropdown-content">
            <a href="./sale_gridView.php">Sales Order List</a>
            <a href="./sale_insertView.php">Add Sales</a>
	</li>
    
    <?php 
		//--- if user is not logined , show login form 
		if	(!isset($_SESSION["userid"])){ 
	?>
	
    <div class="topnav">
        <div class="login-container">
            <form method="post" action="login.php">
                <input type="text" placeholder="Username" name="userid">
                <input type="password" placeholder="Password" name="userpwd">
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>
    
    <?php
		}
		else { 
	?>
	
	<div class="topnav">
        <div class="login-container">
            <form method="post" action="logout.php">
                <button type="submit">Sign Out</button>
            </form>
        </div>
    </div>
    
	<?php
		}
	?>
    
</ul>

<?php
if	(!isset($_SESSION["userid"])){ 
?>

<h1>Welcome to 4A816031 Store Database</h1>
<img style="width: auto ; float: center; display: block; margin-left: auto; margin-right: auto;" src="http://w3.ncut.edu.tw/ncut/ncutlogo/logo2007_02.jpg">

<?php
    }
?>
</body>
</html>