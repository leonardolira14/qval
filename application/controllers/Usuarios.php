<?php
header('Access-Control-Allow-Origin: *');
/**
* defined('BASEPATH') OR exit('No direct script access allowed');
*/
class Usuarios extends CI_Controller
{
	 function __construct(){
		parent::__construct();
        $this->load->model("Model_Usuarios");
        $this->load->model("Model_Perfiles");
        $this->load->model("Model_Cuestionarios");
         $this->load->helper("ayuda");
    }
	
	public function index()
	{
		$ped=[];
		$datos=json_decode($_POST["datos"]);
		$data["usuarios"]=$this->Model_Usuarios->getallUsuarios($datos->empresa);
		$pf=$this->Model_Perfiles->GetPerfiles($datos->empresa,'1');
		if($pf!=false){
			foreach ($pf as $key) {
			if($key->Tipo==="I"){
				array_push($ped,array('num' =>$key->IDGrupo ,'Nombre'=>$key->Nombre));
			}
			
		}
		}
		
		$data["perfiles"]=$ped;
		$data["empresa"]=$datos->empresa;
		$this->load->view('usuarios/principal',$data);
	}
	public function optionuser(){
		$datos=json_decode($_POST["datos"]);
		switch ($datos->tip) {
			case 'adduser':
				$gen=$this->Model_Usuarios->AddUser($datos->empresa,$datos->data->Nombre,$datos->data->Apellidos,$datos->data->Usuario,$datos->data->Puesto,$datos->data->Email,$datos->data->Grupo);
				$data["pass"]="1";
				$data["Mensaje"]=$gen;
				break;
			
			case 'telphones':
				$data["telepones"]=$this->Model_Usuarios->getTelephones($datos->usuario,$datos->tipo);
				break;
			case 'add-tel':
				
				$this->Model_Usuarios->addTelephones($datos->DQTipo,$datos->usuario,$datos->data->Telefono,$datos->tipo);
				$data["telepones"]=$this->Model_Usuarios->getTelephones($datos->usuario,"I");
			 	$data["pass"]=1;
			 	break;
			case 'dat-tel':
				$data["Mensaje"]=$this->Model_Usuarios->datTelefono($datos->num,$datos->tipo);
				break;
			case 'update-tel':
				$this->Model_Usuarios->UpdateTel($datos->data->Telefono,$datos->DQTipo,$datos->num);
				$data["telepones"]=$this->Model_Usuarios->getTelephones($datos->usuario,"I");
				break;
			case "del-tel":
				$this->Model_Usuarios->DelTel($datos->num);
				$data["telepones"]=$this->Model_Usuarios->getTelephones($datos->usuario,"I");
				break;
			case "Dat-us":
				$data["datosU"]=$this->Model_Usuarios->DatosUsuario($datos->num);
				break;
			case "searchus":
				$data["datosU"]=$this->Model_Usuarios->searchuser($datos->num);
				break;
			case "update":
			
			$this->Model_Usuarios->UpdateUs($datos->usuario,$datos->data->Nombre,$datos->data->Apellidos,$datos->data->Usuario,$datos->data->Puesto,$datos->data->Email,$datos->Grupo);
			$data["pass"]=1;
				break;
			case "Del":
			$data["pass"]=1;
				$this->Model_Usuarios->delUsuario($datos->usuario);
				break;
		}
		echo json_encode($data);
		
	}
	public function cvs_export(){
		$usuarios=[];
		$datos=$_GET["num"];
		$array=$this->Model_Usuarios->getallUsuarios($datos);
		foreach ($array as $usuario) {
			array_push($usuarios,array("Nombre"=>$usuario->Nombre,"Apellidos"=>$usuario->Apellidos,"Puesto"=>$usuario->Puesto,"Usuario"=>$usuario->Usuario,"Correo"=>$usuario->Correo));
		}
		$titulos=array("Nombre","Apellidos","Puesto","Usuario","Correo");
		converter_cvs($usuarios,"UsuariosQval",$titulos);
	}
	
	public function JSon_export(){
		$datos=json_decode($_POST["datos"]);
		$array=$this->Model_Usuarios->getallUsuarios($datos->num);
		$usuarios=[];
		foreach ($array as $usuario) {
			array_push($usuarios,array("Nombre"=>$usuario->Nombre,"Apellidos"=>$usuario->Apellidos,"Puesto"=>$usuario->Puesto,"Usuario"=>$usuario->Usuario,"Correo"=>$usuario->Correo));
		}
		$data["Usuarios"]=$usuarios;
		echo json_encode($data);
	}
	//funcion para activar el modo offline de app
	public function offline(){
		$datos=json_decode($_POST["datos"]);
		$data["detallecuestionario"]=$this->Model_Cuestionarios->offdetalles($datos->Config);
		$data["preguntas"]=$this->Model_Cuestionarios->offpreguntas($data["detallecuestionario"]);
		$data["clientes"]=$this->Model_Cuestionarios->offusacalif($datos->Config,$datos->Empresa);
		echo json_encode($data);
	}
	public function addaccions(){
		$datos=json_decode($_POST["datos"]);
		$this->Model_Usuarios->addaccions($datos->num,$datos->funciones);
		$data["pass"]=1;
		echo json_encode($data);
	}
}