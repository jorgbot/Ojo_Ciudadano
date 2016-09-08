<div class="row">
    <div class="col s12">
        <div class="row">
            <div class="col s12 drawchintantable">
               <?php $this->chintantable->createsearch('Config ');?>
                <table class="highlight responsive-table">
                    <thead>
                        <tr>
                                        <th data-field="title">Title</th>
                                        <th data-field="action">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function drawtable(resultrow) {
      if (resultrow.type == 1) {
                resultrow.type = "Text";
            } else if (resultrow.type == 2) {
                resultrow.type = "File";
            } else if (resultrow.type == 3) {
                resultrow.type = "Drop Down";
            }
            return "<tr><td>" + resultrow.title + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 tooltipped' href='<?php echo site_url('site/editConfig?id=');?>" + resultrow.id + "'><i class='material-icons'>mode_edit</i></a></td></tr>";
    }
    generatejquery('<?php echo $base_url;?>');
</script>
