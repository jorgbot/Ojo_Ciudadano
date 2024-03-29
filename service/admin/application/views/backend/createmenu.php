<div class="row">
	<div class="col-lg-12">
	    <section class="panel">
		    <header class="panel-heading">
				 Detalles de Menu
			</header>
			<div class="panel-body">
			    <form class="form-horizontal tasi-form" method="post" action="<?php echo site_url('menu/createMenuSubmit');?>">
				    <div class="form-group">
						<label class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="name" value="<?php echo set_value('name');?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Icono</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="icon" value="<?php echo set_value('icon');?>" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Descripcion</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="description" value="<?php echo set_value('description');?>" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Palabra Clave</label>
						<div class="col-sm-4">
						  <input type="text" id="" name="keyword" class="form-control" value="<?php echo set_value('keyword'); ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Url</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="url" value="<?php echo set_value('url'); ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Tipo de Menu</label>
						<div class="col-sm-4">
						  <?php
							$linktype= array(
							"1" => "Site Url",
							"2" => "Base URL",
							"3" => "External URL"
							);
							echo form_dropdown('linktype',$linktype,set_value('linktype'));
						  ?>
						</div>
					</div>
					<div class=" form-group">
					  <label class="col-sm-2 control-label">Parent Menu</label>
					  <div class="col-sm-4">
						<?php 	 echo form_dropdown('parentmenu',$parentmenu,set_value('parentmenu'));
						?>
					  </div>
					</div>
					<div class=" form-group">
					  <label class="col-sm-2 control-label">Menu Access</label>
					  <div class="col-sm-4">
						<?php   echo form_multiselect('menuaccess[]',$accesslevel,set_value('menuaccess'),'id="select2" class="myselect2 form-control populate placeholder select2-offscreen" ');	 ?>
					  </div>
					</div>
					<div class=" form-group">
					  <label class="col-sm-2 control-label">Esta Activo</label>
					  <div class="col-sm-4">
						<?php
						$isactive = array(
						"1" => "Yes",
						"2" => "No",
						);
						echo form_dropdown('isactive',$isactive,set_value('isactive'));
						?>
					  </div>
					</div>
					<div class=" form-group">
					  <label class="col-sm-2 control-label">Orden</label>
					  <div class="col-sm-4">
						<input type="number" name="order" class="form-control" value="<?php echo set_value('order'); ?>">
					  </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">&nbsp;</label>
						<div class="col-sm-4">
							<button type="submit" class="btn btn-info">Enviar</button>
						</div>
					</div>
				</form>
			</div>
		</section>
    </div>
</div>
