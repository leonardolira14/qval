<?php
/**
* 
*/
class Model_Calificaciones extends CI_Model
{
	
	function __construct()
	{
		//parent::__construct();
		$this->load->database();
		$this->load->helper('ayuda_helper');
	}
	public function DatPrege($num){
		$get=$this->db->select("*")->where("IDPregunta='$num'")->get("preguntas");
		if($get->num_rows()==0)
		{
			return false;
		}else
		{
			return $get->result()[0];
		}
	}
	public function adddetalle($IDValora,$IDPregunta,$Respuesta,$calificacion){
		$array=array("IDValora"=>$IDValora,"IDPregunta"=>$IDPregunta,"Respuesta"=>$Respuesta,"Calificacion"=>$calificacion);
		$this->db->insert("detallecalificacion",$array);
	}
	public function AddCalifapp($todas){
		$totalpuntos=0;
		$totalpuntosr=0;
		$totalp=0;
		foreach ($todas as $una) {
			//primero agrego los datos a la bd de las calificaciones
			$array=array("IDCuestionario"=>$una->IDCuestionario,"IDEmisor"=>$una->IDEmisor,"IDReceptor"=>$una->IDReceptor,"TEmisor"=>$una->TEmisor,"TReceptor"=>$una->TReceptor,"Calificacion"=>0);
			$this->db->insert("tbcalificaciones",$array);
			//obtengo el ultimo id
			$ultimoID=$this->db->select_max("IDCalificacion")->get("tbcalificaciones");
			$ultimoID=$ultimoID->result()[0]->IDCalificacion;
				//primero obtengo el total de puntos de ese cuestionario
		foreach($una->cuestionario as $line){
			$datos=$this->DatPrege($line->IDPregunta);
			 if($datos->Forma==="DIAS"){
			 	$peso=calif_dias($datos->Peso,$line->Respuesta);
			 	$totalpuntos=$totalpuntos+$peso;
			 	$totalpuntosr=$totalpuntosr+$datos->Peso;
			 	$totalp++;
			 	$this->adddetalle($ultimoID,$line->IDPregunta,$line->Respuesta,$peso);
			}else if($datos->Forma==="HORAS"){
				$peso=calif_horas($datos->Peso,$line->Respuesta);
			 	$totalpuntos=$totalpuntos+$peso;
			 	$totalpuntosr=$totalpuntosr+$datos->Peso;
			 	$this->adddetalle($ultimoID,$line->IDPregunta,$line->Respuesta,$peso);
			 	$totalp++;
			}else if($datos->Forma==="MINUTOS"){
				$peso=calif_minutos($datos->Peso,$line->Respuesta);
			 	$totalpuntos=$totalpuntos+$peso;
			 	$totalpuntosr=$totalpuntosr+$datos->Peso;
			 	$this->adddetalle($ultimoID,$line->IDPregunta,$line->Respuesta,$peso);
			 	$totalp++;
			}else if($datos->Forma==="AB"){
				$totalp++;
				if($datos->Respuesta===$line->Respuesta){
						$this->adddetalle($ultimoID,$line->IDPregunta,$line->Respuesta,$datos->Peso);
						$totalpuntos=$totalpuntos+$datos->Peso;
						$totalpuntosr=$totalpuntosr+$datos->Peso;
					}else{
						$this->adddetalle($ultimoID,$line->IDPregunta,$line->Respuesta,0);
					}	
			}else if($datos->Forma==="SI/NO" || $datos->Forma==="SI/NO/NT" || $datos->Forma==="SI/NO/NS" || $datos->Forma==="SI/NO/NA" || $datos->Forma==="NUMERO"){
					if($line->Respuesta!="NA" || $line->Respuesta!="NS" || $line->Respuesta!="NT" ){
						if($datos->Respuesta===$line->Respuesta){
						$this->adddetalle($ultimoID,$line->IDPregunta,$line->Respuesta,$datos->Peso);
						$totalpuntos=$totalpuntos+$datos->Peso;
						$totalpuntosr=$totalpuntosr+$datos->Peso;
					}else{
						$totalpuntosr=$totalpuntosr+$datos->Peso;
						$this->adddetalle($ultimoID,$line->IDPregunta,$line->Respuesta,0);
					}
					$totalp++;		
				}else{
					$this->adddetalle($ultimoID,$line->IDPregunta,$line->Respuesta,0);
					}	
				}	
			}//ya que termino el ciclo ahora tengo que cambiar la calificacion
			//la calificacion se toma total de puntos entre el numero de preguntas
			$prom=($totalpuntos*100)/$totalpuntosr;
			$prom=$prom/10;
			$this->db->where("IDCalificacion='$ultimoID'")->update("tbcalificaciones",array("Calificacion"=>number_format($prom,2)));		
		}		
	}
}
