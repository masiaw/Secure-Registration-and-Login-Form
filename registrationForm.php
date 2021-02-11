<?php
header("Content-Security-Policy: default-src 'self'");
echo "<form action='registrationFormCheck.php' method='post'>";
echo "<pre>"; 

echo "Forename:";
echo "<input name='vrForename' type='varchar'/>";
echo "<br/>";

echo "Surname:";
echo " <input name='vrSurname' type='varchar'/>";
echo "<br/>";

echo "Username:";
echo " <input name='vrUsername' type='varchar'/>";
echo "<br/>";

echo "Email:";
echo "<input name='vrEmail' type='varchar'/>";
echo "<br/>";

echo "Date Of Birth:";
echo "<input name='dateOfBirth' type='date'/>";
echo "<br/>";

echo "Address in format 'Postcode, house number':";
echo "<input name='vrAddress' type='varchar'/>";
echo "<br/>";

echo "Password:";
echo "<input name='Password' type='password'/>";
echo "<br/>";

echo "Confirm password:";
echo "<input name='conPassword' type='password'/>";
echo "<br/>";
echo "<br/>"; 
echo "<input type='submit' value='Register'>";
echo "</pre>";
echo "</form>";
?>
