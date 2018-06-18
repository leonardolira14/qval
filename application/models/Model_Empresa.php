<?php
/**
* 
*/
class Model_Empresa extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
		$this->load->helper("ayuda");
	}
	public function getTipos()
	{
		$rec=$this->db->select("*")->get("tiposempresa");
		$data["tiposempresa"]=$rec->result();
		$rec=$this->db->select("*")->get("noempleados");
		$data["noempleados"]=$rec->result();
		$rec=$this->db->select("*")->get("tipfacturacion");
		$data["tipofacturacion"]=$rec->result();
		$rec=$this->db->select("*")->where("IDPais='42'")->get("estado");
		$data["estados"]=$rec->result();
		return $data;
	}
	public function GetdatsEmpresa($empresa){
		$rec=$this->db->select("*")->where("IDEmpresa='$empresa'")->get("empresa");
		return $rec->result()[0];
	}
	public function updatelogo($empresa,$logo){
		$dat=array("Logo"=>$logo);
		$this->db->where("IDEmpresa='$empresa'")->update("empresa",$dat);
	}
	public function updategen($rz,$nc,$rfc,$te,$noe,$fac,$desc,$empresa){
		$ar=array("RazonSocial"=>$rz,"NombreComercial"=>$nc,"RFC"=>$rfc,"TipoEmpresa"=>$te,"NoEmpleados"=>$noe,"FacturacionAnual"=>$fac,"Descripcion"=>$desc);
		$der=$this->db->where("IDEmpresa=$empresa")->update("empresa",$ar);
		return $der; 
	}
	public function updatecontac($pagina,$direc,$colonia,$municipio,$cp,$estado,$tel,$empresa){
		$ar=array("Pagina"=>$pagina,"Calleynum"=>$direc,"Colonia"=>$colonia,"Municipio"=>$municipio,"CP"=>$cp,"Estado"=>$estado,"Telefono"=>$tel);
		$der=$this->db->where("IDEmpresa=$empresa")->update("empresa",$ar);
		return $der; 
	}

}