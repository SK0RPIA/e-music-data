<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="assets/CSS/Page_Accueil.css">
	<title>Bienvenue sur CMS-SLAM</title>
</head>



<body>

	<header>
		<?php 
	// => Le code php sous ce comentaire sera mit dans admin_session.php dans sa version finale.
	//	include_once("./src/php/admin_session.php"); 
	if(isset($_SESSION['prenom'])){
		echo "<div style='color: white;'>Vous êtes connecté : " . $_SESSION['prenom'] ."</div>";
	}
	  ?>
	</header>
	<ul>
		<li><a href="#"> <img class="logo" src="assets/img/logo/favicon.png" alt=""> </a></li>
		<li><a href="#">Accueil</a></li>
		<li><a href="#">Informations</a></li>
		<li><a href="#">Contact</a></li>
		<li><a href="#">A propos</a></li>
        <li><a class="droite" href="#">Inscription/Connexion</a></li>

	</ul>
	<h1>Bienvenue sur e-Music</h1>
	<h2 class="titre1">Qu'est ce que e-Music ?</h2>
	<br>
	<p class="block1">e-Music est un système de <strong>gestion des inscriptions et paiements</strong> aux différents cours de musique, qu’ils soient collectifs ou
	individuels.<br> Et permet également d'enregistrer les <strong>prêts des instruments</strong> ainsi que leur maintenance.</br>
		
	</p>
	</br>
	<ol>
		<h2 class="titre2">Sous titre 1</h2>
		
		<h2 class="titre3">Sous-titre 2</h2>
		<h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis magnam ullam, veniam et beatae tempore odit
			esse sit modi dolores quam labore fuga repellat ipsum ex neque ab iste quo.</h2>
		<p>Exemple de paragraphe avec des </p>

</body>




</html>