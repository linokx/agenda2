<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sortie extends CI_Controller {
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
		$this->load->model('M_Sortie');
		$data['distance'] = 500;
		$data['lieux'] = $this->M_Sortie->lister($data);
		$latitude = 50;
		$longitude = 5;
		$i = 0;
		foreach($data['lieux'] as $lieu)
		{
			$distance = round((6366*acos(cos(deg2rad($latitude))*cos(deg2rad($lieu->lat))*cos(deg2rad($lieu->lon) -deg2rad($longitude))+sin(deg2rad($latitude))*sin(deg2rad($lieu->lat))))*1000)/1000;
			$data['lieux'][$i]->distance = ($distance < 1) ? $distance*1000 ."m": round($distance*10)/10 ."km"; 
			$i++;
		}

		$dataMenu['distances'] = array(	array('distance' => 10,'texte' => '10km'),
										array('distance' => 20,'texte' => '20km'),
										array('distance' => 30,'texte' => '30km'),
										array('distance' => 40,'texte' => '40km'),
										array('distance' => 50,'texte' => '50km et +'));
		$dataMenu['types'] = array(	array('type' => 1,'texte' => 'Bar et Club'),
									array('type' => 2,'texte' => 'Concert et Spectacle'),
									array('type' => 3,'texte' => 'Détente'),
									array('type' => 4,'texte' => 'Culturel'),
									array('type' => 5,'texte' => 'Casino et Adulte'),
									array('type' => 6,'texte' => 'Sport'));

		$dataLayout['main_title'] = "Agenda";
		$dataLayout['menu'] = $this->load->view('menu_sortie',$dataMenu,true);
		$dataLayout['vue'] = $this->load->view('lister_sortie',$data,true);
		$this->load->view('layout',$dataLayout);
	}
	public function ajouter()
	{

		$this->load->helper('form');
		$this->load->model('M_Agenda');
		$id = $this->session->userdata('logged_in');
		$dataMenu['amis'] = $this->M_Agenda->listerAmis($id->id);
		$data['main_title'] = "Agenda";
		$data['menu'] = $this->load->view('menu_agenda',$dataMenu,true);
		$data['vue'] = $this->load->view('ajouter_agenda','',true);
		$this->load->view('layout',$data);
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
}
?>