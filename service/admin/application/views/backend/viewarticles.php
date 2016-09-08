<div class="row">
    <div class="col s12">
        <div class="row">
            <div class="col s12 drawchintantable">
                <?php $this->chintantable->createsearch('List of Pages');?>
                <table class="highlight responsive-table">
                    <thead>
                        <tr>
                            <th data-field="id" data-selectall='true' data-delete-selected="<?php echo $deleteselected;?>">Id</th>
                            <th data-field="title">Title</th>
                            <th data-field="status">Status</th>
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

    <div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url('site/createArticles'); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a>
    </div>

</div>
<script>
    function drawtable(resultrow) {
        return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.title + "</td><td>" + resultrow.status + "</td><td>" + resultrow.timestamp + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editArticles?id=');?>" + resultrow.id + "'><i class='material-icons'>mode_edit</i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\" href='<?php echo site_url('site/deleteArticles?id='); ?>" + resultrow.id + "'><i class='material-icons propericon'>delete</i></i></a></td></tr>";
    }
    generatejquery('<?php echo $base_url;?>');
</script>
