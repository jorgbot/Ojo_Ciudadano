<div class="row">
    <div class="col s12">
        <div class="row">
            <div class="col s12 drawchintantable">
                 <?php $this->chintantable->createsearch('Lista de Usuarios');?>
                <table class="highlight responsive-table">
                    <thead>
                        <tr>
                            <th data-field="id" data-selectall='true' data-delete-selected="<?php echo $deleteselected;?>">Id</th>
                            <th data-field="name">Nombre</th>
                            <th data-field="email">Correo</th>
                            <th data-field="logintype">Tipo Inicio</th>
                            <th data-field="accesslevelname">Nivel Acceso</th>
                            <th data-field="">Accion</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <?php $this->chintantable->createpagination();?>

    </div>
     <div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url('site/createUser'); ?>" data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>

</div>
<script>
    function drawtable(resultrow) {
        if (!resultrow.username) {
            resultrow.username = "";
        }
        if (!resultrow.logintype) {
            resultrow.logintype = "";
        }
        if (!resultrow.json) {
            resultrow.json = "";
        }
        return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.name + "</td><td>" + resultrow.email + "</td><td>" + resultrow.logintype + "</td><td>" + resultrow.accesslevelname + "</td><td><a class='btn waves-effect waves-light  blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/edituser?id=');?>" + resultrow.id + "'><i class='material-icons'>mode_edit</i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\" href='<?php echo site_url('site/deleteUser?id='); ?>" + resultrow.id + "'><i class='material-icons propericon'>delete</i></a></td><tr>";
    }
    generatejquery('<?php echo $base_url;?>');
</script>
