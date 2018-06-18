<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Express extends CI_Controller
{
	
	function __construct()
	{
			parent::__construct();
			$this->load->model("Model_Perfiles");
			$this->load->helper("ayuda");
	}
	public function index(){
		$datos=json_decode($_POST["datos"]);
		$empresa=$datos->empresa;
		$data["grupos"]=$this->Model_Perfiles->GetPerfilSET($empresa,"E",1);
		$this->load->view('express/principal',$data);
	}
}