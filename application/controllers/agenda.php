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
		$this->load->model('M_Agenda');
		$id = $this->session->userdata('id');

		$dataMenu['amis'] = $this->M_Agenda->listerAmis($id);

		$data['main_title'] = "Agenda";
		$data['menu'] = $this->load->view('menu_agenda','',true);
		$data['vue'] = $this->load->view('lister_agenda','',true);
		$this->load->view('layout',$data);
	}
}
?>