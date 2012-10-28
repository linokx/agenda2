<div id="centre">
<?php 
echo anchor('agenda/lister/'.$precedent, '< Semaine précedente', array('title'=>"Voir l'agenda de la semaine passée",'class'=>"lien"));
echo anchor('agenda/lister/'.$suivant, 'Semaine suivante >', array('title'=>"Voir l'agenda de la semaine prochaine",'class'=>"lien")); ?>
<!-- <a class="lien" href="index.php?a=lister&c=agenda&w=<php echo $precedent; if(isset($_GET['id'])) echo '&id='.$_GET['id']; if(isset($_GET['id_membre'])) echo '&id_membre='.$_GET['id_membre']; ?>">< Semaine précedente</a>
<a class="lien" style="float:right" href="index.php?a=lister&c=agenda&w=<php echo $suivant; if(isset($_GET['id'])) echo '&id='.$_GET['id']; if(isset($_GET['id_membre'])) echo '&id_membre='.$_GET['id_membre']; ?>">Semaine suivante ></a>
-->
<div id="agenda">
<table id="calend" style="background-color:white;border-collapse:collapse; width:100%" border="1">
    <thead>
        <tr height="20px">
            <th style="width:48px">
            </th>
            <?php foreach ($calendrier as $head): ?>
                <th style="width:109px" scope="cols"><?php echo $head; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php for($i=$pref;$i<24;$i++): ?>
            <tr height="40px">
                <td scope="rows">
                    <?php echo $heure= ($i<10)?'0'.$i.':00':$i.':00'; ?>
                </td>
                <?php for($d=0; $d<7; $d++): ?>
                    <td></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>


    <?php
     /*foreach($rdvs as $agenda):

        ?>
                    <div class="rdv type_<?php echo $agenda->id_type; ?>" id="<?php echo $agenda->id_agenda;?>" style="top:<?php echo $agenda->heure_deb;?>px; left:<?php echo $agenda->position; ?>px;  height:<?php echo $agenda->longueur;?>px; width:72px" >
                        <span class="details">
                            Du <b><?php echo $agenda->date_deb.'</b> à <b>'.$agenda->heure_deb_text; ?></b><br />
                            Au <b><?php echo $agenda->date_fin.'</b> à <b>'.$agenda->heure_fin_text; ?></b><br />
                            Lieu&nbsp;: <b><?php echo $agenda->lieu; ?></b><br />
                            Description&nbsp;: <b><?php echo $agenda->description; ?></b><br />
                            <a href="index.php?a=modifier&c=agenda&id=<?php echo $agenda->id_agenda; ?>">Modifier</a>
                            <a  href="index.php?a=supprimer&c=agenda&id=<?php echo $agenda->id_agenda; ?>">Supprimer</a>
                        </span>
                            <p><?php echo $agenda->description; ?></p>
                    </div>
                    <?php
            endforeach;*/
    ?>
    <?php
    $date = new DateTime('10/22/2012');
    $date_auj = explode('-',date_format($date, 'D-d-m-Y'));
    for($d=0;$d<7;$d++):
        foreach($rdvs as $agenda):
            $date_deb = explode('-',$agenda->date_deb);
            $date_fin = explode('-',$agenda->date_fin);
            //Si ca commence aujourd'hui
            if($date_auj[0]+$d == $date_deb[2])
            {
                $heure_deb = 77+((($agenda->heure_deb-($pref*60))/60)*47);
                $duree = ($agenda->heure_deb+$agenda->duree > 1440) ? (((1440-$agenda->heure_deb)/60)*47)-20 : (($agenda->duree/60)*47)-20;
            }
            //Si ca a commencé avant aujourd'hui et ca corrige un beug sur les events de + d'un jour
            else if(($date_auj[0]+$d) <= $date_fin[2])
            {
                $heure_deb = 77;
                $duree =(($date_auj[0]+$d) == $date_fin[2])? ((($agenda->heure_fin-($pref*60))/60)*47)-20 : (((1440-($pref*60))/60)*47)-20;
            }
            //$position = 54+((93)*$d);
            $position = $agenda->position;
            if(($date_auj[0]+$d >= $date_deb[2])&&($date_auj[0]+$d < $date_fin[2]) || ($date_auj[0]+$d == $date_fin[2] && $agenda->heure_fin > ($pref*60))):
                ?>
                <div class="rdv type_<?php echo $agenda->id_type; ?>" id="<?php echo $agenda->id_agenda;?>" style="top:<?php echo $heure_deb;?>px; left:<?php echo $position; ?>px;  height:<?php echo $duree;?>px; width:72px" >
                    <span class="details">
                        Du <b><?php echo $agenda->date_deb.'</b> à <b>'.floor($agenda->heure_deb/60).'h'.$minute = ($agenda->heure_deb%60>10)?$agenda->heure_deb%60:"0".$agenda->heure_deb%60 ; ?></b><br />
                        Au <b><?php echo $date_fin[2].'/'.$date_fin[1].'</b> à <b>'.floor($agenda->heure_fin/60).'h'.$minute = ($agenda->heure_fin%60>10)?$agenda->heure_fin%60:"0".$agenda->heure_fin%60 ; ?></b><br />
                        Lieu&nbsp;: <b><?php echo $agenda->lieu; ?></b><br />
                        Description&nbsp;: <b><?php echo $agenda->description; ?></b><br />
                        <a href="index.php?a=modifier&c=agenda&id=<?php echo $agenda->id_agenda; ?>">Modifier</a>
                        <a  href="index.php?a=supprimer&c=agenda&id=<?php echo $agenda->id_agenda; ?>">Supprimer</a>
                    </span>
                        <p><?php echo $agenda->description; ?></p>
                </div>
                <?php 
            endif;
        endforeach;
    endfor;
    ?>
</div>
</div>