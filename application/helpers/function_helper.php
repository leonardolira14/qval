<?if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists("_compracion"))
{
		function _comparacion($numero1,$numero2)
		{
			if($numero1===$numero2){
				return 1;
			}else if($numero1>$numero2){
				return 2;
			}elseif($numero1<$numero2){
				return 3;
			}
		}

}
if(!function_exists("_media_puntos"))
{
	function _media_puntos($_puntos_obtenidos,$_puntos_posibles){
		
		if($_puntos_obtenidos===0 && $_puntos_posibles===0){
			$num=0;
		}else{
			$num=round(($_puntos_obtenidos/$_puntos_posibles)*10,2);
		}

		if($num===0){
				$_data["class"]="text-blue";
		}else if($num>0){
				$_data["class"]="text-success";
		}else if($num<0){
				$_data["class"]="text-red";
		}
		$_data["num"]=$num;
		return $_data;
	}
}
if(!function_exists('_increment'))
{
	function _increment($a,$b,$c)
	{

		
		$num=0;
		$_data=[];
		
		if(bccomp($a, $b)===0){
			$num=0;
		}else if((int)$b===0){
			$num=100;
		}else if((int)$a===0){
			$num=-100;
		}else{
			
			$num=round((((float)$a-(float)$b)/(float)$b)*100,2);
		}

		if($c==="imagen"){
			if($num===0){
				$_data["class"]="text-blue";
			}else if($num>0){
				$_data["class"]="text-success";
			}else if($num<0){
				$_data["class"]="text-red";
			}
			$_data["num"]=$num."%";

		}else{
			if($num===0){
				$_data["class"]="text-blue";
			}else if($num<0){
				$_data["class"]="text-success";
			}else if($num>0){
				$_data["class"]="text-red";
			}
			$_data["num"]=$num."%";

		}
		
		return $_data;
	}
}
if(!function_exists('_build_joson'))
{
	function _build_json($_status=FALSE,$_data=FALSE,$_controller=FALSE)
	{
		$CI= &get_instance();
		if(!(boolean)$_status)
		{
			if(isset($_data['message_identifier']))
			{
				if((boolean)$_controller)
					$_data["message"]=$CI->lang->line($CI->data["controller"].$_data["message_identifier"]);
				else
					$_data["message"]=$CI->lang->line($_data["message_identifier"]);
			}
			else
			{
					$_data["message"]=$CI->lang->line("_cannot_complete");
			}
		}
		$_data["status"]=$_status;
		exit(json_encode($_data));
	}
}
if(!function_exists('_is_ajax_request'))
{
	function _is_ajax_request()
	{
		$CI= &get_instance();
		if(!$CI->input->is_ajax_request())
			_build_json();
	}
}
if(!function_exists('_is_post'))
{
	function _is_post()
	{
		if($_SERVER['REQUEST_METHOD']!=='POST')
			_build_json();
	}	
}
