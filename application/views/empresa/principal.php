<div class="container">
	<div class="row">
		<div class="card w-100">
			<div class="card-body">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h3><span>Datos de Empresa</span></h3>
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
						<div class="col-12">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="logo-tab" data-toggle="tab" href="#logo" role="tab" aria-controls="logo" aria-selected="true">Logo</a>
								</li>
								<li class="nav-item">
									<a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">General</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Contacto</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Usuario</a>
								</li>
							</ul>
						</div>
						<div class="col-12">
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="logo" role="tabpanel" aria-labelledby="logo-tab">
									<div class="row m-t-20">

										<div class="col-12">
											<div class="con-img">
												<?php
												if($perfiles->Logo!=Null || $perfiles->Logo!="" )
												{
													?>
													<img src="assets/img/logosEmpresa/<?=$perfiles->Logo ?>" class="img-fluid" alt="">
													<?php
												}
												else
												{
													?>
													<img  src="assets/img/foto-no-disponible.jpg" class="img-fluid" alt="">
													<?php
												}
												?>
												
											</div>

										</div>
										<div class="col-6 centrar-h m-t-30">
											<div class="alert alert-primary" role="alert">
												NOTA: PESO MÁXIMO 2 MB, FORMATOS JPG,PNG.
											</div>
										</div>
										<div class="col-12 text-center m-t-30">
											<label for="logemps" class="btn btn-primary"><i class="fa fa-file-image-o"></i> Seleccionar Logo
											</label>
											<label id="uplogoemp" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Cambios</label>
											<form id="form-logo">
												<input onchange="help.prevviewimg(this,'.con-img img')" accept="image/x-png,image/jpeg,image/jpeg" type="file" id="logemps" name="log-img" style="display: none">
											</form>
										</div>
										
									</div>
								</div>
								<div class="tab-pane fade show " id="home" role="tabpanel" aria-labelledby="home-tab">
									<form method="post" class="row m-t-20" id="dat-general">
										<div class="col-12 alert alert-danger no-visible" role="alert">
											This is a danger alert—check it out!
										</div>
										<div class="col-12">
											<div class="form-group">
												<label for=""><strong>*</strong> Razon Social</label>
												<input type="text" name="razonsocial" value="<?=$perfiles->RazonSocial ?>" class="form-control">
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">Nombre Comercial</label>
												<input type="text" name="nombrecomercial" value="<?=$perfiles->NombreComercial ?>" class="form-control">
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">RFC(Registro Federal de Contribuyentes)</label>
												<input type="text" name="RFC" value="<?=$perfiles->RFC ?>" class="form-control">
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">Tipo de Empresa</label>
												
												<select name="tiposempresa" class="form-control" id="">
													<option selected value="">Selecciona</option>
													<?php
													
													foreach ( $datos["tiposempresa"] as $tipo) {
														if ($perfiles->TipoEmpresa===$tipo->TipoEmpresa) {
															?>
															<option selected value="<?=$tipo->TipoEmpresa?>"><?=$tipo->TipoEmpresa?></option>
															<?php
														}else
														{
															?>
															<option value="<?=$tipo->TipoEmpresa?>"><?=$tipo->TipoEmpresa?></option>
															
															<?php
														}														
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">No de Empleados</label>
												<select name="noempleados" class="form-control">
													<option selected value="">Selecciona</option>
													<?php
													
													foreach ( $datos["noempleados"] as $tipo) {
														if ($perfiles->NoEmpleados===$tipo->Empleados) {
															?>
															<option selected value="<?=$tipo->Empleados?>"><?=$tipo->Empleados?></option>
															<?php
														}else
														{
															?>
															<option value="<?=$tipo->Empleados?>"><?=$tipo->Empleados?></option>
															
															<?php
														}														
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">Facturación Anual</label>
												<select name="facturacion"  class="form-control">
													<option selected value="">Selecciona</option>
													<?php
													
													foreach ( $datos["tipofacturacion"] as $tipo) {
														if ($perfiles->FacturacionAnual===$tipo->Facturacion) {
															?>
															<option selected value="<?=$tipo->Facturacion?>"><?=$tipo->Facturacion?></option>
															<?php
														}else
														{
															?>
															<option value="<?=$tipo->Facturacion?>"><?=$tipo->Facturacion?></option>
															
															<?php
														}														
													}
													?>
												</select>
											</div>
										</div>						
											<div class="col-12">
												<div class="form-group">
													<label for="">Descripción de la Empresa</label>
													<textarea name="descripcion" class="form-control" col="30" rows="10"><?=$perfiles->Descripcion ?></textarea>
												</div>
											</div>
									</form>
										<div class="col-12 text-center">
											<button id="btn-updategen" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Cambios</button>
										</div>
									
								</div>
								<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
									<form method="post" id="frm-contac" class="row m-t-20">
										<div class="col-12 alert alert-danger no-visible" role="alert">
											This is a danger alert—check it out!
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">Página Web</label>
												<input name="pagina" type="text" value="<?=$perfiles->Pagina ?>" class="form-control">
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">Dirección (Calle y Número)</label>
												<input name="direc" type="text" value="<?=$perfiles->Calleynum ?>" class="form-control">
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">Colonia</label>
												<input name="colonia" type="text" value="<?=$perfiles->Colonia ?>" class="form-control">
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">Municipio/Delegación</label>
												<input name="municipio" type="text" value="<?=$perfiles->Municipio ?>" class="form-control">
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">Código Postal</label>
												<input name="cp" type="text" value="<?=$perfiles->CP ?>"  class="form-control">
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">Estado</label>
												<select name="estado" name="estado"  class="form-control">
													<option selected value="">Selecciona</option>
													<?php
													
													foreach ( $datos["estados"] as $tipo) {
														if ($perfiles->Estado===$tipo->estadonombre) {
															?>
															<option selected value="<?=$tipo->estadonombre?>"><?=$tipo->estadonombre?></option>
															<?php
														}else
														{
															?>
															<option value="<?=$tipo->estadonombre?>"><?=$tipo->estadonombre?></option>
															
															<?php
														}														
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">Telefono</label>
												<input name="tel" type="text" value="<?=$perfiles->Telefono ?>" class="form-control">
											</div>
										</div>
									</form>
									<div class="row">
										<div class="col-12 text-center">
											<button id="btn-datcont" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Cambios</button>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
									<div class="row">
										<div class="col-6 m-t-20 m-b-30">
											<div class="row">
												<div class="col-12">
													<h3>Datos de Usuario</h3>
												</div>
												<form id="frm-datus" action="post" >
													<div class="row">
														<div class="col-12 alert alert-danger no-visible" role="alert">
													This is a danger alert—check it out!
												</div>
												<div class="col-12">	
													<div class="form-group">
														<label for="">Nombre</label>
														<input type="text" name="nombre" value="<?=$usuario[0]->Nombre ?>" class="form-control">
													</div>
												</div>
												<div class="col-12">
													<div class="form-group">
														<label for="">Apellidos</label>
														<input type="text" name="apellido" value="<?=$usuario[0]->Apellidos ?>" class="form-control">
													</div>
												</div>
												<div class="col-12">
													<div class="form-group">
														<label for="">Puesto</label>
														<input type="text" name="puesto" value="<?=$usuario[0]->Puesto ?>" class="form-control">
													</div>
												</div>
												<div class="col-12">
													<div class="form-group">
														<label for="">Correo Electronico</label>
														<input type="text" name="correo" value="<?=$usuario[0]->Correo ?>" class="form-control">
													</div>
												</div>
													</div>	
												</form>
												<div class="col-12 text-center">
													<button id="btn-upus" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Cambios</button>
												</div>
											</div>											
										</div>
										<div class="col-6 m-t-20 m-b-30">
											<div class="row">
												<div class="col-12">
													<h3>Cambio de Contraseña</h3>
												</div>
												<form action="post" id="frm-upclave" class="col-12" >
												<div class="row">
													<div class="col-12 alert alert-danger no-visible" role="alert">
													This is a danger alert—check it out!
												</div>
												<div class="col-12">
													<div class="form-group">
														<label for="">Contraseña Actual</label>
														<input type="password" name="c" class="form-control">
													</div>
												</div>
												<div class="col-12">
													<div class="form-group">
														<label for="">Contraseña Actual</label>
														<input type="password" name="c1" class="form-control">
													</div>
												</div>
												<div class="col-12">
													<div class="form-group">
														<label for="">Confirmar Contraseña</label>
														<input type="password" name="c2" class="form-control">
													</div>
												</div>
												</div>
												</form>
												<div class="col-12 text-center">
													<button id="btn-upclave" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Cambios</button>
												</div>
											</div>											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>