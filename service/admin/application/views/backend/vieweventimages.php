<div class="row">
    <div class="col s12">
        <div class="row">
            <div class="col s12 dragable">
                <div class="row">
                    <div class="col m6 l6">
                        <h5 class="panel-title">List of Event Images</h5>
                    </div>
                    <div class="col m6 l6">
                        <a href="#" class="saveOrdering blue darken-4 btn waves-effect waves-light" style="float: right;margin-top: 15px;"><i class='material-icons left'>save</i> Save</a>
                    </div>
                </div>
                <div class="row">
                    <ul class="getordering collection"></ul>

                </div>
            </div>
        </div>
    </div>
      <div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url('site/createEventImages?id=').$this->input->get('id');?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a>
    </div>
</div>
<script>
function drawtable(resultrow) {
      return "<li class='collection-item avatar' data-id='"+resultrow.id+"'><img src='<?php echo base_url('uploads').'/'; ?>"+ resultrow.image +"' class='circle'><span class='title'>" + resultrow.image + "</span><p>" + resultrow.status + "</p><a class='secondary-content blue-text text-darken-4' href='<?php echo site_url('site/editEventImages?id=');?>" + resultrow.id + "&eventid=" + resultrow.eventid + "'><i class='material-icons'>mode_edit</i></a><a class='secondary-content red-text' style='top:50px;' onclick=\"return confirm('Are you sure you want to delete?');\" href='<?php echo site_url('site/deleteEventImages?id='); ?>" + resultrow.id + "&eventid=" + resultrow.eventid + "'><i class='material-icons propericon'>delete</i></a></li>";
    
//     return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.event + "</td><td>" + resultrow.status + "</td><td>" + resultrow.order + "</td><td>" + image + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editEventImages?id=');?>" + resultrow.id + "&eventid=" + resultrow.eventid + "'><i class='material-icons'>mode_edit</i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\" href='<?php echo site_url('site/deleteEventImages?id='); ?>" + resultrow.id + "&eventid=" + resultrow.eventid + "'><i class='material-icons propericon'>delete</i></a></td></tr>";
    }

    getDragDropOrdering("<?php echo $base_url;?>" , "<?php echo $orderfield; ?>","<?php echo $tablename;?>" ,"<?php echo $where;?>");
</script>
<script>
</script>



<!--
<div class="row">
    <div class="col s12">
        <div class="row">
            <div class="col s12 drawchintantable">
               <?php $this->chintantable->createsearch('List of Event Images');?>
                <table class="highlight responsive-table">
                    <thead>
                        <tr>
                            <th data-field="id" data-selectall='true' data-delete-selected="<?php echo $deleteselected;?>">Id</th>
                            <th data-field="event">Event</th>
                            <th data-field="status">Status</th>
                            <th data-field="order">Order</th>
                            <th data-field="image">Image</th>
                            <th data-field="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <?php $this->chintantable->createpagination();?>

    </div>
    <div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url('site/createEventImages?id=').$this->input->get('id');?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a>
    </div>

</div>
<script>
    function drawtable(resultrow) {
 var image = "<a class='img-center' href='<?php echo base_url('uploads').'/'; ?>" + resultrow.image + "' ><img src='<?php echo base_url('uploads').'/'; ?>" + resultrow.image + "' ></a>";
            if (resultrow.image == "") {
                image = "No Receipt Available";
            }
            return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.event + "</td><td>" + resultrow.status + "</td><td>" + resultrow.order + "</td><td>" + image + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editEventImages?id=');?>" + resultrow.id + "&eventid=" + resultrow.eventid + "'><i class='material-icons'>mode_edit</i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\" href='<?php echo site_url('site/deleteEventImages?id='); ?>" + resultrow.id + "&eventid=" + resultrow.eventid + "'><i class='material-icons propericon'>delete</i></a></td></tr>";
    }
    generatejquery('<?php echo $base_url;?>');
</script>
-->
