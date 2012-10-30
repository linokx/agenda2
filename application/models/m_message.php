<?php
	class M_Message extends CI_Model
	{
		public function voir()
		{
			$this->db->select('*');
			$this->db->from('message');
			$this->db->join('membre', 'id_dest = id');
			$this->db->where('(id_dest = 1 OR id_exp = 1) AND id_convers = 1');
			$this->db->group_by('id_convers, date DESC'); 
			
			$query = $this->db->get();
			return $query->result();
		}
	}
?>