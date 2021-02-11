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
$password =  htmlspecialchars($_POST['vrPassword']);

// Check connection
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}
// query
$userQuery = "SELECT * FROM Customer";
$userResult = $conn->query($userQuery);

// flag type variable 
$userFound = 0;
echo "<table border='1'>";
if ($userResult->num_rows > 0){
  while($userRow = $userResult->fetch_assoc()) 
    {
		if ($userRow['Username'] == $username)
		{
			$userFound = 1; 
			
			// Get password from database			
			if (password_verify($password, $userRow['Password']))
			{
				echo "Hi " .$username. "!";
				echo "<br/> Welcome to our website";
			}
			else
			{
				echo "Wrong password";
			}	
		}
	}
}
if ($userFound == 0){
	echo "This user was not found in our Database";
} 
 ?>