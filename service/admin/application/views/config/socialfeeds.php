<div class="row offset-s3">
    <div class="col s12">
        <h4 class="pad-left-15">Config -> Social Feeds</h4>
    </div>

    <div class="col s12 m6">
     
        <!--		FACEBOOK-->
        <div class="logintype facebookLogin">
            <div class="row">
                <div class="input-field col s12">
                    <label for="fbappid">Facebook Page Url</label>
                    <input type="text" id="fbappid" name="facebookappid">
                </div>
            </div>
        </div>
        <!--		TWITTER-->
        <div class="logintype twitterLogin">
            <div class="row">
                <div class="input-field col s12">
                    <label for="tappid">Twitter Page Url</label>
                    <input type="text" id="tappid" name="twitterappid">
                </div>
            </div>
        </div>
        <!--		INSTAGRAM-->
        <div class="logintype instagramLogin">
            <div class="row">
                <div class="input-field col s12">
                    <label for="iappid">Instagram Page Url</label>
                    <input type="text" id="iappid" name="instagramappid">
                </div>
            </div>
        </div>
           <!-- GOOGLE-->
        <div class="logintype googleplusLogin">
            <div class="row">
                <div class="input-field col s12">
                    <label for="appid">Google+ Page Url</label>
                    <input type="text" id="appid" name="googleplusappid">
                </div>
            </div>
        </div>


        <!--		YOUTUBE-->
        <div class="logintype youtubeLogin">
            <div class="row">
                <div class="input-field col s12">
                    <label for="yappid">Youtube Page Url</label>
                    <input type="text" id="yappid" name="youtubeappid">
                </div>
            </div>
        </div>
        <!--		TUMBLR-->
        <div class="logintype tumblrLogin">
            <div class="row">
                <div class="input-field col s12">
                    <label for="tuappid">Tumblr Page Url</label>
                    <input type="text" id="tuappid" name="tumblrappid">
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
					<textarea name="text" class="materialize-textarea logindata" id="textid"><?php echo set_value( 'text',$before->text);?></textarea>
					<label>Text</label>
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
         var $logintype = '';
        $(document).ready(function () {


            var inidata=$(".logindata").val();
            inidata=getStringtoJson(inidata);

            for(var i=0;i<inidata.length;i++)
            {
                $(".logintype input[name="+inidata[i].name+"]").val(inidata[i].value);
            }



           
            var $logintype = $(".logintype");

            $("button.loginsubmit").click(function () {
                var sendjson = [];
                $logintype = $(".logintype");
                for (var i = 0; i < $logintype.length; i++) {
                    var obj = {};
                    var $checkbox = $logintype.eq(i).find(".row").find("input[type=text]");
                    obj.name = $checkbox.attr("name");
                    obj.value = $checkbox.val();
                    sendjson.push(obj);
                }
                console.log(sendjson);

                $(".logindata").val(JSON.stringify(sendjson));
            });


        });
    </script>