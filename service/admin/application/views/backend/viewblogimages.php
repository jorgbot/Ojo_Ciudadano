<div class="row">
    <div class="col s12">
        <div class="row">
            <div class="col s12 drawchintantable">
               <?php $this->chintantable->createsearch('Lista de Blog con Imagenes');?>
                <table class="highlight responsive-table">
                    <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="blog">Blog</th>
                            <th data-field="status">Estado</th>
            <!--                        <th data-field="order">Order</th>-->
                            <th data-field="image">Imagen</th>
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
    <div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4" href="<?php echo site_url('site/createBlogImages?id=').$this->input->get('id');?>"><i class="material-icons">add</i></a>
    </div>

</div>
<script>
    function drawtable(resultrow) {
        var image = "<a class='img-center' href='<?php echo base_url('uploads').'/'; ?>" + resultrow.image + "' ><img src='<?php echo base_url('uploads').'/'; ?>" + resultrow.image + "'></a>";
        if (resultrow.image == "") {
            image = "Sin Recibo Disponible";
        }
        return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.blog + "</td><td>" + resultrow.status + "</td><td>" + image + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editBlogImages?id=');?>" + resultrow.id + "&blogid=" + resultrow.blogid + "'><i class='material-icons'>mode_edit</i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\" href='<?php echo site_url('site/deleteBlogImages?id='); ?>" + resultrow.id + "&blogid=" + resultrow.blogid + "'><i class='material-icons propericon'>delete</i></a></td></tr>";
    }
    generatejquery('<?php echo $base_url;?>');
</script>
