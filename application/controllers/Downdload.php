<?php
/**
* clase para subir los archivos
*/
class Downdload extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("Model_Usuarios");
		$this->load->model("Model_Clientes");
		$this->load->model("Model_Empresa");
	}
	public function uplogo(){
		if($this->input->is_ajax_request()){
			$empresa=$this->input->post("empresa");
			$config=[
				"upload_path"=>'./assets/img/logosEmpresa',
				"allowed_types"=>"jpg|PNG|png|JPG|JPEG|jpeg",
				"overwrite"=>true
			];
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload("log-img")) {
				$data['pass']=0;
	            $data['mensaje'] = $this->upload->display_errors();
	        }else{
	        	$dat= array("upload_data"=>$this->upload->data());
	        	$this->Model_Empresa->updatelogo($empresa,$dat["upload_data"]["file_name"]);
	        	$data['pass']=1;
	        }
		}
        echo json_encode($data);
	}
	public function upusuarios(){
		if($this->input->is_ajax_request()){
			$empresa=$this->input->post("empresa");
			$config=[
				"upload_path"=>'./assets/plantillas/uparchivos',
				"allowed_types"=>"csv",
				"overwrite"=>true
			];
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload("usuexpres")) {
				$data['pass']=0;
	            $data['mensaje'] = $this->upload->display_errors();
	        }else{
	        	
	        	$dat= array("upload_data"=>$this->upload->data());
	        	$fp = fopen(base_url()."/assets/plantillas/uparchivos/".$dat["upload_data"]["file_name"], "r");
	        	$cont=0;
	        	while(!feof($fp)) {
	        		$linea = fgets($fp);
	        		$datos=explode(",",$linea);
	        		if($cont!=0 && $linea!=false){
	        			$this->Model_Usuarios->AddUser($empresa,$datos[0],$datos[1],$datos[3],$datos[2],$datos[4],0);
	        		}
	        		$cont++;        		
	        	}
	        	$cont=$cont-1;
	        	$data['pass']=1;
	        	$data['mensaje']="Total de registros actualizados ".$cont;
	        }
		}
        echo json_encode($data);
	}
	public function upclientes(){
		if($this->input->is_ajax_request()){
			$empresa=$this->input->post("empresa");
			$config=[
				"upload_path"=>'./assets/plantillas/uparchivos',
				"allowed_types"=>"csv",
				"overwrite"=>true
			];
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload("usuexpres")) {
				$data['pass']=0;
	            $data['mensaje'] = $this->upload->display_errors();
	        }else{
	        	
	        	$dat= array("upload_data"=>$this->upload->data());
	        	$fp = fopen(base_url()."/assets/plantillas/uparchivos/".$dat["upload_data"]["file_name"], "r");
	        	$cont=0;
	        	while(!feof($fp)) {
	        		$linea = fgets($fp);
	        		$datos=explode(",",$linea);
	        		if($cont!=0 && $linea!=false){
	        			$this->Model_Clientes->AddCliente($datos[9],$empresa,$datos[0],$datos[7],$datos[2],'0','','','',$datos[4],$datos[1],$datos[5],$datos[8],$datos[6]);
	        		}
	        		$cont++;        		
	        	}
	        	$cont=$cont-1;
	        	$data['pass']=1;
	        	$data['mensaje']="Total de registros actualizados ".$cont;
	        }
		}
        echo json_encode($data);
	}
}