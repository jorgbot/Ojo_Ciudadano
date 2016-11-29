<div class="row">
    <div class="col s12">
    <h4 class="pad-left-15">Editar Municipioss</h4>
    </div>
</div>
<div class="row">
    <form class="col s12" method="post" action="<?php echo site_url('site/editMunicipiosSubmit');?>" enctype="multipart/form-data">
        <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id', $before->id);?>" style="display:none;">

        <div class="row">
            <div class="input-field col s12 m6">
                <label>Nombre</label>
                <input type="text" name="name" value="<?php echo set_value('name', $before->name);?>">
            </div>
        </div>
        <div class="row">
            <div class="col ss12 m6">
                <label>Blog Id</label>
                <input id="blof_id" name="blog_id" type="number" placeholder="Enter text ..." value="<?php echo set_value('blog_id', $before->blog_id);?>">
            </div>
        </div>
        <div class="row">
            <div class="file-field input-field col s12 m6">
                <span class="img-center big image1">
                   <?php if ($before->image != '') { ?>
                    <img src="<?php echo base_url('uploads').'/'.$before->image;?>">
                    <?php } ?>
                </span>
            </div>
        </div>
         <div class="row">
            <div class="input-field col s12 m6">
                <label>Estado</label>
                <input type="number" name="isactive" value="<?php echo set_value('isactive', $before->isactive);?>">
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class=" form-group">
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary jsonsubmit waves-effect waves-light blue darken-4">Guardar</button>
                        <a href="<?php echo site_url('site/viewBlog'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
