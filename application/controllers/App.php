<?php
header('Access-Control-Allow-Origin: *');
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class App extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model("Model_Clientes");
        $this->load->model("Model_Usuarios");
        $this->load->model("Model_Cuestionarios");

	}
    public function realiza(){
        $datos=json_decode($_POST["datos"]);
        $bandera=false;
        //primero busco si el cliente que viene es valido
        $datclie=explode("|",$datos->cliente);
        if($datclie[0]==="E" || $datclie[0]==="I" ){
                $bandera=true;
        }else{
             $data["pass"]=0;
             $data["mensaje"]="Este Código no es valido";
        }
        //reviso la banderera
        if($bandera===true){
            //verifico si es interno o externo
            if($datclie[0]==="E" ){
                 $datcliente=$this->Model_Clientes->ReadClieusu($datclie[1],$datos->empresa);
                  $data["cliente"]=array("ID"=>$datcliente->IDCliente,"Clave"=>$datcliente->Clave,"Nombre"=>$datcliente->Nombre." ".$datcliente->Apellidos,"Usuario"=>$datcliente->Usuario,"TipoE"=>"E");
            }else if($datclie[0]==="I"){
                 $datcliente=$this->Model_Usuarios->DatosUsuarious($datclie[1],$datos->empresa);
                 $data["cliente"]=array("ID"=>$datcliente->IDUsuario,"Clave"=>$datcliente->Clave,"Nombre"=>$datcliente->Nombre. " ".$datcliente->Apellidos,"Usuario"=>$datcliente->Usuario,"TipoE"=>"I");
            }
            //ahora busco una relacion de cuestionarios
            $dats_Cuest=$this->Model_Cuestionarios->relacion($datos->Configus,$datcliente->IDConfig,"I",$datclie[0]);
            if($dats_Cuest!=false){
             //ahora busco coloco las preguntas
                $data["DCuestionario"]=$dats_Cuest;
                $data["cuestionario"]=$this->Model_Cuestionarios->CuestionarioApp($dats_Cuest->Cuestionario);
                 $data["pass"]=1;              
            }else{
             $data["pass"]=0;
             $data["mensaje"]="Sin relación con este cliente.";
            }
          
        }
         echo json_encode($data);
    }
    public function recibe(){
        $datos=json_decode($_POST["datos"]);

        $bandera=false;
        //primero busco si el cliente que viene es valido
        $datclie=explode("|",$datos->cliente);
        if($datclie[0]==="E" || $datclie[0]==="I" ){
                $bandera=true;
        }else{
             $data["pass"]=0;
             $data["mensaje"]="Este Código no es valido";
        }
        //reviso la banderera
        if($bandera===true){
            //verifico si es interno o externo
            if($datclie[0]==="E" ){
                 $datcliente=$this->Model_Clientes->ReadClieusu($datclie[1],$datos->empresa);
                  $data["cliente"]=array("ID"=>$datcliente->IDCliente,"Clave"=>$datcliente->Clave,"Nombre"=>$datcliente->Nombre." ".$datcliente->Apellidos,"Usuario"=>$datcliente->Usuario,"TipoE"=>"E");
                  
            }else if($datclie[0]==="I"){
                 $datcliente=$this->Model_Usuarios->DatosUsuarious($datclie[1],$datos->empresa);
                 $data["cliente"]=array("ID"=>$datcliente->IDUsuario,"Clave"=>$datcliente->Clave,"Nombre"=>$datcliente->Nombre. " ".$datcliente->Apellidos,"Usuario"=>$datcliente->Usuario,"TipoE"=>"I");
                 
            }
            //ahora busco una relacion de cuestionarios
            $dats_Cuest=$this->Model_Cuestionarios->relacion($datcliente->IDConfig,$datos->Configus,$datclie[0],"I");
            if($dats_Cuest!=false){
             //ahora busco coloco las preguntas
                $data["DCuestionario"]=$dats_Cuest;
                $data["cuestionario"]=$this->Model_Cuestionarios->CuestionarioApp($dats_Cuest->Cuestionario);  
                $data["pass"]=1;            
            }else{
             $data["pass"]=0;
             $data["mensaje"]="Sin relación con este cliente.";
            }
          
        }
         echo json_encode($data);
    }
    public function actclaveus(){
         $datos=json_decode($_POST["datos"]);
         $this->Model_Usuarios->uppclaveapp($datos->ID,$datos->clave);
         $dats=$this->Model_Usuarios->DatosUsuario($datos->ID);
         $data["datosU"]=$dats;
         echo json_encode($data);
    }
}