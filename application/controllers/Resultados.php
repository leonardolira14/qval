<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Resultados extends CI_Controller
{
	
	function __construct()
	{
			parent::__construct();
			$this->load->model("Model_Cuestionarios");
			$this->load->model("Model_Resultados");
			$this->load->helper("ayuda");
	}
	Public function index()
	{

		$this->load->view('resultados/principal');
		$this->load->view('resultados/modal/modals');
	}
	//muestra los cuestionarios segun el estatus que manden
	public function MuestraCues(){
		$datos=json_decode($_POST["datos"]);
		$data["cuestionarios"]=$this->Model_Cuestionarios->getCuestionarios($datos->empresa,$datos->estatus);
		echo json_encode($data);
	}
	public function Resumen(){
		$datos=json_decode($_POST["datos"]);
		$data["perfiles"]=$this->Model_Resultados->GetReceptor_Emisor($datos->numC);
		$data["graficos"]=$this->Model_Resultados->sumapreg($datos->numC);
		$data["Resumen"]=$this->Model_Resultados->Resumen($datos->numC);
		$data["detalles"]=$this->Model_Resultados->detalles($datos->numC);
		$data["numerodeveces"]=$this->Model_Resultados->numvescuest($datos->numC);
		echo json_encode($data);
	}
	public function detalles_cvs(){
		$datos=$_GET["num"];
		$titulos=array("Fecha","Emisor","Receptor","Pregunta","Respuesta","Calificación");
		$array=$this->Model_Resultados->detalles($datos);
		converter_cvs($array,"DetalleQval",$titulos);
	}
	public function resumen_cvs(){
		$datos=$_GET["num"];
		$titulos=array("No.Pregunta","Pregunta","Respuesta Positiva","Forma","No.Respuestas Positivas","No. de Respuestas");
		$array=$this->Model_Resultados->Resumen($datos);
		converter_cvs($array,"ResumenQval",$titulos);
	}
}