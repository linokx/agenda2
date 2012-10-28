<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('member');
		};
	}
	public function index()
	{
		$this->lister();
	}
	public function lister()
	{

		$data['pref'] = 6;
		$data['today'] = explode('-',date('d-m-Y'));
		$semaine = ($this->uri->segment(4))?$this->uri->segment(4):date('W');
		$annee = ($this->uri->segment(3))?$this->uri->segment(3):date('Y');
		$data['semaine'] = $semaine;
		$data['annee'] = $annee;
		$data['calendrier'] = $this->calendrier($data, 'thead');
		if($semaine-1 > 0){
			$data['precedent'] = $annee.'/'.($semaine-1);
		}
		else{
			$data['precedent'] = ($annee-1).'/'.date('W',strtotime(($annee-1).'-12-28'));
		}
		if($semaine+1 < date('W',strtotime($annee.'-12-28'))){
			$data['suivant'] = $annee.'/'.($semaine+1);
		}
		else
		{
			$data['suivant'] = ($annee+1).'/1';
		}
		$this->load->model('M_Agenda');
		$id = $this->session->userdata('logged_in');
		$d = 10;
		$m = 10;
		$y = 2012;
		$long = 6;
		$date_min = date($y.'-'.$m.'-'.$d);		
		$date_max = date($y.'-'.$m.'-'.($d+($long-1)));
		$info_liste = array('perso' => true, 'id' => $id->id, 'min' => $date_min, 'max' => $date_max);
		//$data['rdvs'] =$this->M_Agenda->lister($info_liste);
		$data['rdvs'] = $this->calendrier($this->M_Agenda->lister($info_liste),'rdv');
		$dataMenu['amis'] = $this->M_Agenda->listerAmis($id->id);
		$dataLayout['main_title'] = "Agenda";
		$dataLayout['menu'] = $this->load->view('menu_agenda',$dataMenu,true);
		$dataLayout['vue'] = $this->load->view('lister_agenda',$data,true);
		$this->load->view('layout',$dataLayout);
	}

	public function ajouter()
	{

		$this->load->model('M_Agenda');
		$items = array('date_deb','heure_deb','date_fin','heure_fin','type','rappel');
		$data = $this->verification($this->input,$items);
		if($data['etat']){
			$data['id'] = $this->session->userdata('logged_in')->id;
			$heure = explode(':',$data['heure_deb']);
			$data['heure_deb'] = ($heure[0]*60)+$heure[1];
			$heure = explode(':',$data['heure_fin']);
			$data['heure_fin'] = ($heure[0]*60)+$heure[1];
			$date_deb = explode('-', $data['date_deb']); 
			$date_fin = explode('-', $data['date_fin']);
			$data['duree'] = (($date_fin[0]-$date_deb[0])*1440)+($data['heure_fin'] - $data['heure_deb']);
			$data['date_deb'] = $date_deb[2].'-'.$date_deb[1].'-'.$date_deb[0];
			$data['date_fin'] = $date_fin[2].'-'.$date_fin[1].'-'.$date_fin[0];
			$data['delai'] = 0;
			$data['lieu'] = ($this->input->post('lieu')!=null)?$this->input->post('lieu'):"";
			$data['description'] = $this->input->post('description');
			$data['prive'] = $this->input->post('prive');

			$this->M_Agenda->ajouter($data);

			$dataLayout['vue'] = $this->load->view('lister_agenda','',true);
		}
		else{
			$this->load->helper('form');
			if(!$data['rempli']):
				$data['date_deb'] = date('d-m-Y');
				$data['heure_deb'] = date('G').':00';
				$data['date_fin'] = date('d-m-Y');
				$data['heure_fin'] = (date('G')+1).':00';
			endif;
			$dataLayout['vue'] = $this->load->view('ajouter_agenda',$data,true);
		}

		$id = $this->session->userdata('logged_in');
		$dataMenu['amis'] = $this->M_Agenda->listerAmis($id->id);
		$dataLayout['main_title'] = "Agenda";
		$dataLayout['menu'] = $this->load->view('menu_agenda',$dataMenu,true);
		$this->load->view('layout',$dataLayout);
	}

	public function voir(){

		$data['main_title'] = "Voir Agenda";
		$data['menu'] = "" ;
		$data['vue'] = $this->load->view('construction','',true);
		$this->load->view('layout',$data);
	}
	public function croiser(){

		$data['main_title'] = "Croiser Agenda";
		$data['menu'] = "" ;
		$data['vue'] = $this->load->view('construction','',true);
		$this->load->view('layout',$data);

	}
	private function verification($data,$items){
		$infos['etat'] = true;
		$infos['rempli'] = false;
		foreach($items as $item):
			if($data->post($item) != null):
			 	$infos[$item] =$data->post($item);
			 	$infos['rempli'] = ($item != 'type' && $item != 'rappel')? true : $infos['rempli'];
			else:
				$infos[$item] = ($item == 'type')?1:"";
				$infos[$item] = ($item == 'rappel')?0:"";
				$infos['etat'] = false;
			endif;
		endforeach;
		return $infos;
	}

	private function calendrier($data,$part){

		if($part == "thead"){
			$head = array();
			$annee = $data['annee'];
			$semaine = $data['semaine'];
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

            for($d=0;$d<7;$d++):
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
	            array_push($head, $nom_jour.' '.$date_auj[1].'/'.$date_auj[2]);
            endfor;
            return $head;
        }
        else
        {
        	$this->load->helper('array');
        	$result = array();
        	$t=0;
        	for($d=0;$d<7;$d++):
                $date = new DateTime('10/01/2012');
                $date_auj = explode('-',date_format($date, 'D-d-m-Y'));
                $date_auj[0] = 2;
                $pref = 6;
	            foreach($data as $rdv[$t]):
	                $date_deb = explode('-',$rdv[$t]->date_deb);
	                $date_fin = explode('-',$rdv[$t]->date_fin);
	                //$date_deb[2]=23;
	                //echo(($date_fin[2]*1).'&');
	                $date_deb[1] = element('1', $date_deb);
	                $date_deb[2] = element('2', $date_deb);
	                $date_fin[2] = element('2', $date_fin);
	                if(($date_auj[0]+$d >= $date_deb[2])&&($date_auj[0]+$d < $date_fin[2]) || ($date_auj[0]+$d <= $date_fin[2] && $rdv[$t]->heure_fin > ($pref*60))):
		                //Si ca commence aujourd'hui
		               if($date_auj[0]+$d >= $date_deb[2])
		                {
		                    $heure_deb = 77+((($rdv[$t]->heure_deb-($pref*60))/60)*47);
		                    $duree = ($rdv[$t]->heure_deb+$rdv[$t]->duree > 1440) ? (((1440-$rdv[$t]->heure_deb)/60)*47)-20 : (($rdv[$t]->duree/60)*47)-20;
		                }
		                //Si ca a commencé avant aujourd'hui et ca corrige un beug sur les events de + d'un jour
		                else if(($date_auj[0]+$d) <= $date_fin[2])
		                {
		                    $heure_deb = 77;
		                    $duree =(($date_auj[0]+$d) == $date_fin[2])? ((($rdv[$t]->heure_fin-($pref*60))/60)*47)-20 : (((1440-($pref*60))/60)*47)-20;
		                }
		                //$position = 54+((93)*$d);
		                $deb = $date_deb[2].'/'.$date_deb[1];
		                $heure_deb = floor($rdv[$t]->heure_deb/60).'h'.$minute = ($rdv[$t]->heure_deb%60>10)?$rdv[$t]->heure_deb%60:"0".$rdv[$t]->heure_deb%60;
		                $fin = $date_fin[2].'/'.$date_fin[1];
		                $heure_fin = floor($rdv[$t]->heure_fin/60).'h'.$minute = ($rdv[$t]->heure_fin%60>10)?$rdv[$t]->heure_fin%60:"0".$rdv[$t]->heure_fin%60;

		                $rdv[$t]->heure_deb_text = $heure_deb;
		                $rdv[$t]->date_deb = $deb;
		                $rdv[$t]->heure_fin_text = $heure_deb;
		                //$rdv->date_fin = $deb;
		                $rdv[$t]->position = 54+(93*($date_deb[2]-$date_auj[1]));
		                $rdv[$t]->longueur = $duree;
		                array_push($result,$rdv[$t]);
	            	$t++;
	            	endif;
	            endforeach;
	            $t++;
	        endfor;

	        return $result;
        }
	}
}
?>