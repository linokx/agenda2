<?php
	class M_Agenda extends CI_Model
	{
		public function listerAmis($id)
		{
			$this->db->select('*');
			$this->db->from('amis');
			$this->db->join('membre', 'amis.id = membre.id');
			$this->db->where('amis.id_amis',$id);
			
			$query = $this->db->get();
			return $query->result();
		}
	}
?>