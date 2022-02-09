<?php
require('db.inc.php');
$msg="";
if(isset($_POST['email']) && isset($_POST['password'])){
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$res=mysqli_query($con,"select * from login where email='$email' and password='$password'");
	$count=mysqli_num_rows($res);
  
	if($count>0){
		$row=mysqli_fetch_assoc($res);
		$_SESSION['ROLE']=$row['Role'];
		$_SESSION['USER_ID']=$row['id'];
		$_SESSION['USER_NAME']=$row['name'];
		header('location:home.php');
		die();
	}else{
		$msg="Please enter correct login details";
	}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َParkinson's Detection</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Graduate">
    <style type="text/css">
body{
  background-image: url("glass.jpg");
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  font-family:Graduate;
  margin: 0;
  padding: 0;

}
.box{
  width: 300px;
  padding: 40px;
  position: absolute;
  top: 65%;
  left: 50%;
  transform: translate(-50%,-50%);
  background: rgba(0,0,0,0.5);
  color: #FFF;
  text-align: center;
}
.box h1{
  color: white;
  text-transform: uppercase;
  font-weight: 500;
}
.box input[type = "text"],.box input[type = "password"]{
  border:0;
  background: none;
  display: block;
  margin: 20px auto;
  text-align: center;
  border: 2px solid #3498db;
  padding: 14px 10px;
  width: 200px;
  outline: none;
  color: white;
  border-radius: 24px;
  transition: 0.25s;
}
::placeholder {
  color: white;
  font-family: Graduate;
}
.box input[type = "text"]:focus,.box input[type = "password"]:focus{
  width: 280px;
  border-color:white;
}
.box input[type = "submit"]{
  border:0;
  background: none;
  display: block;
  margin: 20px auto;
  text-align: center;
  border: 2px solid #3498db;
  padding: 14px 40px;
  outline: none;
  color: white;
  border-radius: 24px;
  transition: 0.25s;
  cursor: pointer;
  font-family: Graduate;
}
.box input[type = "submit"]:hover{
  background: #3498db;
  color: white;
}
.empulse{
  color: white;
  text-align: center;

}
</style>
  </head>
  <body>
<form class="box" method="post">
  <h1>Login</h1>
  <input type="text" name="email" placeholder="EMAIL ID" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="submit" name="" value="Login">
  <div class="result_msg"><?php echo $msg?></div>
</form>

<script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
  </body>
</html>
