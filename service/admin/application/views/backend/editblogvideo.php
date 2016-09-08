<div class="row">
    <div class="col s12">
    <h4 class="pad-left-15">Edit Blog Video</h4>
    </div>
</div>
<div class="row">
    <form class="col s12" method="post" action="<?php echo site_url('site/editBlogVideoSubmit');?>" enctype="multipart/form-data">
        <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id', $before->id);?>" style="display:none;">

        <div class="row">
            <div class="input-field col s6">
                <label for="order">Order</label>
                <input type="text" id="order" name="order" value="<?php echo set_value('order', $before->order);?>">
            </div>
        </div>
            <div class="row">
            <div class="input-field col s6">
                <label for="video">Video</label>
                <input type="text" id="video" name="video" value="<?php echo set_value('video', $before->video);?>">
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <?php echo form_dropdown('status', $status, set_value('status', $before->status)); ?>
            </div>
        </div>
            <div class="row">
            <div class="input-field col s6">
                <?php echo form_dropdown('blog', $blog, set_value('blog', $before->blog)); ?>
            </div>
        </div>
        <div class=" form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light green">Save</button>
                <a href="<?php echo site_url('site/viewBlogVideo?id=').$this->input->get('blogid'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
            </div>
        </div>
    </form>
</div>
