<div class="row">
    <div class="col s12">
    <h4 class="pad-left-15">Crear Consulta</h4>
    </div>
        <form class="col s12" method="post" action="<?php echo site_url('site/createEnquirySubmit');?>" enctype="multipart/form-data">

            <div class="row">
                <div class="input-field col s12 m6">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" value="<?php echo set_value('name');?>">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <label for="email">Email/Correo</label>
                    <input type="email" id="email" class="form-control" name="email" value="<?php echo set_value('email');?>">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <label for="title">Titulo</label>
                    <input type="text" id="title" name="title" value="<?php echo set_value('title');?>">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <?php echo form_dropdown('user', $user, set_value('user')); ?>
                     <label>Usuario</label>
                </div>
            </div>

             <div class="row">
             <div class="col s12 m6">
                  <label>Contenido</label>
                  <textarea id="some-textarea" name="content" placeholder="Enter text ..."><?php echo set_value('content');?></textarea>

             </div>

        </div>
           <div class="row">
               <div class="col s12 m6">
                       <div class=" form-group">
                    <button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Guardar</button>
                    <a href="<?php echo site_url('site/viewEnquiry'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancelar</a>
            </div>
               </div>
           </div>

        </form>
</div>
