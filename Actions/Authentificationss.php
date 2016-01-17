<?php
if (! isset ( $_SESSION )) {
	session_start ();
}
?>

<?php


function test($mon1, $mon2){
	if(strcmp($mon1,$mon2) == 0)
		return true;
	return false;
}
?>
