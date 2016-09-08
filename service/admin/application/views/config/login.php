<div class="row offset-s3">
	<div class="col s12">
		<h4 class="pad-left-15">Config -> Login</h4>
	</div>

	<div class="col s12 m6">
		<div class="logintype normalLogin">
			<div class="row checkbox">
				<div class="col s6 m6">
					<label for="filled-in-box" class="form-checkbox">Email and Password Login</label>
				</div>
				<div class="col s6 m6">
					<div class="switch">
						<label>
							Off
							<input type="checkbox" name="email">
							<span class="lever"></span> On
						</label>

					</div>
				</div>
			</div>
		</div>
		<div class="logintype googleLogin">
			<div class="row checkbox">
				<div class="col s6 m6">
					<label for="filled-in-box" class="form-checkbox">Google Login</label>
				</div>
				<div class="col s6 m6">
					<div class="switch">
						<label>
							Off
							<input type="checkbox" name="Google">
							<span class="lever"></span> On
						</label>
					</div>
				</div>
			</div>

			<!--            <div class="row checkbox">-->
			<div class="sublogintype" style=" min-height: 110px;">
				<div class="row">
					<div class="input-field col s12">
						<label for="appid">Google Client ID</label>
						<input type="text" id="appid" name="appid">
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<label for="secretid">Google Client secret</label>
						<input type="text" id="secretid" name="secret">
					</div>
				</div>
			</div>
			<!--            </div>-->

		</div>
		<div class="logintype facebookLogin">
			<div class="row checkbox">
				<div class="col s6">
					<label for="filled-in-box" class="form-checkbox">Facebook Login</label>
				</div>
				<div class="col s6">
					<div class="switch">
						<label>
							Off
							<input type="checkbox" name="Facebook">
							<span class="lever"></span> On
						</label>
					</div>
				</div>
			</div>
			<div class="sublogintype" style=" min-height: 110px;">
				<div class="row">
					<div class="input-field col s12">
						<label for="fbappid">Facebook App ID</label>
						<input type="text" id="fbappid" name="appid">
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<label for="fbsecretid">Facebook App Secret</label>
						<input type="text" id="fbsecretid" name="secret">
					</div>
				</div>
			</div>

		</div>
		<div class="logintype twitterLogin">
			<div class="row checkbox">
				<div class="col s6">
					<label for="filled-in-box" class="form-checkbox">Twitter Login</label>
				</div>
				<div class="col s6">
					<div class="switch">
						<label>
							Off
							<input type="checkbox" name="twitter">
							<span class="lever"></span> On
						</label>
					</div>
				</div>
			</div>
			<div class="sublogintype" style=" min-height: 110px;">
				<div class="row">
					<div class="input-field col s12">
						<label for="tappid">Twitter Consumer Key (API Key)</label>
						<input type="text" id="tappid" name="appid">
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<label for="tsecretid">Twitter Consumer Secret (API Secret)</label>
						<input type="text" id="tsecretid" name="secret">
					</div>
				</div>
			</div>

		</div>
		<div class="logintype instagramLogin">
			<div class="row checkbox">
				<div class="col s6">
					<label for="filled-in-box" class="form-checkbox">Instagram Login</label>
				</div>
				<div class="col s6">
					<div class="switch">
						<label>
							Off
							<input type="checkbox" name="instagram">
							<span class="lever"></span> On
						</label>
					</div>
				</div>
			</div>
			<div class="sublogintype" style=" min-height: 110px;">
				<div class="row">
					<div class="input-field col s12">
						<label for="iappid">Instagram Client ID</label>
						<input type="text" id="iappid" name="appid">
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<label for="isecretid">Instagram Client Secret</label>
						<input type="text" id="isecretid" name="secret">
					</div>
				</div>
			</div>
		</div>
		<form class="col s12" method="post" action="<?php echo site_url('site/editConfigSubmit');?>" enctype="multipart/form-data">
			<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">

			<div class="row" style="display:none">
				<div class="input-field col s6">
					<label for="title">Title</label>
					<input type="text" id="title" name="title" value="<?php echo set_value('title',$before->title);?>">
				</div>
			</div>
			<div class="row" style="display:none">
				<div class="input-field col s12">
					<textarea name="content" class="materialize-textarea">
						<?php echo set_value( 'content',$before->content);?>
					</textarea>
					<label>Content</label>
				</div>
			</div>
			<div class="row" style="display:none">
				<div class="input-field col s12">
					<textarea name="text" class="materialize-textarea logindata" id="textid">
						<?php echo set_value( 'text',$before->text);?>
					</textarea>
					<label>Text</label>
				</div>
			</div>

			<div class="row" style="display:none">
				<div class="input-field col s6">
					<?php echo form_dropdown( 'type',$type,set_value( 'type',$before->type)); ?>
				</div>
			</div>
			<div class="row">
				<div class="submitlogin">
					<button class="btn blue darken-4 waves-effect waves-light loginsubmit" name="action">Save
					</button>
				</div>
			</div>
		</form>
	</div>
	<script>
		var $demo = 0;
		$('.class1').click(function () {
			var $this = $(this);
			console.log($this);
			if ($this.is(".class1")) {
				if ($this.is(":checked")) {
					$(".class1").not($this).prop({
						disabled: true,
						checked: false
					});
				} else {
					$(".class1").prop("disabled", false);
				}
			}
		});
		var $logint = {};
		$(document).ready(function () {
            $(".sublogintype").hide();


			var $logintype = $(".logintype");
			var alldata = getStringtoJson($("#textid").val());
			for (var i = 0; i < alldata.length; i++) {
				var $checkbox = $logintype.eq(i).find(".checkbox").find("input[type=checkbox]");
				var $inputs = $logintype.eq(i).find(".sublogintype").find("input");

				$inputs.eq(0).val(alldata[i].appid);
				$inputs.eq(1).val(alldata[i].secret);

				if (alldata[i].value == true) {
					$checkbox.prop("checked", true);
                    checkboxclick($checkbox);
				}

			}

			$(".logintype input[type=checkbox]").click(function() {
                checkboxclick(this);
            });

			$("button.loginsubmit").click(function () {
				var sendjson = [];
				var $logintype = $(".logintype");
				$logint = $logintype;
				for (var i = 0; i < $logintype.length; i++) {
					var obj = {};
					var $checkbox = $logintype.eq(i).find(".checkbox").find("input[type=checkbox]");
					var $inputs = $logintype.eq(i).find(".sublogintype").find("input");
					obj.name = $checkbox.attr("name");
					obj.value = $checkbox.prop("checked");
					for (var j = 0; j < $inputs.length; j++) {
						obj[$inputs.eq(j).attr("name")] = $inputs.eq(j).val();
					}
					sendjson.push(obj);
				}
				console.log(sendjson);

				$(".logindata").val(JSON.stringify(sendjson));
				$("form.loginform").submit();
			});
            
            function checkboxclick (checkbox) {
				var shouldshow = $(checkbox).prop("checked");
				var $sublogin = $(checkbox).parents(".logintype").find(".sublogintype");
				if (shouldshow) {
					$sublogin.show(200);
				} else {
					$sublogin.hide(200);
				}
			} 
            
            
            
		});
	</script>