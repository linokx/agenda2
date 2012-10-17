<p><a href="index.php?a=lister&c=agenda">Afficher mon agenda</a>
<a href="index.php?a=ajouter&c=agenda">Voir l'agenda d'un ami</a>
<a href="index.php?a=croiser&c=agenda">Croiser les agendas</a></p>
<form method="get" action="index.php">
    <input type="hidden" name="a" value="lister" />
    <input type="hidden" name="c" value="agenda" />
	<?php
    $semaine = (isset($_GET['w']))?$_GET['w'] : date('W');
	$annee = (isset($_GET['y']))?$_GET['y'] : date('Y'); ?>	
    <input type="hidden" name="w" value="<?php echo $semaine; ?>" />
    <input type="hidden" name="y" value="<?php echo $annee; ?>" />
    <select name="id_membre">
        <option value="">-------------</option>
        <?php foreach($view['data']['amis'] as $amis): ?>
        <option value="<?php echo $amis['id']; ?>"<?php if(isset($_GET['id']) && $_GET['id'] == $amis['id_amis']): ?> selected="selected" <?php endif; ?>><?php echo $amis['prenom'].' '.$amis['nom']; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Voir l'agenda" />
</form>
<p><a href="index.php?a=ajouter&c=agenda">Ajouter un évênement</a></p>