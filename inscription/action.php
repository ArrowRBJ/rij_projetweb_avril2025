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
		<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="../assets/css/main.css">
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

            mysqli_report(MYSQLI_REPORT_OFF);
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
		<header id="header">
            <div class="logo">
                <a href="../index.php">
					<?php echo $configuration['cfg_theme'] . '<span> by ' .  $configuration['cfg_nom_developpeur'] . '</span>' ?>
				</a>
            </div>
			<a href="#menu">Menu</a>
		</header>
        <!-- Nav -->
        <nav id="menu">
            <ul class="links">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../affichage/affichagecategorie.php?indice=0">categories</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="../session/session.php">Connection</a></li>
            </ul>
        </nav>


        <!-- One -->
        <section id="One" class="wrapper style3">
            <div class="inner">
                <header class="align-center">
                    <h2>Inscription</h2>
                </header>
            </div>
        </section>

        <!-- Two -->
        <section id="two" class="wrapper style2">
            <div class="inner">
                <div class="box">
                    <div class="content">
                        <?php
                            if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['confirmation'])){

                                $nom=htmlspecialchars(addslashes($_POST['nom'])); 
                                $prenom=htmlspecialchars(addslashes($_POST['prenom']));
                                $id=htmlspecialchars(addslashes($_POST['pseudo']));
                                $mail=htmlspecialchars(addslashes($_POST['email']));  
                                $mdp=htmlspecialchars(addslashes($_POST['mdp']));
                                $conf=htmlspecialchars(addslashes($_POST['confirmation'])); 
                                $code=htmlspecialchars(addslashes($_POST['code']));

                                if(strcmp($code,$configuration['cfg_code'])==0){
                                    if(strcmp($mdp,$conf)==0){
                                        $test = "SELECT * from t_compte_cpt where cpt_pseudo='" . $id . "';";
                                        $result5 = $mysqli->query($test);
                                        if ($result5->num_rows == 0) {
                                            $sql = "INSERT INTO t_compte_cpt (cpt_pseudo , cpt_mot_de_passe) VALUES ('" . $id . "', md5('" . $mdp . "'));" ;
                                            $result3 = $mysqli->query($sql);

                                            if ($result3 == false) {    
                                                echo "Error: La requête a échoué  \n";    
                                                echo "Query: " . $sql . "\n";    
                                                echo "Errno: " . $mysqli->errno . "\n";    
                                                echo "Error: " . $mysqli->error . "\n";    
                                                exit;
                                            } 
                                            else { 

                                                $pfl = "INSERT INTO t_profil_pfl (cpt_pseudo , pfl_nom, pfl_prenom, pfl_email, pfl_role, pfl_validite, pfl_date ) VALUES ('" . $id . "','" . $nom . "','" . $prenom . "','" . $mail . "', 'R', 'D', CURRENT_DATE);";
                                                $result4 = $mysqli->query($pfl);
                                                if ($result4 == false) { 
                                                    $dlt = "DELETE FROM t_compte_cpt WHERE cpt_pseudo = '" . $id . "';";
                                                    $result6 = $mysqli->query($dlt);
                                                    if ($result6 == false) //Erreur lors de l’exécution de la requête
                                                    { // La requête a echoué
                                                        echo "Error: La requête DELETE a echoué \n";
                                                        echo "Errno: " . $mysqli->errno . "\n";
                                                        echo "Error: " . $mysqli->error . "\n";
                                                        exit();
                                                    }
                                                    else //La requête s’est bien exécutée
                                                    {
                                                        echo "Error: La requête INSERT a échoué  \n";    
                                                        echo "Query: " . $pfl . "\n";    
                                                        echo "Errno: " . $mysqli->errno . "\n";    
                                                        echo "Error: " . $mysqli->error . "\n";    
                                                        exit;
                                                    }
                                                    
                                                }
                                                else{ 
                                                    echo '<header class="align-center">';
                                                    echo "<p> Inscription réussie ! </p>" ;
                                                    echo "<h2> Bienvenue </h2>";
                                                    echo "</header>";
                                                
                                                }
                                            }  
                                        } 
                                        else {
                                            echo '<header class="align-center">';
                                            echo "<p> Pseudo deja pris </p>";
                                            echo "<h2> Réesayez </h2>";
                                            echo '<a href="inscription.php" class="button alt">Inscription</a>' ;
                                            echo "</header>";
                                            
                                        }
                                        
                                    }
                                    else {
                                        echo '<header class="align-center">';
                                        echo "<p> Confirmation de mot de passe ratée. </p>";
                                        echo "<h2> Réesayez </h2>";
                                        echo '<a href="inscription.php" class="button alt">Inscription</a>' ;
                                        echo "</header>";
                                        
                                    }
                                }
                                else{
                                    echo '<header class="align-center">';
                                    echo "<p> Mauvais code d'inscription </p>";
                                    echo "<h2> Réesayez </h2>";
                                    echo '<a href="inscription.php" class="button alt">Inscription</a>' ;
                                    echo "</header>"; 
                                }
                            }   
                            else{
                                echo '<header class="align-center">';
                                echo "<p> Veuillez remplir tous les champs </p>";
                                echo "<h2> Réesayez </h2>";
                                echo '<a href="inscription.php" class="button alt">Inscription</a>' ;
                                echo "</header>"; 
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