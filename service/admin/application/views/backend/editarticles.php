<div class="row">
	<div class="col s12">
		<h4 class="pad-left-15"><?php echo $title;?></h4>
	</div>
</div>
</div>
<div class="row">
	<form class="col s12" method="post" action="<?php echo site_url('site/editArticlessubmit');?>" enctype="multipart/form-data">
		<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id', $before->id);?>" style="display:none;">
		<?php if ($before->id == 1) {
    ?>

			<?php
} else {
         ?>
				<div class="row">
					<div class="input-field col s12 m6">
						<label>Title</label>
						<input type="text" name="title" value="<?php echo set_value('title', $before->title);
         ?>">
					</div>
				</div>
				<?php
     } ?>

					<?php if ($before->id == 1) {
    ?>

						<?php
} else {
         ?>
							<div class="row">
								<div class="input-field col s12 m6">
									<?php echo form_dropdown('status', $status, set_value('status', $before->status));
         ?>
										<label>Status</label>
								</div>
							</div>
							<?php
     } ?>
								<div class="row">
									<div class="col s12 m6">
										<label>Content</label>
										<textarea id="some-textarea" name="content" placeholder="Enter text ...">
											<?php echo set_value('content', $before->content);?>
										</textarea>
									</div>
								</div>


								<div class="row hidden" >
									<div class="input-field col s12 m6">
										<label>Timestamp</label>
										<input type="text" readonly="true" name="timestamp" value="<?php echo set_value('timestamp', $before->timestamp);?>">
									</div>
								</div>
                            	<?php if ($before->id == 1) {
    ?>

						<?php
} else {
         ?>

								<div class="row">
									<div class="file-field input-field col s12 m6">

										<span class="img-center big image1">
										 <?php if ($before->image != '') {
    ?>
                <img src="<?php echo base_url('uploads').'/'.$before->image;
    ?>" ><?php
}
         ?></span>
										<div class="btn blue darken-4">
											<span>Image</span>
											<input name="image" type="file" multiple>
										</div>
										<div class="file-path-wrapper">
											<input class="file-path validate image1" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image', $before->image);
         ?>">
											<?php if ($before->image == '') {
} else {
    ?>
												<?php
}
         ?>
										</div>
										 <div class="md4"><a class="waves-effect waves-light btn red clearimg input-field ">Clear Image</a></div>
									</div>

								</div>
        <?php
     } ?>
								<div class="row">
									<div class=" form-group col s12 m6">
											<button type="submit" class="btn btn-primary jsonsubmit waves-effect waves-light blue darken-4">Save</button>
											<?php if ($before->id == 1) {
    ?>

												<?php
} else {
         ?>
													<a href="<?php echo site_url('site/viewArticles');
         ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
													<?php
     } ?>
														<!--                <a href="<?php echo site_url('site/viewArticles'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>-->
										</div>
								</div>
	</form>
</div>
<script>
    $(document).ready(function () {
        $(".clearimg").click(function () {
            if (confirm("Are you sure want to clear Image!") == true) {
                $.get("<?php echo site_url('site/clearArticleImage?id='.$before->id);?>", function (data) {
                    $("input.image1").val("");
                    $("span.image1").html("");
                });


            } else {
                return 0;
            }
        });
    });
</script>
