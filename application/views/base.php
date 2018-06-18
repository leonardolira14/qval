<script>
	$(function(){
		help.datsempresa();
	})
</script>
<header>
<div class="container-fluid">
	<div class="row">
		<div class="col-12 text-center">
			<img src="<?= base_URL()?>/assets/img/Qval-admyo.jpg" alt="">
		</div>
	</div>
</div>
</header>
<div class="ray"></div>
<div class="cont-gen container-fluid">
	<div class="row">
		<div class="col-2 no-float menu">
			<ul class="menu-ul">
				<li class="item-menu active"  onclick="help.datsempresa()" id="mun-config"><span>Configuración <i class="fa fa-chevron-right" aria-hidden="true"></i></span>	</li>
				<li class="item-menu p-grup"><span>Grupos <i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
				<li class="item-menu"  id="mun-us" onclick="help.loadusuarios()"><span>Usuarios <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
					
				</li>
				<li class="item-menu" id="mun-clie" onclick="help.loadclientes()"><span>Clientes/Proveedores <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
					
				</li>
				<li class="item-menu p-cues"><span>Cuestionarios <i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
				<li class="item-menu" id="mun-res" onclick="help.loadresultados()"><span>Resultados <i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
				<li class="item-menu p-express" ><span>Carga Exprés <i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
				<li class="item-menu " ><span>Power Street <i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
				<a href="<?=base_URL()?>assets/apk/android/qval.apk" target="_blank" /><li class="item-menu" ><span>Descargar App Adroid <i class="fa fa-chevron-right" aria-hidden="true"></i></span></li></a>
			</ul>
		</div>
		<div class="col-10 no-float fondo" id="carga">
			
		</div>
	</div>
</div>
<div class="izimodal" id="borrargrupo" data-zindex="1031" data-width="40%">
	<div class="container">
		<div class="row">
			<div class="col-12 p-l-20 p-r-20">
				<h3>¿Está seguro de eliminar este Grupo?</h3>
			</div>
			<div class="col-12 p-l-20 p-r-20">
				
				<ul>
					<li><i class="fa fa-angle-right" aria-hidden="true"></i> Todos los usuarios de este grupo no tendrán grupo asignado, por lo consiguiente no podran usar y responder cuestionarios de QVAL.</li>
					<li><i class="fa fa-angle-right" aria-hidden="true"></i> Todos los cuestionarios con este grupo pasarán a ser archivados.</li>
					<li><i class="fa fa-angle-right" aria-hidden="true"></i> Todos los informes especiales y preguntas de este grupo seran alterados</li>
					<li><i class="fa fa-angle-right" aria-hidden="true"></i> Le recomendamos los siguientes pasos previos:
						<ul>
							<li> <i class="fa fa-angle-double-right" aria-hidden="true"></i> Reasignar los usuarios a otro grupo.</li>
							<li><i class="fa fa-angle-double-right" aria-hidden="true"></i> Reasigbar cuestionarios a otro grupo.</li>
						</ul>
					</li>
					<li><i class="fa fa-angle-right" aria-hidden="true"></i> Se enviara un email a los usuarios implicados notificando los cambios</li>
				</ul>
			</div>
			<div class="col-12 m-t-10 m-b-10 text-right">
				<button class="btn btn-danger m-r-20" onclick="help.borrargrup(this.id)" id="">Borrar</button>
				<button class="btn btn-secondary" data-izimodal-close>Cancelar</button>
			</div>
		</div>
	</div>
</div>
<div class="izimodal" id="msgerror" data-header-color="#B20000" data-width="40%">
	<div class="container bodyerror">
		<div class="row">
			<div class="col-12">
				<h4></h4>
			</div>
		</div>
	</div>
</div>
<div class="izimodal" id="sncuest"  data-header-color="#B20000" data-width="40%">
	<div class="container bodyerror">
		<div class="row">
			<div class="col-12">
				<p class="text-center"><h5>No hay cuestionarios!</h5></p>
				<div class="col-12 m-t-10 m-b-10 text-right">
				<button class="btn btn-success m-r-20 p-cues">Agregar Cuestionario</button>
				<button class="btn btn-secondary" data-izimodal-close>Cancelar</button>
			</div>
			</div>
		</div>
	</div>
</div>
