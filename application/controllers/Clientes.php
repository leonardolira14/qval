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
        $this->load->helper('url','security',"form");
        $this->load->library(['form_validation','pagination']);
       
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
				$palabra=$_GET["ser"];
			}
			
		}else{

			$datos=json_decode($_POST["datos"]);

			$empresa=$datos->empresa;
			$palabra=$datos->palabra;
		}

		$config['reuse_query_string'] = TRUE;
		$config['use_page_numbers'] = FALSE;
		$config['base_url'] = base_url().'clientes/index/'.$empresa."?ser=".$palabra;
		$config['query_string_segment'] = "page";
		$config['total_rows'] = $this->Model_Clientes->filas($empresa,1);
		$config['per_page'] = $pages;
		$config['num_links'] = 2;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config["uri_segment"] = (int)$start_index;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$this->pagination->initialize($config);
		
		$data["listclie"] = $this->Model_Clientes->total_paginados($palabra,$empresa,$config['per_page'],$start_index,1); 
		
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
		$config=array( array(
					'field'=>'Email', 
					'label'=>'Correo Electrónico', 
					'rules'=>'trim|required|valid_email|xss_clean|is_unique[clientes.Correo]'					
				),array(
					'field'=>'RZ', 
					'label'=>'Razón Social', 
					'rules'=>'required|xss_clean|is_unique[clientes.Nombre]'					
				),array(
					'field'=>'NC', 
					'label'=>'Nombre Comercial', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'TPersona', 
					'label'=>'Tipo Contribuyente', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'RFC', 
					'label'=>'RFC', 
					'rules'=>'required|xss_clean'					
				),array(
					'field'=>'Pais', 
					'label'=>'Pais', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'Estado', 
					'label'=>'Estado', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'Municipio', 
					'label'=>'Municipio', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'Direccion', 
					'label'=>'Direccion', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'Grupo', 
					'label'=>'Grupo', 
					'rules'=>'required|xss_clean'					
				),array(
					'field'=>'Apellidos', 
					'label'=>'Apellidos', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'Tel', 
					'label'=>'Telelefono', 
					'rules'=>'xss_clean'					
				));
		$this->form_validation->set_rules($config);
			$array=array("required"=>'El campo %s es obligatorio',"valid_email"=>'El campo %s no es valido',"min_length[3]"=>'El campo %s debe ser mayor a 3 Digitos',"min_length[10]"=>'El campo %s debe ser mayor a 10 Digitos','alpha'=>'El campo %s debe estar compuesto solo por letras',"matches"=>"Las contraseñas no coinciden",'is_unique'=>'El contenido del campo %s ya esta registrado');
		$this->form_validation->set_message($array);
		
		if($this->form_validation->run() !=false){
			
			$rz=$this->input->post("RZ");
			$nombrecomer=$this->input->post("NC");
			$rfc=$this->input->post("RFC");
			$muicipio=$this->input->post("Municipio");
			$calle=$this->input->post("Direccion");
			$Apellido=$this->input->post("Apellidos");
			$Puesto=$this->input->post("Puesto");
			$Tipocontribuyente=$this->input->post("TPersona");
			$Pais=$this->input->post("Pais");
			$Estado=$this->input->post("Estado");
			$IDConfig=$this->input->post("Grupo");
			$correo=$this->input->post("Email");
			$tel=$this->input->post("Tel");
			$empresa=$this->input->post("empresa");
			$sql=$this->Model_Clientes->AddCliente($Tipocontribuyente,$empresa,$rz,$nombrecomer,$rfc,$IDConfig,$Pais,$Estado,$muicipio,$calle,$Apellido,$Puesto,$correo,$tel);
			$dat["pass"]=1;
			$dat["Mensaje"]=$sql;
		}else{
			$dat["pass"]=0;
			$dat["mensaje"]=validation_errors();
		}
	  	echo json_encode($dat);		
		exit();
		
		
	}
	public function readClie(){
		$datos=json_decode($_POST["datos"]);
		$get["datos"]=$this->Model_Clientes->ReadClie($datos->numc);
		echo json_encode($get);
	}
	public function ModCliente(){
		$config=array( array(
					'field'=>'Email', 
					'label'=>'Correo Electrónico', 
					'rules'=>'trim|required|valid_email|xss_clean'					
				),array(
					'field'=>'RZ', 
					'label'=>'Razón Social', 
					'rules'=>'required|xss_clean'					
				),array(
					'field'=>'NC', 
					'label'=>'Nombre Comercial', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'TPersona', 
					'label'=>'Tipo Contribuyente', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'RFC', 
					'label'=>'RFC', 
					'rules'=>'required|xss_clean'					
				),array(
					'field'=>'Pais', 
					'label'=>'Pais', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'Estado', 
					'label'=>'Estado', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'Municipio', 
					'label'=>'Municipio', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'Direccion', 
					'label'=>'Direccion', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'Grupo', 
					'label'=>'Grupo', 
					'rules'=>'required|xss_clean'					
				),array(
					'field'=>'Apellidos', 
					'label'=>'Apellidos', 
					'rules'=>'xss_clean'					
				),array(
					'field'=>'Tel', 
					'label'=>'Telelefono', 
					'rules'=>'xss_clean'					
				));
		$this->form_validation->set_rules($config);
			$array=array("required"=>'El campo %s es obligatorio',"valid_email"=>'El campo %s no es valido',"min_length[3]"=>'El campo %s debe ser mayor a 3 Digitos',"min_length[10]"=>'El campo %s debe ser mayor a 10 Digitos','alpha'=>'El campo %s debe estar compuesto solo por letras',"matches"=>"Las contraseñas no coinciden",'is_unique'=>'El contenido del campo %s ya esta registrado');
		$this->form_validation->set_message($array);
		
		if($this->form_validation->run() !=false){
			
			$rz=$this->input->post("RZ");
			$nombrecomer=$this->input->post("NC");
			$rfc=$this->input->post("RFC");
			$muicipio=$this->input->post("Municipio");
			$calle=$this->input->post("Direccion");
			$Apellido=$this->input->post("Apellidos");
			$Puesto=$this->input->post("Puesto");
			$Tipocontribuyente=$this->input->post("TPersona");
			$Pais=$this->input->post("Pais");
			$Estado=$this->input->post("Estado");
			$IDConfig=$this->input->post("Grupo");
			$correo=$this->input->post("Email");
			$tel=$this->input->post("Tel");
			$cliente=$this->input->post("cliente");
		$sql=$this->Model_Clientes->updateCliente($cliente,$Tipocontribuyente,$rz,$nombrecomer,$rfc,$IDConfig,$Pais,$Estado,$muicipio,$calle,$Apellido,$Puesto,$correo,$tel);
		$dat["pass"]=1;
			$dat["Mensaje"]=$sql;
		}else{
			$dat["pass"]=0;
			$dat["mensaje"]=validation_errors();
		}
	  	echo json_encode($dat);	
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
