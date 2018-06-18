<script src="assets/js/appclie.js"></script>
<div class="container">
	<div class="row">
		<div class="card w-100">
			<div class="card-body">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h3><span>Clientes/Proveedores</span></h3>
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
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Add-cliente"><i class="fa fa-user-plus" aria-hidden="true"></i> Alta</button>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalexpresclie"><i class="fa fa-address-book-o" aria-hidden="true"></i> Alta exprés</button>
									<div class="btn-group" role="group">
										<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-file-text" aria-hidden="true"></i> Exportar
										</button>
										<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
											<a class="dropdown-item" href="<?= base_URL() ?>/clientes/cvs_export?num=<?=$empresa ?>">CVS</a>
												<a class="dropdown-item" id="exporjsonclie" llc="<?=$empresa ?>" href="#">JSON</a>
										</div>
									</div>
								</div>
							</div>
						</div><!--section button-->
						<div class="col-12">
							<table class="table table-hover table-striped">
								<thead class="thead-qval">
									<tr>
										<th cope="col">#</th>
										<th cope="col">Razon Social</th>
										<th cope="col">Nombre Comercial</th>
										<th cope="col"></th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($listclie)
									{
										foreach ($listclie as $cliente) {
											?>
											<tr>
												<td></td>
												<td><?=$cliente->Nombre?></td>
												<td><?=$cliente->NombreComercial?></td>
												<td>
													<div class="btn-group" role="group"><button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>				<div class="dropdown-menu accion-funCl" aria-labelledby="btnGroupDrop1">
															<ul>
																
																<li lla="mod-funC" class="dropdown-item" llt="E" llc="<?=$cliente->IDCliente?>"><i class="fa fa-wrench" aria-hidden="true"></i> Modificar Datos</li><li lla="del-funC" class="dropdown-item" llt="E" llc="<?=$cliente->IDCliente?>"><i class="fa fa-ban"  aria-hidden="true"></i> Borrar</li>
																<li lla="qr-funC"  class="dropdown-item"  id="E|<?=$cliente->Usuario?>"><i class="fa fa-qrcode" aria-hidden="true"></i> Código QR</li></ul></div></div>

												</td>
											</tr>
											<?php
										}
									}
									?>

								</tbody>
							</table>
							<nav aria-label="Page navigation example">
							  
							    <?= $links ?>
							</nav>
							 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>