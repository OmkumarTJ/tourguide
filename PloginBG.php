<?php
$connect = mysqli_connect("localhost","root","","tourguide");
if(!$connect){
	die("Error");
}

$username = $_POST['Username'];
$password = $_POST['password'];

$login_query = "SELECT * from registrationbg where username = '$username' and password1 = '$password' ";

$result = mysqli_query($connect,$login_query);
$res = mysqli_num_rows($result);

if($res>0){
	require 'BOOKMODEL.html';
}
else
{
  echo '<script> alert("you entered username or password is incorrect"); </script>';
require 'loginBG.html';
}
?>



