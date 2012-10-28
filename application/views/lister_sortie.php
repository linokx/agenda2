<div id="centre">
<?php

    foreach($lieux as $lieu):?>
    <div style="margin-bottom:10px; border:1px white solid; background-color:white;padding-bottom:1em" >
            <h3 style="background-color:#8CB032; margin-bottom:0.7em; padding:0.3em 0.6em; display:block; font-weight:bold"><?php echo $lieu->nom; ?></h3>
            <p style="display:block; padding-left: 2em">
            Ouvert tous les jours de <br />
            Fermé le <?php echo $lieu->fermeture; ?><br />
            <?php echo $lieu->numero.', '.$lieu->adresse.' - '.$lieu->ville; ?> (Distance:  <?php echo $lieu->distance; ?>.)</p>    
        </div>
    <?php
    endforeach;
?>
</div>