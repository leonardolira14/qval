<?php 

/**
* 
*/
class Model_Clientes extends CI_Model
{
	
	function __construct()
	{
			$this->load->database();
			$this->constante="FpgH456Gtdgh43i349gjsjf%ttt";
			$this->load->helper("ayuda");
	}
	//funcion para obtener los clientes de una empresa
	public function getClientes($empresa,$estado){
		$sql=$this->db->select("*")->where("IDEmpresa='$empresa' and Estado='$estado'")->get("clientes");
		if($sql->num_rows()===0){
			return false;
		}else{
			return $sql->result();
		}
	}
	//filas de los clienetes
	public function filas($empresa,$estado)
	{
		$sql=$this->db->where("IDEmpresa='$empresa' and Estado='$estado'")->get('clientes');
		return $sql->num_rows();
	}
	public function total_paginados($empresa,$por_pagina,$segmento,$estado){
		$consulta = $this->db->where("IDEmpresa='$empresa' and Estado='$estado'")->order_by("IDCliente","DESC")->get('clientes',$por_pagina,$segmento);
		if($consulta->num_rows()>0)
        {
            foreach($consulta->result() as $fila){
            	$data[] = $fila;
            }
             return $data;
        }
	}
	//funcion para agregar un cliente 
	public function AddCliente($Tipocontribuyente,$empresa,$rz,$nombrecomer,$rfc,$IDConfig,$Pais,$Estado,$muicipio,$calle,$Apellido,$Puesto,$correo,$tel){
		$sql=$this->db->select('*')->where("IDEmpresa='$empresa' and NombreComercial='$nombrecomer' and RFC='$rfc' and Nombre='$rz'")->get('clientes');
		if($sql->num_rows!=0){
			exit();
		}
		$usuario=md5(substr($rz,3).substr($nombrecomer,3).date('dm'));
		$array=array("IDEmpresa"=>$empresa,"Nombre"=>$rz,"RFC"=>$rfc,"Usuario"=>$usuario,"Pais"=>$Pais,"Municipio"=>$muicipio,"Direccion"=>$calle,"Puesto"=>$Puesto,"Tel"=>$tel,"EEstado"=>$Estado,"Clave"=>"","Correo"=>$correo,"Actipass"=>1,"IDConfig"=>$IDConfig,"Estado"=>1,"NombreComercial"=>$nombrecomer,"TPersona"=>$Tipocontribuyente,"Apellidos"=>$Apellido);
		$sql=$this->db->insert("clientes",$array);
		return $sql;
	}
	public function addexpress($Tipocontribuyente,$empresa,$rz,$correo,$IDConfig){
		$usuario=substr($rz,3).substr($Tipocontribuyente,3).date('d-m');
		$array=array("Nombre"=>$rz,"Usuario"=>$usuario,"Correo"=>$correo,"Actipass"=>1,"IDConfig"=>$IDConfig,"Estado"=>1,"TPersona"=>$Tipocontribuyente);
		$sql=$this->db->insert("clientes",$array);
		return $usuario;
	}
	//funcion para ller los datos de un clientee
	public function ReadClie($num){
		$sql=$this->db->select("*")->where("IDCliente='$num'")->get("clientes");
		return $sql->result();
	}
	public function ReadClieusu($num,$empresa){
		$sql=$this->db->select("*")->where("Usuario='$num' and IDEmpresa='$empresa'")->get("clientes");
		return $sql->result()[0];
	}
	Public function updateCliente($num,$Tipocontribuyente,$rz,$nombrecomer,$rfc,$IDConfig,$Pais,$Estado,$muicipio,$calle,$Apellido,$Puesto,$correo,$tel){
		$array=array("Nombre"=>$rz,"RFC"=>$rfc,"Pais"=>$Pais,"Municipio"=>$muicipio,"Direccion"=>$calle,"Puesto"=>$Puesto,"Tel"=>$tel,"EEstado"=>$Estado,"Clave"=>"","Correo"=>$correo,"Actipass"=>1,"IDConfig"=>$IDConfig,"Estado"=>1,"NombreComercial"=>$nombrecomer,"TPersona"=>$Tipocontribuyente,"Apellidos"=>$Apellido);
		$sql=$this->db->where("IDCliente='$num'")->update("clientes",$array);
		return $sql;

	}
	Public function DelCliente($num){
		$array=array("Estado"=>0);
		$sql=$this->db->where("IDCliente='$num'")->update("clientes",$array);
		return $sql;
	}
	//actualizar password de cliente 
	public function uppclaveapp($num,$clave){
		$arr=array("Clave"=>$clave);
		$this->db->where("IDCliente='$num'")->update("clientes",$arr);
	}

}
