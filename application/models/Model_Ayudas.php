<?php

class Model_Ayudas extends CI_Model
{
	
	function __construct()
	{
			$this->load->database();
			$this->load->helper("ayuda");
	}

	public function GetPaises(){
		$sql=$this->db->select("*")->order_by("paisnombre", "asc")->get("pais");
		return $sql->result();
	}
	public function GetEstado($numpais){
		$sql=$this->db->select("*")->where("IDPais='$numpais'")->get("estado");
		return $sql->result();
	}
}
