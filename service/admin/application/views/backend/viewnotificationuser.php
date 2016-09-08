<div class="row">
    <div class="col s12">
        <div class="row">
            <div class="col s12 drawchintantable">
               <?php $this->chintantable->createsearch("List of Notification Users");?>
                <table class="highlight responsive-table">
                    <thead>
                        <tr>
                          <th data-field="id">ID</th>
                          <th data-field="notification">Notification</th>
                          <th data-field="user">User</th>
                          <th data-field="timestamp">Timestamp</th>
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
    <div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light green accent-4" href="<?php echo site_url("site/createNotificationUser?id=").$this->input->get('id');?>"><i class="material-icons">add</i></a>
    </div>

</div>
<script>
    function drawtable(resultrow) {
         return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.notification + "</td><td>" + resultrow.user + "</td><td>" + resultrow.timestamp + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light orange lighten-1' href='<?php echo site_url('site/editNotificationUser?id=');?>" + resultrow.id + "&notificationid=" + resultrow.notificationid + "'><i class='material-icons'>mode_edit</i></a><a class='btn btn-danger btn-xs waves-effect waves-light red' onclick=\"return confirm('Are you sure you want to delete?');\" href='<?php echo site_url('site/deleteNotificationUser?id='); ?>" + resultrow.id + "&notificationid=" + resultrow.notificationid + "'><i class='material-icons propericon'>delete</i></a></td></tr>";
    }
    generatejquery('<?php echo $base_url;?>');
</script>
