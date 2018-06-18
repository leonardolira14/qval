<?php
/**
* 
*/
class Model_Resultados extends CI_Model
{
	
	function __construct()
	{
		//parent::__construct();
		$this->load->database();
		$this->load->helper('ayuda_helper');
	}
	//function para saber de quien califica y quien recibe en un cuestionario
	public function GetReceptor_Emisor($numC){
		$get=$this->db->select("cuestionario.IDCuestionario,nombre,Status,PerfilCalifica,PerfilCalificado,TPEmisor,TPReceptor")->from("cuestionario")->join("detallecuestionario","detallecuestionario.IDCuestionario=cuestionario.IDCuestionario")->where("cuestionario.IDCuestionario='$numC'")->get();
		if($get->num_rows()==0)
		{
			return false;
		}else
		{
			$cuestion=[];
			foreach ($get->result() as $key) {
				array_push($cuestion,array("IDCuestionario"=>$key->IDCuestionario,"Nombre"=>$key->nombre,"Status"=>$key->Status,"Emisor"=>$this->nombreperfil($key->PerfilCalifica,$key->TPEmisor),"Receptor"=>$this->nombreperfil($key->PerfilCalificado,$key->TPReceptor)));
			}
			return $cuestion;
		}
	}
	//funcion para obtener el nombre del perfil para general
	public function nombreperfil($numero,$tipo){
		
			$sql=$this->db->select('Nombre')->where("IDGrupo='$numero' and Tipo='$tipo'")->get("grupos");
			return $sql->result()[0]->Nombre;
		
	}
	//funcion para obtener las suma de cada pregunta en los detalles
	public function sumapreg($numC){
		//primero obtengo el cuestionario
		$preguntas=[];
		$sql=$this->db->select("Cuestionario")->where("IDCuestionario='$numC'")->get("detallecuestionario");
		$cuestionario=explode(",",$sql->result()[0]->Cuestionario);
		//ahora tengo que ir cada una de las´preguntas y ver cual es cual
		foreach ($cuestionario as $pregunta) {
			array_push($preguntas,$this->tipoPregunta( $pregunta));
			
		};
		return $preguntas;
	}
	//saca que tipo y cuantas respuestas fueron
	public function tipoPregunta($nom){
		//primero obtengo el IDde la pregunta
		$sql=$this->db->select('*')->where("Nomenclatura='$nom'")->get("preguntas");
		$idpregunta=$sql->result()[0]->IDPregunta;
		$Forma=$sql->result()[0]->Forma;
		//obtengo el numero de veces que se ha realizso ese cuesttionario
		//ahora checo en detalles de calificiaciones para ver cuantas veces se ha respondido esa pregunta
		$data["Pregunta"]=$sql->result()[0]->Pregunta;
		$data["Forma"]=$sql->result()[0]->Forma;
		if($Forma==="SI/NO"){
			$data["labels"]=["SI","NO"];
			$data["backgroundColor"]=["#3e95cd","#8e5ea2"];
			
			$sql=$this->db->where("IDPregunta='$idpregunta' and  Respuesta='SI'")->from("detallecalificacion")->count_all_results();
			$si=$sql;
			$sql=$this->db->where("IDPregunta='$idpregunta' and  Respuesta='NO'")->from("detallecalificacion")->count_all_results();
			$no=$sql;
			$data["data"]=[$si,$no];
		}else if($Forma==="DIAS" || $Forma==="HORAS" || $Forma==="NUMERO"){
			//obtengo el numero maximo si tengo un 0 le ponemos 10 como minimo
			$sql=$this->db->select_max('Respuesta')->where("IDPregunta='$idpregunta'")->get("detallecalificacion");
			if($sql->result()[0]->Respuesta==="0"){
				$dias=10;
			}else{
				$dias=(int)$sql->result()[0]->Respuesta;
			}
			//ahora realizo el los labels
			$data["backgroundColor"]=["#3e95cd","#E00101","#E17706","#D0C30A","#37E50C","#3e95cd","#21253F","#11D853","#01FF8C","#CD0587","#A5CD07","#3e95cd","#1230F4","#7502F7"];
			$dat=[];
			$dattas=[];
			for($i=1;$i<=$dias;$i++){
				array_push($dat,$Forma." (".(string)$i.")");
				$sql=$this->db->where("IDPregunta='$idpregunta' and  Respuesta='$i'")->from("detallecalificacion")->count_all_results();
				array_push($dattas,$sql);
			}
			$data["data"]=$dattas;
			$data["labels"]=$dat;
		}

	return $data;
	}
	//funcion para saber el numero de veces que se realizo un cuestuonario
	public function numvescuest($numC){
			$sql=$this->db->where("IDCuestionario='$numC'")->from("tbcalificaciones")->count_all_results();
		return $sql;
	}
	//funcion para le resumen
	public function Resumen($numC){
		//verifico el cuantas veces se realizo ese cuestionario
	
		//primero obtengo el cuestionario
		$sql=$this->db->select("Cuestionario")->where("IDCuestionario='$numC'")->get("detallecuestionario");
		$cuestionario=explode(",",$sql->result()[0]->Cuestionario);
		//ahora tengo que ir obtenido los id de ese cuestionario
		$ncuest=[];
		foreach ($cuestionario as $pregunta) {
			$sql=$this->db->select('*')->where("Nomenclatura='$pregunta'")->get("preguntas");
			array_push($ncuest,array("ID"=>$sql->result()[0]->IDPregunta,"Pregunta"=>$sql->result()[0]->Pregunta,"RespuestaPos"=>$sql->result()[0]->Respuesta,"Forma"=>$sql->result()[0]->Forma));
		}
		//cuando ya tengo los el array de las preguntas de ese cuestionario verifico cuantas respuestas hubo buenas
		$nprea=[];
		foreach ($ncuest as $preg) {
			
			if($preg["Forma"]!="AB"){
				//obtengo el total de respuestas positivas
				$sql=$this->db->where("IDPregunta='".(int)$preg["ID"]."' and  Respuesta='".$preg["RespuestaPos"]."'")->from("detallecalificacion")->count_all_results();
				 //$preg["Trespuestaspos"]=$sql;				
				$preg["Trespuestaspos"]=$sql;
				//ahora el total de veces que se realizo esa pregunta
				$sql=$this->db->where("IDPregunta='".(int)$preg["ID"]."'")->from("detallecalificacion")->count_all_results();
				$preg["Trespuestas"]=$sql;

				
			}else{
				// si la pregunta es abierta solo verifico cuantas veses se realzo esa pregunta
				$sql=$this->db->where("IDPregunta='".(int)$preg["ID"]."'")->from("detallecalificacion")->count_all_results();
				$preg["Trespuestas"]=$sql;
				$preg["Trespuestaspos"]="NA";
			}
			array_push($nprea,$preg);
		}
		return $nprea;		
	}
	//ahora obtenemos los datos de detalles de cada pregunta 
	public function detalles($numC){
		$cuestionario=$this->ObtenerId($numC);
		//ahora tengo que obtener todas las veces que se ha realizado ese cuestionario
		$sql=$this->db->select("*")->where("IDCuestionario='$numC'")->get("tbcalificaciones");
		if($sql->num_rows()===0){
			return false;
		}else{
			$veces=$sql->result();
			// si ya  hay calificaciones con ese cuestionario empieso a llenar el array
			$resumen=[];
			foreach ($veces as $key) {
				foreach ($cuestionario as $pregunta) {
					$sql=$this->db->select("*")->where("IDValora='$key->IDCalificacion' and IDPregunta='".$pregunta["ID"]."'")->get("detallecalificacion");
					array_push($resumen,array("Fecha"=>$key->Fecha,"Emisor"=>$this->DatEmRe($key->IDEmisor,$key->TEmisor),"Receptor"=>$this->DatEmRe($key->IDReceptor,$key->TReceptor),"Pregunta"=>$pregunta["Pregunta"],"Respuesta"=>$sql->result()[0]->Respuesta,"Puntos"=>$sql->result()[0]->Calificacion)); 
				}
			}
			return $resumen;
		}

	}
	//funcion para obtener el nombre un emisor o receptor
	public function DatEmRe($id,$tp){
		if($tp=="E")
		{
			//si es externo tengo que buscar en la tabla de cientes
			$sql=$this->db->select("Nombre")->where("IDCliente='$id'")->get("clientes");
			return $sql->result()[0]->Nombre;
		}else if($tp=="I")
		{
			//si es interno tengo que buscar en la tabla de usuarios
			$sql=$this->db->select("Nombre")->where("IDUsuario='$id'")->get("usuario");
			return $sql->result()[0]->Nombre;
		}
	}

	//funcion para obtener un cuestionario y separarlo este me devuelve los datos de las preguntas en un array
	public function ObtenerId($numC){
		//primero obtengo el cuestionario
		$sql=$this->db->select("Cuestionario")->where("IDCuestionario='$numC'")->get("detallecuestionario");
		$cuestionario=explode(",",$sql->result()[0]->Cuestionario);
		$ncuest=[];
		foreach ($cuestionario as $pregunta) {
			$sql=$this->db->select('*')->where("Nomenclatura='$pregunta'")->get("preguntas");
			array_push($ncuest,array("ID"=>$sql->result()[0]->IDPregunta,"Pregunta"=>$sql->result()[0]->Pregunta,"Puntos"=>$sql->result()[0]->Peso,"RespuestaPos"=>$sql->result()[0]->Respuesta,"Forma"=>$sql->result()[0]->Forma));
		}
		return $ncuest;
	}
}