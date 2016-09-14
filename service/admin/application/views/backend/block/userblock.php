<section class="panel">
    <div class="panel-body">
        <ul class="nav nav-stacked">
            <li><a class="<?php if ($this->uri->segment(2) == 'edituser') {
    echo 'active';
} ?>" href="<?php echo site_url('site/edituser?id=').$before->id; ?>">Detalles de Usuario</a></li>
            <li><a class="<?php if ($this->uri->segment(2) == 'editAddress') {
    echo 'active';
} ?>" href="<?php echo site_url('site/editAddress?id=').$before->id; ?>">Direccion</a></li>
            <li><a class="<?php if ($this->uri->segment(2) == 'viewuserinterestevents') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewuserinterestevents?id=').$before->id; ?>">Eventos Favoritos de Usuario</a></li>
        </ul>
    </div>
</section>
