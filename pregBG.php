<?php 
$connect = mysqli_connect("localhost","root","","tourguide");
if(!$connect)
{
	die("Error");
}
$SELECT="SELECT email From registrationbg WHERE email =? Limit 1";
 $sql_query = "INSERT INTO registrationbg (email,username,password1,password2) VALUES ('".$_POST['email']."','".$_POST['username']."','".$_POST['password1']."','".$_POST['password2']."') ";
 
 //prpare statement
 $stmt= $connect->prepare($SELECT);
 $stmt->bind_param("s",$email);
 $stmt->execute();
  $stmt->bind_result($email);
    $stmt->store_result();
    $rnum=$stmt->num_rows;
    mysqli_query($connect,$sql_query);
     echo '<script> alert("you have successfully registered"); </script>';
   require 'loginBG.html'        ?>






