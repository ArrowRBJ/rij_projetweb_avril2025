<!-- RABENJARIJAONA Iaro Jaosanta -- 7/3/2025 -- Application affichant des information a l'attention d'usagers d'un zoo -->
<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Infoscreen inscription </title>
		<meta charset="utf-8"><meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
		<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="../assets/css/main.css">
	</head>
	<body>
    <header id="header">
			<a href="#menu">Menu</a>
		</header>
        <!-- Nav -->
        <nav id="menu">
            <ul class="links">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../affichage/affichagecategorie.php?indice=0">categories</a></li>
                <li><a href="../session/session.php">Connection</a></li>
            </ul>
        </nav>
        <section id="One" class="wrapper style3">
            <div class="inner">
                <header class="align-center">
                    <h2>Inscription</h2>
                </header>
            </div>
        </section>

        <section id="two" class="wrapper style2">
                <div class="inner">
                    <div class="box">
                        <div class="content">
        
                            <form action="action.php" method="post">
                            <fieldset>
                            <legend>Données personnelles :</legend>
                            Votre Nom : <input type="text" name="nom" /> 
                            <br>
                            Votre Prenom : <input type="text" name="prenom" />
                            <br>
                            Votre Pseudo : <input type="text" name="pseudo" />
                            <br>
                            Votre adresse E-mail : <input type="text" name="email" />
                            <br>
                            Votre mot de passe : <input type="password" name="mdp" />
                            <br>
                            Verifiez le mot de passe : <input type="password" name="confirmation" />
                            <br>
                            Code d'inscription : <input type="password" name="code" />
                            <br>
                            <input type="submit" value="Valider">
                            </fieldset>
                            </form>
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

	</body>
</html>
