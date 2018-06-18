<?php
header('Access-Control-Allow-Origin: *');
/**
* 
*/
class Cuestionario extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Model_Cuestionarios");
		$this->load->model("Model_Perfiles");
		$this->load->model("Model_Calificaciones");
		$this->load->model("Model_Clientes");
		$this->load->model("Model_Usuarios");
	}
	public function index()
	{
		$datos=json_decode($_POST["datos"]);
		$data["cuestionarios"]=$this->Model_Cuestionarios->getCuestionariosHome($datos->empresa,1);
		$data["preguntas"]=$this->Model_Cuestionarios->getPreguntas($datos->empresa,1);
		$data["preguntast"]=$this->Model_Cuestionarios->getPreguntas($datos->empresa,3);
		$data["perfiles"]=$this->Model_Perfiles->GetPerfiles($datos->empresa,1);
		$data["preguntasqval"]=$this->Model_Cuestionarios->GetPreguntasqval();
		$this->load->view("cuestionarios/principal",$data);
	}
	public function getcuestion()
	{
		$datos=json_decode($_POST["datos"]);
		$data["cuestionarios"]=$this->Model_Cuestionarios->getCuestionarios($datos->Empresa,1);
		echo json_encode($data);
	}
	public  function addcues(){
		$datos=json_decode($_POST["datos"]);
		if($datos->tp==="m")
		{
			//para guardar configuracion nueva del cuestionario
			$get=$this->Model_Cuestionarios->Modicuestion($datos->num,$datos->Nombre,$datos->email,$datos->wats);
			$res=$this->Model_Cuestionarios->ModDetallesCues($datos->num,$datos->cuestionario,$datos->emisor,$datos->receptor);
			if($res===true){
				$data["pass"]="1";
				$data["Mensaje"]="paso";
			
			}else
			{
				$data["pass"]="0";
				$data["Mensaje"]="algo paso";
			}

		}else
		{
			//saber si la configuracion ya existe para no tener dobles
			$che=$this->Model_Cuestionarios->checkconfig($datos->empresa,$datos->emisor,$datos->receptor);
			if($che===false){
				$get=$this->Model_Cuestionarios->addCuestionario($datos->Nombre,$datos->empresa,$datos->email,$datos->wats);
				$res=$this->Model_Cuestionarios->adddetallescues($get,$datos->cuestionario,$datos->emisor,$datos->receptor);
			if($res===true){
				$data["pass"]="1";
				$data["Mensaje"]="paso";
			}
			}else
			{
				$data["pass"]="0";
				$data["Mensaje"]="Ya existe un cuestionario para estos grupos.";
			}
		}
		
		
		echo json_encode($data);
		
	}
	public function addPreg()
	{
		$datos=json_decode($_POST["datos"]);
		$get=$this->Model_Cuestionarios->AddPrg($datos->pregunta,$datos->forma,$datos->frecuencia,$datos->puntos,$datos->respuesta,"1",$datos->empresa);
		if($get===true){
			$data["pass"]="1";
			$data["Mensaje"]="ok";
		}else
		{
			$data["pass"]="0";
			$data["Mensaje"]=$get;
		}
		echo json_encode($data);
	}
	public function oppreg(){
		$datos=json_decode($_POST["datos"]);
		switch($datos->tip){
			case "del":
				$this->Model_Cuestionarios->ChegPreges($datos->num,0);
				break;
			case "alt":
				$this->Model_Cuestionarios->ChegPreges($datos->num,1);
				break;
			case "mod":
				$data["datos"]=$this->Model_Cuestionarios->DatPrege($datos->num);
				break;
			case "modDat":
				$data["datos"]=$this->Model_Cuestionarios->updateDatPreg($datos->num,$datos->pregunta,$datos->forma,$datos->frecuencia,$datos->puntos,$datos->respuesta);
		}
		$data["pass"]="1";
		echo json_encode($data);
	}
	//datos de pregunta de qval
	public function oppregqval()
	{
		$datos=json_decode($_POST["datos"]);
		
		switch($datos->tip){
			case "dat":
				$data["datos"]=$this->Model_Cuestionarios->DatosPregqval($datos->num);
				break;
		}
		echo json_encode($data);

	}
	//funcion para traer los datos de un cuestionario con un id
	public function OprCues(){
		$datos=json_decode($_POST["datos"]);
		switch ($datos->tip) {
			case 'mod':
				$data['Mensaje']=$this->Model_Cuestionarios->DatConf($datos->num);
				break;
			case 'asigpr':
				$data["Mensaje"]=$this->Model_Cuestionarios->Dcuestionario($datos->num);
				break;
			case 'ModCues':
				$data["Mensaje"]=$this->Model_Cuestionarios->AddCuesT($datos->num,$datos->cues);
		}
		echo json_encode($data);
	}
	//funciones para la app
	public function updata(){
		$datos=json_decode($_POST["datos"]);
		$de=$this->Model_Calificaciones->AddCalifapp($datos->calificaciones);
		foreach ($datos->clientes as $cliente) {
			if($cliente->TipoE==="E"){
				$this->Model_Clientes->uppclaveapp($cliente->ID,$cliente->Clave);
			}else{
				$this->Model_Usuarios->uppclaveapp($cliente->ID,$cliente->Clave);
			}
		}
		$data["pass"]="ok";
		echo json_encode($data);
	}
}