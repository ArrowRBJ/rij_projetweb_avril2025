<!-- RABENJARIJAONA Iaro Jaosanta -- 7/3/2025 -- Application affichant des information a l'attention d'usagers d'un zoo -->
<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Infoscreen connection </title>
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
                <li><a href="../inscription/inscription.php">Inscription</a></li>
            </ul>
        </nav>
        <section id="One" class="wrapper style3">
            <div class="inner">
                <header class="align-center">
                    <h2>Connection</h2>
                </header>
            </div>
        </section>

        <section id="two" class="wrapper style2">
                <div class="inner">
                    <div class="box">
                        <div class="content">
                            <form action="session_action.php" method="post">
                                <fieldset>
                                    <legend>Veuillez saisir votre pseudo et votre mot de passe :</legend>
                                    <p>Votre pseudo :
                                    <input type="text" name="pseudo" placeholder="pseudo" />
                                    </p>
                                    <p>Votre mot de passe :
                                    <input type="password" name="mdp" placeholder="mot de passe" />
                                    </p>
                                    <p><input type="submit" value="Valider"></p>
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
