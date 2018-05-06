<?php
require_once('config.php');	

// Load Classes
C::loadClass('User');
//Init User class
$User = new User();


if(!empty($_POST["nickName"])) {
$result = $User->query("SELECT count(*) FROM tblUser WHERE nickName='" . $_POST["nickName"] . "'");
// $row = mysqli_fetch_row($result['0']['count(*)']);
// $user_count = $row[0];
if($result['0']['count(*)'] >0) echo "<span class='status-not-available'> Username Not Available.</span>";
else echo "<span class='status-available'> Username Available.</span>";
}


?>
