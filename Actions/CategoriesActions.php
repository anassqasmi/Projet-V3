<?php 
// manage all categories actions(create,edit,delete), interaction // with DAO
if (!isset($_SESSION))
{
	//session_start();
}
?>

<?php
 

function modcate($newCat, $oldCat) {
	modCat($newCat, $oldCat);
	exit();
}

function deletecate($oldCat) {
	deleteCat($oldCat);
	exit();
}

?>