<!DOCTYPE HTML>
<html lang="fr-BE">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().CSS_DIR;?>/style.css" media="screen" />
	<title>Accueil | Agenda</title>
</head>
<body>
	<div id="conteneur">
		<header>
			<h1>
				<?php echo anchor('agenda', 'Agenda', 'title="Page d\'accueil"'); ?>
			</h1>
		</header><nav>
			<ul>
				<li>
					<?php echo anchor('member', 'Accueil', 'title="Page d\'accueil"'); ?>
				</li>
				<li>
					<?php echo anchor('agenda', 'Agenda', 'title="Voir mon emploi du temps"'); ?>
				</li>
				<li><?php echo anchor('sortie', 'Sorties', 'title="Sorties dans les environs"'); ?>
				</li>
				<li>
					<a href="">Amis</a>
				</li>
				<li><?php echo anchor('message', 'Message', 'title="Accéder à la messagerie"'); ?>
				</li>
				<li>
					<a href="">Profil</a>
				</li>
			</ul>
		</nav>
		<div id="intro"></div><?php echo $connexion; ?>
		</div><div id="accueil">
			<h2>Les prochains évênements</h2>
			<div class="sujet">
				<h3>Concert et Théâtre</h3>
				<div class="recent">
					<h4>Soirée Halloween</h4>
					<img src="#"/>
					<div><p>Description du lieu, description du lieu, description du lieu, description du lieu</p><p>n°, rue de nulpart, description du lieu, description<br/>Liège</p>
					<a href="#" class="ajout">Ajouter à l'agenda</a>
					</div>
				</div><div class="recent">
					<h4>Soirée Halloween</h4>
					<img src="#"/>
					<div><p>Description du lieu, description du lieu, description du lieu, description du lieu</p><p>n°, rue de nulpart, description du lieu, description<br/>Liège</p>
					<a href="#" class="ajout">Ajouter à l'agenda</a>
					</div>
				</div>
			</div>
			<div class="sujet">
				<h3>Musée et Culture</h3>
				<div class="recent">
					<h4>Soirée Halloween</h4>
					<img src="#"/>
					<div><p>Description du lieu, description du lieu, description du lieu, description du lieu</p><p>n°, rue de nulpart, description du lieu, description<br/>Liège</p>
					<a href="#" class="ajout">Ajouter à l'agenda</a>
					</div>
				</div><div class="recent">
					<h4>Soirée Halloween</h4>
					<img src="#"/>
					<div><p>Description du lieu, description du lieu, description du lieu, description du lieu</p><p>n°, rue de nulpart, description du lieu, description<br/>Liège</p>
					<a href="#" class="ajout">Ajouter à l'agenda</a>
					</div>
				</div>
			</div>
		</div>
		<footer>© Bekaert Ludovic</footer>
	</div>
</body>
</html>