<div class="row">
    <div class="col s12">
    <h4 class="pad-left-15">Create Event Images</h4>
    </div>
        <form class="col s12" method="post" action="<?php echo site_url('site/createEventImagesSubmit');?>" enctype="multipart/form-data">
               <div class="row">
                <div class="input-field col s6">
                    <?php echo form_dropdown('event', $event, set_value('event', $this->input->get('id'))); ?>
                     <label>Event</label>
                </div>
            </div>
               <div class="row">
                <div class="input-field col s6">
                    <?php echo form_dropdown('status', $status, set_value('status')); ?>
                     <label>Status</label>
                </div>
            </div>
            <div class="row">
                <div class="file-field input-field col s12 m6">
                    <div class="btn blue darken-4">
                        <span>Image</span>
                        <input name="image" type="file" multiple>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image');?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <label for="order">Order</label>
                    <input type="text" name="order" id="order" value="<?php echo set_value('order');?>">
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                        <div class="form-group">
                <label class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
                    <a href="<?php echo site_url('site/viewEventImages?id=').$this->input->get('id'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
                </div>
            </div>
                </div>
            </div>

        </form>
</div>
