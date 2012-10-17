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
		</nav>
		<?php echo $vue; ?>
	</div>
</body>
</html>