<?php

$connect = mysqli_connect("localhost","root","","tourguide");

if(!$connect)
{
die("Error");
}
// rendu photo kum same code naala function create panni parameter ah image name send panniruken //

if(isset($_POST['submit']) && isset($_FILES['photo'])  && isset($_FILES['proof']))
{
	
	
	//echo "<pre>";

	// print_r function is for print details of the image //

	//print_r($_FILES['photo']);
	//print_r($_FILES['proof']);

	//echo "</pre>";

	// function calling


	$query = "INSERT INTO signguidedetails(Name,Gender,Dob,Bloodgroup,Age,Nativeplace,DoorNO,Street,Area,City,Pincode,State,Phonenumber,Email,Language,Qualification,Skill,Experience) VALUES('".$_POST['Name']."','".$_POST['Gender']."','".$_POST['Dob']."','".$_POST['Bloodgroup']."','".$_POST['Age']."','".$_POST['Nativeplace']."','".$_POST['DoorNO']."','".$_POST['Street']."','".$_POST['Area']."','".$_POST['City']."','".$_POST['Pincode']."','".$_POST['State']."','".$_POST['Phonenumber']."','".$_POST['Email']."','".$_POST['Language']."','".$_POST['Qualification']."','".$_POST['Skill']."','".$_POST['Experience']."')";
	  mysqli_query($connect,$query);

	uploadimg('photo','photo');
	uploadimg('proof','proof');

}

function uploadimg($name,$col_name){


	/*print_r function call panna ipdi varum so ithula erunthu tha size tep_name eduthu namaloda condition ku correct ah erukka nu check pandrom like size, extention antha maari*/

/*
Array
(
    [name] => bg.jpg
    [full_path] => bg.jpg
    [type] => image/jpeg
    [tmp_name] => C:\xampp\tmp\php727F.tmp
    [error] => 0
    [size] => 81405
)
Array
(
    [name] => brbanner.jpg
    [full_path] => brbanner.jpg
    [type] => image/jpeg
    [tmp_name] => C:\xampp\tmp\php7280.tmp
    [error] => 0
    [size] => 10340
)*/

    $img_name = $_FILES[$name]['name'];
	$img_size = $_FILES[$name]['size'];
	$img_tmp_name = $_FILES[$name]['tmp_name'];
	$img_error = $_FILES[$name]['error'];

	// error ennamachum eruntha else part ku poirum

	if($img_error === 0)
	{

		// this for image size itha namma estam pola mathikalam

		if($img_size > 500000)
		{
			
			echo "<script> alert('invalid image extension');</script";
		}

		else{
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			// extention checcking

			$allowed_doc = array("jpg","jpeg","png");
			if(in_array($img_ex_lc, $allowed_doc)){

				// this is for image save aagum bothu intha 'IMG-' name ooda save aagum aduku tha //
			
				$new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;

				// ithula uploads vanthu ne entha folder la save pannanum nu nenaikerio athod name //

				$img_upload_path = 'img/'.$new_img_name;
				move_uploaded_file($img_tmp_name, $img_upload_path);

				// connecting to database

				$con = mysqli_connect("localhost","root","","tourguide");
				
				if(!$con)
				{
					echo "<script> alert(' DB not connected');</script";
				}

				$sql = "INSERT INTO signguidedetails(photo,proof) VALUES('$name','$col_name')";
				mysqli_query($con,$sql);
				echo "<script> alert('successfully submitted');</script";

			}

			else{
				echo "<script> alert(' pls upload jpg,jpeg or png format files only');</script";
			}
		}

	}

	else{
		echo "<script> alert(' Something wrong with your file'); </script";
		
	}
}


?>









