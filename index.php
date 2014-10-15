<?php

	if(!empty($_POST['email']))
	{
		$fp = fopen('users.csv', 'a');
	    fputcsv($fp, array($_POST['email']));

		fclose($fp);
	}

?>

<!DOCTYPE HTML>
<!--
	Ex Machina by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>FESTITIME</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
		<link href='http://fonts.googleapis.com/css?family=Rosario:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
		
		<!-- script analytics -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-52717471-1', 'auto');
			ga('require', 'displayfeatures');
			ga('send', 'pageview');
		</script>
		<!-- script analytics -->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/waypoints.min.js"></script>
		<script type="text/javascript" src="js/foundation.min.js"></script>
		<script type="text/javascript" src="js/jquery.sticky.js"></script>
		<link rel="stylesheet" href="css/foundation.min.css" />
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
	<!-- Header -->
		<div id="header">	
			<nav id="nav" class="nav">
				<ul>
					<li class="active menu1"><a href="#banner">Qui sommes-nous ?</a></li>
					<li class="menu2"><a href="#bandeau1">Le projet</a></li>
					<li class="menu3"><a href="#bandeau2">L'équipe</a></li>
					<li class="menu4"><a href="#footer">Contact</a></li>
				</ul>
			</nav>
		</div>
	<!-- Header -->
		
	<!-- Banner -->
		<div id="banner">
			<div class="container">
				<div class="who">
					<h5>Qui sommes-nous ?</h5>
					<p>Festitime est un site d’information et de vente dédié aux festivals. Cependant, comme nous pensons à tout (et surtout à vous), il vous sera également possible d’acquérir des packs comprenant le transport et l’hébergement. En effet, notre but est de vous apporter un maximum de confort lors de la réservation de votre ticket, sur un site le plus intuitif possible. Nous vous avons convaincu ? Alors inscrivez-vous en bas de page pour être au courant dès la sortie de notre site !</p>
				</div>
			</div>
			<img src="images/logo.png" class="logo" alt="">
		</div>
	<!-- /Banner -->

	<!-- Main -->
		<div id="page">
			<!-- Extra -->
			<div id="bandeau1">
				<h5>Le projet</h5>
			</div>
			<div class="row video">
				<div class="small-12 medium-10 large-8 small-centered columns">
					<div class="flex-video widescreen">
						<iframe width="853" height="480" src="//www.youtube.com/embed/3Umd3v8j8Y0" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
			</div>	
			<div class="row description">
				<div class="small-12 medium-6 large-3 columns">
					<section>
						<p><img src="images/achat.png" alt="ticket"></p>
						<header>
							<h2>Achat</h2>
						</header>
						<p class="subtitle">Des achats simples et sécurisés, c’est ce que nous voulons avant tout. Avec nous, réservez en quelques clics et avec le moins d’étapes possibles. Tout simplement.</p>
						
					</section>
				</div>
				<div class="small-12 medium-6 large-3 columns">
					<section>
						<p><img src="images/transport.png" alt=""></p>
						<header>
							<h2>Transport</h2>
						</header>
						<p class="subtitle">Vous ne savez pas comment venir et n’avez pas envie de passer des heures à chercher ? Pas de problème ! Nous vous indiquons pour chaque festival l’accès le plus proche, et nous organisons votre déplacement de A à Z, quel que soit votre moyen de transport.</p>
					</section>
				</div>
				<div class="small-12 medium-6 large-3 columns">
					<section>
						<p><img src="images/hebergement.png" alt=""></p>
						<header>
							<h2>Hébergement</h2>
						</header>
						<p class="subtitle">Il n’est pas toujours facile de savoir où loger une fois sur place. Festitime vous aide en vous proposant différents packagings comprenant hôtel, camping, location, et vous accompagne à chaque étape de votre démarche.</p>
						
					</section>
				</div>
				<div class="small-12 medium-6 large-3 columns">
					<section>
						<p><img src="images/tarif.png" alt=""></p>
						<header>
							<h2>Tarif de groupe</h2>
						</header>
						<p class="subtitle">Avec Festitime, ne craignez plus d’être séparés quand vous venez à plusieurs. Lors de l’achat de votre billet, réservez aussi ceux de vos amis. Renseignez simplement leurs mails, et nous leur enverrons un message les prévenant de votre démarche et les invitant à régler leurs billets.</p>
						
					</section>
				</div>
			</div>
			<!-- /Extra -->
				
			<!-- Main -->
			<div id="main" class="container">
				<div id="bandeau2"> <h5>L'équipe</h5>
				</div>
				<div class="row equipe">
					<div class="small-12 medium-6 large-3 columns">
						<section>
							<p><img class="equipe1" src="images/RomainA_1.jpg" alt="ticket"></p>
							<header>
								<h2>Romain Allain</h2>
							</header>
							<p class="subtitle">Intégrateur Web</p>
							
						</section>
					</div>
					<div class="small-12 medium-6 large-3 columns">
						<section>
							<p><img class="equipe2" src="images/Lorraine_1.jpg" alt=""></p>
							<header>
								<h2>Lorraine Girard</h2>
							</header>
							<p class="subtitle">Designer UX-UI</p>
							
						</section>
					</div>
					<div class="small-12 medium-6 large-3 columns">
						<section>
							<p><img class="equipe3" src="images/Tiphaine_1.jpg" alt=""></p>
							<header>
								<h2>Tiphaine Leplat</h2>
							</header>
							<p class="subtitle">Directrice Créative</p>
							
						</section>
					</div>
					<div class="small-12 medium-6 large-3 columns">
						<section>
							<p><img class="equipe4" src="images/Lina_1.jpg" alt=""></p>
							<header>
								<h2>Lina Saxema</h2>
							</header>
							<p class="subtitle">Directrice artistique</p>
							
						</section>
					</div>
					<div class="small-12 medium-6 large-3 columns">
						<section>
							<p><img class="equipe5" src="images/Mathilde_1.jpg" alt="ticket"></p>
							<header>
								<h2>Mathilde Husson</h2>
							</header>
							<p class="subtitle">Développeuse Back-End</p>
					
						</section>
					</div>
					<div class="small-12 medium-6 large-3 columns">
						<section>
							<p><img class="equipe6" src="images/RomainG_1.jpg" alt=""></p>
							<header>
								<h2>Romain Grelet</h2>
							</header>
							<p class="subtitle">Directeur Technique</p>
						
							
						</section>
					</div>
					<div class="small-12 medium-6 large-3 columns">
						<section>
							<p><img class="equipe7" src="images/Sabrina_1.jpg" alt=""></p>
							<header>
								<h2>Sabrina Lamon</h2>
							</header>
							<p class="subtitle">Responsable Communication et Marketing</p>
							
						</section>
					</div>
					<div class="small-12 medium-6 large-3 columns">
						<section>
							<p><img class="equipe8" src="images/Florian_1.jpg" alt=""></p>
							<header>
								<h2>Florian Ninou</h2>
							</header>
							<p class="subtitle">Responsable Financier et Commercial - PDG</p>
							
						</section>
					</div>
				</div>
			</div>
		</div>

	<!-- Footer -->
		<div class="row container2">
			<div id="footer">
				<h5>Restez informé !</h5>
				<form action="index.php" method="POST">
					<input id="email" name="email" type="email" placeholder="Saisissez votre email" required style="width:330px";>
					<input class="btn" type="submit" value="Envoyer" equired style="width:150px";>
				</form>
			</div>
		</div>
	<!-- /Footer -->
	<script>
		$(document).ready(function(){
			$(".nav").sticky({topSpacing:0});
		});
		$('#banner').waypoint(function() {
			$('.menu1').addClass('active');
			$('.menu2').removeClass('active');
			$('.menu3').removeClass('active');
			$('.menu4').removeClass('active');
		});
		$('#bandeau1').waypoint(function() {
			$('.menu1').removeClass('active');
			$('.menu2').addClass('active');
			$('.menu3').removeClass('active');
			$('.menu4').removeClass('active');
		});
		$('#bandeau2').waypoint(function() {
			$('.menu1').removeClass('active');
			$('.menu2').removeClass('active');
			$('.menu3').addClass('active');
			$('.menu4').removeClass('active');
		}, { offset: '25%' });
		$('.container2').waypoint(function() {
			$('.menu1').removeClass('active');
			$('.menu2').removeClass('active');
			$('.menu3').removeClass('active');
			$('.menu4').addClass('active');
		}, { offset: '100%' });
		$( ".equipe1" ).hover(
			function() {
				$(".equipe1").attr("src", "images/RomainA_2.jpg");
			}, function() {
				$(".equipe1").attr("src", "images/RomainA_1.jpg");
			}
		);
		$( ".equipe2" ).hover(
			function() {
				$(".equipe2").attr("src", "images/Lorraine_2.jpg");
			}, function() {
				$(".equipe2").attr("src", "images/Lorraine_1.jpg");
			}
		);
		$( ".equipe3" ).hover(
			function() {
				$(".equipe3").attr("src", "images/Tiphaine_2.jpg");
			}, function() {
				$(".equipe3").attr("src", "images/Tiphaine_1.jpg");
			}
		);
		$( ".equipe4" ).hover(
			function() {
				$(".equipe4").attr("src", "images/Lina_2.jpg");
			}, function() {
				$(".equipe4").attr("src", "images/Lina_1.jpg");
			}
		);
		$( ".equipe5" ).hover(
			function() {
				$(".equipe5").attr("src", "images/Mathilde_2.jpg");
			}, function() {
				$(".equipe5").attr("src", "images/Mathilde_1.jpg");
			}
		);
		$( ".equipe6" ).hover(
			function() {
				$(".equipe6").attr("src", "images/RomainG_2.jpg");
			}, function() {
				$(".equipe6").attr("src", "images/RomainG_1.jpg");
			}
		);
		$( ".equipe7" ).hover(
			function() {
				$(".equipe7").attr("src", "images/Sabrina_2.jpg");
			}, function() {
				$(".equipe7").attr("src", "images/Sabrina_1.jpg");
			}
		);
		$( ".equipe8" ).hover(
			function() {
				$(".equipe8").attr("src", "images/Florian_2.jpg");
			}, function() {
				$(".equipe8").attr("src", "images/Florian_1.jpg");
			}
		);
	</script>
	<!-- Copyright -->
		
	</body>
</html>
