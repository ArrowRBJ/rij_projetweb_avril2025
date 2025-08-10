 <!-- RABENJARIJAONA Iaro Jaosanta -- 7/3/2025 -- Application affichant des information a l'attention d'usagers d'un zoo -->
<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
--><html>
	<head>
		<title>Projet Infoscreen</title>
		<meta charset="utf-8"><meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
		<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="assets/css/main.css">
	</head>
	<body>
		<?php
			$mysqli = new mysqli('localhost','root','','e22309086_db1');
            if ($mysqli->connect_errno)
            {
            // Affichage d'un message d'erreur
            echo "Error: Problème de connexion à la BDD \n";
            echo "Errno: " . $mysqli->connect_errno . "\n";
            echo "Error: " . $mysqli->connect_error . "\n";
            // Arrêt du chargement de la page
            exit();
            }
            // Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
            if (!$mysqli->set_charset("utf8")) {
            printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
            exit();
            }
            //echo ("Connexion BDD réussie !");

			//Préparation de la requête
			$requete="SELECT * FROM t_configuration_cfg;"; 

			$result1 = $mysqli->query($requete);
			if ($result1 == false) //Erreur lors de l’exécution de la requête
			{ // La requête a echoué
			echo "Error: La requête a echoué \n";
			echo "Errno: " . $mysqli->errno . "\n";
			echo "Error: " . $mysqli->error . "\n";
			exit();
			}
			else //La requête s’est bien exécutée
			{
				$configuration = $result1->fetch_assoc();
			}
        ?>

		<!-- Header -->
		<header id="header" class="alt">
			<div class="logo">
				<a href="index.php">
					<?php echo $configuration['cfg_theme'] . '<span> by ' .  $configuration['cfg_nom_developpeur'] . '</span>' ?>
				</a>
			</div>
			<a href="#menu">Menu</a>
		</header>
		
		<!-- Nav -->
		<nav id="menu">
			<ul class="links">
				<li><a href="index.php">Home</a></li>
				<li><a href="affichage/affichagecategorie.php?indice=0">categories</a></li>
				<li><a href="inscription/inscription.php">Inscription</a></li>
				<li><a href="session/session.php">Connection</a></li>
				
			</ul>
		</nav>
		
		<!-- Banner -->
		<section class="banner full">
			<article>
				<img src="images/slide01.jpg" alt="" width="1440" height="961">
				<div class="inner">
					<header>
						<h2> <?php echo $configuration['cfg_theme'] ?> </h2>
					</header></div>
			</article>
		</section>
		
		<!-- One -->
		<section id="one" class="wrapper style2">
			<div class="inner">
				<div class="box">
					<div class="content">
						<header class="align-center">
							<h2>Dernières nouvelles</h2>
						</header>
						<?php
                            //Préparation de la requête récupérant tous les profils
                            $requete="SELECT * FROM t_news_new WHERE new_etat = 'A' ORDER BY new_date DESC LIMIT 10;"; 
                            //Affichage de la requête préparée

                            $result1 = $mysqli->query($requete);
                            if ($result1 == false) //Erreur lors de l’exécution de la requête
                            { // La requête a echoué
                            echo "Error: La requête a echoué \n";
                            echo "Errno: " . $mysqli->errno . "\n";
                            echo "Error: " . $mysqli->error . "\n";
                            exit();
                            }
                            else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
                            {
								echo '<div class="table-wrapper">';
								echo '<table class="alt">';
								echo "<thead>";
								echo "<tr>";
								echo "<th>" . 'Titre' . "</th>";
								echo "<th>" . 'Description' . "</th>";
								echo "<th>" . 'Auteur' . "</th>";
								echo "<th>" . 'Date' . "</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								while ($actu = $result1->fetch_assoc())
								{
									echo "<tr>";
									echo ('<td>' . $actu['new_titre'] . ' </td> ');
									echo ('<td>' . $actu['new_texte'] . ' </td> ');
									echo ('<td>'  . $actu['cpt_pseudo'] . '</td>' );
									echo (' <td> ' . $actu['new_date'] . ' </td> ');
									echo "</tr>";
								
								}
								echo "</tbody>";
								echo "</table>";
								echo "</div>";

                            }
                        ?>
					</div>
				</div>
			</div>
		</section>
		
		<!-- Footer -->
		<footer id="footer">
			<div class="container">
				<ul class="icons"><li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
				</ul>
			</div>
		</footer>
		<div class="copyright">
		<?php echo 'Made by ' . $configuration['cfg_nom_developpeur'] . ' | Template by' ?> <a href="https://templated.co/">Templated</a> Distributed by <a href="https://themewagon.com/">ThemeWagon</a>.
		</div>

		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>

		<?php //Ferme la connexion avec la base MariaDB
		$mysqli->close();
        ?>
	</body>
</html>
