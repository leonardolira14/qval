<?php
$num="";
if($perfiles!=false){
	$internos="";
	$externos="";

	$int=1;
	$ext=1;
	if($perfiles){
		foreach ($perfiles as $key) {
		if($key->Tipo=="I"){
			$internos.="<tr><td>".$int."</td><td>".$key->Nombre.'</td><td>Interno</td><td>
			<div class="btn-group" role="group"><button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>				<div class="dropdown-menu accion-grupoI" aria-labelledby="btnGroupDrop1">
			<ul><li class="dropdown-item" lla="as" llt="I" id="'.$key->IDGrupo.'"><i class="fa fa-file" aria-hidden="true"></i> Asignar Cuestionario</li><li class="dropdown-item" lla="mod" llt="I" id="'.$key->IDGrupo.'"><i class="fa fa-wrench" aria-hidden="true"></i> Modificar</li><li lla="del" class="dropdown-item" llt="I" id="'.$key->IDGrupo.'"><i class="fa fa-ban" aria-hidden="true"></i> Borrar</li></ul></div></div>
			</td></tr>';
			$int++;
		}else{
			$externos.="<tr><td>".$ext."</td><td>".$key->Nombre.'</td><td>Externo</td><td>
			<div class="btn-group" role="group"><button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>				<div class="dropdown-menu accion-grupoI" aria-labelledby="btnGroupDrop1">
			<ul><li class="dropdown-item" lla="as" llt="E" id="'.$key->IDGrupo.'"><i class="fa fa-file" aria-hidden="true"></i> Asignar Cuestionario</li><li class="dropdown-item" lla="mod" llt="E" id="'.$key->IDGrupo.'"><i class="fa fa-wrench" aria-hidden="true"></i> Modificar</li><li lla="del" class="dropdown-item" llt="E" id="'.$key->IDGrupo.'"><i class="fa fa-ban" aria-hidden="true"></i> Borrar</li></ul></div></div>
			</td></tr>';
			$ext++;
		}
	}
	}
	
	$num=$key->IDEmpresa;
}
?>
<div class="container">
	<div class="row">
		<div class="card w-100">
			<div class="card-body">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h3><span>Grupos</span></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card w-100 m-t-30">
			<div class="card-body">
				<div class="container">
					<div class="row">
						<div class="col-12 text-rigth m-b-20"><!---->
							<div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Buscar" aria-label="Input group example" aria-describedby="btnGroupAddon2">
									<button class="btn btn-primary" ><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
								<div class="btn-group" role="group" aria-label="First group">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-grupo"><i class="fa fa-user-plus"></i> Alta</button>
									<div class="btn-group" role="group">
										<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-text" aria-hidden="true"></i></i> Exportar</button>
										<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
											<a class="dropdown-item" href="<?= base_URL() ?>/admin/cvs_export?num=<?=$num ?>">CVS</a>
											<a class="dropdown-item" id="exporjsongrup"  href="#">JSON</a>
										</div>
									</div>
								</div>
							</div>
						</div><!--section button-->

						<div class="col-12 m-t-20">
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Perfiles Internos</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Perfiles Externos</a>
								</li>
							</ul>
						</div><!-- butttons tabs de perfiles-->
						<div class="col-12">
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 m-t-20">
												<table class="table table-hover">
													<thead class="thead-qval">
														<tr>
															<th scope="col">#</th>
															<th scope="col">Nombre</th>
															<th scope="col">Tipo</th>
															<th scope="col">Acciones</th>
														</tr>
													</thead>
													<tbody>
														<?php
														if(isset($internos)){
															echo $internos;	
														}
														
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 m-t-20">
												<table class="table table-hover">
													<thead class="thead-qval">
														<tr>
															<th scope="col">#</th>
															<th scope="col">Nombre</th>
															<th scope="col">Tipo</th>
															<th scope="col">Acciones</th>
														</tr>
													</thead>
													<tbody>
														<?php
														if(isset($externos)){
															echo $externos;	
														}
														
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!--close tab conteni-->
					</div><!--close rowcard-->
				</div><!---close contacard-->
			</div><!--close body card-->
		</div><!--close card-->
	</div><!--close row-->
</div><!---close conta-->
<!--INICIO MODAL ADD PERFL-->
<div class="modal" id="add-grupo" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Alta Grupo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Nombre</label>
								<input type="text" class="form-control" id="nombre" aria-describedby="emailHelp" placeholder="">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Tipo de Grupo</label>
								<div class="custom-controls-stacked">
									<div class="container-fluid">
										<form id="frmtipo">
											<div class="row">
												<div class="col-6">
													<label class="custom-control custom-radio">
														<input id="I" name="tipo" value="I" type="radio" checked class="custom-control-input">
														<span class="custom-control-indicator"></span>
														<span class="custom-control-description">Interno</span>
													</label>
												</div>
												<div class="col-6">
													<label class="custom-control custom-radio">
														<input value="E" id="E" name="tipo" type="radio" class="custom-control-input">
														<span class="custom-control-indicator"></span>
														<span class="custom-control-description">Externo</span>
													</label>
												</div>

											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="alert alert-primary" id="alertadd" role="alert">
								<span>Ingresa un nombre para un grupo</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnadd-grupo" class="btn btn-primary">Guardar</button>
				<button type="button" class="btn btn-secondary">Borrar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>
<!--CLOSE MODAL ADD PERFIL-->
<div class="modal" id="exporjson" tabindex="-1" role="dialog">
	 <div class="modal-dialog" role="document">
	 	 <div class="modal-content">
		 	 	<div class="modal-header">
		        <h5 class="modal-title">Grupos Qval</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <div class="card">
				  <div class="card-body">
				    This is some text within a card body.
				  </div>
				</div>
		      </div>
	 	 </div>
	 </div>
</div>
