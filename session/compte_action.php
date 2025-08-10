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
        ?>

        <!-- Two -->
        <section id="two" class="wrapper style2">
            <div class="inner">
                <div class="box">
                    <div class="content">
                        <?php
                            if(!empty($_POST['amodifier'])){
                                $pseudo_choisi = htmlspecialchars(addslashes($_POST['amodifier']));
                            }
                            else if(!empty($_POST['setid'])){
                                $pseudo_choisi = $_POST['setid'];
                            }

                            if($pseudo_choisi == "gestionnaire1" || $pseudo_choisi == $_SESSION['login']){
                                echo '<header class="align-center">';
                                echo "<p> Vous ne pouvez pas modifier ce profil </p>";
                                echo '<a href="admin_comptes.php" class="button alt">Retour</a>' ;
                                echo "</header>";
                            }
                            else{
                                $requete2='SELECT * FROM t_profil_pfl  WHERE cpt_pseudo ="' . $pseudo_choisi . '";'; 
                                $result2= $mysqli->query($requete2);

                                if($result2==false){
                                    // La requête a echoué    
                                    echo "Error: Problème d'accès à la base  <br>";    
                                    exit();
                                }
                                else{

                                    $ligne = $result2->fetch_assoc();

                                    if($ligne['pfl_validite']=='A'){

                                        $desactiver = "UPDATE t_profil_pfl SET pfl_validite = 'D'" . ' WHERE cpt_pseudo = "' . $pseudo_choisi .'";';
                                        $update = $mysqli->query($desactiver);

                                        if($update==false){
                                            echo "Error: La requête UPDATE a echoué ";
                                            echo "Errno: " . $mysqli->errno  ;
                                            echo "Error: " . $mysqli->error ;
                                            exit();
                                        }
                                        else{
                                            header("Location:admin_comptes.php");
                                        }

                                    }
                                    else{
                                        $activer = "UPDATE t_profil_pfl SET pfl_validite = 'A'" . ' WHERE cpt_pseudo = "' . $pseudo_choisi .'";';
                                        $update2 = $mysqli->query($activer);

                                        if($update2==false){
                                            echo "Error: La requête UPDATE a echoué ";
                                            echo "Errno: " . $mysqli->errno  ;
                                            echo "Error: " . $mysqli->error ;
                                            exit();
                                        }
                                        else{
                                            header("Location:admin_comptes.php");
                                        }
                                    }
                                }

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