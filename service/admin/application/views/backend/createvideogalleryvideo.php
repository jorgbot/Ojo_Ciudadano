<div class="row">
    <div class="col s12">
        <h4 class="pad-left-15">Create Video Gallery Video</h4>
    </div>
    <form class="col s12" method="post" action="<?php echo site_url('site/createVideoGalleryVideoSubmit');?>" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s6">
                <?php echo form_dropdown('videogallery', $videogallery, set_value('videogallery', $this->input->get('id'))); ?>
                 <label>Video Gallery</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <label for="alt">Title</label>
                <input type="text" id="alt" name="alt" value="<?php echo set_value('alt');?>">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <label for="url">Url</label>
                <input type="text" id="url" name="url" value="<?php echo set_value('url');?>">
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <label for="order">Order</label>
                <input type="text" id="order" name="order" value="<?php echo set_value('order');?>">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <?php echo form_dropdown('status', $status, set_value('status')); ?>
                 <label>Status</label>
            </div>
        </div>
        <div class="row">
            <div class="col s6">
                     <div class=" form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
                <a href="<?php echo site_url('site/viewVideoGalleryVideo?id=').$this->input->get('id');?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
            </div>
        </div>
            </div>
        </div>

    </form>
</div>
