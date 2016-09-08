<div class="row">
    <div class="col s12">
    <h4 class="pad-left-15">Create Config</h4>
    </div>
        <form class="col s12" method="post" action="<?php echo site_url('site/createConfigSubmit');?>" enctype="multipart/form-data">

            <div class="row">
                <div class="input-field col s6">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="<?php echo set_value('title');?>">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <?php echo form_dropdown('type', $type, set_value('type')); ?>
                     <label>Type</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea name="content" class="materialize-textarea" length="120">
                        <?php echo set_value('content');?>
                    </textarea>
                    <label>Content</label>
                </div>
            </div>
                 <div class="row">
                <div class="input-field col s12">
                    <textarea name="text" class="materialize-textarea" length="120">
                        <?php echo set_value('text');?>
                    </textarea>
                    <label>Text</label>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary waves-effect waves-light green">Save</button>
                    <a href="<?php echo site_url('site/viewConfig'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
                </div>
            </div>
        </form>
</div>
