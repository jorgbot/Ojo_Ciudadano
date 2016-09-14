<div class="row">
    <div class="col s12">
    <h4 class="pad-left-15">Crear Blog</h4>
    </div>
        <form class="col s12" method="post" action="<?php echo site_url('site/createBlogSubmit');?>" enctype="multipart/form-data">

                <div class="row">
                <div class="input-field col s12 m6">
                    <label for="title">Titulo</label>
                    <input type="text" id="title" name="title" value="<?php echo set_value('title');?>">
                </div>
            </div>
            <div class="row">
            <div class="col s12 m6">
                 <label>Contenido</label>
                  <textarea id="some-textarea" name="content" placeholder="Enter text ..."><?php echo set_value('content');?></textarea>
          
            </div>

        </div>
             <div class="row">
                <div class="file-field input-field col s12 m6">
                    <div class="btn blue darken-4">
                        <span>Imagen</span>
                        <input name="image" type="file" multiple>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image');?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m6">
                        <div class=" form-group">
                    <button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Guardar</button>
                    <a href="<?php echo site_url('site/viewBlog'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancelar</a>
            </div>
                </div>
            </div>

        </form>
</div>
