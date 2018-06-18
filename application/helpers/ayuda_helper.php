<?php
function genenim($letras){
		$lt=str_split($letras);
		$inlt=array_reverse($lt);
		$nomenclatura=[];
		$bande=0;
		foreach ($inlt as $key => $value) {
			if($key===count($inlt)){

			}else if(($inlt[$key]==="Z") && ($key===0)){
				array_push($nomenclatura,"A");
				//array_push($nomenclatura,ponerletra($inlt[$key]));
			}else if($inlt[$key]==="Z"){
				array_push($nomenclatura,ponerletra($inlt[$key]));
			}else{
				$bande=$key;
				array_push($nomenclatura,ponerletra($inlt[$key]));
				break;
			}
			
		}
		for($bande;$bande<count($inlt)-1;$bande++){
			array_push($nomenclatura,$inlt[$bande+1]);
		}
		$no="";
		$nomenclatura=array_reverse($nomenclatura);
		foreach ($nomenclatura as $key ) {
			$no.= $key;
		}
		return $no;
}
function ponerletra($letra){
	$abc=["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
	if($letra==="Z"){
		return "A";
	}else{
		foreach ($abc as $key => $value) {
			if($letra===$abc[$key]){
				return $abc[$key+1];
			}
		}
	}
	
}
//generador de contraseñas
function RandomPass(){

	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 8; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
//quita los espacios en blanco
function limpia_espacios($cadena){
	$cadena = str_replace(' ', '', $cadena);
	return $cadena;
}
//convertir a cvs
function converter_cvs($array,$titulo,$cabezeras){
	$output=fopen("php://output", 'W')or die("Can't open php://output");
	 header('Content-Encoding: UTF-8');
    header('Content-Type: text/csv; charset=utf-8' );
	header("Content-Disposition:attachment;filename=".$titulo.".csv"); 
	 header('Content-Transfer-Encoding: binary');
	 fputs( $output, "\xEF\xBB\xBF" ); 
fputcsv($output, $cabezeras);
 
foreach($array as $pregunta) {
    fputcsv($output,$pregunta);
}
fclose($output) or die("Can't close php://output");
}
function calif_minutos($peso,$respuesta){
$dias=(int)$respuesta;
	$dias=1-(int)$dias/60;
	$peso=(float)$peso;
	$calificacion=$peso*$dias;
	return $calificacion;
}
function calif_horas($peso,$respuesta){
	$dias=(int)$respuesta;
	$dias=1-(int)$dias/24;
	$peso=(float)$peso;
	$calificacion=$peso*$dias;
	return $calificacion;
}
function calif_dias($peso,$respuesta){
$dias=(int)$respuesta;
	$dias=1-(int)$dias/30;
	$peso=(float)$peso;
	$calificacion=$peso*$dias;
	return $calificacion;
}
function formapreg($tipo,$id,$pregunta){
	$cade='<div class="col-12 form-group">'.$pregunta.'<div class="resp m-t-10 row">';
	switch($tipo){
			case "SI/NO":
				$cade.="<select class='form-control' id='".$id."'><option value=''>Selecciona Respuesta</option><option value='SI'>SI</option><option value='NO'>NO</option></select></div></div>";
				break;	
			case "SI/NO/NA":
				$cade.="<select class='form-control' id='".$id."'><option value=''>Selecciona Respuesta</option><option value='SI'>SI</option><option value='NO'>NO</option><option value='NA'>NA</option></select></div></div>";
			break;	
			case "SI/NO/NA/NS":
				$cade.="<select class='form-control' id='".$id."'><option value=''>Selecciona Respuesta</option><option value='SI'>SI</option><option value='NO'>NO</option><option value='NA'>NA</option><option value='NS'>NS</option></select></div></div>";
			break;
			case "SI/NO/NS":
				$cade.="<select class='form-control' id='".$id."'><option value=''>Selecciona Respuesta</option><option value='SI'>SI</option><option value='NO'>NO</option><option value='NS'>NS</option></select></div></div>";
			break;
			case "SI/NO/NT":
				$cade.="<select class='form-control' id='".$id."'><option value=''>Selecciona Respuesta</option><option value='SI'>SI</option><option value='NO'>NO</option><option value='NT'>No Tiene</option></select></div></div>";
			break;
			case "AB":
				$cade.="<input type='text' class='form-control' id='".$id."'/></div></div>";
			break;
			case "NUMERO";case "MINUTOS";case "HORAS"; case "DIAS":
				$cade.="<input type='number' class='form-control'  id='".$id."'/></div></div>";
			break;	
		}
		return $cade;
}
?>
