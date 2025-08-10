<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
<head>
	<title>InfoScreen affichage</title>
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
    //echo ("Connexion BDD réussie !");

    $requete0="SELECT * FROM t_configuration_cfg;"; 

    $result0 = $mysqli->query($requete0);
    if ($result0 == false) //Erreur lors de l’exécution de la requête
    { // La requête a echoué
    echo "Error: La requête a echoué \n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit();
    }
    else //La requête s’est bien exécutée
    {
        $configuration = $result0->fetch_assoc();
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
            <li><a href="../inscription/inscription.php">Inscription</a></li>
            <li><a href="affichagecategorie.php?indice=0">categories</a></li>
        </ul>
    </nav>
    <!-- <section id="one" class="wrapper style2">   </section> -->
        <div class="outer">
            <div class="box">
                <div class="content">
                    <?php
                        if((isset($_GET['indice']) && is_numeric($_GET['indice']))&&($_GET['indice']>=0 && $_GET['indice']<=8)){
                            // Niveau 3 de difficulté ==> récupération du paramètre passé dans l'URL de la page Web + test
                            $id = [];
                            $titre = [];

                            // Préparation de la 1ère requête SQL pour récupérer l'identifiant et l'intitulé de toutes les catgories (8 maximum)
                            $requete="SELECT cat_titre , cat_id FROM t_categorie_cat WHERE cat_statut='A'";

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
                                // Si aucune ligne de résultat
                                if( $result1->num_rows == 0 ){
                                    echo "Aucune catégorie" ;
                                }
                                else{
                                    
                                    while( $categorie = $result1->fetch_assoc() ){
                                        $id[] = $categorie['cat_id'];   
                                        $titre[] = $categorie['cat_titre']; 
                                    }

                                }
                            }

                            // Préparation de la 2ème requête SQL pour récupérer les informations de la catégorie dont on connaît l'identifiant
                            $requete2="SELECT * FROM t_information_inf JOIN t_categorie_cat USING (cat_id) WHERE cat_id =" . $id[$_GET['indice']] . " AND inf_etat='A';";
                            // Niveau 3 de difficulté ==> identifiant stocké dans la case $id[$_GET['indice']]

                            //echo ($requete2);

                            // Exécution de la 2ème requête SQL
                            $result2 = $mysqli->query($requete2);

                            if ($result1 == false) //Erreur lors de l’exécution de la requête
                            { // La requête a echoué
                            echo "Error: La requête a echoué \n";
                            echo "Errno: " . $mysqli->errno . "\n";
                            echo "Error: " . $mysqli->error . "\n";
                            exit();
                            }
                            else //La requête s’est bien exécutée
                            {
                                // Si aucune ligne de résultat
                                if( $result2->num_rows == 0 ){
                                    echo '<header class="align-center">';
                                    echo '<h2>'. $titre[$_GET['indice']] .'</h2>';
                                    echo '<div class="align-center">' ;
                                    echo "Aucune Information" ;
                                    echo '</div>' ;
                                }
                                else{
                                    echo '<header class="align-center">';
                                    echo '<h2>'. $titre[$_GET['indice']] .'</h2>';
                                    echo '<div class="align-center">' ;
                                    while ($info = $result2->fetch_assoc()){
                                        if ($info['inf_etat'] == 'A'){
                                            echo ' | ' . $info['inf_texte'] . ' | ';
                                            echo "<br>";
                                        }                                        
                                    }
                                    echo '</div>' ;

                                }
                            }
                        }
                        else{
                            echo "<p> Erreur d'indice </p>";
                        }
                        
                    ?>
                </div>
            </div>
        </div>
    

    

	<!-- Scripts -->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/jquery.scrollex.min.js"></script>
	<script src="../assets/js/skel.min.js"></script>
	<script src="../assets/js/util.js"></script>
	<script src="../assets/js/main.js"></script>
    
    <?php
    $mysqli->close();

    // Redirection automatique vers la page de catégorie suivante
    $numero = $_GET['indice'] + 1;
    if ($numero<$result1->num_rows){
        header("refresh:10;url=affichagecategorie.php?indice=".$numero.""); 
    }
    else{
        header("refresh:10;url=affichagecategorie.php?indice=0"); 
    }

    ?>
</body>
</html>