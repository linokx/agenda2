<?php
	class M_Sortie extends CI_Model
	{
		public function lister($data)
		{

			$latitude = 50;
			$longitude = 5;
			$distance = $data['distance'];
			$formule = "(6366*acos(cos(radians($latitude))*cos(radians(`lat`))*cos(radians(`lon`) -radians($longitude))+sin(radians($latitude))*sin(radians(`lat`))))";
			$this->db->select('*');
			$this->db->from('lieu');
			$this->db->where($formule.'<='.$distance);
			
			$query = $this->db->get();
			return $query->result();
		}


		/*function getList($distance, $theme)
		{
		global $connex;
		if($theme > 0 && $theme <8)
		{
			$theme = "AND id_theme = ".$theme;
		}
		else
		{
			$theme = null;
		}
		$this->connex = $connex;
			$latitude= $_SESSION['connected']['lat'];
			$longitude= $_SESSION['connected']['lon'];
			$formule="(6366*acos(cos(radians($latitude))*cos(radians(`lat`))*cos(radians(`lon`) -radians($longitude))+sin(radians($latitude))*sin(radians(`lat`))))";
		
		if($distance < 50){			
			$req = "SELECT *,$formule AS dist FROM lieu WHERE $formule<=$distance $theme ORDER by dist ASC LIMIT 0,500";
		}
		else
			$req = "SELECT *,$formule AS dist FROM lieu ORDER by dist ASC LIMIT 0,500";
	
		try
		{			
			$ps = $this->connex->prepare($req);
			$ps->execute();	
			$lieux = $ps->fetchAll() ;
		}
		catch ( PDOException $e )
		{
			die( $e->getMessage());
		}
		return $lieux;
	}*/
	}
?>