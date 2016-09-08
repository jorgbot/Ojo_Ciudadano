<div class="row">
    <div class="col s12">
        <div class="row">
            <div class="col s12 dragable">
                <div class="row">
                    <div class="col m6 l6">
                        <h5 class="panel-title">List of Image Gallery</h5>
                    </div>
                    <div class="col m6 l6">
                        <a href="#" class="saveOrdering blue darken-4 btn waves-effect waves-light" style="float: right;margin-top: 15px;"><i class='material-icons left'>save</i> Save</a>
                    </div>
                      <table class="highlight responsive-table">
                    <thead>
                      
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                </div>
                <div class="row">
                    <ul class="getordering collection"></ul>
                </div>
            </div>
        </div>
    </div>
     <div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createGallery"); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a>
    </div>
</div>
<script>
function drawtable(resultrow) {
     return "<li class='collection-item avatar' data-id='"+resultrow.id+"'><img src='<?php echo base_url('uploads').'/'; ?>"+ resultrow.image +"' class='circle'><span class='title'>" + resultrow.name + "</span><p>" + resultrow.status + "<br>" + resultrow.timestamp + "</p><a class='secondary-content blue-text text-darken-4' href='<?php echo site_url('site/editGallery?id=');?>" + resultrow.id + "'><i class='material-icons'>mode_edit</i></a><a class='secondary-content red-text' style='top:50px;' onclick=\"return confirm('Are you sure you want to delete?');\" href='<?php echo site_url('site/deleteGallery?id='); ?>" + resultrow.id + "'><i class='material-icons propericon'>delete</i></a></li>";
    }
    
    getDragDropOrdering("<?php echo $base_url;?>" , "<?php echo $orderfield; ?>","<?php echo $tablename;?>" ,"<?php echo $where;?>");
</script>
<script>
</script>
