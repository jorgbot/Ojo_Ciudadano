<div class="row">
    <div class="col s12">
    <h4 class="pad-left-15">Crear Municipio</h4>
    </div>
        <form class="col s12" method="post" action="<?php echo site_url('site/createMunicipiosSubmit');?>" enctype="multipart/form-data">

                <div class="row">
                <div class="input-field col s12 m6">
                    <label for="title">Nombre</label>
                    <input type="text" id="name" name="name" value="<?php echo set_value('name');?>">
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6">
                 <label>Blog ID</label>
                  <input type="text" id="blog_id" name="blog_id" value="<?php echo set_value('blog_id');?>">
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6">
                 <label>Estado</label>
                  <input type="text" id="isactive" name="isactive" value="<?php echo set_value('isactive');?>">
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6">
                        <div class=" form-group">
                    <button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Guardar</button>
                    <a href="<?php echo site_url('site/viewMunicipios'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancelar</a>
            </div>
                </div>
            </div>

        </form>
</div>
