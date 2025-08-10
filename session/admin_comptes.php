<!-- RABENJARIJAONA Iaro Jaosanta -- 7/3/2025 -- Application affichant des information a l'attention d'usagers d'un zoo -->
<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
--><html>
	<head>
		<title>Infoscreen Admin</title>
		<meta charset="utf-8"><meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
		<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="../assets/css/main.css">
	</head>
	<body>
		<?php
            session_start();

            if(!isset($_SESSION['login']) && !isset($_SESSION['role'])){
                header("Location:session.php");
            }

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

            mysqli_report(MYSQLI_REPORT_OFF);
            //echo ("Connexion BDD réussie !");

			//Préparation de la requête
			$requete="SELECT * FROM t_configuration_cfg;"; 

			$result1 = $mysqli->query($requete);
			if ($result1 == false) //Erreur lors de l’exécution de la requête
			{ // La requête a echoué
			echo "Error: La requête a echoué ";
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
		<header id="header">
            <div class="logo">
					<?php echo $configuration['cfg_theme'] . '<span> by ' .  $configuration['cfg_nom_developpeur'] . '</span>' ?>
            </div>
			<a href="#menu">Menu</a>
		</header>
        <!-- Nav -->
        <nav id="menu">
            <ul class="links">
                <li><a href="admin_accueil.php">Mon compte</a></li>
                <li><a href="admin_categories.php">Categories</a></li>
                <li><a href="deconnection.php">Deconnection</a></li>
            </ul>
        </nav>


        <!-- One -->
        <section id="One" class="wrapper style3">
            <div class="inner">
                <header class="align-center">
                    <h2>Gestion des Comptes</h2>
                </header>
            </div>
        </section>

        <!-- Two -->
        <section id="two" class="wrapper style2">
            <div class="inner">
                <div class="box">
                    <div class="content">
                        <form action="compte_action.php" method="post">
                            <fieldset>
                                <legend>Veuillez saisir le pseudo du compte à modifier</legend>
                                <p>pseudo :
                                <input type="text" name="amodifier" placeholder="pseudo" />
                                </p>
                                <p><input type="submit" value="Activer/desactiver"></p>
                            </fieldset>
                        </form>
                        
                    </div>
                </div>
            </div>
        </section>

         <!-- Three -->
         <section id="three" class="wrapper style2">
            <div class="inner">
                <div class="box">
                    <div class="content">
                        <?php
                            $R_profil = 'SELECT * FROM t_profil_pfl ;';
                            $result2 = $mysqli->query($R_profil);

                            if($result2 == false){  
                                echo "Error: La requête a échoué <br>";    
                                echo "Query: " . $sql . "<br>";    
                                echo "Errno: " . $mysqli->errno . "<br>";    
                                echo "Error: " . $mysqli->error . "<br>";    
                                exit();
                            } 
                            else { 
                                echo '<header class="align-center">';
                                echo "<p> nombre de profils :" . $result2->num_rows . "</p>";
                                echo "<h2> PROFILS </h2>";
                                echo "</header>"; 
                                echo '<div class="table-wrapper">';
								echo '<table class="alt">';
								echo "<thead>";
								echo "<tr>";
								echo "<th>" . 'Pseudo' . "</th>";
								echo "<th>" . 'Nom' . "</th>";
								echo "<th>" . 'Prenom' . "</th>";
								echo "<th>" . 'Email' . "</th>";
                                echo "<th>" . 'role' . "</th>";
                                echo "<th>" . 'validite' . "</th>";
                                echo "<th>" . 'Action' . "</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								while ($profils = $result2->fetch_assoc())
								{
									echo "<tr>";
                                    echo ('<td>'  . $profils['cpt_pseudo'] . '</td>' );
									echo ('<td>' . $profils['pfl_nom'] . ' </td> ');
									echo ('<td>' . $profils['pfl_prenom'] . ' </td> ');
									echo ('<td>'  . $profils['pfl_email'] . '</td>' );
									echo (' <td> ' . $profils['pfl_role'] . ' </td> ');
                                    echo ('<td>'  . $profils['pfl_validite'] . '</td>' );

                                    echo '<td>';
                                    echo '<form action="compte_action.php" method="post">';
                                    echo '<fieldset>';
                                    echo '<input type="hidden" name="setid" value="' . $profils['cpt_pseudo'] .'" />';
                                    echo '<input type="submit" value="Activer/desactiver">';
                                    echo '</fieldset>';
                                    echo '</form>';
                                     echo '</td>';

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
                <ul class="icons">
                    <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                    <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                    <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                    <li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
                </ul>
            </div>
        </footer>
        <div class="copyright">
        <?php echo 'Made by ' . $configuration['cfg_nom_developpeur'] . ' | Template by' ?> 
        <a href="https://templated.co/">Templated</a> Distributed by <a href="https://themewagon.com/">ThemeWagon</a>.
        </div>



        <!-- Scripts -->
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/jquery.scrollex.min.js"></script>
		<script src="../assets/js/skel.min.js"></script>
		<script src="../assets/js/util.js"></script>
		<script src="../assets/js/main.js"></script>

		<?php //Ferme la connexion avec la base MariaDB
		$mysqli->close();
        ?>
	</body>
</html>