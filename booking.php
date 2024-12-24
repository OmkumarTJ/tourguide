<?php

$connect = mysqli_connect("localhost","root","","tourguide");

if(!$connect)
{
die("Error");
}

if(isset($_POST['submit']) && isset($_FILES['photo'])  && isset($_FILES['proof']))
{

	$query = "INSERT INTO bookingdetails (Name,Gender,Dob,Bloodgroup,Age,DoorNO,Street,Area,City,Pincode,State,Phonenumber,Email,Pickupdate,Pickuplocation,Members,Language,Room,Food,Tourdays) VALUES
	('".$_POST['Name']."',
	'".$_POST['Gender']."','".$_POST['Dob']."','".$_POST['Bloodgroup']."','".$_POST['Age']."','".$_POST['DoorNO']."','".$_POST['Street']."','".$_POST['Area']."','".$_POST['City']."','".$_POST['Pincode']."','".$_POST['State']."','".$_POST['Phonenumber']."','".$_POST['Email']."','".$_POST['Pickupdate']."','".$_POST['Pickuplocation']."','".$_POST['Members']."','".$_POST['Language']."','".$_POST['Room']."','".$_POST['Food']."','".$_POST['Tourdays']."')";
	  mysqli_query($connect,$query);

	uploadimg('photo');

}

function uploadimg($name){

    $img_name = $_FILES[$name]['name'];
	$img_size = $_FILES[$name]['size'];
	$img_tmp_name = $_FILES[$name]['tmp_name'];
	$img_error = $_FILES[$name]['error'];

	if($img_error === 0)
	{
		if($img_size > 500000)
		{			
			echo "<script> alert(' invalid image extension');</script";
		}
		else{
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_doc = array("jpg","jpeg","png");
			if(in_array($img_ex_lc, $allowed_doc)){

				$new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;

				$img_upload_path = 'img/'.$new_img_name;
				move_uploaded_file($img_tmp_name, $img_upload_path);

				$con = mysqli_connect("localhost","root","","tourguide");
				
				if(!$con)
				{
					echo "<script> alert(' DB not connected');</script";
				}

				$sql = "INSERT INTO bookingdetails(photo) VALUES('$new_img_name')";
				mysqli_query($con,$sql);
				echo "<script> alert('successfully submitted');</script";
			}
			else{
				echo "<script> alert(' pls upload jpg,jpeg or png format files only');</script";
			}
		}
	}
	else{
		echo "<script> alert('Something wrong with your file');</script";
		
	}
}

?>










