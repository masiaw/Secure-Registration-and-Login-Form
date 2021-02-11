<?php
header("Content-Security-Policy: default-src 'self'");
echo "<form action='changePasswordCheck.php' method='post'>";
echo "<pre>"; // check in Google what pre does

echo "Username:";
echo " <input name='vrUsername' type='varchar'/>";
echo "<br/>";

echo "Old Password:";
echo "   <input name='vrOldPassword' type='varchar'/>";
echo "<br/>";

echo "New password:";
echo "<input name='vrnewPass' type='varchar'/>";
echo "<br/>";

echo "Confirm new password:";
echo "<input name='vrnewPassConfirm' type='varchar'/>";
echo "<br/>";

echo "<br/>";

echo "<br/>"; 
echo "<input type='submit' value='Change Password'>";

echo "</pre>";
echo "</form>";

?>

