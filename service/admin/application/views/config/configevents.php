<div class="row">
	<div class="col s12">
		<h4 class="pad-left-15">Configuracion -> Evento </h4>
	</div>
	<form class="col s12" method="post" action="<?php echo site_url('site/editConfigSubmit');?>" enctype="multipart/form-data">
		<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">

		<div class="row" style="display:none">
			<div class="input-field col s6">
				<label for="title">Titulo</label>
				<input type="text" id="title" name="title" value="<?php echo set_value('title',$before->title);?>">
			</div>
		</div>
		<div class="row" style="display:none">
			<div class="input-field col s6">
				<?php echo form_dropdown( 'type',$type,set_value( 'type',$before->type)); ?>
			</div>
		</div>
		<div class="row" style="display:none">
			<div class="input-field col s12">
				<textarea name="content" class="materialize-textarea" length="120">
					<?php echo set_value( 'content',$before->content);?>
				</textarea>
				<label>Contenido</label>
			</div>
		</div>
		<?php if($before->text == "true") {?>
			<div class="row">
				<div class="col s6">
					<label for="filled-in-box" class="form-checkbox">Estado</label>
				</div>
				<div class="col s6">
					<div class="switch">
						<label>
							No
							<input type="checkbox" name="text" value="true" checked>
							<span class="lever"></span> Si
						</label>
					</div>
				</div>
			</div>
			<?php }
     else { ?>
				<div class="row">
					<div class="col s6">
						<label for="filled-in-box" class="form-checkbox">Estado</label>
					</div>
					<div class="col s6">
						<div class="switch">
							<label>
								No
								<input type="checkbox" name="text" value="true">
								<span class="lever"></span> Si
							</label>
						</div>
					</div>
				</div>

				<?php } ?>
					<div class=" form-group">
						<div class="row">
							<div class="col s12">
								<button type="submit" class="btn btn-primary blue darken-4">Guardar</button>
								<a href="<?php echo site_url("site/viewConfig"); ?>" class="btn btn-secondary red">Cancelar</a>
							</div>
						</div>
					</div>
	</form>
</div>