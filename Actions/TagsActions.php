<?php if (!isset($_SESSION))
// manage all Tags actions(create,edit,delete), interaction 
// with DAO
  {
    //session_start();
  }

function modTa($newCat, $oldCat) {
	modTagg($newCat, $oldCat);
}

function deleteTa($newCat, $oldCat) {
	deleteTagg($oldCat);
}

?>