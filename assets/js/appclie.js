if(empresa===""){
	if(help.getcokie("datusuario")!=undefined){
		dat=JSON.parse(help.getcokie("datusuario"));
		empresa=dat.Mensaje[0].IDEmpresa;
	}
}
function Clientes(){
	var that=this;
	that.estados=function(pais,div){
		tip={"pais":pais}
		var html="<option value=''>Selecciona</option>";
		help.senddata(tip,"clientes/estados",function(data){
			console.log(data);
			$.each(data.pais,function(index,estado){
				html+="<option value='"+estado.id+"'>"+estado.estadonombre+"</option>";
			})
			$(div).html(html);
			return false;
		})
	}

}

var cliente=new Clientes;
$(document).on('change',"#Add-cliente #pais",function(){
		cliente.estados($(this).val(),"#Add-cliente #estados");
})
var cleave = new Cleave('#Add-cliente .tel', {
    phone: true,
    phoneRegionCode: 'MX'
});
$(document).on('click','#Add-cliente #btnadd-clie',function(){
	var tip={};
	tip["data"]=help.validardor("#Add-cliente .modal-body","#Add-cliente .alert");
	console.log(tip);
	if(tip["data"]!=false){
		tip["empresa"]=empresa;
		help.senddata(tip,"clientes/addCliente",function(res){
			if(res.pass==1){
				$("#Add-cliente").modal('toggle');
				setTimeout(function(){
					help.loadclientes();
				},1000)
			}
		})
	}else{
		return false;
	}
})
$(document).on("click","#Add-cliente .btn-primary",function(){
	console.log($(this).attr("id"))
	tip={};
	tip["numc"]=$(this).attr("id");
	tip["data"]=help.validardor("#Add-cliente .modal-body","#Add-cliente .alert");
	if(tip["data"]!=false){
		tip["empresa"]=empresa;
		help.senddata(tip,"clientes/ModCliente",function(res){
			if(res.pass==1){
						$("#Add-cliente").modal('toggle');
						setTimeout(function(){
							help.loadclientes();
						},1000)
					}
				})
	}else{
		return false;
	}
})
$(document).on("click",".accion-funCl .dropdown-item",function(){
	var tip={};
	switch($(this).attr("lla")){
		case "mod-funC":
			tip["numc"]=$(this).attr("llc");
			help.senddata(tip,"clientes/readClie",function(resp){
				console.log(resp.datos)
				$.each(resp.datos,function(index,datos){
					$("#Add-cliente input[name='Email']").val(datos.Correo);
					$("#Add-cliente input[name='RZ']").val(datos.Nombre);
					$("#Add-cliente input[name='NC']").val(datos.NombreComercial);
					$("#Add-cliente input[name='Direccion']").val(datos.Direccion);
					$("#Add-cliente select[name='Estado']").val(datos.EEstado);
					$("#Add-cliente select[name='Grupo']").val(datos.IDConfig);
					$("#Add-cliente input[name='Municipio']").val(datos.Municipio);
					$("#Add-cliente input[name='RFC']").val(datos.RFC);
					$("#Add-cliente input[name='Tel']").val(datos.Tel);
					$("#Add-cliente select[name='Pais']").val(datos.Pais);
					$("#Add-cliente input[name='Puesto']").val(datos.Puesto);
					$("#Add-cliente input[name='Apellidos']").val(datos.Apellidos);
					$("#Add-cliente select[name='TPersona']").val(datos.TPersona);
					$("#Add-cliente #btnadd-clie").attr("id",datos.IDCliente);
					$("#Add-cliente").modal("show");
				})
			})
		break;
		case "del-funC":
			tip["numc"]=$(this).attr("llc");
			help.senddata(tip,"clientes/DelCliente",function(res){
				toastr.success("Se a eliminado correctamente");
			if(res.pass==1){
				help.loadclientes();	
					}
				})
			break;
		case "qr-funC":
			cg="https://chart.googleapis.com/chart?cht=qr&chs=400x400&choe=ISO-8859-1&chl="+$(this).attr("id");
			$("#qr-funct img").attr("src",cg)
		$("#qr-funct").modal("toggle");
			break;
	}
	
})
$(document).on('hide.bs.modal','#Add-cliente', function (e) {
 $("#Add-cliente .modal-body input").val("");
 $("#Add-cliente .btn-primary").attr("id","btnadd-clie");
});
$(document).on("click","#exporjsonclie",function(){
	var tip={"num":empresa};
	help.senddata(tip,"clientes/JSon_export", function(resp){
		$("#exporjson .modal-body .card-body").html(JSON.stringify(resp));
		$("#exporjson").modal("show");
		return false;
	})
	
})