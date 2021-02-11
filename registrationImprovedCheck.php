<?php
header("Content-Security-Policy: default-src 'self'");
 $servername = "localhost";
 $rootuser="root";
 $db="socnet";
 $rootpassword ="";
// Create connection
$conn = new mysqli($servername, $rootuser, $rootpassword, $db);
// Check connection
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}

//Values from form
$forename = htmlspecialchars($_POST['vrForename']);
$surname = htmlspecialchars($_POST['vrSurname']);
$username = htmlspecialchars($_POST['vrUsername']); 
$email = htmlspecialchars($_POST['vrEmail']); 
$dateofb = htmlspecialchars($_POST['DOB']); 
$address = htmlspecialchars($_POST['vrAddress']); 
$password = htmlspecialchars($_POST['Password']); 
$conpassword = htmlspecialchars($_POST['conPassword']); 

if (empty($forename) || !preg_match('#[A-Za-z_-]{3,16}$#',$forename)){
	exit("invalid forename");
}

if (empty($surname) || !preg_match('#^[A-Za-z_-]{3,16}$#s',$surname)){
	exit("invalid surname");
}
 
if (empty($username) || !preg_match('#^[A-Za-z]+[0-9]*$#s',$username)){
	exit("invalid username");
}

if (empty($email) || !preg_match('#[A-Za-z]+[0-9]*@[A-Za-z]+([.][A-Za-z])+#',$email)){
	exit("invalid email");
}

if (empty($address) || !preg_match('#(^[A-Za-z][A-Za-z][0-9][0-9][A-Za-z][A-Za-z][,][\s][0-9]+)+$#s',$address)){
	exit("invalid address format");
}

if(!preg_match('#[A-Z]+#',$password)){
	exit("Password must contain atleast one capital letter");
}

if(!preg_match('#[a-z]+#',$password)){
	exit("Password must contain atleast one small letter");
}

if(!preg_match('#[0-9]+#',$password)){
	exit("Password must contain atleast one number");
}

if(strlen($password) < 8){
	exit("Password must be at least 8 characters long");
}
if (empty($password) || !preg_match('#[A-Za-z]+[0-9]+[A-Za-z]*#',$password)){
	exit("invalid password");
}

// Hash password use BCRYPT
$hash = password_hash ($password , PASSWORD_BCRYPT);

//Generate key
$vKey = md5(time().$username);

$secretKey = "6LeieQkaAAAAAKIN_p23Qyj20w2ENUx5gUNvoyg9";
$responseKey = $_POST['g-recaptcha-response'];
$userIP = $_SERVER['REMOTE_ADDR'];

$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
$response = file_get_contents($url);
$response = json_decode($response);
if ($response->success)
{
    echo "Great! Your username is: $username Please go to your email and verify your account";
	echo"<br/>";
    if($password == $conpassword)
	{
		//  INSERT query   , check hash variable in the Values statement 
		$userQuery = "INSERT INTO customer2 (Forename, Surname, Username, CustomerEmailAddress, DateOfBirth, Address, Password,vKey) Values( '$forename', '$surname', '$username', '$email', '$dateofb', '$address', '$hash','$vKey')";
		if ($conn->query($userQuery) == TRUE)
		{
			$to = $email;
			$subject = 'Email verification2';
			$message = "<a href = 'https://localhost/coursework/verify.php?vkey=$vKey> Register Account </a>";

			mail($to,$subject,$message,'From:sussexproject99@yahoo.com');
		}
		else
		{
			echo "not successfull";
		}
	}
	else 
	{
		echo "The passwords do not match each other, therefore you were not registered.";
	}
}
else
{
    echo "Verification failed!";
}
?>