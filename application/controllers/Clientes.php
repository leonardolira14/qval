<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Clientes extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model("Model_Clientes");
        $this->load->model("Model_Ayudas");
        $this->load->model("Model_Perfiles");
        $this->load->library('form_validation');
        $this->load->library('pagination');
         $this->load->helper('url');
	}

	Public function index()
	{	$pages=5;
		$start_index=0;
		if(!isset($_POST["datos"])){
			$empresa=$this->uri->segment(3);
			if(!isset($_GET["page"])){
				$start_index=0;
			}else{
				$start_index =$_GET["page"];
			}
			
		}else{

			$datos=json_decode($_POST["datos"]);

			$empresa=$datos->empresa;
		}
		$config['base_url'] = base_url().'clientes/index/'.$empresa;
		$config['query_string_segment'] = "page";
		$config['total_rows'] = $this->Model_Clientes->filas($empresa,1);
		$config['per_page'] = $pages;
		$config['num_links'] = 3;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config["uri_segment"] = $start_index;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$this->pagination->initialize($config);
		
		$data["listclie"] = $this->Model_Clientes->total_paginados($empresa,$config['per_page'],$start_index,1); 
		$data["links"]=$this->pagination->create_links();
		$data2["grupos"]=$this->Model_Perfiles->GetPerfilSET($empresa,"E",1);
		$data2["pais"]=$this->Model_Ayudas->GetPaises();
		$data["muni"]=$this->Model_Ayudas->GetEstado(42);
		$data["empresa"]=$empresa;
		$this->load->view('clientes/principal',$data);
		$this->load->view('clientes/modals/mensajes',$data2);
	}
	Public function estados()
	{	
		$datos=json_decode($_POST["datos"]);
		$data["pais"]=$this->Model_Ayudas->GetEstado($datos->pais);
		echo json_encode($data);
	}
	Public function addCliente(){
		if(isset($_POST["datos"])){
		$datos=json_decode($_POST["datos"]);
		$rz=$datos->data->RazonSocial;
		$nombrecomer=$datos->data->NombreComercial;
		$rfc=$datos->data->RFC;
		$muicipio=$datos->data->Municipio;
		$calle=$datos->data->Calle;
		$Apellido=$datos->data->Apellido;
		$Puesto=$datos->data->Puesto;
		$Tipocontribuyente=$datos->data->Tipocontribuyente;
		$Pais=$datos->data->Pais;
		$Estado=$datos->data->Estado;
		$IDConfig=$datos->data->Grupo;
		$correo=$datos->data->Email;
		$tel=$datos->data->Telefono;
		$sql=$this->Model_Clientes->AddCliente($Tipocontribuyente,$datos->empresa,$rz,$nombrecomer,$rfc,$IDConfig,$Pais,$Estado,$muicipio,$calle,$Apellido,$Puesto,$correo,$tel);
		$data["pass"]=1;
		$data["Mensaje"]=$sql;
		echo json_encode($data);
		}
	}
	public function readClie(){
		$datos=json_decode($_POST["datos"]);
		$get["datos"]=$this->Model_Clientes->ReadClie($datos->numc);
		echo json_encode($get);
	}
	public function ModCliente(){
		$datos=json_decode($_POST["datos"]);
		$rz=$datos->data->RazonSocial;
		$nombrecomer=$datos->data->NombreComercial;
		$rfc=$datos->data->RFC;
		$muicipio=$datos->data->Municipio;
		$calle=$datos->data->Calle;
		$Apellido=$datos->data->Apellido;
		$Puesto=$datos->data->Puesto;
		$Tipocontribuyente=$datos->data->Tipocontribuyente;
		$Pais=$datos->data->Pais;
		$Estado=$datos->data->Estado;
		$IDConfig=$datos->data->Grupo;
		$correo=$datos->data->Email;
		$tel=$datos->data->Telefono;
		$cliente=$datos->numc;
		$sql=$this->Model_Clientes->updateCliente($cliente,$Tipocontribuyente,$rz,$nombrecomer,$rfc,$IDConfig,$Pais,$Estado,$muicipio,$calle,$Apellido,$Puesto,$correo,$tel);
		$data["pass"]=1;
		$data["Mensaje"]=$sql;
		echo json_encode($data);
	}
	public function DelCliente(){
		$datos=json_decode($_POST["datos"]);
		$sql=$this->Model_Clientes->DelCliente($datos->numc);
		$data["pass"]=1;
		$data["Mensaje"]=$sql;
		echo json_encode($data);
	}
	public function cvs_export(){
		$usuarios=[];
		$datos=$_GET["num"];
		$array=$this->Model_Clientes->getClientes($datos,1);
		foreach ($array as $usuario) {
			array_push($usuarios,array("Razon Social"=>$usuario->Nombre,"NombreComercial"=>$usuario->NombreComercial,"RFC"=>$usuario->RFC,"Usuario"=>$usuario->Usuario,"Correo"=>$usuario->Correo));
		}
		$titulos=array("Razon Social","Nombre Comercial","RFC","Usuario","Correo");
		converter_cvs($usuarios,"ClientesQval",$titulos);
	}
	
	public function JSon_export(){
		$datos=json_decode($_POST["datos"]);
		$array=$this->Model_Clientes->getClientes($datos->num,1);
		$usuarios=[];
		foreach ($array as $usuario) {
			array_push($usuarios,array("Razon Social"=>$usuario->Nombre,"NombreComercial"=>$usuario->NombreComercial,"RFC"=>$usuario->RFC,"Usuario"=>$usuario->Usuario,"Correo"=>$usuario->Correo));
		}
		$data["Clientes"]=$usuarios;
		echo json_encode($data);
	}
	public function cargaexpress(){
		$datos=json_decode($_POST["datos"]);
		$data["usuario"]=$this->Model_Clientes->addexpress($datos->data->TipoContribuyente,$datos->empresa,$datos->data->RazonSocial,$datos->data->Email,$datos->data->Grupo);
		echo json_encode($data);
	}

}
