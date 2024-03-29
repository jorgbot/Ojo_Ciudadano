<div class="row">
	<div class="col s12">
		<h4 class="pad-left-15">Editar Usuario</h4>
	</div>
</div>
<div class="row">
	<form class="col s12" method="post" action="<?php echo site_url('site/editUserSubmit');?>" enctype="multipart/form-data">
		<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id', $before->id);?>" style="display:none;">

		<div class="row">
			<div class="input-field col m6 s12">
				<label>Nombre</label>
				<input type="text" name="name" value="<?php echo set_value('name', $before->name);?>">
			</div>
		</div>

		<div class="row">
			<div class="input-field col m6 s12">
				<label for="email">Correo</label>
				<input type="email" id="normal-field" class="form-control" name="email" value="<?php echo set_value('email', $before->email);?>">
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<input type="password" name="password" value="" id="password">
				<label for="password">Contraseña</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<input type="password" name="confirmpassword" value="" id="confirmpassword">
				<label for="confirmpassword">Confirmar contraseña</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<label for="socialid">Id Red Social</label>
				<input type="text" id="socialid" name="socialid" value="<?php echo set_value('socialid', $before->socialid);?>">
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<label for="contact">Contacto</label>
				<input type="text" id="contact" name="contact" value="<?php echo set_value('contact', $before->contact);?>">
			</div>
		</div>

		<div class="row">
			<div class="input-field col m6 s12">
			<select id="logintype" name="logintype" placeholder="Login Type" id="" value="<?php echo set_value('logintype', $before->logintype);?>">
			    <option value="<?php echo set_value('logintype', $before->logintype);?>"><?php echo set_value('logintype', $before->logintype);?></option>
			    <option value="Email">Correo</option>
			    <option value="Facebook">Facebook</option>
			    <option value="Google">Google</option>
			    <option value="Twitter">Twitter</option>
			    <option value="Instagram">Instagram</option>
			</select>
				<label for="logintype">Tipo de Inicio</label>
			</div>
		</div>

		<div class="row">
			<div class="input-field col m6 s12">
				<?php echo form_dropdown('status', $status, set_value('status', $before->status)); ?>
					<label>Estado</label>
			</div>
		</div>

		<div class="row">
			<div class="input-field col m6 s12">
				<?php echo form_dropdown('accesslevel', $accesslevel, set_value('accesslevel', $before->accesslevel)); ?>
					<label>Nivel de acceso</label>
			</div>
		</div>
		<div class="row">
			<div class="file-field input-field col m6 s12">
				<span class="img-center big image1">
								                    	<?php if ($before->image == '') {
} else {
    ?><img src="<?php echo base_url('uploads').'/'.$before->image;
    ?>">
															<?php
} ?>
															</span>
				<div class="btn blue darken-4">
					<span>Imagen</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate image1" type="text" placeholder="Sube uno o más archivos" value="<?php echo set_value('image', $before->image);?>">
				</div>
				 <div class="md4"><a class="waves-effect waves-light btn red clearimg input-field ">Limpiar Imagen</a></div>
			</div>

		</div>
		<div class="row">
			<div class="file-field input-field col m6 s12">
				<span class="img-center big image2">
								<?php if ($before->coverimage == '') {
} else {
    ?><img src="<?php echo base_url('uploads').'/'.$before->coverimage;
    ?>" >
						<?php
} ?>
				</span>
				<div class="btn blue darken-4">
					<span>Imagen de portada</span>
					<input name="coverimage" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate image2" type="text" placeholder="Sube uno o más archivos" value="<?php echo set_value('coverimage', $before->coverimage);?>">
				</div>
				<div class="md4"><a class="waves-effect waves-light btn red clearimg1 input-field ">Limpiar Imagen</a></div>
			</div>

		</div>

		<div class="row">
			<div class="input-field col m6 s12">
				<textarea name="address" class="materialize-textarea" length="120"><?php echo set_value('address', $before->address);?></textarea>
				<label>Direccion</label>
			</div>
		</div>

		<!--        EVENT NOTIFICATION-->
		<?php if ($before->eventnotification == 'true') {
    ?>
			<div class="row">
				<div class="col m3 s6">
					<label for="filled-in-box" class="form-checkbox">Notificacion de eventos</label>
				</div>
				<div class="col m3 s6">
					<div class="switch">
						<label>
							No
							<input type="checkbox" name="eventnotification" value="true" checked>
							<span class="lever"></span> Si
						</label>
					</div>
				</div>
			</div>
			<?php
} else {
         ?>
				<div class="row">
					<div class="col m3 s6">
						<label for="filled-in-box" class="form-checkbox">Notificacion de eventos</label>
					</div>
					<div class="col m3 s6">
						<div class="switch">
							<label>
								No
								<input type="checkbox" name="eventnotification" value="true">
								<span class="lever"></span> Si
							</label>
						</div>
					</div>
				</div>

				<?php
     } ?>

					<!--               PHOTO NOTIFICATION-->
					<?php if ($before->photonotification == 'true') {
    ?>
						<div class="row">
							<div class="col m3 s6">
								<label for="filled-in-box" class="form-checkbox">Notificacion de fotos</label>
							</div>
							<div class="col m3 s6">
								<div class="switch">
									<label>
										No
										<input type="checkbox" name="photonotification" value="true" checked>
										<span class="lever"></span> Si
									</label>
								</div>
							</div>
						</div>
						<?php
} else {
         ?>
							<div class="row">
								<div class="col m3 s6">
									<label for="filled-in-box" class="form-checkbox">Notificacion de fotos</label>
								</div>
								<div class="col m3 s6">
									<div class="switch">
										<label>
											No
											<input type="checkbox" name="photonotification" value="true">
											<span class="lever"></span> Si
										</label>
									</div>
								</div>
							</div>

							<?php
     } ?>
								<!--               VIDEO NOTIFICATION-->
								<?php if ($before->videonotification == 'true') {
    ?>
									<div class="row">
										<div class="col m3 s6">
											<label for="filled-in-box" class="form-checkbox">Notificacion de video</label>
										</div>
										<div class="col m3 s6">
											<div class="switch">
												<label>
													No
													<input type="checkbox" name="videonotification" value="true" checked>
													<span class="lever"></span> Si
												</label>
											</div>
										</div>
									</div>
									<?php
} else {
         ?>
										<div class="row">
											<div class="col m3 s6">
												<label for="filled-in-box" class="form-checkbox">Notificacion de video</label>
											</div>
											<div class="col m3 s6">
												<div class="switch">
													<label>
														No
														<input type="checkbox" name="videonotification" value="true">
														<span class="lever"></span> Si
													</label>
												</div>
											</div>
										</div>

										<?php
     } ?>
											<!--               BLOG NOTIFICATION-->

											<?php if ($before->blognotification == 'true') {
    ?>
												<div class="row">
													<div class="col m3 s6">
														<label for="filled-in-box" class="form-checkbox">Notificacion de Blog</label>
													</div>
													<div class="col m3 s6">
														<div class="switch">
															<label>
																No
																<input type="checkbox" name="blognotification" value="true" checked>
																<span class="lever"></span> Si
															</label>
														</div>
													</div>
												</div>
												<?php
} else {
         ?>
													<div class="row">
														<div class="col m3 s6">
															<label for="filled-in-box" class="form-checkbox">Notificacion de Blog</label>
														</div>
														<div class="col m3 s6">
															<div class="switch">
																<label>
																	No
																	<input type="checkbox" name="blognotification" value="true">
																	<span class="lever"></span> Si
																</label>
															</div>
														</div>
													</div>

													<?php
     } ?>
														<div class=" form-group">
															<div class="row">
																<div class="col m12">
																	<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Guardar</button>
																	<a href="<?php echo site_url('site/viewUsers'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancelar</a>
																</div>
															</div>
														</div>



	</form>
</div>
<script>
    $(document).ready(function () {

        // IMAGE
        $(".clearimg").click(function () {
            if (confirm("¿Seguro desea borrar la imagen?") == true) {
                $.get("<?php echo site_url('site/clearUserImage?id='.$before->id);?>", function (data) {
                    $("input.image1").val("");
                    $("span.image1").html("");
                });


            } else {
                return 0;
            }
        });

//        COVER IMAGE
        $(".clearimg1").click(function () {
            if (confirm("¿Seguro desea borrar la imagen?") == true) {
                $.get("<?php echo site_url('site/clearCoverImage?id='.$before->id);?>", function (data) {
                    $("input.image2").val("");
                    $("span.image2").html("");
                });


            } else {
                return 0;
            }
        });
    });
</script>
