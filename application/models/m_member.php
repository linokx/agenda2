<?php
	class M_Member extends CI_Model
	{
		public function verifier($data)
		{
			$query = $this->db->get_where('membre', array('login'=> $data['nom'], 'mdp'=> sha1($data['mdp'])));
			return $query->num_rows();
		}
	}
?>