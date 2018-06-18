if(empresa===""){
	console.log(help.getcokie("datusuario"))
	if(help.getcokie("datusuario")!=undefined){
		dat=JSON.parse(help.getcokie("datusuario"));
		empresa=dat.Mensaje[0].IDEmpresa;
	}else{
		location.href ="/adminqval";
	}
}
function Resultados (){
	'use strict';
	
	var that=this;
	that.CargarCuestion=function(num){
		var tip={"empresa":empresa,"estatus":num};
		console.log(tip);
		help.senddata(tip,"Resultados/MuestraCues", function(resp){
			var html="<option val=''>Selecciona</option>";
			$.each(resp.cuestionarios,function(index,cuestionario){
				html+="<option value='"+cuestionario.IDCuestionario+"'>"+cuestionario.Nombre+"</option>";
			})
			$("#cuestion").html(html);

		})
	}
	that.CargaResumen=function(num){
		var tip={"numC":num};
		help.senddata(tip,"Resultados/Resumen", function(resp){
			$("#cvs-detalles").attr("href", "http://"+window.location.host+"/adminqval/resultados/detalles_cvs?num="+num);
			$("#cvs-resumen").attr("href", "http://"+window.location.host+"/adminqval/resultados/resumen_cvs?num="+num);
				$(".datos .nombre").text(resp.perfiles[0].Nombre)
				$(".datos .Estatus").text(resp.perfiles[0].Status)
				$(".datos .Pemisor").text(resp.perfiles[0].Emisor)
				$(".datos .Preceptor").text(resp.perfiles[0].Receptor)
				$(".Numveces").text("Datos recopilados de "+resp.numerodeveces+" veces que se realizo este cuestionario.")
				that.ponergraficar(resp.graficos);
				var html="";
				$.each(resp.Resumen,function(index,datos){
					html+="<tr><td>"+datos.Pregunta+"</td><td>"+datos.RespuestaPos+"</td><td>"+datos.Trespuestas+"</td><td>"+datos.Trespuestaspos+"</td></tr>";
				})
				$("#tbresumenbody").html(html);
				var html="";
				console.log(resp)
				if(resp.detalles!=false){
					$.each(resp.detalles,function(index,datos){
					html+="<tr><td>"+datos.Pregunta+"</td><td>"+datos.Fecha+"</td><td>"+datos.Emisor+"</td><td>"+datos.Receptor+"</td><td>"+datos.Respuesta+"</td><td>"+datos.Puntos+"</td></tr>";
					})
					$("#tbdetallebody").html(html);
				}

		})
	}
	that.ponergraficar=function(datos){
		var html="";
		$.each(datos,function(index,dato){
			html+="<div class='col-6'><div class='contgrap'><canvas id='grap"+index+"' width='100%' height='100%'></canvas></div></div>"
		})
		$("#graficos2").html(html);
		$.each(datos,function(index,dato){
			if(dato.Forma!='SI/NO'){
				that.graficabarra('grap'+index,dato.data,dato.labels,dato.Pregunta,dato.backgroundColor);
			}else{
				that.graficarCirc('grap'+index,dato.labels,dato.backgroundColor,dato.data,dato.Pregunta,dato.Forma);
			}
			
		})
		
	}
	that.graficarCirc=function(div,label,color,datos,titulo,forma){
		new Chart(document.getElementById(div), {
		    type: 'doughnut',
		    data: {
		      labels: label,
		      datasets: [
		        {
		          label: "no se que va",
		          backgroundColor: color,
		          data: datos
		        }
		      ]
		    },
		    options: {
		      title: {
		        display: true,
		        text: titulo+" ("+forma+")"
		      }
		    }
		});
	}
	that.graficabarra=function(div,data,labels,titulo,color){
		var stackedBar=new Chart(div,{
			type:'bar',
			data:{
				labels:labels,
				datasets:[{
					label:"que epdo",
					backgroundColor:color,
					data:data
				}]
			},
			options:{
				legend: { display: false },
				title: {
		        display: true,
		        text: titulo
		      }

			}

		})
	}
	that.graficarArea=function(labels,titulo,forma,data,div){
		var speedData = {
			  labels: labels,
			  datasets: [{
			    label: titulo+" ("+forma+")",
			    data: data,
			    backgroundColor: "#41255d",
			  }]
			};
		var chartOptions = {
				  legend: {
				    display: true,
				    position: 'top',
				    labels: {
				      boxWidth: 200,
				      fontColor: 'black'
				    }
				  }
				};
		var lineChart = new Chart(div, {
			  type: 'line',
			  data: speedData,
			  options: chartOptions
			});

	}
}


var resultado =new Resultados();
$(function(){
	$("#stipo").on("change",function(){
		if($(this).val()!=""){
			resultado.CargarCuestion($(this).val());
		}
		
	})
	$("#cuestion").on("change",function(){
		if($(this).val()!=""){
			resultado.CargaResumen($(this).val());
		}
		
	}) 

})