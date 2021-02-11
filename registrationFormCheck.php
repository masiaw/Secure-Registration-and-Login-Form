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
$dateofb = htmlspecialchars($_POST['dateOfBirth']); 
$address = htmlspecialchars($_POST['vrAddress']); 
$password = htmlspecialchars($_POST['Password']); 
$conpassword = htmlspecialchars($_POST['conPassword']);


if (empty($forename) || !preg_match('#^[A-Za-z_-]{3,16}$#s',$forename)){
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
	exit("Password must contain at least one capital letter");
}

if(!preg_match('#[a-z]+#',$password)){
	exit("Password must contain at least one small letter");
}

if(!preg_match('#[0-9]+#',$password)){
	exit("Password must contain at least one number");
}

if(strlen($password) < 8){
	exit("Password must be at least 8 characters long");
}
if (empty($password) || !preg_match('#[A-Za-z]+[0-9]+[A-Za-z]*#',$password)){
	exit("invalid password");
}

// Hash password use BCRYPT
$hash = password_hash ($password , PASSWORD_BCRYPT);

if($password == $conpassword)
{
	//  INSERT query   , check hash variable in the Values statement 
	$userQuery = "INSERT INTO customer (Forename, Surname, Username, CustomerEmailAddress, DateOfBirth, Address, Password) 
	Values( '$forename', '$surname', '$username', '$email', '$dateofb', '$address', '$hash')";
	if ($conn->query($userQuery) == TRUE)
	{
		echo "You have been successfully registered";
	}	
	else
	{
		echo "not successfull";
	}
}
else 
{
	echo "Your passwords do not match";
}
?>

