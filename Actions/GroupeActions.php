<?php 
// manage all Groups actions(create,edit,delete), interaction 
// with DAO

if (!isset($_SESSION))
{
	//session_start();
}

function addGr($nom, $uid) {
	addG($nom, $uid);
}

function deleteGr($gId) {
	deleteG($gId);
}

function modGr($id, $gnom, $listU)
{
	modG($id, $gnom, $listU);
}

?>