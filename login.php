<?php
header("Content-Security-Policy: default-src 'self'");
echo "<form action='loginCheck.php' method='post'>";
echo "<pre>"; // check in Google what pre does

echo "Username:";
echo " <input name='vrUsername' type='varchar'/>";
echo "<br/>";

echo "Password:";
echo "   <input name='vrPassword' type='varchar'/>";
echo "<br/>";

echo "<br/>"; 
echo "<input type='submit' value='Log in'>";

echo "</pre>";
echo "</form>";

?>

