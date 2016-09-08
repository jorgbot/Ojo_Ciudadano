<div class="row">
	<div class="col s12">
		<h4 class="pad-left-15">Edit Slider</h4></div>
	<form class="col s12" method="post" action="<?php echo site_url('site/editSliderSubmit');?>" enctype="multipart/form-data">
		<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id', $before->id);?>" style="display:none;">

		<div class="row">
			<div class="input-field col m6 s12">
				<label for="order">Order</label>
				<input type="text" id="order" name="order" value="<?php echo set_value('order', $before->order);?>">
			</div>
		</div>

		<div class="row">
			<div class="input-field col m6 s12">
				<?php echo form_dropdown('status', $status, set_value('status', $before->status)); ?>
					<label>Status</label>
			</div>
		</div>

		<div class="row">
			<div class="file-field input-field col m6 s12">
				<span class="img-center big image1">
                   			<?php if ($before->image == '') {
} else {
    ?><img src="<?php echo base_url('uploads').'/'.$before->image;
    ?>">
						<?php
} ?></span>
				<div class="btn blue darken-4">
					<span>Image</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate image1" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image', $before->image);?>">
				</div>
<!--				<div class="md4"><a class="waves-effect waves-light btn red clearimg input-field ">Clear Image</a></div>-->
			</div>

		</div>
		<div class=" form-group">
			<div class="row">
				<div class="col m6 s12">
					<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
					<a href="<?php echo site_url('site/viewSlider'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
    $(document).ready(function () {
        $(".clearimg").click(function () {
            if (confirm("Are you sure want to clear Image!") == true) {
                $.get("<?php echo site_url('site/clearSliderImage?id='.$before->id);?>", function (data) {
                    $("input.image1").val("");
                    $("span.image1").html("");
                });


            } else {
                return 0;
            }
        });
    });
</script>
