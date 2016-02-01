<?php 
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
	bindtextdomain($domain, "Locale");
	textdomain($domain);	
	//************************language************************//************************language************************

	
	
	if (isset($_SESSION['unom']))
  	{
		session_start();
  		echo '<script type="text/javascript">'
  			, 'document.location.replace("View/Accueil.php");'
  			, '</script>';
  	}
?>
<!DOCTYPE html>

<html lang='en'>
<head>
    <meta charset="UTF-8" /> 
    <title>
        Welcome
    </title>
    <link rel="stylesheet" type="text/css" href="View/css/style.css" />
</head>
<body>
	<!-- ************************language************************	//************************language************************ -->
	<form action="index.php">
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
	
<div id="wrapper">

	<form name="login-form" class="login-form" action="Controlor/MainControlor.php?fun=auth" method="post">
	
		<div class="header">
		<h1>
		<?php
		echo gettext("Connexion");
		?>
		</h1>
		<span style=" font-color: red;">
			<?php 			
				 if(isset($_GET['form']))
					echo $_GET['form'] . "</br>";
			?>
		</span>
		</div>
	
		<div class="content">
		<input name="login" type="text" class="input username" placeholder=<?php echo gettext("nom_de_l'utilisateur"); ?> />
		<div class="user-icon"></div>
		<input name="passwd" type="password" class="input password" placeholder=<?php echo gettext("Mot_de_passe"); ?> />
		<div class="pass-icon"></div>		
		</div>

		<div class="footer">
		<input type="submit" name="submit" value=<?php echo gettext("Connexion"); ?> class="button" />
		<a class="register" href="View/Inscription.php"><?php echo gettext("inscription"); ?></a>
		</div>
	
	</form>

</div>
<div class="gradient"></div>


</body>
</html>
	
