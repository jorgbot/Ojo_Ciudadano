<div class="row">
    <div class="col s12">
    <h4 class="pad-left-15">Crear Blog con Video</h4>
    </div>
        <form class="col s12" method="post" action="<?php echo site_url('site/createBlogVideoSubmit');?>" enctype="multipart/form-data">

           <div class="row">
                <div class="input-field col s6">
                    <label for="video">Video</label>
                    <input type="text" name="video" id="video" value="<?php echo set_value('video');?>">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <?php echo form_dropdown('status', $status, set_value('status')); ?>
                     <label>Estatus</label>
                </div>
            </div>
               <div class="row">
                <div class="input-field col s6">
                    <?php echo form_dropdown('blog', $blog, set_value('blog', $this->input->get('id'))); ?>
                     <label>Blog</label>
                </div>
            </div>

               <div class="row">
                <div class="input-field col s6">
                    <label for="order">Orden</label>
                    <input type="text" name="order" id="order" value="<?php echo set_value('order');?>">
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary waves-effect waves-light green">Guardar</button>
                    <a href="<?php echo site_url('site/viewBlogVideo?id=').$this->input->get('id'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancelar</a>
                </div>
            </div>
        </form>
</div>
