<?php

$connect = mysqli_connect("localhost","root","","tourguide");
if(!$connect){
	die("Error");
}

$username = $_POST['Username'];
$password = $_POST['password'];

$login_query = "SELECT * from registrationsg where username = '$username' and password1 = '$password' ";

$result = mysqli_query($connect,$login_query);
$res = mysqli_num_rows($result);



if($res>0){

	require 'APPMODEL.html';
}
else
{


 echo '<script> alert("you entered username or password is incoorect"); </script>';
 require 'loginSG.html';
}
?>


