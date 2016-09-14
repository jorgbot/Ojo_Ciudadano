<div class="row">
    <div class="col s12">
    <h4 class="pad-left-15">Crear Galeria de Imagenes</h4>
    </div>
        <form class="col s12" method="post" action="<?php echo site_url('site/createVideoGallerySubmit');?>" enctype="multipart/form-data">

            <div class="row">
                <div class="input-field col s12 m6">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" value="<?php echo set_value('name');?>">
                </div>
            </div>
              <div class="row">
                <div class="input-field col s12 m6">
                    <label for="subtitle">Sub-Titulo</label>
                    <input type="text" name="subtitle" id="subtitle" value="<?php echo set_value('subtitle');?>">
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6">
                    <?php echo form_dropdown('status', $status, set_value('status')); ?>
                     <label>Estado</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <label for="order">Orden</label>
                    <input type="text" name="order" id="order" value="<?php echo set_value('order');?>">
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6">
                         <div class=" form-group">
                    <button type="submit" class="btn btn-primary jsonsubmit waves-effect waves-light blue darken-4">Guardar</button>
                    <a href="<?php echo site_url('site/viewVideoGallery'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancelar</a>
            </div>
                </div>
            </div>

        </form>
</div>
