<?php 
if (!isset($_SESSION))
  {
    session_start();
  }
  
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>admin</title>
	
	
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
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

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>
	
	<?php include('masterPage.php');
	include ('../DAO/FileAccess.php');
	?>
	
	<section id="main" class="column">
		
		<h4 class="alert_info"><?php echo $_SESSION['unom'] . "";?></h4>
		
		<article class="module width_full">
			<header><h3><?php echo gettext("Statistique");?></h3></header>
			<div class="module_content">
				<article class="stats_graph">
				<div id="myfirstchart" style="height: 250px;"></div>
					<!-- <img src="http://chart.apis.google.com/chart?chxr=0,0,3000&chxt=y&chs=520x140&cht=lc&chco=76A4FB,80C65A&chd=s:Tdjpsvyvttmiihgmnrst,OTbdcfhhggcTUTTUadfk&chls=2|2&chma=40,20,20,30" width="520" height="140" alt="" />
				 -->
				</article>
				
				<article class="stats_overview">
					<div class="overview_today">
						<p class="overview_day"><?php echo gettext("Tâches");?></p>
						<p class="overview_count"><?php echo nbTache() ; ?></p>
						<p class="overview_type"><?php echo gettext("A_Faire");?></p>
						<p class="overview_count"><?php echo nbTacheDone(); ?></p>
						<p class="overview_type"><?php echo gettext("Terminé");?></p>
					</div>
				</article>
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">ISITACHES</h3>
		<ul class="tabs">
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content" align="center">
				<img src="images/mes_tache.png"/>
				
			</div><!-- end of #tab1 -->
			
			</div><!-- end of #tab2 -->
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
		<article class="module width_quarter">
			<header><h3>Messages</h3></header>
			<div class="message_list">
				<div class="module_content">
					<div class="message"><p>msg 1 balbal isima bla bla</p>
					<p><strong>bofouss</strong></p></div>
					<div class="message"><p>msg 1 balbal isima bla bla</p>
					<p><strong>john</strong></p></div>
					<div class="message"><p>msg 1 balbal isima bla bla.</p>
					<p><strong>yassin</strong></p></div>
					<div class="message"><p>Vmsg 1 balbal isima bla bla.</p>
					<p><strong>anass</strong></p></div>
				</div>
			</div>
			<footer>
			</footer>
		</article><!-- end of messages article -->
	</section>


<script>
      new Morris.Area({
        element: 'myfirstchart',
          data: [
            {y: 'Sat', a: 7},
            {y: 'Sun', a: 3},
            {y: 'Mon', a: 5},
            {y: 'Tue', a: 0},
            {y: 'Wed', a: 1},
            {y: 'Thi', a: 7},
            {y: 'Fri', a: 2}
          ],
          parseTime: false,
          xkey: 'y',
          ykeys: ['a'],
          labels: ['Taches']
       });
</script>
</body>

</html>

<?php
 ?>