<?php
$to = "farhatullah6683@gmail.com";
$subject = "Recover your password";
$txt = "Your password is ------";
if (mail($to,$subject,$txt)) {
	echo "Sent";
}else{
	echo "Failed";
}

?>