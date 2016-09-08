<div class="row">
    <div class="col s12">
    <h4 class="pad-left-15">Edit Event Video</h4>
    </div>
</div>
<div class="row">
    <form class="col s12" method="post" action="<?php echo site_url('site/editEventVideoSubmit');?>" enctype="multipart/form-data">
        <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id', $before->id);?>" style="display:none;">

         <div class="row">
            <div class="input-field col s6">
                <?php echo form_dropdown('event', $event, set_value('event', $before->event)); ?>
                 <label>Event</label>
            </div>
        </div>
            <div class="row" style="display:none">
            <div class="input-field col s6">
                <?php echo form_dropdown('videogallery', $videogallery, set_value('videogallery', $before->videogallery)); ?>
                 <label>Video Gallery</label>
            </div>
        </div>
           <div class="row">
            <div class="input-field col s6">
                <?php echo form_dropdown('status', $status, set_value('status', $before->status)); ?>
                 <label>Status</label>
            </div>
        </div>
            <div class="row">
            <div class="input-field col s6">
                <label>Order</label>
                <input type="text" name="order" value="<?php echo set_value('order', $before->order);?>">
            </div>
        </div>
           <div class="row">
            <div class="input-field col s6">
                <label>Url</label>
                <input type="text" name="url" value="<?php echo set_value('url', $before->url);?>">
            </div>
        </div>
        <div class="row">
            <div class="col s6">
                   <div class=" form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
                <a href="<?php echo site_url('site/viewEventVideo?id=').$this->input->get('eventid'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
            </div>
        </div>
            </div>
        </div>

    </form>
</div>
