<?php
header("Content-Security-Policy: default-src 'self'");
// server and db connection values
 $servername = "localhost";
 $rootUser="root";
 $db="socnet";
 $rootPassword ="";

// Create connection
$conn = new mysqli($servername, $rootUser, $rootPassword, $db);

// values come from user entry in webform
$username = htmlspecialchars($_POST['vrUsername']);
$oldPassword =  htmlspecialchars($_POST['vrOldPassword']);
$newPassword =  htmlspecialchars($_POST['vrnewPass']);
$conPassword =  htmlspecialchars($_POST['vrnewPassConfirm']);


if(!preg_match('#[A-Z]+#',$newPassword)){
	exit("Password must contain at least one capital letter");
}

if(!preg_match('#[a-z]+#',$newPassword)){
	exit("Password must contain at least one small letter");
}

if(!preg_match('#[0-9]+#',$newPassword)){
	exit("Password must contain at least one number");
}

if(strlen($newPassword) < 8){
	exit("Password must be at least 8 characters long");
}

if (empty($newPassword) || !preg_match('#[A-Za-z]+[0-9]+[A-Za-z]*#',$newPassword)){
	exit("invalid password");
}

// Check connection
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}
// query
$userQuery = "SELECT * FROM Customer";
$userResult = $conn->query($userQuery);

// flag type variable 
$userFound = 0;

echo "<table border='1'>";
if($newPassword == $conPassword)
{
   if ($userResult->num_rows > 0)
   {
  	while($userRow = $userResult->fetch_assoc()) 
    	{
		if ($userRow['Username'] == $username)
		{
			$userFound = 1; 
				
			if (password_verify($oldPassword, $userRow['Password']))
			{
				// Hash password use BCRYPT
				$hash = password_hash ($newPassword , PASSWORD_BCRYPT);					
				$sql = "UPDATE customer SET Password='$hash' WHERE Username ='$username'";
				if($conn->query($sql) == TRUE)
				{
					echo "Record updated sucessfully";
				}
				else
				{
					echo "Password not updated";
				}
			}
			else
			{
				echo "Wrong current password";
			}	
		}
		else{
			echo "User not found";
		}
   	}
   }
}
else
{
	echo "Your passwords do not match";
}
 
 ?>
