<?php
header('Access-Control-Allow-Origin: *');
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Model_Usuarios extends CI_Model
{
	
	public  function __construct(){
		
        $this->load->database();
        $this->constante="FpgH456Gtdgh43i349gjsjf%ttt";
        $this->load->helper("ayuda");
    }
    public function login($usuario,$clave){
    	$clave=md5($clave.$this->constante);
    	$resp=$this->db->select("*")->where("Usuario='$usuario' and Clave='$clave'")->get("usuario");
    	if($resp->num_rows()===0){
			return false;
    	}else{
			return $resp->result();
    	}

    }
    public function updateclave($c,$c1,$num){
    	$clave=md5($c.$this->constante);
    	$clave1=md5($c1.$this->constante);
    	$get=$this->db->select("*")->where("IDEmpresa='$num'")->get("usuario");
    	$datos=$get->result()[0];
    	if($datos->Clave!=$clave){
    		return false;
    	}else{
    		$d=array("Clave"=>$clave1);
    		$this->db->where("IDUsuario='$num'")->update("usuario",$d);
			return true;
    	}
    }
	public function getallUsuarios($num)
	{
		$get=$this->db->select("*")->where("IDEmpresa='$num'")->get("usuario");
		if($get->num_rows()===0){
			return false;
		}
		else
		{
			return $get->result();
		}
	}
	//funcion para agrgar un usuario
	public function AddUser($empresa,$nombre,$Apellidos,$usuario,$puesto,$correo,$Grupo){
		//$pas=md5(RandomPass().$this->constante);
		$array=array("IDEmpresa"=>$empresa,"Nombre"=>$nombre,"Apellidos"=>$Apellidos,"Usuario"=>limpia_espacios($usuario),"Correo"=>$correo,"Est"=>1,"IDConfig"=>$Grupo,"Puesto"=>$puesto);
		return $this->db->insert("usuario",$array);
	}
	//funcion para obtener los telefonos de un usuario
	public function getTelephones($usuario,$tip){
		$sql=$this->db->select('*')->where("IDUsuario='$usuario' and Tipo='$tip'")->get("telefonos");
		if($sql->num_rows===0){
			return false;
		}else{
			return $sql->result();
		}
	}
	public function addTelephones($dqtipo,$usuario,$telefono,$tipo){
		$array=array("IDUsuario"=>$usuario,"Telefono"=>$telefono,"DQTipo"=>$dqtipo,"Tipo"=>$tipo);
		$this->db->insert("telefonos",$array);
	}
	public function datTelefono($num,$tip){
		$sql=$this->db->select('*')->where("IDTelefono='$num' and Tipo='$tip'")->get("telefonos");
		if($sql->num_rows===0){
			return false;
		}else{
			return $sql->result();
		}
	}
	public function  UpdateTel($telefono,$dqtipo,$num){
		$array=array("Telefono"=>$telefono,"DQTipo"=>$dqtipo);
		$sql=$this->db->where("IDTelefono='$num'")->update("telefonos",$array);
	}
	public function  DelTel($num){
		$sql=$this->db->where("IDTelefono='$num'")->delete("telefonos");
	}
	//funciones para los usuarios
	public function searchuser($num){
		$sql=$this->db->select("*")->where("Usuario='$num'")->get("usuario");
		if($sql->num_rows===0){
			return false;
		}else{
			return $sql->result();
		}
	}
	public function DatosUsuario($num){
		$sql=$this->db->select("*")->where("IDUsuario='$num'")->get("usuario");
		if($sql->num_rows===0){
			return false;
		}else{
			return $sql->result();
		}
	}
	public function DatosUsuarious($num,$empresa){
		$sql=$this->db->select("*")->where("Usuario='$num' and IDEmpresa='$empresa'")->get("usuario");
		if($sql->num_rows===0){
			return false;
		}else{
			return $sql->result()[0];
		}
	}
	Public function UpdateUs($num,$Nombre,$Apellidos,$usuario,$Puesto,$correo,$Grupo){
		$array=array("Nombre"=>$Nombre,"Apellidos"=>$Apellidos,"Usuario"=>limpia_espacios($usuario),"Puesto"=>$Puesto,"Correo"=>$correo,"IDConfig"=>$Grupo);
		$this->db->where("IDUsuario='$num'")->update("usuario",$array);
	}
	Public function UpdateUssg($num,$Nombre,$Apellidos,$Puesto,$correo){
		$array=array("Nombre"=>$Nombre,"Apellidos"=>$Apellidos,"Puesto"=>$Puesto,"Correo"=>$correo);
		return  $this->db->where("IDUsuario='$num'")->update("usuario",$array);

	}
	Public function delUsuario($num){
		$sql=$this->db->where("IDUsuario='$num'")->delete("usuario");
	}
	public function addaccions($us,$fun){
		$array=array("funciones"=>json_encode($fun));
		$this->db->where("IDUsuario='$us'")->update("usuario",$array);
	}
	//funcion para cambiar la contraseña de un usuario desde la app
	public function uppclaveapp($us,$clave){
		$arr=array("Clave"=>$clave);
		$this->db->where("IDUsuario='$us'")->update("usuario",$arr);
	}
}