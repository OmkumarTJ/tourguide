<?php 

$connect = mysqli_connect("localhost","root","","tourguide");

if(!$connect)
{
	die("Error");
}


$SELECT="SELECT email From registrationsg WHERE email =? Limit 1";
 $sql_query = "INSERT INTO registrationsg (email,username,password) VALUES ('".$_POST['email']."','".$_POST['username']."','".$_POST['password']."') ";
 
 //prpare statement
 $stmt= $connect->prepare($SELECT);
 $stmt->bind_param("s",$email);
 $stmt->execute();
  $stmt->bind_result($email);
    $stmt->store_result();
    $rnum=$stmt->num_rows;

   mysqli_query($connect,$sql_query);
  echo '<script> alert("sign up as a guide successfully registered"); </script>';
   require 'loginSG.html';
?>











