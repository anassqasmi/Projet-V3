<?php 
	if (!isset($_SESSION))
	{
	session_start();
	}
  if (!isset($_SESSION['unom']))	
  {
  	echo '<script type="text/javascript">'
  			, 'document.location.replace("../Index.php");'
  			, '</script>';
  }
  
  //************************language************************	//************************language************************
  
  if (isset($_GET['lang']))
  {
  	$language = $_GET['lang'];
  
  }else{
  	$language = "fr_FR";
  }
  putenv("LANG=".$language);
  setlocale(LC_ALL, $language);
  $domain = "messages";
  bindtextdomain($domain, "../Locale");
  textdomain($domain);
  //************************language************************//************************language************************
  
  

?>

<head>
	<meta charset="utf-8"/>
	<title>Etudiant</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

	function deco()
	{
		alert("ll");
		document.location.replace("../Controlor/MainControloe.php?fun=dec");
	}

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="Accueil.php"><?php echo gettext("Accueil");?></a></h1>
			<h2 class="section_title"><?php echo gettext("Espace_Etudiant");?></h2>
		</hgroup>
		<!-- ************************language************************	//************************language************************ -->
		<form action=<?php echo basename($_SERVER['PHP_SELF']); ?> >
				<select name="lang" id="lang" size="1" onChange="this.form.submit()">
			<?php if ($_GET['lang'] == "ar_AR")
		  		echo '<option selected value="ar_AR">Arabe</option>';
		  		else 
		  		echo '<option value="ar_AR">Arabe</option>';
		  	?>
		  	<?php if ($_GET['lang'] == "fr_FR" || !isset($_GET['lang']))
		  		echo '<option selected value="fr_FR">Francais</option>';
		  		else 
		  		echo '<option value="fr_FR">Francais</option>';
		  	?>
		  	<?php if ($_GET['lang'] == "en_US")
		  		echo '<option selected value="en_US">Anglais</option>';
		  		else 
		  		echo '<option value="en_US">Anglais</option>';
		  	?>
		  	<?php if ($_GET['lang'] == "es_ES")
		  		echo '<option selected value="es_ES">Espagniol</option>';
		  		else 
		  		echo '<option value="es_ES">Espagniol</option>';
		  	?>
			</select>
	    </form>
		<!-- ************************language************************	//************************language************************ -->
		
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo $_SESSION['unom'] ?> (<a href="#">3 <?php echo gettext("Tâches");?></a>)</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="index.html"><?php echo gettext("Espace_Etudiant");?></a> <div class="breadcrumb_divider"></div> <a class="current"></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		<h3><?php echo gettext("parametrage");?></h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="Options2.php"><?php echo gettext("Option");?></a></li>
			<!-- <li class="icn_security"><a href="#">Security</a></li>  -->
			<li class="icn_jump_back"><a href="../Controlor/MainControlor.php?fun=dec" onclick="deco()"><?php echo gettext("Déconnecter");?></a></li>
		</ul>
		<h3></h3>
		<ul class="">
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
		</ul> 
		
		<footer>
			<hr />
			<p><strong><?php echo gettext("droits_d'auteur");?> &copy; QASMI ANASS</strong></p>
			<p>Taches Manager <a href="#"></a></p>
			<p></p>
		</footer>
		<ul class="">
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
			<li class=""><a href="#"></a></li>
		</ul> 
	</aside><!-- end of sidebar -->
	


<?php
?>