<div class="row">
    <div class="col s12">
    <h4 class="pad-left-15">Edit Video Gallery</h4>
    </div>
</div>
<div class="row">
    <form class="col s12" method="post" action="<?php echo site_url('site/editVideoGallerySubmit');?>" enctype="multipart/form-data">
        <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id', $before->id);?>" style="display:none;">
         <div class="row">
            <div class="input-field col s12 m6">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo set_value('name', $before->name);?>">
            </div>
        </div>
         <div class="row">
            <div class="input-field col s12 m6">
                <label for="subtitle">Subtitle</label>
                <input type="text" id="subtitle" name="subtitle" value="<?php echo set_value('subtitle', $before->subtitle);?>">
            </div>
        </div>
            <div class="row">
            <div class="input-field col s12 m6">
                <label for="order">order</label>
                <input type="text" id="order" name="order" value="<?php echo set_value('order', $before->order);?>">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6">
                <?php echo form_dropdown('status', $status, set_value('status', $before->status)); ?>
                 <label>Status</label>
            </div>
        </div>
               <div class="row">
            <div class="input-field col s12 m6">
                <label>Timestamp</label>
                <input type="text" readonly="true" name="timestamp" value="<?php echo set_value('timestamp', $before->timestamp);?>">
            </div>
        </div>
<div class="row">
    <div class="col s12 m6">
         <div class=" form-group">
                <button type="submit" class="btn btn-primary jsonsubmit waves-effect waves-light blue darken-4">Save</button>
                <a href="<?php echo site_url('site/viewVideoGallery'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
        </div>
    </div>
</div>

    </form>
</div>
