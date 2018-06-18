<script src="assets/js/appresultados.js"></script>
<div class="container">
	<div class="row">
		<div class="card w-100">
			<div class="card-body">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h3><span>Resultados</span></h3>
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
						<div class="col-3">
							<div class="form-group">
								<label for="tipo">Estatus</label>
								<select name="tipo" id="stipo" class="form-control">
									<option value="">Selecciona</option>
									<option value="1">Activo</option>
									<option value="0">Desactivado</option>
								</select>
							</div>
						</div>
						<div class="col-9">
							<div class="form-group">
								<label for="cuestion">Cuestionarios</label>
								<select name="cuestionario" id="cuestion" class="form-control"></select>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container m-t-10 datos">
	<div class="row">
		<div class="card w-100">
			<div class="card-body">
				<div class="container">
					<div class="row">
						<!================ffffff========================>
						<div class="col-12 m-t-20">
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link active" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="true">Datos</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="graficos-tab" data-toggle="tab" href="#graficos" role="tab" aria-controls="graficos" aria-selected="true">Graficos</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="resumen-tab" data-toggle="tab" href="#resumen" role="tab" aria-controls="resumen" aria-selected="true">Resumen</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="detalle-tab" data-toggle="tab" href="#detalle" role="tab" aria-controls="detalle" aria-selected="true">Detalles</a>
								</li>
							</ul>
						</div><!-- butttons tabs de perfiles-->
						<div class="col-12 m-t-20">

							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="datos" role="tabpanel" aria-labelledby="datos-tab">
									<div class="row">
										<div class="col-12 ">
										<span><h5>Datos</h5></span>
									</div>
									<div class="col-6 m-t-10">
										<div><h6><strong>Nombre: </strong><span class="nombre"></span></h6></div>
									</div>	
									<div class="col-6 m-t-10">
										<div><h6><strong>Estatus: </strong><span class="Estatus"></span></h6></div>
									</div>
									<div class="col-6 m-t-10">
										<div><h6><strong>Perfil Emisor: </strong><span class="Pemisor"></span></h6></div>
									</div>
									<div class="col-6 m-t-10">
										<div><h6><strong>Perfil Receptor: </strong><span class="Preceptor"></span></h6></div>
									</div>
									</div>
									
								</div>

								<div class="tab-pane fade" id="graficos" role="tabpanel" aria-labelledby="graficos-tab">
									<div class="row">
										<div class="col-12">
											<span><h5>Graficos</h5></span>
										</div>
										<div class="col-12 m-t-20">
											<span><h6 class="Numveces">Graficos</h6></span>
										</div>

									<div class="col-12">
										<div class="container-fluid">
											<div class="row" id="graficos2">
												
											</div>
										</div>
									</div>
									</div>
									
								</div>
								<div class="tab-pane fade" id="resumen" role="tabpanel" aria-labelledby="resumen-tab">
									<div class="row">
										<div class="col-12">
										<span><h5>Resumen</h5></span>
										</div>
										<div class="col-12">
											<table class="table table-hover table-responsive">
												<thead class="thead-qval">
													<tr>
														<th>Pregunta</th>
														<th>Respuesta Positiva</th>
														<th>No.Respuestas</th>
														<th>Respuestas Positivas</th>

													</tr>
												</thead>
												<tbody id="tbresumenbody">
													
												</tbody>
											</table>
										</div>
										<div class="col-12">
											 <a  id="cvs-resumen" target="_blank" i class="btn btn-primary">Descargar Resumen(CVS)</a>
										</div>
									</div>
									

								</div>
								<div class="tab-pane fade" id="detalle" role="tabpanel" aria-labelledby="detalle-tab">
									<div class="row">
										<div class="col-12">
											<span><h5>Detalle</h5></span>
										</div>
										<div class="col-12">
											<table class="table table-hover table-responsive">
												<thead class="thead-qval">
													<tr>
														<th>Pregunta</th>
														<th>Fecha</th>
														<th>Califica</th>
														<th>Calificado</th>
														<th>Respuesta</th>
														<th>Puntos</th>
													</tr>
												</thead>
												<tbody id="tbdetallebody">
													
												</tbody>
											</table>
										</div>
										<div class="col-12">
											 <a  href="<?= base_URL(); ?>/resultados/detalles_cvs?num=9" target="_blank" id="cvs-detalles"  class="btn btn-primary">Descargar Detalle(CVS)</a>
										</div>
									</div>
									
								</div>
							</div>
							<!========================================>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>