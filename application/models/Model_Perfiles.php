<?php 
/**
* 
*/
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_perfiles extends CI_Model
{
	
	public  function __construct(){
        $this->load->database();
    }
    public function GetPerfilSET($empresa,$tipo,$status)
    {
    	$get=$this->db->select("*")->where("IDEmpresa='$empresa' and Status='$status' and Tipo='$tipo'")->get("grupos");
    	if($get->num_rows()==0){
			return false;
		}else
		{
			return $get->result();
		}
    }
    //funcion para obtener los perfiles de una empresa
	public function GetPerfiles($empresa,$status){
		$get=$this->db->select("*")->where("IDEmpresa='$empresa' and Status='$status'")->get("grupos");
		if($get->num_rows()==0){
			return false;
		}else
		{
			return $get->result();
		}
	}
	public function GetPerfileN($nombre,$empresa)
	{
		$get=$this->db->select('*')->where("Nombre='$nombre' and IDEmpresa='$empresa'")->get('grupos');
		if($get->num_rows()==0)
		{
			return false;
		}else
		{
			return $get->result();
		}
	}
	public function GetPerfileI($num)
	{
		$get=$this->db->select('*')->where("IDGrupo='$num'")->get('grupos');
		if($get->num_rows()==0)
		{
			return false;
		}else
		{
			return $get->result();
		}
	}
	public function AddPerfil($empresa,$nombre,$tipo){
		$datos=array(
			"IDEmpresa"=>$empresa,
			"Nombre"=>$nombre,
			"Tipo"=>$tipo,
			"status"=>1

		);
		$this->db->insert("grupos",$datos);
	}
	public function ModPerfil($nombre,$tipo,$num){
		$datos=array(
			"Nombre"=>$nombre,
			"Tipo"=>$tipo
		);
	return $this->db->where("IDGrupo='$num'")->update("grupos",$datos);
	}
	public function DelPerfil($num){
		$datos=array(
			"Status"=>0
		);
		$t=$this->db->where("IDGrupo='$num'")->update("grupos",$datos);
		return $t;
	}
}