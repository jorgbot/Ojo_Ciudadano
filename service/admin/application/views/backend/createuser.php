<div class="row">
	<div class="col s12">
		<h4 class="pad-left-15">Crear Usuario</h4>
	</div>
	<form class="col s12" method="post" action="<?php echo site_url('site/createUserSubmit');?>" enctype="multipart/form-data">
		<div class="row">
			<div class="input-field col m6 s12">
				<label for="name">Nombre</label>
				<input type="text" id="name" name="name" value="<?php echo set_value('name');?>">
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<label for="email">Correo</label>
				<input type="email" id="email" class="form-control" name="email" value="<?php echo set_value('email');?>">
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
				<label for="confirmpassword">Repetir Contraseña</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<label for="socialid">Id Red Social</label>
				<input type="text" id="socialid" name="socialid" value="<?php echo set_value('socialid');?>">
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<label for="contact">Contacto</label>
				<input type="text" id="contact" name="contact" value="<?php echo set_value('contact');?>">
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
			<select id="logintype" name="logintype" id="" value="<?php echo set_value('logintype');?>">
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
				<?php echo form_dropdown('status', $status, set_value('status')); ?>
					<label>Estado</label>
			</div>
		</div>
		<div class="row">
			<div class="file-field input-field col m6 s12">
				<div class="btn blue darken-4">
					<span>Imagen</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Sube uno o más archivos" value="<?php echo set_value('image');?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="file-field input-field col m6 s12">
				<div class="btn blue darken-4">
					<span>Imagen Portada</span>
					<input name="coverimage" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Sube uno o más archivos" value="<?php echo set_value('coverimage');?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<?php echo form_dropdown('accesslevel', $accesslevel, set_value('accesslevel')); ?>
					<label>Nivel de Acceso</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<textarea name="address" class="materialize-textarea" length="120"><?php echo set_value('address');?></textarea>
				<label>Direccion</label>
			</div>
		</div>
		<div class="row">
			<div class="col m3 s6">
				<label for="filled-in-box" class="form-checkbox">Notificacion de Eventos</label>
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

		<div class="row">
			<div class="col m3 s6">
				<label for="filled-in-box" class="form-checkbox">Notificacion de Fotos</label>
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

		<div class="row">
			<div class="col m3 s6">
				<label for="filled-in-box" class="form-checkbox">Notificacion de Videos</label>
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

		<div class=" form-group">
			<div class="row">
				<div class="col m6 s12">
					<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Guardar</button>
					<a href="<?php echo site_url('site/viewUsers'); ?>" class="waves-effect waves-light btn red">Cancelar</a>
				</div>
			</div>
		</div>
	</form>
</div>
