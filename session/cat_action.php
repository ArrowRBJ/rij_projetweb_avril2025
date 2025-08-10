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
                            if(!empty($_POST['del_inf'])){
                                $delete = $_POST['del_inf'];
                                $requete = 'DELETE FROM t_information_inf WHERE inf_id =' . $delete . ';';
                            }
                            else if(!empty($_POST['ajout'])){
                                $cat = htmlspecialchars(addslashes($_POST['ajout']));
                                $requete = 'INSERT INTO t_categorie_cat (cat_titre , cat_statut , cat_date) VALUE ("' . $cat . '",' . "'A' , CURRENT_DATE ) ;";
                            }
                            else if(!empty($_POST['setid'])){
                                $cat = $_POST['setid'];
                                $requete = 'DELETE FROM t_liaison_lsn WHERE cat_id= ' . $cat . ' ;' ;
                                $requete2 =' DELETE FROM t_information_inf WHERE cat_id=' . $cat .'  ;' ;
                                $requete3 =' DELETE FROM t_categorie_cat WHERE cat_id=' . $cat . '  ;';
                            }

                            $result2= $mysqli->query($requete);

                            if($result2==false){
                                // La requête a echoué    
                                echo '<header class="align-center">';
                                echo "<p> Echec de la requete </p>";
                                echo '<a href="admin_categories.php" class="button alt">Retour</a>' ;
                                echo "</header>";    
                                exit();
                            }
                            else{
                                if(!empty($_POST['setid'])){
                                    $result3 = $mysqli->query($requete2);
                                    if($result3==false){
                                        // La requête a echoué    
                                        echo '<header class="align-center">';
                                        echo "<p> Echec de la suppression </p>";
                                        echo '<a href="admin_categories.php" class="button alt">Retour</a>' ;
                                        echo "</header>";    
                                        exit();
                                    }
                                    else{
                                        $result4 = $mysqli->query($requete3);
                                        if($result4==false){
                                            // La requête a echoué    
                                            echo '<header class="align-center">';
                                            echo "<p> Echec de la suppression </p>";
                                            echo '<a href="admin_categories.php" class="button alt">Retour</a>' ;
                                            echo "</header>";    
                                            exit();
                                        }
                                        else{
                                            header('Location:admin_categories.php');
                                        }
                                    }

                                }
                                else{
                                    header('Location:admin_categories.php');
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