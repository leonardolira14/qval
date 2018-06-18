
<div class="container">
	<div class="row">
		<div class="card w-100">
			<div class="card-body">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h3><span>Carga Express</span></h3>
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
					<div class="row" id="form-expres">
						<div class="col-6">
							<div class="form-group">
								<label for="">Tipo de Contribuyente</label>
								<select required lln="TipoContribuyente"  class="form-control">
									<option value="">selecciona</option>
									<option value="PM">Persona Moral</option>
										<option value="PMF">Persona Física Act. Empresarial </option>
										<option value="PF">Persona Física </option>
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="">Razon Social</label>
								<input lln="RazonSocial" required type="text" class="form-control">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="">Correo Electrónico</label>
								<input lln="Email" required type="email" class="form-control">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="">Grupo</label>
								<select lln="Grupo" required  class="form-control">
									<?php
										if($grupos!=false){

										
											foreach ($grupos as $key) {
												?>
												<option value="<?= $key->IDGrupo?>"><?= $key->Nombre?></option>
												<?php
											}
											}
										?>
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="alert alert-info" role="alert">
							  Llena los datos correctamente.
							</div>
						</div>
						<div class="col-12">
							<button  id="btnaddexpress" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade "  id="qr-express" tabindex="-1" role="dialog">
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