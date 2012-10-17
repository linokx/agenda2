<!DOCTYPE HTML>
<html lang="fr-BE">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url().CSS_DIR;?>/style.css" media="screen" />
	<title><?php echo $main_title; ?></title>
</head>
<body>
	<div id="conteneur">
		<header>
			<h1>
				<a href="<?php echo site_url(); ?>" title="Page d'accueil" />Agenda</a>
			</h1>
		</header>
		<nav>
			<ul>
				<li>
					<a href="">Membre</a>
				</li>
			</ul>
		</nav>
		<div id="menu">
			<?php echo $menu; ?>
		</div>
		<div id="content">
			<?php echo $vue; ?>
		</div>
		<footer>© Bekaert Ludovic</footer>
	</div>
</body>
</html>