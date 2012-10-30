<div id="centre">
<?php

    foreach($lieux as $lieu):?>
    <div class="sortie" style="margin-bottom:10px; background-color:white;padding-bottom:1em" >
        <h3 style="background-color:#8CB032; margin-bottom:0.7em; padding:0.3em 0.6em; font-weight:bold"><?php echo $lieu->nom.' ('.$lieu->distance.')'; ?>
            <span>Voir la fiche complète</span></h3>
            <img src="#"/><p>
            Ouvert tous les jours de <br />
            Fermé le <?php echo $lieu->fermeture; ?><br />
            <?php echo $lieu->numero.', '.$lieu->adresse.' - '.$lieu->ville; ?></p>    
        </div>
    <?php
    endforeach;
?>
</div>