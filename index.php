<?php
// Inclure le fichier de connexion
require_once 'db_connection.php';

// Récupération des réseaux sociaux depuis la base de données
$requeteSQL = "SELECT nom_du_reseau, lien, icon FROM social_media WHERE actif = 1";
$result = mysqli_query($connexion, $requeteSQL);

if (!$result) {
    die("Erreur dans la requête : " . mysqli_error($connexion));
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Portfolio</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>


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
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Header -->
			<style>
			#header {
				background: #fff;
				padding: 4.5em 0 2.5em 0;
				text-align: center;
			}

			#header .logo {
				color: #3c3b3b;
				font-size: 2em;
				margin-bottom: 1em;
			}

			#header h1 {
				color: #3c3b3b;
				font-size: 2.5em;
				margin-bottom: 0.5em;
			}

			#header p {
				color: #666;
				font-size: 1.2em;
				line-height: 1.65em;
				margin-bottom: 1.5em;
			}

			#header .button {
				background-color: #3c3b3b;
				color: #fff;
				padding: 0.75em 2em;
				border-radius: 4px;
				text-decoration: none;
				transition: background-color 0.2s;
			}

			#header .button:hover {
				background-color: #4f4f4f;
			}
			</style>
			<style>
			#nav {
				background: #f4f4f4;
				padding: 1em 0;
				text-align: center;
				border-bottom: 1px solid #e6e6e6;
				box-shadow: 0 2px 5px rgba(0,0,0,0.1);
			}

			#nav ul {
				list-style: none;
				margin: 0;
				padding: 0;
			}

			#nav ul li {
				display: inline-block;
				margin: 0 1em;
			}

			#nav ul li a {
				color: #3c3b3b;
				text-decoration: none;
				font-size: 1.1em;
				transition: color 0.2s;
			}

			#nav ul li a:hover {
				color: #4f4f4f;
			}
			</style>
			<nav id="nav">
				<ul>
					<li><a href="#accueil">Accueil</a></li>
					<li><a href="#projet">Projet</a></li>
					<li><a href="#competences">Compétences</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</nav>

			<div id="header">
				<span class="logo icon fa-paper-plane"></span>
				<h1>Bienvenue sur mon Portfolio</h1>
				<p>Je suis Thomas Herbin, étudiant en développement web.</p>
				<p>Découvrez mes projets et mes compétences à travers ce portfolio.</p>
				<ul class="actions special">
					<li><button class="button">Voir mon CV</button></li>
				</ul>
			</div>

		<!-- Main -->
			<div id="main">

				<header class="major container medium">
					<h2>We conduct experiments that
					<br />
					may or may not seriously
					<br />
					break the universe</h2>
					<!--
					<p>Tellus erat mauris ipsum fermentum<br />
					etiam vivamus nunc nibh morbi.</p>
					-->
				</header>

				<div class="box alt container">
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

				<!--
				<div class="box container">
					<header>
						<h2>A lot of generic stuff</h2>
					</header>
					<section>
						<header>
							<h3>Paragraph</h3>
							<p>This is the subtitle for this particular heading</p>
						</header>
						<p>Phasellus nisl nisl, varius id <sup>porttitor sed pellentesque</sup> ac orci. Pellentesque
						habitant <strong>strong</strong> tristique <b>bold</b> et netus <i>italic</i> malesuada <em>emphasized</em> ac turpis egestas. Morbi
						leo suscipit ut. Praesent <sub>id turpis vitae</sub> turpis pretium ultricies. Vestibulum sit
						amet risus elit.</p>
					</section>
					<section>
						<header>
							<h3>Blockquote</h3>
						</header>
						<blockquote>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget.
						tempus euismod. Vestibulum ante ipsum primis in faucibus.</blockquote>
					</section>
					<section>
						<header>
							<h3>Divider</h3>
						</header>
						<p>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra
						ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel. Praesent nec orci
						facilisis leo magna. Cras sit amet urna eros, id egestas urna. Quisque aliquam
						tempus euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
						posuere cubilia.</p>
						<hr />
						<p>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra
						ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel. Praesent nec orci
						facilisis leo magna. Cras sit amet urna eros, id egestas urna. Quisque aliquam
						tempus euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
						posuere cubilia.</p>
					</section>
					<section>
						<header>
							<h3>Unordered List</h3>
						</header>
						<ul class="default">
							<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
							<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
							<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
							<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						</ul>
					</section>
					<section>
						<header>
							<h3>Ordered List</h3>
						</header>
						<ol class="default">
							<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
							<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
							<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
							<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						</ol>
					</section>
					<section>
						<header>
							<h3>Table</h3>
						</header>
						<div class="table-wrapper">
							<table class="default">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Description</th>
										<th>Price</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>45815</td>
										<td>Something</td>
										<td>Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</td>
										<td>29.99</td>
									</tr>
									<tr>
										<td>24524</td>
										<td>Nothing</td>
										<td>Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</td>
										<td>19.99</td>
									</tr>
									<tr>
										<td>45815</td>
										<td>Something</td>
										<td>Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</td>
										<td>29.99</td>
									</tr>
									<tr>
										<td>24524</td>
										<td>Nothing</td>
										<td>Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</td>
										<td>19.99</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="3"></td>
										<td>100.00</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</section>
					<section>
						<header>
							<h3>Form</h3>
						</header>
						<form method="post" action="#">
							<div class="row">
								<div class="col-6 col-12-mobilep">
									<label for="name">Name</label>
									<input class="text" type="text" name="name" id="name" value="" placeholder="John Doe" />
								</div>
								<div class="col-6 col-12-mobilep">
									<label for="email">Email</label>
									<input class="text" type="text" name="email" id="email" value="" placeholder="johndoe@domain.tld" />
								</div>
								<div class="col-12">
									<label for="subject">Subject</label>
									<input class="text" type="text" name="subject" id="subject" value="" placeholder="Enter your subject" />
								</div>
								<div class="col-12">
									<label for="subject">Message</label>
									<textarea name="message" id="message" placeholder="Enter your message" rows="6"></textarea>
								</div>
								<div class="col-12">
									<ul class="actions special">
										<li><input type="submit" value="Send" /></li>
										<li><input type="reset" value="Reset" class="alt" /></li>
									</ul>
								</div>
							</div>
						</form>
					</section>
				</div>
				-->

				<footer class="major container medium">
					<h3>Get shady with science</h3>
					<p>Vitae natoque dictum etiam semper magnis enim feugiat amet curabitur tempor orci penatibus. Tellus erat mauris ipsum fermentum etiam vivamus.</p>
					<ul class="actions special">
						<li><a href="#" class="button">Join our crew</a></li>
					</ul>
				</footer>

			</div>

		<!-- Footer -->
			<div id="footer">
				<div class="container medium">

					<header class="major last">
						<h2>Questions or comments?</h2>
					</header>

					<p>Vitae natoque dictum etiam semper magnis enim feugiat amet curabitur tempor
					orci penatibus. Tellus erat mauris ipsum fermentum etiam vivamus.</p>

					<form method="post" action="#">
						<div class="row">
							<div class="col-6 col-12-mobilep">
								<input type="text" name="name" placeholder="Name" />
							</div>
							<div class="col-6 col-12-mobilep">
								<input type="email" name="email" placeholder="Email" />
							</div>
							<div class="col-12">
								<textarea name="message" placeholder="Message" rows="6"></textarea>
							</div>
							<div class="col-12">
								<ul class="actions special">
									<li><input type="submit" value="Send Message" /></li>
								</ul>
							</div>
						</div>
                    </form>

                    <!-- Section réseaux sociaux -->
                    <div class="social-links">
                        <?php 
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<a href="' . htmlspecialchars($row["lien"]) . '" 
                                     class="' . htmlspecialchars($row["nom_du_reseau"]) . '" 
                                     target="_blank">
                                     <i class="bi bi-' . htmlspecialchars($row["icon"]) . '"></i>
                                  </a>';
                        }
                        ?>
                    </div>

                    <?php
                    // Fermeture de la connexion
                    mysqli_close($connexion);
                    ?>

					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
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