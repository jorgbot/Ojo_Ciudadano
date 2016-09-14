<section class="panel">
    <div class="panel-body">
        <ul id="nav-mobile">
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'editNotification') {
    echo 'active';
} ?>" href="<?php echo site_url('site/editNotification?id=').$before1; ?>">Detalles de Notificaciones</a></li>
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'viewNotificationUser') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewNotificationUser?id=').$before2; ?>">Notification de Usuario</a></li>
        </ul>
    </div>
</section>
