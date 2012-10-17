
    <?php 
$pref = 6;
$today = explode('-',date('d-m-Y'));
$semaine = (isset($_GET['w']))?$_GET['w'] : date('W');
$annee = (isset($_GET['y']))?$_GET['y'] : date('Y');
$precedent = ($semaine-1 > 0)? ($semaine-1).'&y='.$annee : date('W',strtotime(($annee-1).'-12-31')).'&y='.($annee-1);
$suivant = ($semaine+1 > date('W',strtotime($annee.'-12-31')))? ($semaine+1).'&y='.$annee :(1).'&y='.($annee+1); ?>
<a class="lien" href="index.php?a=lister&c=agenda&w=<?php echo $precedent; if(isset($_GET['id'])) echo '&id='.$_GET['id']; if(isset($_GET['id_membre'])) echo '&id_membre='.$_GET['id_membre']; ?>">< Semaine précedente</a>
<a class="lien" style="float:right" href="index.php?a=lister&c=agenda&w=<?php echo $suivant; if(isset($_GET['id'])) echo '&id='.$_GET['id']; if(isset($_GET['id_membre'])) echo '&id_membre='.$_GET['id_membre']; ?>">Semaine suivante ></a>
<div id="agenda">
<table id="calend" style="background-color:white;border-collapse:collapse; width:100%" border="1">
    <thead>
        <tr height="20px">
            <th style="width:48px">
            </th>
            <?php
            $nbre_jour =  7;
			$pre = date('N',strtotime($annee.'-1-1'));
			$jours = ($semaine)*7;
			$compte = $pre-2;
			$j = 1;
			while(($jours-$compte) > $nbre_jours = date('t',strtotime($annee.'-'.$j.'-01')))
			{
				$j++;
				$compte += $nbre_jours;
			}
			$longueur = 7;
			$depart = date('d', strtotime($annee.'-'.$j.'-'.($jours - $compte)));
			$mois_date = $j;

            for($d=0;$d<$nbre_jour;$d++):
				//$depart = date('d')-(date('N')-1);
				//$mois_date = 7;
				if($depart+$d > date('t',strtotime($annee.'-'.$mois_date.'-01'))){
					 $mois_date++;
					 $depart= 1-$d;
				}
				if($mois_date > 12)
				{
					$annee++;
					$mois_date = 1;
				}
                $date = new DateTime($mois_date.'/'.($depart+$d).'/'.$annee);
                $date_auj = explode('-',date_format($date, 'D-d-m-Y'));
                $num_jour = ($date_auj[0]);
                switch($num_jour){
                    case 'Mon':
                    $nom_jour = 'lun.';
                    break;
                    case 'Tue':
                    $nom_jour = 'mar.';
                    break;
                    case 'Wed':
                    $nom_jour = 'mer.';
                    break;
                    case 'Thu':
                    $nom_jour = 'jeu.';
                    break;
                    case 'Fri':
                    $nom_jour = 'ven.';
                    break;
                    case 'Sat':
                    $nom_jour = 'sam.';
                    break;
                    case 'Sun':
                    $nom_jour = 'dim.';
                    break;
                    default:
                    $nom_jour = '';
                }
                ?>
                <th style="width:109px"<?php if($today[0] == $date_auj[1] && $today[1] == $date_auj[2] && $today[2] == $date_auj[3]): ?> class="auj" <?php endif; ?> scope="cols"><?php echo $nom_jour.' '.$date_auj[1].'/'.$date_auj[2]; ?></th>
            <?php endfor; ?>
        </tr>
    </thead>
    <tbody>
        <?php
            for($i=$pref;$i<24;$i++):
                ?>
                <tr height="40px">
                    <td scope="rows">
                    <?php
                        
                        $heure = ($i<10)?'0'.$i:$i;
                        echo $heure.':00';
                    ?>
                    </td>
                    <?php
                    for($d=0; $d<7; $d++){
                        echo '<td></td>';
                    }
                    ?>
                </tr>
                <?php
             endfor;
        ?>
    </tbody></table>