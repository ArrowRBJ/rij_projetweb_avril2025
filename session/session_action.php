<!-- RABENJARIJAONA Iaro Jaosanta -- 7/3/2025 -- Application affichant des information a l'attention d'usagers d'un zoo -->
<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Infoscreen verification </title>
		<meta charset="utf-8"><meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
		<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="../assets/css/main.css">
	</head>
	<body>
		<?php
            session_start();

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
        ?>

        <!-- Two -->
        <section id="two" class="wrapper style2">
            <div class="inner">
                <div class="box">
                    <div class="content">
                        <?php
                            if(!empty($_POST['pseudo'])&& !empty($_POST['mdp'])){

                                $id=htmlspecialchars(addslashes($_POST['pseudo'])); 
                                $mdp=htmlspecialchars(addslashes($_POST['mdp']));

                                $requete2='SELECT * FROM t_compte_cpt JOIN t_profil_pfl ON t_compte_cpt.cpt_pseudo = t_profil_pfl.cpt_pseudo WHERE t_compte_cpt.cpt_pseudo ="' . $id . '"AND cpt_mot_de_passe = md5("' . $mdp .'")' . "AND pfl_validite = 'A' ;"; 
                                $result2= $mysqli->query($requete2);

                                if($result2==false){
                                    // La requête a echoué    
                                    echo "Error: Problème d'accès à la base  \n";    
                                    exit();
                                }
                                else{

                                    $ligne = $result2->fetch_assoc();

                                    if($result2->num_rows == 1){

                                        $_SESSION['login']=$id;
                                        $_SESSION['role']=$ligne['pfl_role'];

                                        header("Location:admin_accueil.php");
                                    }
                                    else{
                                        echo '<header class="align-center">';
                                        echo "<p> ECHEC DE LA CONNECTION </p>";
                                        echo "<h2> Compte invalide ou inexistant </h2>";
                                        echo '<a href="session.php" class="button alt">Connection</a>' ;
                                        echo "</header>"; 
                                    }
                                }
                            }
                            else{
                                echo '<header class="align-center">';
                                echo "<p> VEUILLEZ REMPLIR TOUS LES CHAMPS </p>";
                                echo '<a href="session.php" class="button alt">Connection</a>' ;
                                echo "</header>";
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        </section>

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