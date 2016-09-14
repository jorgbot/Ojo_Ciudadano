<div class="row">
    <div class="col s12">
    <h4 class="pad-left-15">Editar Consulta</h4>
    </div>
</div>
<div class="row">
    <form class="col s12" method="post" action="<?php echo site_url('site/editEnquirySubmit');?>" enctype="multipart/form-data">
        <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id', $before->id);?>" style="display:none;">

         <div class="row">
            <div class="input-field col s12 m6">
                <?php echo form_dropdown('user', $user, set_value('user', $before->user)); ?>
                 <label>Usuario</label>
            </div>
        </div>
            <div class="row">
            <div class="input-field col s12 m6">
                <label>Nombre</label>
                <input type="text" name="name" value="<?php echo set_value('name', $before->name);?>">
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6">
                <label for="email">Email</label>
                <input type="email" id="normal-field" class="form-control" name="email" value="<?php echo set_value('email', $before->email);?>">
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6">
                <label for="title">Asunto</label>
                <input type="text" id="title" name="title" value="<?php echo set_value('title', $before->title);?>">
            </div>
        </div>
           <div class="row">
            <div class="input-field col s12 m6">
                <label for="timestamp">Fecha</label>
                <input type="text" readonly="true" id="timestamp" name="timestamp" value="<?php echo set_value('timestamp', $before->timestamp);?>">
            </div>
        </div>
           <div class="row">
                 <div class="col s12 m6">
                       <label>Comentario</label>
                        <textarea name="content" placeholder="Ingrese texto ..."><?php echo set_value('content', $before->content);?></textarea>
                 </div>

            </div>
<div class="row">
    <div class="col s12 m6">
        <div class=" form-group">
                <a href="<?php echo site_url('site/viewEnquiry'); ?>" class="btn btn-secondary waves-effect waves-light blue darken-4">Atras</a>
            </div>
    </div>
</div>

    </form>
</div>
