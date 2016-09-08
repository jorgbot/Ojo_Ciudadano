<section class="row offset-s4">
    <div class="col s12">
        <h4 class="pad-left-15">Config -> Blog</h4>
    </div>
    <div class="col s12 m6">
        <div class="logintype cms">
            <div class="row checkbox">
                <div class="col s6">
                    <label for="filled-in-box" class="form-checkbox">CMS</label>
                </div>
                <div class="col s6">
                    <div class="switch">
                        <label>
                            Off
                            <input type="checkbox" name="cms">
                            <span class="lever"></span> On
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="logintype facebookLogin">
            <div class="row checkbox">
                <div class="col s6">
                    <label for="filled-in-box" class="form-checkbox">Wordpress</label>
                </div>
                <div class="col s6">
                    <div class="switch">
                        <label>
                            Off
                            <input type="checkbox" name="wordpress">
                            <span class="lever"></span> On
                        </label>
                    </div>
                </div>
            </div>
            <div class="sublogintype" style=" min-height: 110px;">
                <div class="input-field col s12">
                    <label for="appid">Wordpress User Name</label>
                    <input type="text" id="appid" name="appid">
                </div>
            </div>
        </div>
        <div class="logintype wordpressSelf">
            <div class="row checkbox">
                <div class="col s6">
                    <label for="filled-in-box" class="form-checkbox">Self Hosted Wordpress</label>
                </div>
                <div class="col s6">
                    <div class="switch">
                        <label>
                            Off
                            <input type="checkbox" name="wordpressself">
                            <span class="lever"></span> On
                        </label>
                    </div>
                </div>
            </div>
            <div class="sublogintype" style=" min-height: 110px;">
                <div class="input-field col s12">
                    <label for="appid">Self Hosted Wordpress URL</label>
                    <input type="text" id="appid" name="appid">
                </div>
            </div>

        </div>
      
        
        <div class="logintype twitterLogin">
            <div class="row checkbox">
                <div class="col s6">
                    <label for="filled-in-box" class="form-checkbox">Tumblr</label>
                </div>
                <div class="col s6">
                    <div class="switch">
                        <label>
                            Off
                            <input type="checkbox" name="tumblr">
                            <span class="lever"></span> On
                        </label>
                    </div>
                </div>
            </div>
            <div class="sublogintype" style=" min-height: 110px;">
                <div class="input-field col s12">
                    <label for="appid">Tumblr User Name</label>
                    <input type="text" id="appid" name="appid">
                </div>
            </div>

        </div>

        <div class="hidden123">

            <form class='form-horizontal tasi-form loginform' method='post' action='<?php echo site_url("site/editConfigSubmit");?>' enctype='multipart/form-data'>
                <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">

                <div class="form-group" style="display:none">
                    <label class="col-sm-2 control-label" for="normal-field">Title</label>
                    <div class="col-sm-4">
                        <input type="text" id="normal-field" class="form-control" name="title" value='<?php echo set_value(' title ',$before->title);?>'>
                    </div>
                </div>
                <div class=" form-group" style="display:none">
                    <label class="col-sm-2 control-label" for="normal-field">Content</label>
                    <div class="col-sm-8">
                        <textarea name="content" id="" cols="20" rows="10" class="form-control tinymce">
                            <?php echo set_value( 'content',$before->content);?>
                        </textarea>
                    </div>
                </div>

                <div class=" form-group" style="display:none">
                    <label class="col-sm-2 control-label" for="normal-field">Text</label>
                    <div class="col-sm-8">
                        <textarea name="text" class="logindata" id="textid" cols="20" rows="10" class="form-control tinymce">
                            <?php echo set_value( 'text',$before->text);?>
                        </textarea>
                    </div>
                </div>

                <div class=" form-group" style="display:none">
                    <label class="col-sm-2 control-label" for="normal-field">Type</label>
                    <div class="col-sm-4">
                        <?php echo form_dropdown( "type",$type,set_value( 'type',$before->type));?>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <div class="submitlogin">
                            <button class="btn waves-effect waves-light blue darken-4 loginsubmit" type="submit" name="action">Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>
</section>

<script>
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
            //                var obj = {};
            var $checkbox = $logintype.eq(i).children(".checkbox").find("input[type=checkbox]");
            var $inputs = $logintype.eq(i).children(".sublogintype").find("input");
            console.log(alldata[i]);
            
            $inputs.eq(0).val(alldata[i].appid);

            if (alldata[i].value == true) {
                $checkbox.prop("checked", true);
                checkboxclick($checkbox);
            }
        }


        $(".logintype input[type=checkbox]").click(function( ) {
            checkboxclick(this);
        });

        $("button.loginsubmit").click(function () {
            var sendjson = [];
            var $logintype = $(".logintype");
            $logint = $logintype;
            for (var i = 0; i < $logintype.length; i++) {
                var obj = {};
                var $checkbox = $logintype.eq(i).children(".checkbox").find("input[type=checkbox]");
                var $inputs = $logintype.eq(i).children(".sublogintype").find("input");
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

            var $sublogin = $(checkbox).parents(".logintype").children(".sublogintype");
            if (shouldshow) {
                
                var $inputs=$(".logintype input[type=checkbox]");
                for(var i=0;i<$inputs.length;i++)
                {
                    console.log($inputs.eq(i)==$(checkbox));
                    if($inputs.eq(i).prop("checked"))
                    {
                       $inputs.eq(i).prop("checked",false);
                        checkboxclick($inputs.eq(i));
                    }
                }   
                $(checkbox).prop("checked",true)
                
                $sublogin.show(200);
            } else {
                $sublogin.hide(200);
            }
        }
      
    });
</script>