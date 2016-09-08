<div class="row">
    <div class="col s12">
        <h4 class="pad-left-15">Create Notifications</h4>
    </div>
    <form class="col s12" method="post" action="<?php echo site_url('site/createNotificationSubmit');?>" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s12 m6">
                <?php echo form_dropdown('linktype', $linktype, set_value('linktype', $showdropdown)); ?>
                 <label>Link Type</label>
            </div>
        </div>
        <!--	Event-->
        <div class="row drop">
            <div class="input-field col s12 m6">
                <?php echo form_dropdown('event', $event, set_value('event')); ?>
                 <label>Event</label>
            </div>
        </div>

        <!--	Blog-->
        <div class="row drop">
            <div class="input-field col s12 m6">
                <?php echo form_dropdown('blog', $blog, set_value('blog')); ?>
                 <label>Blog</label>

            </div>
        </div>

        <!--	Gallery-->
        <div class="row drop">
            <div class="input-field col s12 m6">
                <?php echo form_dropdown('video', $video, set_value('video')); ?>
                 <label>Video Gallery</label>

            </div>
        </div>

        <!--	Video-->
        <div class="row drop">
            <div class="input-field col s12 m6">
                <?php echo form_dropdown('gallery', $gallery, set_value('gallery')); ?>
                 <label>Image Gallery</label>

            </div>
        </div>

        <!--	Article-->
        <div class="row drop">
            <div class="input-field col s12 m6">
                <?php echo form_dropdown('article', $article, set_value('article')); ?>
                 <label>Page</label>
            </div>
        </div>
        <!--	External link-->
        <div class="row drop">
            <div class="input-field col s12 m6">
                <label for="link">External link</label>
                <input type="text" id="link" name="link" value="<?php echo set_value('link');?>">
            </div>
        </div>


        <div class="row">
            <div class="input-field col s12 m6">
                <?php echo form_dropdown('status', $status, set_value('status')); ?>
                 <label>Status</label>
            </div>
        </div>

        <div class="row">
            <div class="file-field input-field col s12 m6">
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
            <div class="input-field col s12 m6">
                <textarea id="content" name="content" class="materialize-textarea"></textarea>
                <label for="content">Content</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                    <div class=" form-group">
                <button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
                <a href="<?php echo site_url('site/viewNotification'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
        </div>
            </div>
        </div>

    </form>
</div>
<script type="text/javascript">
    //dropdown function
    var $linktype;
    var $sub;
    var $i;
    var $typeid;
    var $event = $('select[name=event]');
    var $article = $('select[name=article]');
    var $video = $('select[name=video]');
    var $gallery = $('select[name=gallery]');
    var $blog = $('select[name=blog]');
    var $link = $('#link');

    function hideshow(id, data) {
        for ($i = 0; $i < $sub.length; $i++) {
            $sub.eq($i).prop("hidden", true);
        }
        $sub.eq(id).prop("hidden", false);
        console.log(data.val());
        $typeid = data.val();

    }




    $(document).ready(function () {
        //jquery to dropdown
        console.log("on deady");
        $event.change(function () {
            $("#typeid").val($event.val());
        });
        $article.change(function () {
            $("#typeid").val($article.val());
        });
        $video.change(function () {
            $("#typeid").val($video.val());
        });
        $gallery.change(function () {
            $("#typeid").val($gallery.val());
        });
        $blog.change(function () {
            $("#typeid").val($blog.val());
        });
        $link.change(function () {
            $("#typeid").val($link.val());
        });

        $sub = $(".drop");
        for ($i = 0; $i < $sub.length; $i++) {
            $sub.eq($i).prop("hidden", true);
        }

        //my changes
        $linktype = $('select[name=linktype]');
        $linktype.change(function () {
            console.log("on change");
            switch ($linktype.val()) {
            case "2":
                {
                    hideshow(4, $('select[name=article]'));
                    $typeid = $('select[name=article]').val();
                }
                break;
            case "3":
                {
                    hideshow(0, $('select[name=event]'));
                    $typeid = $('select[name=event]').val();
                }
                break;
            case "6":
                {
                    hideshow(3, $('select[name=gallery]'));
                    $typeid = $('select[name=gallery]').val();
                }
                break;
            case "8":
                {
                    hideshow(2, $('select[name=video]'));
                    $typeid = $('select[name=video]').val();
                }
                break;
            case "10":
                {
                    hideshow(1, $('select[name=blog]'));
                    $typeid = $('select[name=blog]').val();
                }
                break;
            case "17":
                {
                    hideshow(5, $('select[name=link]'));
                    $typeid = $('select[name=link]').val();
                }
                break;
            default:
                {
                    console.log("in deault");
                    for ($i = 0; $i < $sub.length; $i++) {
                        $sub.eq($i).prop("hidden", true);
                    }
                }
            }

        });

    });
</script>
