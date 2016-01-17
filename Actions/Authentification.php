<?php
if (! isset ( $_SESSION )) {
	session_start ();
}
?>

<?php

include ("../DAO/FileAccess.php");

$GET['nom1'] = 'anass';
$GET['nom2'] = 'anass';
$n1 = $GET['nom2'];
$n2 = $GET['nom1'];
function test($n1, $n2){
	if(strcmp($n1,$n2) == 0)
		return true;
	return false;
}

function login($login, $passwd) {
	if (connectUser ( $login, $passwd ) == 1) {
		if ($_SESSION ['utype'] == "admin") {
			echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Accueil.php");'
				, '</script>';
			return 'ok';
		}else {
			echo '<script type="text/javascript">'
						, 'document.location.replace("../View/espaceEtudiant.php");'
						, '</script>';
			return 'ok';
		}
	} else {
		echo '<script type="text/javascript">', 'document.location.replace("../Index.php?form=login passe incorrect");', '</script>';
		return 'notOk';
		exit ();
	}
}
?>
