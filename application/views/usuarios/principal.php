	<div class="container">
		<div class="row">
			<div class="card w-100">
				<div class="card-body">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<h3><span>Usuarios</span></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container m-t-30">
		<div class="row">
			<div class="card w-100">
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
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-usuario"><i class="fa fa-user-plus" aria-hidden="true"></i> Alta</button>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#altaexpres"><i class="fa fa-address-book-o" aria-hidden="true"></i> Alta exprés</button>
										<div class="btn-group" role="group">
											<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-file-text" aria-hidden="true"></i> Exportar
											</button>
											<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
												<a class="dropdown-item" href="<?= base_URL() ?>/usuarios/cvs_export?num=<?=$empresa ?>">CVS</a>
												<a class="dropdown-item" id="exporjsonus" llc="<?=$empresa ?>" href="#">JSON</a>
											</div>
										</div>
									</div>
								</div>
							</div><!--section button-->
							<div class="col-12">
								<table class="table table-hover">
									<thead class="thead-qval">
										<tr>
											<th scope="col">#</th>
											<th scope="col">Nombre</th>
											<th scope="col">Apellidos</th>
											<th scope="col">Usuario</th>
											<th scope="col"></th>
										</tr>
									</thead>
									<tbody>
										<?php 
										
										if($usuarios!=false){
											$i=1;
											foreach ($usuarios as $key) {
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$key->Nombre?></td>
													<td><?=$key->Apellidos?></td>
													<td>
														<div class="btn-group" role="group"><button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>				<div class="dropdown-menu accion-funU" aria-labelledby="btnGroupDrop1">
															<ul>
																<li class="dropdown-item" lla="add-funU" llt="E" llc="<?= $key->IDUsuario?>"><i class="fa fa-list-ol" aria-hidden="true"></i> Asignar Acciones</li>
																<li data-toggle="modal"  data-target="#add-tel"  class="dropdown-item" onclick="help.optionusr('get-tel',this.id)" id="<?= $key->IDUsuario?>"><i class="fa fa-phone" aria-hidden="true"></i> Telefonos</li><li lla="mod-funU" class="dropdown-item" lla="mod" llt="E" llc="<?= $key->IDUsuario?>"><i class="fa fa-wrench" aria-hidden="true"></i> Modificar</li><li lla="del-funU" class="dropdown-item" llt="E" llc="<?= $key->IDUsuario?>"><i class="fa fa-ban" aria-hidden="true"></i> Borrar</li>
																<li  class="dropdown-item" onclick="help.optionusr('gen-qr',this.id)" id="I|<?= $key->Usuario?>"><i class="fa fa-phone" aria-hidden="true"></i> Código QR</li></ul></div></div></td>		
															</tr>
															<?php
														}	
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade "  id="add-usuario" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Alta Usuario</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="container">
									<div class="row" id="form-usuario">

										<div class="col-12">
											<div class="form-group">
												<label  for='usuario'>Nombre</label>
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon2"><i class="fa fa-user" aria-hidden="true"></i>
													</span>
													<input type="text" class="form-control" lln="Nombre" required id="nombre">
												</div>
											</div>
										</div>
										<div class="col-6 ">
											<div class="form-group">
												<label  for='usuario'>Apellidos</label>
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon2"><i class="fa fa-user" aria-hidden="true"></i></span>
													<input type="text" class="form-control" lln='Apellidos' required id="apellidos">
												</div>

											</div>
										</div>	
										<div class="col-6 ">
											<div class="form-group">
												<label for="apellidos">Usuario</label>
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon2"><i class="fa fa-user-secret" aria-hidden="true"></i></span>
													<input type="text" class="form-control " lln='Usuario' required id="usuario">
												</div>
											</div>
										</div>

										<div class="col-6">
											<div class="form-group">
												<label for="apellidos">Puesto</label>
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon2"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
													<input type="text" class="form-control" lln='Puesto' required id="apellidos">
												</div>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="apellidos">Email</label>
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon2"><i class="fa fa-envelope" aria-hidden="true"></i></span>
													<input type="email" class="form-control" lln='Email' required id="apellidos">
												</div>
											</div>
										</div>

										<div class="col-6">
											<div class="form-group">
												<label for="apellidos">Grupo</label>
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon2"><i class="fa fa-users" aria-hidden="true"></i></span>
													<select required lln='Grupo' class="form-control" id="grupo">
														<?php 
														if($perfiles!=false){
															foreach ($perfiles as $key) {
																?>
																<option value='<?= $key["num"] ?>'><?= $key["Nombre"] ?></option>
																<?php
															}
														}
														?>
													</select>
												</div>
											</div>
										</div>

										<div class="col-12">
											<div class="alert alert-info" role="alert">
												<strong></strong> Se enviara un correo electronico con las instrucciones de uso, a la dirección que registre
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" id="btnadd-grupo" onclick="help.optionusr('add','')" class="btn btn-primary">Guardar</button>
										<button type="button" class="btn btn-secondary">Borrar</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="modal fade "  id="add-tel" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Registrar Teléfono</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="col-12">
									<div class="form-group">
										<label for="apellidos">Teléfono</label>
										<div class="input-group">
											<span class="input-group-addon succes" id="basic-addon2"><i class="fa fa-phone" aria-hidden="true"></i></span>
											<select class="form-control" id="telefonoss">
												<option value="0">0</option>
											</select>
											<div class="btn-group">
												<button type="button" class="btn btn-primary dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Acciones
												</button>
												<div class="dropdown-menu" id="acc-tel">
													<a class="dropdown-item" href="#" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Registrar Nuevo</a>
													<a class="dropdown-item"  lln="del-tel" onclick="help.optionusr('del-tel','')" href="#">Eliminar</a>
													<a class="dropdown-item" onclick="help.optionusr('dat-tel','')" href="#">Modificar</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 collapse m-t-10 m-b-10" id="collapseExample">
									<div class="card card-body">
										<div class="row">
											<div class="col-8 bg-light">
												<div class="form-group center-prelative">
													<div class="input-group">
														<span class="input-group-addon succes" id="basic-addon2">+52</span>
														<input type="text" required class="form-control" placeholder="7761239515" lln="Telefono">
														<select name="" class="form-control" id="DQTipo">
															<option value="Movil">Movil</option>
															<option value="Fijo">Fijo</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-4 bg-light ">
												<div class="center-prelative">
													<button type="button" id="btnadd-grupo" onclick="help.optionusr('add-tel','46')" class="btn btn-primary">Guardar</button>
													<button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >Cerrar</button>
												</div>

											</div>
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="alert alert-info" role="alert">
										<span>Estos son los teléfonos registrados de este usuario</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade "  id="add-funct" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Registrar Acciones</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="container">
									<div class="row">
										<div class="col-12">
											<table class="table table-hover">
												<thead class="thead-qval">
													<tr>
														<th scope="col"></th>
														<th scope="col">Accion</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><input type="checkbox" value="."></td>
														<td>Calificar en Qval</td>
													</tr>
													<tr>
														<td><input type="checkbox" value="."></td>
														<td>Configuración de datos de empresa</td>
													</tr>
													<tr>
														<td><input type="checkbox" value="."></td>
														<td>Acciones dentro de Grupos</td>
													</tr>
													<tr>
														<td><input type="checkbox" value="."></td>
														<td>Acciones dentro de Usuarios</td>
													</tr>
													<tr>
														<td><input type="checkbox" value="."></td>
														<td>Acciones dentro de Clientes</td>
													</tr>
													<tr>
														<td><input type="checkbox" value="."></td>
														<td>Acciones dentro de Proveedores</td>
													</tr>
													<tr>
														<td><input type="checkbox" value="."></td>
														<td>Acciones dentro de Cuestionarios</td>
													</tr>
													<tr>
														<td><input type="checkbox" value="."></td>
														<td>Acciones dentro de Resultados</td>
													</tr>
													<tr>
														<td><input type="checkbox" value="."></td>
														<td>Carga Exprés</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" id="btnadd-accus"  class="btn btn-primary">Guardar</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade"  id="msj-conf" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Mensaje de Qval</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="card">
									<div class="card-body">
										<div class="col-12 text-center">
											<img src="assets/img/alerta.png" class="img-fluid" alt="">
										</div>
										<div class="col-12 text-center">
											<h5><strong>¿Esta seguro de Eliminar a este usuario?</strong></h5>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" id="btn-succes" onclick="help.optionusr('Del','')" class="btn btn-success">Aceptar</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade "  id="qr-funct" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-sm" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Código QR</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-12 text-center" >
										<img src='' class="img-fluid" alt="">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<div class="modal" id="exporjson" tabindex="-1" role="dialog">
	 <div class="modal-dialog" role="document">
	 	 <div class="modal-content">
		 	 	<div class="modal-header">
		        <h5 class="modal-title">Usuarios Qval</h5>
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
<div class="modal fade" id="altaexpres" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alta Express</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       	<div class="container">
       		<div class="row">
       			<ol>
		       		<li>Descarga la plantilla (csv) para guardar los registros.</li>
		       		<li>Llena las columnas correctamente.</li>
		       		<li>Guarda el archivo en el mismo formato (csv).</li>
		       		<li>Al terminar sube el archivo dando click en el boton "Subir Archivo".</li>
		       		<li>Espera a que el sistema confirme que a guardado tus datos.</li>
		       		<li>No olvides al terminar de cargar los registros, agregar un grupo a cada usuario.</li>
		       	</ol>
		       	
       		</div>
       	</div>
       	<div class="alert alert-primary" role="alert">
			Esperando datos...
		</div>
       </div>
      <div class="modal-footer">
        <a   target="_blank" href="assets/plantillas/plantillasnuev/usuarios.csv"><label class="btn btn-primary" for="">Descargar Plantilla</label></a>
        <label  class="btn btn-success">Subir Archivo
        	<form id="frmchang" enctype="multipart/form-data" >
			 	<input type="file" style="display: none;" name="usuexpres" accept=".csv" id="altausexpfiel">
			</form>
        </label>

        <label  class="btn btn-secondary" data-dismiss="modal">Cerrar</label>
       
      </div>
    </div>
  </div>
</div>