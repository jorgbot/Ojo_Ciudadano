<div class="row">
	<div class="col s12">
		<h4 class="pad-left-15">Create User</h4>
	</div>
	<form class="col s12" method="post" action="<?php echo site_url('site/createUserSubmit');?>" enctype="multipart/form-data">
		<div class="row">
			<div class="input-field col m6 s12">
				<label for="name">Name</label>
				<input type="text" id="name" name="name" value="<?php echo set_value('name');?>">
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<label for="email">Email</label>
				<input type="email" id="email" class="form-control" name="email" value="<?php echo set_value('email');?>">
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<input type="password" name="password" value="" id="password">
				<label for="password">Password</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<input type="password" name="confirmpassword" value="" id="confirmpassword">
				<label for="confirmpassword">Confirm Password</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<label for="socialid">Social Id</label>
				<input type="text" id="socialid" name="socialid" value="<?php echo set_value('socialid');?>">
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<label for="contact">Contact</label>
				<input type="text" id="contact" name="contact" value="<?php echo set_value('contact');?>">
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
			<select id="logintype" name="logintype" id="" value="<?php echo set_value('logintype');?>">
			    <option value="Email">Email</option>
			    <option value="Facebook">Facebook</option>
			    <option value="Google">Google</option>
			    <option value="Twitter">Twitter</option>
			    <option value="Instagram">Instagram</option>
			</select>
				<label for="logintype">Login Type</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<?php echo form_dropdown('status', $status, set_value('status')); ?>
					<label>Status</label>
			</div>
		</div>
		<div class="row">
			<div class="file-field input-field col m6 s12">
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
			<div class="file-field input-field col m6 s12">
				<div class="btn blue darken-4">
					<span>Cover Image</span>
					<input name="coverimage" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('coverimage');?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<?php echo form_dropdown('accesslevel', $accesslevel, set_value('accesslevel')); ?>
					<label>Access Level</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col m6 s12">
				<textarea name="address" class="materialize-textarea" length="120"><?php echo set_value('address');?></textarea>
				<label>Address</label>
			</div>
		</div>
		<div class="row">
			<div class="col m3 s6">
				<label for="filled-in-box" class="form-checkbox">Event Notification</label>
			</div>
			<div class="col m3 s6">
				<div class="switch">
					<label>
						Off
						<input type="checkbox" name="eventnotification" value="true">
						<span class="lever"></span> On
					</label>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col m3 s6">
				<label for="filled-in-box" class="form-checkbox">Photo Notification</label>
			</div>
			<div class="col m3 s6">
				<div class="switch">
					<label>
						Off
						<input type="checkbox" name="photonotification" value="true">
						<span class="lever"></span> On
					</label>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col m3 s6">
				<label for="filled-in-box" class="form-checkbox">Video Notification</label>
			</div>
			<div class="col m3 s6">
				<div class="switch">
					<label>
						Off
						<input type="checkbox" name="videonotification" value="true">
						<span class="lever"></span> On
					</label>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col m3 s6">
				<label for="filled-in-box" class="form-checkbox">Blog Notification</label>
			</div>
			<div class="col m3 s6">
				<div class="switch">
					<label>
						Off
						<input type="checkbox" name="blognotification" value="true">
						<span class="lever"></span> On
					</label>
				</div>
			</div>
		</div>

		<div class=" form-group">
			<div class="row">
				<div class="col m6 s12">
					<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
					<a href="<?php echo site_url('site/viewUsers'); ?>" class="waves-effect waves-light btn red">Cancel</a>
				</div>
			</div>
		</div>
	</form>
</div>
