<?php
// Inclure le fichier de connexion
include './Include/db_connection.php';

// Récupération des réseaux sociaux depuis la base de données
$requeteSQL = "SELECT nom_du_reseau, lien, icon FROM social_media";
$result = mysqli_query($conn, $requeteSQL);

if (!$result) {
	die("Erreur dans la requête : " . mysqli_error($conn));
}
?>

<!DOCTYPE HTML>
<!--
	Directive by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Directive by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<link rel="stylesheet" href="assets/css/main.css" />

	</head>
	<body class="is-preload">

		<!-- Header -->

			<nav id="nav">
				<ul>
					<li><a href="#accueil">Accueil</a></li>
					<li><a href="#projet">Projet</a></li>
					<li><a href="#competences">Compétences</a></li>
					<li><a href="../SAE_402_Portfolio/login/login.html">Administration</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</nav>

			<div id="header">
				<span class="logo icon fa-paper-plane"></span>
				<h1>Bienvenue sur mon Portfolio</h1>
				<p>Je suis Wassila Hamed, étudiant en développement web.</p>
				<p>Découvrez mes projets et mes compétences à travers ce portfolio.</p>
				<ul class="actions special">
					<li><a href="assets/document/CV_Hamed_Wassila.pdf" target="_blank" class="button">Voir mon CV</a></li>
				</ul>
			</div>


		<!-- Main -->
			<div id="main">
				<header class="portfolio-major portfolio-container portfolio-medium">
					<h2>À la recherche d'une alternance en développement web</h2>
					<p>Disponible dès septembre 2024 pour une alternance en rythme 2 semaines entreprise / 2 semaines école</p>
				</header>
				
				<div class="box alt container">
				<header class="major">
					<h2>Notre Dernier Projet</h2>
					<p>Découvrez notre réalisation la plus récente</p>
				</header>
					<section class="feature left">
						<a href="#" class="image icon solid fa-signal"><img src="images/pic01.jpg" alt="" /></a>
						<div class="content">
							<h3>The First Thing</h3>
							<p>Vitae natoque dictum etiam semper magnis enim feugiat amet curabitur tempor orci penatibus. Tellus erat mauris ipsum fermentum etiam vivamus eget. Nunc nibh morbi quis fusce lacus.</p>
						</div>
					</section>
					<section class="feature right">
						<a href="#" class="image icon solid fa-code"><img src="images/pic02.jpg" alt="" /></a>
						<div class="content">
							<h3>The Second Thing</h3>
							<p>Vitae natoque dictum etiam semper magnis enim feugiat amet curabitur tempor orci penatibus. Tellus erat mauris ipsum fermentum etiam vivamus eget. Nunc nibh morbi quis fusce lacus.</p>
						</div>
					</section>
					<section class="feature left">
						<a href="#" class="image icon solid fa-mobile-alt"><img src="images/pic03.jpg" alt="" /></a>
						<div class="content">
							<h3>The Third Thing</h3>
							<p>Vitae natoque dictum etiam semper magnis enim feugiat amet curabitur tempor orci penatibus. Tellus erat mauris ipsum fermentum etiam vivamus eget. Nunc nibh morbi quis fusce lacus.</p>
						</div>
					</section>
				</div>

				<header class="major">
					<h2>Notre Dernier Projet</h2>
					<p>Découvrez notre réalisation la plus récente</p>
				</header>
				<div class="video-container container medium">
					<iframe 
						width="100%" 
						height="500" 
						src="https://www.youtube.com/embed/CIuqRWQhFkU?si=koM2FnsfnJOS2Jk1" 
						title="YouTube video player" 
						frameborder="0" 
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
						referrerpolicy="strict-origin-when-cross-origin"
						allowfullscreen>
					</iframe>
				</div>
				</div>
			</div>

		<!-- Footer -->
			<div id="footer">
				<div class="container medium">

				<header class="major last">
				<h2>Des questions ou des commentaires ?</h2>
			</header>

			<p>N'hésitez pas à me contacter si vous avez une question, 
				un projet à proposer ou simplement envie d’échanger. Je suis
				 toujours ouverte aux collaborations, aux retours et aux nouvelles 
				 opportunités dans le développement web.
			</p>

			<form method="post" action="contact.php">
    <div class="row">
        <div class="col-6 col-12-mobilep">
            <input type="text" name="name" placeholder="Nom" required />
        </div>
        <div class="col-6 col-12-mobilep">
            <input type="email" name="email" placeholder="Email" required />
        </div>
        <div class="col-12">
            <textarea name="message" placeholder="Message" rows="6" required></textarea>
        </div>
        <div class="col-12">
            <ul class="actions special">
                <li><input type="submit" value="Envoyer le message" /></li>
            </ul>
        </div>
    </div>
</form>

                    <!-- Section réseaux sociaux -->
					<div class="social-links">
						<?php 
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<a href="' . htmlspecialchars($row["lien"]) . '" 
									 class="social-icon" 
									 target="_blank" 
									 title="' . htmlspecialchars($row["nom_du_reseau"]) . '">
									 <i class="bi bi-' . htmlspecialchars($row["icon"]) . '"></i>
								 </a>';
						}
						?>
					</div>

					<?php
					mysqli_close($conn);
					?>

			<ul class="copyright">
				<li>&copy; Hamed Wassila. Tous droits réservés.</li>
				<li>Design : <a href="http://html5up.net">HTML5 UP</a></li>
			</ul>


				</div>
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>