<?php 
// THIS Class is an object that provides an abstract interface //and persistence mechanism
if (!isset($_SESSION['unom']))
{
	session_start();
}

function nbTache(){
	$nb = 0;
	
	$xml = simplexml_load_file ( "../Ressources/Taches.xml" ) or die ( "Error: Cannot create object" );
	
	foreach ( $xml->children () as $tache ) {
		if(strcmp($tache->statu, '1') != 0){
			$nb++;
		}
	}
	
	return $nb;
}

function nbTacheDone(){
	$nb = 0;

	$xml = simplexml_load_file ( "../Ressources/Taches.xml" ) or die ( "Error: Cannot create object" );

	foreach ( $xml->children () as $tache ) {
		if(strcmp($tache->statu, '1') == 0){
			$nb++;
		}
	}

	return $nb;
}


//////////////////////////////////////// accesse to the file
function readNotes() {
	$xml = simplexml_load_file ( "../Ressources/note.xml" ) or die ( "Error: Cannot create object" );
	
	foreach ( $xml->children () as $tache ) {
		echo $tache->date . ", ";
		echo $tache->contenu . ", ";
		echo $tache->categorie . ", ";
		echo $tache->tag . "<br>";
		echo $tache->for . "<br>";
	}
}
function readUsers() {
	$xml = simplexml_load_file ( "../Ressources/Users.xml" ) or die ( "Error: Cannot create object" );
	$i = 0;
	foreach ( $xml->children () as $tache ) {
		$user[0] =  $tache->attributes();
		$user[1] =  $tache->name;
		$user[2] =  $tache->prenom;
		$user[3] =  $tache->passwd;
		$user[4] =  $tache->typedecompte;
		$user[5] =  $tache->photo;
		$arrUser[$i] = $user;
		$i++;
	}
	$_SESSION['arrU'] = $arrUser;
}

function readEtudiants() {
	$xml = simplexml_load_file ( "../Ressources/Users.xml" ) or die ( "Error: Cannot create object" );
	$i = 0;
	foreach ( $xml->children () as $tache ) {
		if($tache->typedecompte != 'admin'){
			$user[0] =  $tache->attributes();
			$user[1] =  $tache->name;
			$user[2] =  $tache->prenom;
			$user[3] =  $tache->passwd;
			$user[4] =  $tache->typedecompte;
			$user[5] =  $tache->photo;
			$arrUser[$i] = $user;
			$i++;
		}
	}
	$_SESSION['arrU'] = $arrUser;
}

function deleteUser($old)
{
	$xml = simplexml_load_file("../Ressources/Users.xml");
	for($i = 0, $length = count($xml->user); $i < $length; $i++){
		$att = $xml->user[$i]->attributes();
		
		if( $old == $att  ){
			unset($xml->user[$i]);
			break;
		}
	}
	
	$xml->asXML('../Ressources/Users.xml');
}

function saveUser($name, $prnm, $passwd, $email, $typeCompte, $photo) {
	$xmldoc = new DomDocument ( '1.0' );
	$xmldoc->preserveWhiteSpace = false;
	$xmldoc->formatOutput = true;
	
	if ($xml = file_get_contents ( '../Ressources/Users.xml' )) {
		$xmldoc->loadXML ( $xml, LIBXML_NOBLANKS );
		
		// find the headercontent tag
		$root = $xmldoc->getElementsByTagName ( 'users' )->item ( 0 );
		
		// create the <product> tag
		$user = $xmldoc->createElement ( 'user' );
		$numAttribute = $xmldoc->createAttribute ( "id" );
		if(!isset($_SESSION['uid']) ) {
			$numAttribute->value = maxId("Users");
		}else {
			$numAttribute->value = $_SESSION['uid'];
		}
		$user->appendChild ( $numAttribute );
		
		// add the product tag before the first element in the <headercontent> tag
		$root->insertBefore ( $user, $root->firstChild );
		
		// create other elements and add it to the <product> tag.
		$nameElement = $xmldoc->createElement ( 'name' );
		$user->appendChild ( $nameElement );
		$nameText = $xmldoc->createTextNode ( $name );
		$nameElement->appendChild ( $nameText );
		
		$prenom = $xmldoc->createElement ( 'prenom' );
		$user->appendChild ( $prenom );
		$categoryText = $xmldoc->createTextNode ( $prnm );
		$prenom->appendChild ( $categoryText );
		
		$password = $xmldoc->createElement ( "passwd" );
		$user->appendChild ( $password );
		$passwordText = $xmldoc->createTextNode ( $passwd );
		$password->appendChild ( $passwordText );
		
		$emails = $xmldoc->createElement ( "email" );
		$user->appendChild ( $emails );
		$emailText = $xmldoc->createTextNode ( $email );
		$emails->appendChild ( $emailText );
		
		$typeComp = $xmldoc->createElement ( "typedecompte" );
		$user->appendChild ( $typeComp );
		$tcText = $xmldoc->createTextNode ( $typeCompte );
		$typeComp->appendChild ( $tcText );
		
		$photos = $xmldoc->createElement ( "photo" );
		$user->appendChild ( $photos );
		$photoText = $xmldoc->createTextNode ( $photo );
		$photos->appendChild ( $photoText );
		
		$xmldoc->save ( '../Ressources/Users.xml' );
	}
}
function connectUser($login, $passwd) {
	$xml = simplexml_load_file ( "../Ressources/Users.xml" ) or die ( "Error: Cannot create object" );
	$array;
	foreach ( $xml->children () as $tache ) {
			if (($tache->email) == trim ( $login ) && ($tache->passwd) == trim ( $passwd )) {
				$_SESSION['uid'] = $tache->attributes() . "";
				$_SESSION['unom'] = $tache->name . "";
				$_SESSION['uprenom'] = $tache->prenom . "";
				$_SESSION['upwd'] = $tache->passwd . "";
				$_SESSION['utype'] = $tache->typedecompte . "";
				$_SESSION['umail'] = $tache->email . "";
				return 1;
			}
	}
	return 0;
	session_write_close();
}

function getUserById($id) {
	//echo '<script type="text/javascript">'
	//				, 'alert("le user id ' . $id . '");'
	//, '</script>';
	if(intval($id) < 501)
	{
		$xml = simplexml_load_file ( "../Ressources/Users.xml" ) or die ( "Error: Cannot create object" );
		$array;
		foreach ( $xml->children () as $tache ) {
				if ($tache->attributes()."-" == $id."-") {
					return $tache->name . "";
				}
		}
		return 'll';
		session_write_close();
	}else
	{
		$xml = simplexml_load_file ( "../Ressources/Groupes.xml" ) or die ( "Error: Cannot create object" );
		$array;
		foreach ( $xml->children () as $tache ) {
				if ($tache->attributes()."-" == $id."-") {
					return $tache->nom . "";
				}
		}
		return 'll';
		session_write_close();
	}
}

function checkEmail($login) {
	$xml = simplexml_load_file ( "../Ressources/Users.xml" ) or die ( "Error: Cannot create object" );
	foreach ( $xml->children () as $tache ) {
		if (strcmp($tache->email . "", $login . "") == 0) {
			return 1;
		}
	}
		return 0;
}

//////////////////////////////////////// categories
function checkCat($cat) {
	$xml = simplexml_load_file ( "../Ressources/Categories.xml" ) or die ( "Error: Cannot create object" );
	foreach ( $xml->children () as $tache ) {
		if ($tache->name. "k" == $cat. "k") {
			return 1;
		}
	}
	return 0;
}

function saveCat($cat) {
	$xmldoc = new DomDocument ( '1.0' );
	$xmldoc->preserveWhiteSpace = false;
	$xmldoc->formatOutput = true;
	
	if ($xml = file_get_contents ( '../Ressources/Categories.xml' )) {
		$xmldoc->loadXML ( $xml, LIBXML_NOBLANKS );
	
		// find the headercontent tag
		$root = $xmldoc->getElementsByTagName ( 'categories' )->item ( 0 );
	
		// create the <product> tag
		$categ = $xmldoc->createElement ( 'categorie' );
		$numAttribute = $xmldoc->createAttribute ( "id" );
		$numAttribute->value = maxId("Categories");
		$categ->appendChild ( $numAttribute );
	
		// add the product tag before the first element in the <headercontent> tag
		$root->insertBefore ( $categ, $root->firstChild );
	
		// create other elements and add it to the <product> tag.
		$nameElement = $xmldoc->createElement ( 'name' );
		$categ->appendChild ( $nameElement );
		$nameText = $xmldoc->createTextNode ( $cat );
		$nameElement->appendChild ( $nameText );
	
		$xmldoc->save ( '../Ressources/Categories.xml' );
		
	}
}

function saveCat2($cat, $old) {
	$xmldoc = new DomDocument ( '1.0' );
	$xmldoc->preserveWhiteSpace = false;
	$xmldoc->formatOutput = true;

	if ($xml = file_get_contents ( '../Ressources/Categories.xml' )) {
		$xmldoc->loadXML ( $xml, LIBXML_NOBLANKS );

		// find the headercontent tag
		$root = $xmldoc->getElementsByTagName ( 'categories' )->item ( 0 );

		// create the <product> tag
		$categ = $xmldoc->createElement ( 'categorie' );
		$numAttribute = $xmldoc->createAttribute ( "id" );
		$numAttribute->value = $old;
		$categ->appendChild ( $numAttribute );

		// add the product tag before the first element in the <headercontent> tag
		$root->insertBefore ( $categ, $root->firstChild );

		// create other elements and add it to the <product> tag.
		$nameElement = $xmldoc->createElement ( 'name' );
		$categ->appendChild ( $nameElement );
		$nameText = $xmldoc->createTextNode ( $cat );
		$nameElement->appendChild ( $nameText );

		$xmldoc->save ( '../Ressources/Categories.xml' );

	}
}

function readCat() {
	$xml = simplexml_load_file ( "../Ressources/Categories.xml" ) or die ( "Error: Cannot create object" );
	$i = 0;
	$array;
	$arrayid;
	foreach ( $xml->children () as $tache ) {
			$array[$i] = $tache->name;
			$arrayid[$i] = $tache->attributes();
			$i = $i + 1;
	}
	$_SESSION['arr'] = $array;
	$_SESSION['arrid'] = $arrayid;
}

function deleteCat($old)
{
	$data = simplexml_load_file("../Ressources/Categories.xml");
    for($i = 0, $length = count($data->categorie); $i < $length; $i++){
      if($data->categorie[$i]->name == $old ){
        unset($data->categorie[$i]);
        break;
      }
    }
    $data->asXML('../Ressources/Categories.xml');
    //file_put_contents("../Ressources/Categories.xml" , $data->saveXML());
	echo "<script type='text/javascript'>
				document.location.replace('../View/Categories.php');
			</script>";
}

function modCat($new, $old)
{ 
	$data = simplexml_load_file("../Ressources/Categories.xml");
    for($i = 0, $length = count($data->categorie); $i < $length; $i++){
      if($data->categorie[$i]->name == $old ){
      	$id = $data->categorie[$i]->attributes(). "";
      	unset($data->categorie[$i]);
      	$data->asXML('../Ressources/Categories.xml');
      	saveCat2($new, $id);
        break;
      }
    }
    
    echo "<script type='text/javascript'>
				document.location.replace('../View/Categories.php');
			</script>";
}

///////////////////////////////////////// les Tags 
function checkTag($cat) {
	$xml = simplexml_load_file ( "../Ressources/Tags.xml" ) or die ( "Error: Cannot create object" );
	foreach ( $xml->children () as $tache ) {
		if (($tache->name) == $cat) {
			return 1;
		}
	}
	return 0;
}

function saveTagg($cat) {
	$xmldoc = new DomDocument ( '1.0' );
	$xmldoc->preserveWhiteSpace = false;
	$xmldoc->formatOutput = true;

	if ($xml = file_get_contents ( '../Ressources/Tags.xml' )) {
		$xmldoc->loadXML ( $xml, LIBXML_NOBLANKS );

		// find the headercontent tag
		$root = $xmldoc->getElementsByTagName ( 'Tags' )->item ( 0 );

		// create the <product> tag
		$categ = $xmldoc->createElement ( 'Tag' );
		$numAttribute = $xmldoc->createAttribute ( "id" );
		$numAttribute->value = maxId("Tags");
		$categ->appendChild ( $numAttribute );

		// add the product tag before the first element in the <headercontent> tag
		$root->insertBefore ( $categ, $root->firstChild );

		// create other elements and add it to the <product> tag.
		$nameElement = $xmldoc->createElement ( 'name' );
		$categ->appendChild ( $nameElement );
		$nameText = $xmldoc->createTextNode ( $cat );
		$nameElement->appendChild ( $nameText );

		$xmldoc->save ( '../Ressources/Tags.xml' );
		echo "<script type='text/javascript'>
				document.location.replace('../View/Tags.php');
			</script>";

	}
}

function saveTagg2($cat, $old) {
	$xmldoc = new DomDocument ( '1.0' );
	$xmldoc->preserveWhiteSpace = false;
	$xmldoc->formatOutput = true;

	if ($xml = file_get_contents ( '../Ressources/Tags.xml' )) {
		$xmldoc->loadXML ( $xml, LIBXML_NOBLANKS );

		// find the headercontent tag
		$root = $xmldoc->getElementsByTagName ( 'Tags' )->item ( 0 );

		// create the <product> tag
		$categ = $xmldoc->createElement ( 'Tag' );
		$numAttribute = $xmldoc->createAttribute ( "id" );
		$numAttribute->value = $old;
		$categ->appendChild ( $numAttribute );

		// add the product tag before the first element in the <headercontent> tag
		$root->insertBefore ( $categ, $root->firstChild );

		// create other elements and add it to the <product> tag.
		$nameElement = $xmldoc->createElement ( 'name' );
		$categ->appendChild ( $nameElement );
		$nameText = $xmldoc->createTextNode ( $cat );
		$nameElement->appendChild ( $nameText );

		$xmldoc->save ( '../Ressources/Tags.xml' );
		echo "<script type='text/javascript'>
				document.location.replace('../View/Tags.php');
			</script>";

	}
}

function readTagg() {
	$xml = simplexml_load_file ( "../Ressources/Tags.xml" ) or die ( "Error: Cannot create object" );
	$i = 0;
	$array;
	foreach ( $xml->children () as $tache ) {
		$array[$i] = $tache->name;
		$i = $i + 1;
	}
	$_SESSION['arrT'] = $array;
}

function deleteTagg($old)
{
	$data = simplexml_load_file("../Ressources/Tags.xml");
	for($i = 0, $length = count($data->Tag); $i < $length; $i++){
		if($data->Tag[$i]->name == $old ){
			unset($data->Tag[$i]);
			break;
		}
	}
	$data->asXML('../Ressources/Tags.xml');
	echo "<script type='text/javascript'>
				document.location.replace('../View/Tags.php');
			</script>";
}

function modTagg($new, $old)
{
	
	$data = simplexml_load_file("../Ressources/Tags.xml");
	for($i = 0, $length = count($data->Tag); $i < $length; $i++){
		if($data->Tag[$i]->name == $old ){
			$id = $data->Tag[$i]->attributes(). "";
			unset($data->Tag[$i]);
			$data->asXML('../Ressources/Tags.xml');
			saveTagg2($new, $id);
			break;
		}
	}
	
	
}
////////////////////////////////////////// tache
///////////////////////////////////////// les taches

function changerStatu($old)
{
	$xml = simplexml_load_file ( "../Ressources/Taches.xml" ) or die ( "Error: Cannot create object" );
	foreach ( $xml->children () as $tache ) {
		if($tache->attributes() == $old)
		{
			$tmp[0] = $tache->attributes();
			$tmp[1] = $tache->date;
			$tmp[2] = $tache->contenu;
			$tmp[3] = $tache->categorie;
			$tmp[4] = $tache->tag;
			$tmp[5] = $tache->cible;
		}
	}
	deleteTache($old);
	$val2 = "1";
	addTachebyid($old, $tmp[1], $tmp[2], $tmp[3], $tmp[4], $tmp[5], $val2);
}

function changerStat($old, $type)
{
	$xml = simplexml_load_file ( "../Ressources/Taches.xml" ) or die ( "Error: Cannot create object" );
	foreach ( $xml->children () as $tache ) {
		if($tache->attributes() == $old)
		{
			$tmp[0] = $tache->attributes();
			$tmp[1] = $tache->date;
			$tmp[2] = $tache->contenu;
			$tmp[3] = $tache->categorie;
			$tmp[4] = $tache->tag;
			$tmp[5] = $tache->cible;
			
		}
	}
	deleteTache($old);
	//echo '<script type="text/javascript">'
	//		, 'alert("la tache 2 --> ");'
	//				, '</script>';
	$val = "2";
	addTachebyid($old, $tmp[1], $tmp[2], $tmp[3], $tmp[4], $tmp[5], $val);
}

function addTachebyid($id, $date, $tache, $categorie, $tag, $cible, $stat)
{
	$xmldoc = new DomDocument ( '1.0' );
	$xmldoc->preserveWhiteSpace = false;
	$xmldoc->formatOutput = true;
	if ($xml = file_get_contents ( '../Ressources/Taches.xml' )) {
		$xmldoc->loadXML ( $xml, LIBXML_NOBLANKS );

		$root = $xmldoc->getElementsByTagName ( 'taches' )->item ( 0 );

		$user = $xmldoc->createElement ( 'tache' );
		$numAttribute = $xmldoc->createAttribute ( "id" );
		$numAttribute->value = $id;
		$user->appendChild ( $numAttribute );

		$root->insertBefore ( $user, $root->firstChild );

		$nameElement = $xmldoc->createElement ( 'date' );
		$user->appendChild ( $nameElement );
		$nameText = $xmldoc->createTextNode ( $date );
		$nameElement->appendChild ( $nameText );

		$prenom = $xmldoc->createElement ( 'contenu' );
		$user->appendChild ( $prenom );
		$categoryText = $xmldoc->createTextNode ( $tache );
		$prenom->appendChild ( $categoryText );

		$password = $xmldoc->createElement ( "categorie" );
		$user->appendChild ( $password );
		$passwordText = $xmldoc->createTextNode ( $categorie );
		$password->appendChild ( $passwordText );

		$emails = $xmldoc->createElement ( "tag" );
		$user->appendChild ( $emails );
		$emailText = $xmldoc->createTextNode ( $tag );
		$emails->appendChild ( $emailText );

		$typeComp = $xmldoc->createElement ( "cible" );
		$user->appendChild ( $typeComp );
		$tcText = $xmldoc->createTextNode ( $cible );
		$typeComp->appendChild ( $tcText );
		
		$statu = $xmldoc->createElement ( "statu" );
		$user->appendChild ( $statu );
		$tcText = $xmldoc->createTextNode ($stat);
		$statu->appendChild ( $tcText );

		$xmldoc->save ( '../Ressources/Taches.xml' );
	}
}


function addTache($date, $tache, $categorie, $tag, $cible)
{
	$xmldoc = new DomDocument ( '1.0' );
	$xmldoc->preserveWhiteSpace = false;
	$xmldoc->formatOutput = true;
	if ($xml = file_get_contents ( '../Ressources/Taches.xml' )) {
		$xmldoc->loadXML ( $xml, LIBXML_NOBLANKS );

		$root = $xmldoc->getElementsByTagName ( 'taches' )->item ( 0 );

		$user = $xmldoc->createElement ( 'tache' );
		$numAttribute = $xmldoc->createAttribute ( "id" );
		$numAttribute->value = maxId("Taches");
		$user->appendChild ( $numAttribute );

		$root->insertBefore ( $user, $root->firstChild );

		$nameElement = $xmldoc->createElement ( 'date' );
		$user->appendChild ( $nameElement );
		$nameText = $xmldoc->createTextNode ( $date );
		$nameElement->appendChild ( $nameText );

		$prenom = $xmldoc->createElement ( 'contenu' );
		$user->appendChild ( $prenom );
		$categoryText = $xmldoc->createTextNode ( $tache );
		$prenom->appendChild ( $categoryText );

		$password = $xmldoc->createElement ( "categorie" );
		$user->appendChild ( $password );
		$passwordText = $xmldoc->createTextNode ( $categorie );
		$password->appendChild ( $passwordText );

		$emails = $xmldoc->createElement ( "tag" );
		$user->appendChild ( $emails );
		$emailText = $xmldoc->createTextNode ( $tag );
		$emails->appendChild ( $emailText );

		$typeComp = $xmldoc->createElement ( "cible" );
		$user->appendChild ( $typeComp );
		$tcText = $xmldoc->createTextNode ( $cible );
		$typeComp->appendChild ( $tcText );
		
		$statu = $xmldoc->createElement ( "statu" );
		$user->appendChild ( $statu );
		$tcText = $xmldoc->createTextNode ( '0' );
		$statu->appendChild ( $tcText );

		$xmldoc->save ( '../Ressources/Taches.xml' );
	}
}

function readTaches() {
	$xml = simplexml_load_file ( "../Ressources/Taches.xml" ) or die ( "Error: Cannot create object" );
	$i = 0;
	foreach ( $xml->children () as $tache ) {
		$tmp[0] = $tache->attributes();
		$tmp[1] = $tache->date;
		$tmp[2] = $tache->contenu;
		$tmp[3] = $tache->categorie;
		$tmp[4] = $tache->tag;
		$tmp[5] = $tache->cible;
		$tmp[6] = $tache->statu;
		$t[$i] = $tmp; 
		$i = $i + 1;
	}
	$_SESSION['tachesTab'] = $t;
}

function readMyTaches() {
	$xml = simplexml_load_file ( "../Ressources/Taches.xml" ) or die ( "Error: Cannot create object" );
	$i = 0;
	foreach ( $xml->children () as $tache ) {
		if($tache->cible == $_SESSION['uid'] || $tache->cible == '1000' || inThisGroup($tache->cible) == 1)
		{
			$tmp[0] = $tache->attributes();
			$tmp[1] = $tache->date;
			$tmp[2] = $tache->contenu;
			$tmp[3] = $tache->categorie;
			$tmp[4] = $tache->tag;
			$tmp[5] = $tache->cible;
			$tmp[6] = $tache->statu;
			$t[$i] = $tmp;
			$i = $i + 1;
		}
	}
	
	$_SESSION['myTachesTab'] = $t;
}

function inThisGroup($id)
{
	/*echo '<script type="text/javascript">'
			, 'alert("dkhalna");'
					, '</script>';*/
	$xml = simplexml_load_file ( "../Ressources/Groupes.xml" ) or die ( "Error: Cannot create object" );
	foreach ( $xml->children () as $tache ) {
		if($tache->attributes()."" == $id."" )
		{
			$tmp = $tache->UID;
			$array=explode(",",$tmp);
			foreach ($array as $var) {
				if ($_SESSION['uid'] == intval($var))
				{
					return 1;
				}
			}
		}
		return 0;
	}
}

function maxId($name) {
	$xml = simplexml_load_file ( "../Ressources/" . $name .".xml" ) or die ( "Error: Cannot create object" );
	if($name == "Taches" || $name == "Users" || $name == "Tags" || $name == "Categories" ) {
		$i = 0;
	}else {
		$i = 500;
	}
	foreach ( $xml->children () as $tache ) {
		$attrs = $tache->attributes();
		if($attrs["id"] > $i) {
			$i = $attrs["id"];
		}
	}
	$i = $i+1;
	echo $i;
	return $i;
}

function deleteTache($old)
{
	$xml = simplexml_load_file("../Ressources/Taches.xml");
	for($i = 0, $length = count($xml->tache); $i < $length; $i++){
		if($xml->tache[$i]->attributes()."" == $old."" ){
			unset($xml->tache[$i]);
			break;
		}
	}
	$xml->asXML('../Ressources/Taches.xml');
	//file_put_contents("../Ressources/Taches.xml" , $xml->saveXML());
}

function modTache($oldTache, $date, $tache, $categorie, $tag, $cible)
{
	deleteTache($oldTache);
	addTache($date, $tache, $categorie, $tag, $cible);
}

function getTache($id)
{
	$xml = simplexml_load_file("../Ressources/Taches.xml");
	for($i = 0, $length = count($xml->tache); $i < $length; $i++){
		if($xml->tache[$i]->attributes()."" == $id."" ){
			
			$_SESSION['tid'] = $xml->tache[$i]->attributes() . "";
			$_SESSION['td'] = $xml->tache[$i]->date . "";
			$_SESSION['tcontenu'] = $xml->tache[$i]->contenu . "";
			$_SESSION['tca'] = $xml->tache[$i]->categorie . "";
			$_SESSION['tt'] = $xml->tache[$i]->tag . "";
			$_SESSION['tci'] = $xml->tache[$i]->cible . "";
			break;
		}
	}
}

///////////////////////////////////////// les Groupes
function readGroups() {
	$xml = simplexml_load_file ( "../Ressources/Groupes.xml" ) or die ( "Error: Cannot create object" );
	$i = 0;
	foreach ( $xml->children () as $tache ) {
		$tmp[0] = $tache->attributes();
		$tmp[1] = $tache->nom;
		$tmp[2] = $tache->GID;
		$tmp[3] = $tache->UID;
		$t[$i] = $tmp;
		$i = $i + 1;
	}

	$_SESSION['GroupeTab'] = $t;
}

function readGroups2() {
	$xml = simplexml_load_file ( "Ressourcess/Groupes2.xml" ) or die ( "Error: Cannot create object" );
	$i = 0;
	foreach ( $xml->children () as $tache ) {
		$tmp[0] = $tache->attributes();
		$tmp[1] = $tache->nom;
		$tmp[2] = $tache->GID;
		$tmp[3] = $tache->UID;
		$t[$i] = $tmp;
		$i = $i + 1;
	}
	return 'ok';
}



function addG($nom, $UID) {
	
	$xmldoc = new DomDocument ( '1.0' );
	$xmldoc->preserveWhiteSpace = false;
	$xmldoc->formatOutput = true;
	
	if ($xml = file_get_contents ( '../Ressources/Groupes.xml' )) {
		$xmldoc->loadXML ( $xml, LIBXML_NOBLANKS );

		// find the headercontent tag
		$root = $xmldoc->getElementsByTagName ( 'Groupes' )->item ( 0 );

		// create the <product> tag
		$categ = $xmldoc->createElement ( 'Groupe' );
		$numAttribute = $xmldoc->createAttribute ( "id" );
		$numAttribute->value = maxId("Groupes");
		$categ->appendChild ( $numAttribute );

		// add the product tag before the first element in the <headercontent> tag
		$root->insertBefore ( $categ, $root->firstChild );

		// create other elements and add it to the <product> tag.
		$nameElement = $xmldoc->createElement ( 'nom' );
		$categ->appendChild ( $nameElement );
		$nameText = $xmldoc->createTextNode ( $nom );
		$nameElement->appendChild ( $nameText );
		
		$nameElement = $xmldoc->createElement ( 'GID' );
		$categ->appendChild ( $nameElement );
		$nameText = $xmldoc->createTextNode ( "" );
		$nameElement->appendChild ( $nameText );
		
		$nameElement = $xmldoc->createElement ( 'UID' );
		$categ->appendChild ( $nameElement );
		$nameText = $xmldoc->createTextNode ( $UID );
		$nameElement->appendChild ( $nameText );

		$xmldoc->save ( '../Ressources/Groupes.xml' );

	}
}


function PWD($pwd)
{
	$pwd = "asASA199";
	if(preg_match('/[A-Z]/', $pwd)){
 		
 		if(preg_match('/[1-9]/', $pwd)){
			return true;
		}
	}
	return false;
	
}

function Nom($nom)
{
	$id = "anass";
	if(preg_match('/[a-z]/', $pwd)){
 		return true;
	}
	return false;
}

function PrenomExist($nom)
{

	$id = "anass";
	if(preg_match('/[a-z]/', $pwd)){
 		return true;
	}
	return false;
}
///////////////////
function difTag()
{
	
	return 1;
}

function checkuser($id)
{
	$id = "anass";
	if(preg_match('/[a-z]/', $pwd)){
 		return true;
	}
	return false;
}
	
function checkFile($pwd)
{
	$pwd = "File.XML";
	if (strpos($pwd, '.XML') == false)
	{
    		return false;
	}
	else
	{
		return true;
	}
	return true;
}

function virLog($nom)
{
	
	return true;
}

function fileExist($nom)
{
	$nom = "File.XML";
	if (strpos($nom, '.XML') == false)
	{
    		return false;
	}
	else
	{
		return true;
	}
	return true;
}


function deleteG($old)
{
	$xml = simplexml_load_file("../Ressources/Groupes.xml");
	for($i = 0, $length = count($xml->Groupe); $i < $length; $i++){
		if($xml->Groupe[$i]->attributes()."" == $old."" ){
			unset($xml->Groupe[$i]);
			break;
		}
	}
	
	$xml->asXML('../Ressources/Groupes.xml');
}

function modG($id, $Gnom, $listU)
{
	deleteG($id);
	addG($Gnom, $listU);
}

function tagvir()
{
	return 1;
}

function Email($id)
{
	$id = "1";
	$email = "test@gmail.com";
	if (strpos($email, '@') == false)
	{
    		return false;
	}
	else
	{
		return true;
	}
}

?>  
